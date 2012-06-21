<?php

/**
 * 
 * Copyright (c) 2012 <copyright Aruba spa>
 * Permission is hereby granted, free of charge, to any person obtaining a copy of this software 
 * and associated documentation files (the "Software"), to deal in the Software without restriction, 
 * including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, 
 * and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, 
 * subject to the following conditions:
 * The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
 * 
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES 
 * OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. 
 * IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, 
 * WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS 
 * IN THE SOFTWARE.
 * 
 */

App::uses('AppController', 'Controller');
App::uses('VDCResourceBoundsConfig', 'Aruba');
App::uses('AppHypervisor', 'Aruba');
App::uses('AppTemplateDetails','Aruba');
App::uses('AppResourceBound','Aruba');
App::uses('AppTemplateDetails', 'Aruba');
App::uses('NewCloudServer', 'Aruba');

/**
 * NewCloudServers Controller
 *
 * @property NewCloudServer $NewCloudServer
 */
class NewCloudServersController extends AppController {

	public $components = array('RequestHandler');

	/**
	 * Helpers
	 *
	 * @var array
	 */
	public $helpers = array('Html', 'Form');

	/**
	 * index method
	 *
	 * @return void
	 */
	public function index() {
		$this->redirect("view");
	}
	
	public function view() {
		
		$this->NewCloudServer->load();
		//if(!CakeSession::check('vdcConfig')){
		$vdcConfig = $this->NewCloudServer->getWsEndUserVDCConfigClient()->getVDCResourceConfiguration();
		CakeSession::write('vdcConfig',$vdcConfig);				
		//}		
		$this->set('NewCloudServer', $this->NewCloudServer);		
	}

	public function createServer() {
		
		if ($this->request->is('post')) {
										
			$this->NewCloudServer->set($this->request->data);
			$data = $this->request->data['NewCloudServer'];
			
			$this->NewCloudServer->SelectedHypervisorType = $data['Hypervisor'];
			$this->NewCloudServer->SelectedTemplateProdId = $data['OSTemplate'];
			$this->NewCloudServer->SelectedCPUNum = $data['CPU'];
			$this->NewCloudServer->SelectedRAMNum = $data['RAM'];
			
			for ($d = 0; $d < 4; $d++) {
				if (isset($data['DiskSize' .$d])) {			
					$this->NewCloudServer->SelectedDisksSize[$d] = $data['DiskSize' .$d]; 
				}	
			}
			$this->NewCloudServer->load($data['Hypervisor'], $data['OSTemplate']);					
			$this->set('NewCloudServer', $this->NewCloudServer);
						
			if ($this->NewCloudServer->validate() ) {
				
				$result =  $this->NewCloudServer->invokeServerCreation();
				
				if ($result != null && $result->isSuccess()) {					
				
					$this->render("inprogress"); // or redirect to the "inprogress" page..				
				} 
				else {					
					$this->render("view");
				}								
			}
			else {
				$this->Session->setFlash(__('There are some validation problem. Please, check your ethernet fields'));
				$this->render("view");
			}
		}
		else {
			throw new MethodNotAllowedException();						
		}	
	}
	
	public function loadTemplates($hypervisorType) {
		$jsonResp = '';
		if ($hypervisorType != null) {
						
			$this->RequestHandler->setContent('json', 'application/json');
			$this->layout = 'ajax';
			
			if(!CakeSession::check('vdcConfig')){
				$vdcConfig = $this->NewCloudServer->getWsEndUserVDCConfigClient()->getVDCResourceConfiguration();
				CakeSession::write('vdcConfig',$vdcConfig);				
			}
			// retrieving data...
			$vdcConfig = CakeSession::read('vdcConfig');
			
			$data = array();						
			foreach($vdcConfig->getTemplatesFor($hypervisorType) as $osTemplate) {
				$data[] = array('itemId' => $osTemplate->ProductId, 'description' => $osTemplate->Description);
			}
			
			$jsonResp= json_encode($data);
		}
		$this->set('jsonResp', $jsonResp);
		$this->render("ajaxresp");
	}

