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

App::uses('AppModel', 'Model');
App::uses('AppServerDetails', 'Aruba');
App::uses('VDCResourceBoundsConfig', 'Aruba');
App::uses('AppHypervisor', 'Aruba');
App::uses('AppTemplateDetails','Aruba');
App::uses('AppResourceBound','Aruba');
App::uses('AppTemplateDetails', 'Aruba');
/**
 * CloudServer Model
 *
 */
class CloudServer extends AppModel {
		
  	public $AppServerDetail;
  	
  	/**
  	 * array of unconnected Ips
  	 * 
  	 * @var array AppIPAddress
  	 */
  	public $AvailableIps;
  	 	
  	
  	/**
  	 * array of VirtualSwitches not jet connected to $AppServerDetail
  	 * 
  	 * @var array AppVLan
  	 */
  	public $AvailableVirtualSwitches;
  	
  	
  	/**
  	 * CPUs bounds for the OSTemplate  	 
  	 * @var AppResourceBound
  	 */
  	public $AppCPUsBound;
  	
  	/**
  	 * RAMs bounds for the OSTemplate  	 
  	 * @var AppResourceBound
  	 */
  	public $AppRAMsBound;
  	
  	/**
  	 * HDs bounds for the OSTemplate  	 
  	 * @var array AppResourceBound
  	 */
  	public $AppHDxBound=array(0,1,2,3);
	
	public $validate = array();

	
	public function find($type = 'first', $query = array()) {
		
		$ad=array();
		$vdc = $this->getWsEndUserClient()->getVirtualDatacenter();
		if ($vdc != null) {
			foreach($vdc->getServers() as $element) {
				$ad[]=$element;
			}
		}
		if ($type === 'count') {
			return sizeof($ad);
		}

		return $this->adaptList($ad,$query);
	}
	
	
	public function load($ServerId){
				
		$vdc = $this->getWsEndUserClient()->getVirtualDatacenter();
		$oneElementList=$vdc->getAppServersById(array($ServerId));
		$tmp = null;
		if(sizeof($oneElementList)>0){
			$tmp = $oneElementList[0];
			
			//find available ips
			$this->AvailableIps = array();
			foreach ($vdc->getIPAddresses() as $ip){
				if(!isset($ip->ServerId) || ($ip->ServerId==null)){
					$this->AvailableIps[]=$ip;
				}
			}
			
			//find available Virtual switches
			$this->AvailableVirtualSwitches= array();
			foreach ($vdc->getVLans() as $vlan){
				
				if(!$vlan->isConnectedTo($ServerId)){
					$this->AvailableVirtualSwitches[]=$vlan;
				}
			}
			
			if(CakeSession::check('vdcConfig')){
				$vdcConfig = CakeSession::read('vdcConfig');
				$this->AppCPUsBound = $vdcConfig->getResourceBounds($tmp->HypervisorType,$tmp->OSTemplate->ProductId,AppResourceType::CPU);
				$this->AppRAMsBound = $vdcConfig->getResourceBounds($tmp->HypervisorType,$tmp->OSTemplate->ProductId,AppResourceType::RAM);
				$this->AppHDxBound[0]=$vdcConfig->getResourceBounds($tmp->HypervisorType,$tmp->OSTemplate->ProductId,AppResourceType::HARD_DISK_0);
				$this->AppHDxBound[1]=$vdcConfig->getResourceBounds($tmp->HypervisorType,$tmp->OSTemplate->ProductId,AppResourceType::HARD_DISK_1);
				$this->AppHDxBound[2]=$vdcConfig->getResourceBounds($tmp->HypervisorType,$tmp->OSTemplate->ProductId,AppResourceType::HARD_DISK_2);
				$this->AppHDxBound[3]=$vdcConfig->getResourceBounds($tmp->HypervisorType,$tmp->OSTemplate->ProductId,AppResourceType::HARD_DISK_3);
			}
		
		}
		$this->AppServerDetail = $tmp;
		//$this->AppServerDetail = $this->getWsEndUserClient()->getServerDetails($ServerId);
		return $this;
	}
	
	public function removeServer($ServerId){
		return $this->getWsEndUserClient()->SetEnqueueServerDeletion($ServerId);
	}
	
	public function startServer($ServerId){
		return $this->getWsEndUserClient()->SetEnqueueServerStart($ServerId);
	}
	
	public function stopServer($ServerId){
		return $this->getWsEndUserClient()->setEnqueueServerStop($ServerId);
	}
	
	public function powerOffServer($ServerId){
		return $this->getWsEndUserClient()->SetEnqueueServerPowerOff($ServerId);
	}
	
	public function resetServer($ServerId){
		return $this->getWsEndUserClient()->SetEnqueueServerReset($ServerId);
	}
	
	public function archiveServer($ServerId){
		return $this->getWsEndUserClient()->SetEnqueueServerArchiviation($ServerId);
	}
	
	public function restoreServer($ServerId, $cpu, $ram){
		return $this->getWsEndUserClient()->SetEnqueueServerRestore($ServerId, $cpu, $ram);
	}
	
	public function connectVirtualSwitch($vLanResourceId, $networkAdapterId){
		return $this->getWsEndUserClient()->SetEnqueueAssociateVLan($vLanResourceId, $networkAdapterId);
	}
	
	public function disconnectVirtualSwitch($vLanResourceId, $networkAdapterId){
		return $this->getWsEndUserClient()->SetEnqueueDeassociateVLan($vLanResourceId, $networkAdapterId);
	}
	
	public function connectIps($ipAddressResourceIds, $networkAdapterId){
		return $this->getWsEndUserClient()->SetEnqueueAssociateIpAddress($ipAddressResourceIds, $networkAdapterId);
	}
	
