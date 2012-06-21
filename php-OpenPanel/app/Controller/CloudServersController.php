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
/**
 * CloudServers Controller
 *
 * @property CloudServer $CloudServer
 */
class CloudServersController extends AppController {


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
		$this->set('CloudServers', $this->paginate());
	}


	public function view($ServerId = null, $CloudServer=null) {

		if(!CakeSession::check('vdcConfig')){
			$vdcConfig = $this->CloudServer->getWsEndUserVDCConfigClient()->getVDCResourceConfiguration();
			CakeSession::write('vdcConfig',$vdcConfig);
		}

		if($CloudServer==null){
			$CloudServer = $this->CloudServer->load($ServerId);
			if ($CloudServer == null || !isset($CloudServer) || $CloudServer->AppServerDetail==null) {
				throw new NotFoundException(__('Invalid Cloud Server'));
			}
		}
		$this->set('CloudServer', $CloudServer);
	}


	/**
	 * delete method
	 *
	 * @param string $id
	 * @return void
	 */
	public function delete($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}

		$result = $this->CloudServer->removeServer($id);
			
		if ($result->isSuccess()) {
			$this->Session->setFlash(__('The Cloud Server has been removed'));
		}
		else {
			$this->Session->setFlash(__('The Cloud Server could not be removed. Please, try again.').$result->getErrorDescription());
		}
		$this->redirect(array('action' => 'index'));
	}

	/**
	 * start method
	 *
	 * @param string $id
	 * @return void
	 */
	public function start($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}

		$result = $this->CloudServer->startServer($id);
			
		if ($result->isSuccess()) {
			$this->Session->setFlash(__('The Start command has been sent'));
		}
		else {
			$this->Session->setFlash(__('The Start command could not be sent. Please, try again.').$result->getErrorDescription());
		}
		$this->redirect(array('action' => 'view',$id));
	}

	/**
	 * stop method
	 *
	 * @param string $id
	 * @return void
	 */
	public function stop($id = null) {

		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}

		$result = $this->CloudServer->stopServer($id);
			
		if ($result->isSuccess()) {
			$this->Session->setFlash(__('The Stop command has been sent'));

		} else {
			$this->Session->setFlash(__('The Stop command could not be sent. Please, try again.').$result->getErrorDescription());
		}
			
		$this->redirect(array('action' => 'view',$id));
	}

	/**
	 * powerOff method
	 *
	 * @param string $id
	 * @return void
	 */
	public function powerOff($id = null) {

		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}

		$result = $this->CloudServer->powerOffServer($id);
			
		if ($result->isSuccess()) {
			$this->Session->setFlash(__('The PowerOff command has been sent'));

		}
		else {
			$this->Session->setFlash(__('The PowerOff command could not be sent. Please, try again.').$result->getErrorDescription());
		}
			
		$this->redirect(array('action' => 'view',$id));
	}

	/**
	 * reset method
	 *
	 * @param string $id
	 * @return void
	 */
	public function reset($id = null) {

		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}

		$result = $this->CloudServer->resetServer($id);
			
		if ($result->isSuccess()) {
			$this->Session->setFlash(__('The Reset command has been sent'));

		} else {
			$this->Session->setFlash(__('The Reset command could not be sent. Please, try again.').$result->getErrorDescription());
		}
			
		$this->redirect(array('action' => 'view',$id));
	}

	/**
	 * archive method
	 *
	 * @param string $id
	 * @return void
	 */
	public function archive($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}

		$result = $this->CloudServer->archiveServer($id);
			
		if ($result->isSuccess()) {
			$this->Session->setFlash(__('The Archive command has been sent'));

		}
		else {
			$this->Session->setFlash(__('The Archive command could not be sent. Please, try again.').$result->getErrorDescription());
		}
			
		$this->redirect(array('action' => 'view',$id));
	}

	/**
	 * restore method
	 *
	 * @param string $id
	 * @return void
	 */
	public function restore($id = null, $cpu = 1, $ram = 1) {

		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}

		$result = $this->CloudServer->restoreServer($id, $cpu, $ram);
			
		if ($result->isSuccess()) {
			$this->Session->setFlash(__('The Restore command has been sent'));

		}
		else {
			$this->Session->setFlash(__('The Restore command could not be sent. Please, try again.').$result->getErrorDescription());
		}
			
		$this->redirect(array('action' => 'view',$id));
	}


	public function connectVirtualSwitch() {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}

		$ServerId = $this->request->data['serverId'];
		$networkAdapterId = $this->request->data['vlanNetAdpId'];
		$vLanResourceId = $this->request->data['CloudServer']['VlanResourceId'];

		$result = $this->CloudServer->connectVirtualSwitch($vLanResourceId, $networkAdapterId);
			
		if ($result->isSuccess()) {
			$this->Session->setFlash(__('The Connect Virtual Switch command has been sent'));
		}
		else {
			$this->Session->setFlash(__('The Connect Virtual Switch command could not be sent. Please, try again.').$result->getErrorDescription());
		}
			
		$this->redirect(array('action' => 'view',$ServerId));
	}

	public function connectIps(){
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}

		$ServerId = $this->request->data['serverId'];
		$networkAdapterId = $this->request->data['ipNetAdpId'];
		$ipResourceIds = array();
		if (isset($this->request->data['CloudServer'])) {
			foreach ($this->request->data['CloudServer'] as $key => $selId){
				if($selId>0 && ('ipResourceId_'.$selId == $key)){
					$ipResourceIds[]=$selId;
				}
			}
		}
		if(sizeof($ipResourceIds)>0){

			$result = $this->CloudServer->connectIps($ipResourceIds, $networkAdapterId);

			if ($result->isSuccess()) {
				$this->Session->setFlash(__('The Connect IPs command has been sent'));
					
			} else {
				$this->Session->setFlash(__('The Connect IPs command could not be sent. Please, try again.').$result->getErrorDescription());
			}

			$this->redirect(array('action' => 'view',$ServerId));
		}
		else{
			$this->set('showAddIpDlg',true);
			$this->set('addIpDlg_message',__("Select at least one Public IP"));
			$this->view($ServerId);
			$this->render('view');

		}
	}


	public function disconnectIps(){
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}

		$ServerId = $this->request->data['serverId'];
		$networkAdapterId = $this->request->data['ipNetAdpId'];
		$ipResourceIds = array();
		if (isset($this->request->data['CloudServer'])) {
			foreach ($this->request->data['CloudServer'] as $key => $selId){
				if($selId>0 && ('ipResourceId_'.$selId == $key)){
					$ipResourceIds[]=$selId;
				}
			}
		}
		if(sizeof($ipResourceIds)>0){

			$result = $this->CloudServer->disconnectIps($ipResourceIds, $networkAdapterId);

			if ($result->isSuccess()) {
				$this->Session->setFlash(__('The Disconnect IPs command has been sent'));
					
			} else {
				$this->Session->setFlash(__('The Disconnect IPs command could not be sent. Please, try again.').$result->getErrorDescription());
			}

			$this->redirect(array('action' => 'view',$ServerId));
		}
		else{
			$this->set('showDelIpDlg',true);
			$this->set('delIpDlg_message',__("Select at least one Public IP"));
			$this->view($ServerId);
			$this->render('view');

		}
	}


	public function disconnectVirtualSwitch() {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}

		$ServerId = $this->request->data['serverId'];
		$networkAdapterId = $this->request->data['vlanNetAdpId'];
		$vLanResourceId = $this->request->data['VlanResourceId'];


		$result = $this->CloudServer->disconnectVirtualSwitch($vLanResourceId, $networkAdapterId);
			
		if ($result->isSuccess()) {
			$this->Session->setFlash(__('The Disconnect Virtual Switch command has been sent'));

		} else {
			$this->Session->setFlash(__('The Disconnect Virtual Switch command could not be sent. Please, try again.').$result->getErrorDescription());
		}
			
		$this->redirect(array('action' => 'view',$ServerId));
	}

	public function removeDisk($ServerId,$DiskNum) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
			
		$result = $this->CloudServer->removeDisk($ServerId,$DiskNum);
			
		if ($result->isSuccess()) {
			$this->Session->setFlash(__('The Remove Disk command has been sent'));
		}
		else {
			$this->Session->setFlash(__('The Remove Disk command could not be sent. Please, try again.').$result->getErrorDescription());
		}
			
		$this->redirect(array('action' => 'view',$ServerId));
	}

	public function updateDisk($ServerId,$DiskNum,$DiskSize) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}

		$CloudServer = $this->checkCloudServerExist($ServerId);

		$this->CloudServer->set($this->request->data);
		$currSize=0;
		if($CloudServer->AppServerDetail->isDiskInUse($DiskNum)){
			$currSize = $CloudServer->AppServerDetail->getDiskSize($DiskNum);
		}
		if($this->CloudServer->validateHd($CloudServer->AppHDxBound[$DiskNum], $DiskNum, $currSize)){


			if(!$CloudServer->AppServerDetail->isDiskInUse($DiskNum)){
				$result = $this->CloudServer->createDisk($ServerId,$DiskNum,$DiskSize);
				$commandOk=__('The Create Disk command has been sent');
				$commandKo=__('The Create Disk command could not be sent. Please, try again.');
			}
			else{
				$result = $this->CloudServer->resizeDisk($ServerId,$DiskNum,$DiskSize);
				$commandOk=__('The Resize Disk command has been sent');
				$commandKo=__('The Resize Disk command could not be sent. Please, try again.');
			}

			if ($result->isSuccess()) {
				$this->Session->setFlash($commandOk);
			} else {
				$this->Session->setFlash($commandKo);
			}

			$this->redirect(array('action' => 'view',$ServerId));
		}
		else{
			$showServerDiskEdit=array($DiskNum=>true);
			$this->set("showServerDiskEdit",$showServerDiskEdit);
			$this->view($ServerId,$CloudServer);
			$this->render('view');
		}
	}


	private function checkCloudServerExist($ServerId){
		$CloudServer = $this->CloudServer->load($ServerId);
		if ($CloudServer == null || !isset($CloudServer) || $CloudServer->AppServerDetail==null) {
			throw new NotFoundException(__('Invalid Cloud Server'));
		}
		return $CloudServer;
	}


	public function renameServer($ServerId) {

		if ($this->request->is('post')) {

			$this->CloudServer->set($this->request->data);
			if($this->CloudServer->validateName()){
				$result = $this->CloudServer->renameServer($ServerId, $this->request->data['CloudServer']['Name']);

				if ($result->isSuccess()) {
					$this->Session->setFlash(__('The Cloud Server has been renamed'));

				} else {
					$this->Session->setFlash(__('The Cloud Server could not be renamed. Please, try again.').$result->getErrorDescription());
				}
				$this->redirect(array('action' => 'view',$ServerId));
			}
			else{
				$this->set("showServerNameEdit",true);
				$this->view($ServerId);
				$this->render('view');
			}
		}else{
			$this->redirect(array('action' => 'view',$ServerId));
		}
	}

	public function modifyCpus($ServerId) {


		if ($this->request->is('post')) {

			$this->CloudServer->set($this->request->data);

			$CloudServer = $this->checkCloudServerExist($ServerId);
			if($this->CloudServer->validateCpu($CloudServer->AppCPUsBound)){
				$result = $this->CloudServer->modifyCpus($ServerId, $this->request->data['CloudServer']['Cpus']);

				if ($result->isSuccess()) {
					$this->Session->setFlash(__('The Modify CPUs command has been sent'));

				} else {
					$this->Session->setFlash(__('The Modify CPUs command could not be sent. Please, try again.').$result->getErrorDescription());
				}
				$this->redirect(array('action' => 'view',$ServerId));
			}else{
				$this->set("showServerCpusEdit",true);
				$this->view($ServerId,$CloudServer);
				$this->render('view');
			}
		}else{
			$this->redirect(array('action' => 'view',$ServerId));
		}
	}

	public function modifyRams($ServerId) {


		if ($this->request->is('post')) {

			$this->CloudServer->set($this->request->data);
			$CloudServer = $this->checkCloudServerExist($ServerId);
			if($this->CloudServer->validateRam($CloudServer->AppRAMsBound)){
				$result = $this->CloudServer->modifyRams($ServerId, $this->request->data['CloudServer']['Rams']);

				if ($result->isSuccess()) {
					$this->Session->setFlash(__('The Modify RAMs command has been sent'));

				} else {
					$this->Session->setFlash(__('The Modify RAMs command could not be sent. Please, try again.').$result->getErrorDescription());
				}
				$this->redirect(array('action' => 'view',$ServerId));
			}
			else{
				$this->set("showServerRamsEdit",true);
				$this->view($ServerId,$CloudServer);
				$this->render('view');
			}
		}
		else{
			$this->redirect(array('action' => 'view',$ServerId));
		}
	}



}