	public function loadCPUs($hypervisorType, $osTemplateProdId) {
		
		$jsonResp = '';
		if ($hypervisorType != null && $osTemplateProdId != null) {
			$this->RequestHandler->setContent('json', 'application/json');
			$this->layout = 'ajax';

//			if(!CakeSession::check('vdcConfig')){
//				$vdcConfig = $this->NewCloudServer->getWsEndUserVDCConfigClient()->getVDCResourceConfiguration();
//				CakeSession::write('vdcConfig',$vdcConfig);				
//			}
			// retrieving data...			
			$vdcConfig = CakeSession::read('vdcConfig');						
			$AppCPUsBound = $vdcConfig->getResourceBounds($hypervisorType,$osTemplateProdId, AppResourceType::CPU);			
		
			$data = array();
			if(isset($AppCPUsBound)){					
				for ($i = $AppCPUsBound->getMin(); $i <= $AppCPUsBound->getMax(); $i++) {
					$data[] = array('itemId' => $i, 'description' => $i);					
				}				
			}
			
			$jsonResp= json_encode($data);
		}
		$this->set('jsonResp', $jsonResp);
		$this->render("ajaxresp");
	}
	
	public function loadRAMs($hypervisorType, $osTemplateProdId) {
		$jsonResp = '';
		if ($hypervisorType != null && $osTemplateProdId != null) {
			$this->RequestHandler->setContent('json', 'application/json');
			$this->layout = 'ajax';

//			if(!CakeSession::check('vdcConfig')){
//				$vdcConfig = $this->NewCloudServer->getWsEndUserVDCConfigClient()->getVDCResourceConfiguration();
//				CakeSession::write('vdcConfig',$vdcConfig);				
//			}
			
			// retrieving data...
			$vdcConfig = CakeSession::read('vdcConfig');									
			$AppRAMsBound = $vdcConfig->getResourceBounds($hypervisorType,$osTemplateProdId, AppResourceType::RAM);
			
			$data = array();
			if(isset($AppRAMsBound)){					
				for ($i = $AppRAMsBound->getMin(); $i <= $AppRAMsBound->getMax(); $i++) {
					$data[] = array('itemId' => $i, 'description' => $i);
				}
			}			
			 
			$jsonResp= json_encode($data);
		}
		$this->set('jsonResp', $jsonResp);
		$this->render("ajaxresp");
	}

	public function loadHDBounds($hypervisorType, $osTemplateProdId) {
		$jsonResp = '';
		if ($hypervisorType != null && $osTemplateProdId != null) {
			$this->RequestHandler->setContent('json', 'application/json');
			$this->layout = 'ajax';

//			if(!CakeSession::check('vdcConfig')){
//				$vdcConfig = $this->NewCloudServer->getWsEndUserVDCConfigClient()->getVDCResourceConfiguration();
//				CakeSession::write('vdcConfig',$vdcConfig);				
//			}	

			// retrieving data...
			$vdcConfig = CakeSession::read('vdcConfig');
			$data = array();
			$hdBounds = $vdcConfig->getResourceBounds($hypervisorType, $osTemplateProdId, AppResourceType::HARD_DISK_0);
			$data[0] = array(
				array('boundKey' => 'Min:', 'boundValue' => $hdBounds->getMin()),
				array('boundKey' => 'Default:', 'boundValue' => $hdBounds->getDefault()),
				array('boundKey' => 'Max:', 'boundValue' => $hdBounds->getMax()));				
			$hdBounds = $vdcConfig->getResourceBounds($hypervisorType, $osTemplateProdId, AppResourceType::HARD_DISK_1);
			$data[1] = array(
				array('boundKey' => 'Min:', 'boundValue' => $hdBounds->getMin()),
				array('boundKey' => 'Default:', 'boundValue' => $hdBounds->getDefault()),
				array('boundKey' => 'Max:', 'boundValue' => $hdBounds->getMax()));
			$hdBounds = $vdcConfig->getResourceBounds($hypervisorType, $osTemplateProdId, AppResourceType::HARD_DISK_2);
			$data[2] = array(
				array('boundKey' => 'Min:', 'boundValue' => $hdBounds->getMin()),
				array('boundKey' => 'Default:', 'boundValue' => $hdBounds->getDefault()),
				array('boundKey' => 'Max:', 'boundValue' => $hdBounds->getMax()));
			$hdBounds = $vdcConfig->getResourceBounds($hypervisorType, $osTemplateProdId, AppResourceType::HARD_DISK_3);
			$data[3] = array(
				array('boundKey' => 'Min:', 'boundValue' => $hdBounds->getMin()),
				array('boundKey' => 'Default:', 'boundValue' => $hdBounds->getDefault()),
				array('boundKey' => 'Max:', 'boundValue' => $hdBounds->getMax()));
										
			$jsonResp= json_encode($data);
		}
		$this->set('jsonResp', $jsonResp);
		$this->render("ajaxresp");			
	}
	


}