	public function disconnectIps($ipAddressResourceIds, $networkAdapterId){
		return $this->getWsEndUserClient()->SetEnqueueDeassociateIpAddress($ipAddressResourceIds, $networkAdapterId);
	}
	
	
	public function removeDisk($ServerId,$DiskNumber){
		return $this->getWsEndUserClient()->SetEnqueueServerUpdateDiskDelete($ServerId, $DiskNumber);
	}
	
	public function createDisk($ServerId,$DiskNumber,$newSize){
		return $this->getWsEndUserClient()->SetEnqueueServerUpdateDiskCreate($ServerId, $DiskNumber, $newSize);
	}
	
	public function resizeDisk($ServerId,$DiskNumber,$newSize){
		return $this->getWsEndUserClient()->SetEnqueueServerUpdateDiskResize($ServerId, $DiskNumber, $newSize);
	}
	
	public function renameServer($ServerId,$newName){
		return $this->getWsEndUserClient()->renameServer($ServerId, $newName);
	}
	
	public function modifyCpus($ServerId,$Quantity){
		return $this->getWsEndUserClient()->SetEnqueueServerUpdateCPU($ServerId, $Quantity);
	}
	
	public function modifyRams($ServerId,$Quantity){
		return $this->getWsEndUserClient()->SetEnqueueServerUpdateRAM($ServerId, $Quantity);
	}
	
	public function validateName(){
		// redefine here the validate array to obtain multilanguage message
		$this->validate = array(
		'Name' => array(
			'notempty' => array(
				'rule' => 'notempty',
				'message' => __('The Name must not be empty'),
				'allowEmpty' => false,
				'required' => true,
				'last' => true, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
				),
			 'regex'=> array(
				'rule' => '/^[a-z,A-Z,0-9,-]*$/i',
				'message' => __('The Name must contains only [a-z,A-Z,0-9,-]')
					
				)	
			)			
		);
		return parent::validates(array('fieldList'=>'Name'));
	}
	
	
	public function validateCpu($AppCPUsBounds){
		// redefine here the validate array to obtain multilanguage message
		$this->validate = array(
		'Cpus' => array(
			'notempty' => array(
				'rule' => 'notempty',
				'message' => __('The CPUs must not be empty'),
				'allowEmpty' => false,
				'required' => true,
				'last' => true, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
				),
			 'numeric' => array(
				'rule' => 'numeric',
				'message' => __('The CPUs must be numeric'),
				'allowEmpty' => false,				
				'last' => true
				),
			 'range' => array(
				'rule' => array('range', $AppCPUsBounds->getMin()-1, $AppCPUsBounds->getMax()+1 ),				
				'message' => __('The CPUs must be between %s and %s',array($AppCPUsBounds->getMin(), $AppCPUsBounds->getMax())),
				'allowEmpty' => false,				
				'last' => true
				)
			)					
		);
		return parent::validates(array('fieldList'=>'Cpus'));
	}
	
	public function validateRam($AppRAMsBounds){
		// redefine here the validate array to obtain multilanguage message
		$this->validate = array(
		'Rams' => array(
			'notempty' => array(
				'rule' => 'notempty',
				'message' => __('The RAMs must not be empty'),
				'allowEmpty' => false,
				'required' => true,
				'last' => true, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
				),
			 'numeric' => array(
				'rule' => 'numeric',
				'message' => __('The RAMs must be numeric'),
				'allowEmpty' => false,				
				'last' => true
				),
			 'range' => array(
				'rule' => array('range', $AppRAMsBounds->getMin()-1, $AppRAMsBounds->getMax()+1 ),				
				'message' => __('The RAMs must be between %s and %s',array($AppRAMsBounds->getMin(), $AppRAMsBounds->getMax())),
				'allowEmpty' => false,				
				'last' => true
				)
			)					
		);
		return parent::validates(array('fieldList'=>'Rams'));
	}
	
	
	public function validateHd($AppHDxBounds,$diskNumber,$currentSize=0){
		// redefine here the validate array to obtain multilanguage message
		$min=max(array($currentSize,$AppHDxBounds->getMin()));
		$this->validate = array(
		'DiskSize'.$diskNumber => array(
			'notempty' => array(
				'rule' => 'notempty',
				'message' => __('The HD%s Size must not be empty',$diskNumber),
				'allowEmpty' => false,
				'required' => true,
				'last' => true, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
				),
			 'numeric' => array(
				'rule' => 'numeric',
				'message' => __('The HD%s Size must be numeric',$diskNumber),					
				'last' => true
				),
			 'range' => array(
				'rule' => array('range', $min-1, $AppHDxBounds->getMax()+1 ),				
				'message' => __('The HD%s Size must be between %sGB and %sGB',array($diskNumber,$min, $AppHDxBounds->getMax())),				
				'last' => true
				),
			 'multiple' => array(
				'rule' => array('multipleSize', 'DiskSize'.$diskNumber, $AppHDxBounds->getDefault() ),				
				'message' => __('The HD%s Size must be a multiple of %sGB',array($diskNumber,$AppHDxBounds->getDefault())),				
				'last' => true
				)
			)					
		);
		return parent::validates(array('fieldList'=>'DiskSize'.$diskNumber));
	}
	
	public function multipleSize($check,$key,$step) {
               
        return ($check[$key] % $step)==0;
    }
	
	
	public final function isShutdownAvailable() {
		// shutdown is not available for HyperV-lowcost type
		return !AppHypervisorTypes::isSameValue(AppHypervisorTypes::HYPER_V_LOW_COST, $this->AppServerDetail->getHypervisorType());	
	}
		

}
