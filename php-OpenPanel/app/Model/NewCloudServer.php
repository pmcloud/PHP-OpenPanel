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
App::uses('AppNewServers', 'Aruba');
App::uses('VDCResourceBoundsConfig', 'Aruba');
App::uses('AppHypervisor', 'Aruba');
App::uses('AppTemplateDetails','Aruba');
App::uses('AppResourceBound','Aruba');
App::uses('AppTemplateDetails', 'Aruba');
App::uses('AppVirtualDisk', 'Aruba');
App::uses('AppNetworkAdapterType', 'Aruba');
App::uses('AppPublicIpAddressDetails', 'Aruba');
App::uses('AppNetworkAdapterConfiguration', 'Aruba');
App::uses('AppVirtualDiskTypes', 'Aruba');
App::uses('AppPrivateVLanDetails', 'Aruba');
App::uses('AppNewServer', 'Aruba');
App::uses('AppWsResult', 'Aruba');


/**
 * NewCloudServer Model
 *
 */
class NewCloudServer extends AppModel {


	public $SelectedCPUNum;
	 
	public $SelectedRAMNum;
	 
	public $SelectedDisksSize = array(10, -1, -1, -1);
	 
	public $SelectedHypervisorType;
	 
	public $SelectedTemplateProdId;
	
	/**
	 * HDs bounds for the OSTemplate
	 * @var array AppResourceBound
	 */
	public $AppHDxBound=array(0, 1, 2, 3);

	public $AvailableAppVLANs;
	 
	public $HypervisorTypes;

	public $TemplateList;

	public $validate = array();


	public function load($selectedHypervType = null, $selectedTemplateProductId = null){

		$vdcConfig = $this->getWsEndUserVDCConfigClient()->getVDCResourceConfiguration();

		$vlans = $this->getWsEndUserVDCConfigClient()->getVirtualDatacenter()->getVLans();
		if (isset($vlans) && sizeof($vlans) > 0) {
			$this->AvailableAppVLANs = $vlans;
		}
		else {
			$this->AvailableAppVLANs = array();
		}

		$registerdAppHyperv = $vdcConfig->getAllRegisteredHypervisors();
		$appHypervs = array();
		$firstHyper = null;
		foreach($registerdAppHyperv as $rht) {
			$appHypervs[$rht->getHypervisorType()] = $rht->getHypervisorType();
			if ($firstHyper == null) {
				$firstHyper=$rht;
			}
		}

		$this->HypervisorTypes = $appHypervs;
		if ($selectedHypervType == null) {
			$this->SelectedHypervisorType = $firstHyper->getHypervisorType();
		}
		else {
			$this->SelectedHypervisorType = $selectedHypervType;
		}
		//sort($appHypervs, SORT_STRING);

		$templateOptions = array();
		$firstTemplate = null;
		foreach($vdcConfig->getTemplatesFor($this->SelectedHypervisorType) as $osTemplate) {
			$templateOptions[$osTemplate->ProductId] = $osTemplate->Description;
			if ($firstTemplate == null) {
				$firstTemplate = $osTemplate;
			}
		}
		$this->TemplateList = $templateOptions;
		if ($selectedTemplateProductId == null) {
			$this->SelectedTemplateProdId = $firstTemplate->ProductId;
		}
		else {
			$this->SelectedTemplateProdId = $selectedTemplateProductId;
		}

		$this->AppCPUsBound = $vdcConfig->getResourceBounds($this->SelectedHypervisorType, $this->SelectedTemplateProdId, AppResourceType::CPU);
		$this->AppRAMsBound = $vdcConfig->getResourceBounds($this->SelectedHypervisorType, $this->SelectedTemplateProdId, AppResourceType::RAM);

		$this->AppHDxBound[0]=$vdcConfig->getResourceBounds($this->SelectedHypervisorType, $this->SelectedTemplateProdId, AppResourceType::HARD_DISK_0);
		$this->AppHDxBound[1]=$vdcConfig->getResourceBounds($this->SelectedHypervisorType, $this->SelectedTemplateProdId, AppResourceType::HARD_DISK_1);
		$this->AppHDxBound[2]=$vdcConfig->getResourceBounds($this->SelectedHypervisorType, $this->SelectedTemplateProdId, AppResourceType::HARD_DISK_2);
		$this->AppHDxBound[3]=$vdcConfig->getResourceBounds($this->SelectedHypervisorType, $this->SelectedTemplateProdId, AppResourceType::HARD_DISK_3);
	}

	public final function invokeServerCreation() {

		$appVDISKS = array();
		
		$AppVirtualDisk0 = new AppVirtualDisk();
		$AppVirtualDisk0->VirtualDiskType = AppVirtualDiskTypes::PRIMARY_VIRTUAL_DISK;
		$AppVirtualDisk0->Size = $this->SelectedDisksSize[0];
		$appVDISKS[] = $AppVirtualDisk0;
		
		if ( isset($this->SelectedDisksSize[1]) && $this->SelectedDisksSize[1] > 0) {
			$AppVirtualDisk1 = new AppVirtualDisk();
			$AppVirtualDisk1->VirtualDiskType = AppVirtualDiskTypes::ADDITIONAL_VIRTUAL_DISK_1;
			$AppVirtualDisk1->Size = $this->SelectedDisksSize[1];
			$appVDISKS[] = $AppVirtualDisk1;
		}
		if ( isset($this->SelectedDisksSize[2]) && $this->SelectedDisksSize[2] > 0) {
			$AppVirtualDisk2 = new AppVirtualDisk();
			$AppVirtualDisk2->VirtualDiskType = AppVirtualDiskTypes::ADDITIONAL_VIRTUAL_DISK_2;
			$AppVirtualDisk2->Size = $this->SelectedDisksSize[2];
			$appVDISKS[] = $AppVirtualDisk2;
		}
		if ( isset($this->SelectedDisksSize[3]) && $this->SelectedDisksSize[3] > 0) {
			$AppVirtualDisk3 = new AppVirtualDisk();
			$AppVirtualDisk3->VirtualDiskType = AppVirtualDiskTypes::ADDITIONAL_VIRTUAL_DISK_3;
			$AppVirtualDisk3->Size = $this->SelectedDisksSize[3];
			$appVDISKS[] = $AppVirtualDisk3;
		}
		
		if(!CakeSession::check('vdcConfig')) {
			return new AppWsResult(null); // should never get here
		}
		$vdcConfig = CakeSession::read('vdcConfig');
		
		$serverOST = $vdcConfig->getTemplate($this->SelectedHypervisorType, $this->SelectedTemplateProdId);
		$serverName = $this->data['NewCloudServer']['Name'];
		$serverPwd  = $this->data['NewCloudServer']['Password'];		
		$serverCpus = $this->SelectedCPUNum;
		$serverRams = $this->SelectedRAMNum;
						
		// Preparing Ethernet(s) configurations
		$appNAC2 = null;
		$appNAC3 = null;
		
		if (isset( $this->data['NewCloudServer']['ETH02_IP'])) {						
			
			$vlan2Id= $this->data['NewCloudServer']['VLAN_ETH02'];
			$ip2 	= $this->data['NewCloudServer']['ETH02_IP'];
			$nmask2 = $this->data['NewCloudServer']['ETH02_NM'];
			
			$eth2   = new AppNetworkAdapterType(AppNetworkAdapterType::ETHERNET_1);
			$vlan2  = new AppPrivateVLanDetails($vlan2Id,$ip2, $nmask2);
			$appNAC2= new AppNetworkAdapterConfiguration($eth2, $vlan2, null);			
		}
		if (isset( $this->data['NewCloudServer']['ETH03_IP'])) {
			$vlan3Id= $this->data['NewCloudServer']['VLAN_ETH03'];
			$ip3 	= $this->data['NewCloudServer']['ETH03_IP'];
			$nmask3 = $this->data['NewCloudServer']['ETH03_NM'];

			$eth3   = new AppNetworkAdapterType(AppNetworkAdapterType::ETHERNET_2);			
			$vlan3  = new AppPrivateVLanDetails($vlan3Id,$ip3, $nmask3);
			$appNAC3= new AppNetworkAdapterConfiguration($eth3, $vlan3, null);		
		}
		
		$response = $this->getWsEndUserClient()->purchaseIpAddress();
		if ($response == null) {
			return new AppWsResult(null);			
		}
		else if (!$response->isSuccess()) {
			return $response;
		}
		$resourceId = $response->getValue()->ResourceId; //21248;
		
		// here we have a new public ip resource that we will associate to the new server..
		
		// Prepare Ethernet 0 (public-ip)				
		$pip1 = new AppPublicIpAddressDetails($resourceId /*20844*/, true);		
		$eth1 = new AppNetworkAdapterType(AppNetworkAdapterType::ETHERNET_0);		
		$appNAC1 = new AppNetworkAdapterConfiguration($eth1, null, array($pip1));
		
		
		$appNetAdapConfigs = array($appNAC1);
		if ($appNAC2 != null) {
			$appNetAdapConfigs[] = $appNAC2;
		}
		if ($appNAC3 != null) {
			$appNetAdapConfigs[] = $appNAC3;
		}
		
		$appNewServer = new AppNewServer($serverName, $serverPwd, $serverOST->Id, $serverCpus, $serverRams, $appVDISKS, $appNetAdapConfigs);
		$invokeResult = $this->getWsEndUserClient()->SetEnqueueServerCreation($appNewServer);
		
		return $invokeResult;					
	}

	public function validate() {

		$result = $this->validateName();
		$result = $result && $this->validatePassword();
		if ($result) {
				
			for ($d = 0; $d < 4; $d++) {
				if (isset( $this->data['NewCloudServer']['DiskSize' .$d] )) {
					$result = $result && $this->validateHd($this->AppHDxBound[$d], $d, $this->data['NewCloudServer']['DiskSize' .$d]);
				}
			}
			if ($result) {
				
				if (isset( $this->data['NewCloudServer']['ETH02_IP'])) {
					$result = $result &&  $this->validateEth(2);
				}
				if (isset( $this->data['NewCloudServer']['ETH03_IP'])) {
					$result = $result &&  $this->validateEth(3);
				}
				
				if (isset( $this->data['NewCloudServer']['ETH02_IP']) && isset( $this->data['NewCloudServer']['ETH03_IP'])) {
					$result = $result && $this->validateEthParams();	
				}
			}
		}
		return $result;
	}

	private function validateName(){
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
				'message' => __('The Name must contains only [a-z,A-Z,0-9,-]'),
				'last' => true	
			)
		)
		);
		return parent::validates(array('fieldList'=>'Name'));
	}

	private function validatePassword() {
		// redefine here the validate array to obtain multilanguage message
		$this->validate = array(
		'Password' => array(
			'notempty' => array(
				'rule' => 'notempty',
				'message' => __('The Password must not be empty'),
				'allowEmpty' => false,
				'required' => true,
				'last' => true, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			 'regex'=> array(										
				'rule' =>  '/.*^(?=.{7,20})(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9]).*$/i', //'/^((?=.*\\d)(?=.*[A-Z])(?=.*[a-z])).{7,20}$/i',
				'message' => __('The Password must contains only [a-z,A-Z,0-9] from 7 to 20 chars')					
			),
			 'custom-check' => array(
				'rule' => array('customCheck'),
				'message' => __('The Password must contains at least one upper-case char'),
				'last' => true
			)
			// TODO CHECK AGAIN FOR REGEX..
		),
		'PasswordChk' => array(
			'notempty' => array(
				'rule' => 'notempty',
				'message' => __('The PasswordChk must not be empty'),
				'allowEmpty' => false,
				'required' => true,
				'last' => true, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			 'pwdcompare'=> array(
				'rule' => array('pwdcompare'),
				'message' => __('Password and Password check do not match'),
				'last' => true					
			)
			)
		);
		return parent::validates(array('fieldList'=> array('Password', 'PasswordChk')));
	}

	public final function customCheck($dontCare) {
		return  preg_match('/[A-Z]/', $this->data['NewCloudServer']['Password']);
	}
	
	public final function pwdcompare($dontCare) {
		return strcasecmp($this->data['NewCloudServer']['Password'], $this->data['NewCloudServer']['PasswordChk']) == 0;
	}

	private function validateHd($AppHDxBounds, $diskNumber, $currentSize = 0){
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
				'rule' => array('range', $min-1, $AppHDxBounds->getMax() ),				
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

	public final function multipleSize($check,$key,$step) {
		return ($check[$key] % $step)==0;
	}

	private function validateEth($ethPos) {
		$this->validate = array(
			'ETH0'.$ethPos.'_IP' => array(
				'notempty' => array(
						'rule' => 'notempty',
						'message' => __('The IP address of ETHERNET 0%s must not be empty',$ethPos),
						'allowEmpty' => false,
						'required' => true,
						'last' => true, // Stop validation after this rule
						//'on' => 'create', // Limit validation to 'create' or 'update' operations
				),
				'clientip' => array(
						'rule' => array('ip'), // 'IPv4'),
						'message' => __('Please supply a valid IP Address for ETHERNET 0%s',$ethPos)
					)
			),
		    'ETH0'.$ethPos.'_NM' => array(
				'notempty' => array(
						'rule' => 'notempty',
						'message' => __('The Netmask of ETHERNET 0%s must not be empty',$ethPos),
						'allowEmpty' => false,
						'required' => true,
						'last' => true, // Stop validation after this rule
						//'on' => 'create', // Limit validation to 'create' or 'update' operations
				),
				'clientip' => array(
						'rule' => array('ip'),// 'IPv4'),
						'message' => __('Please supply a valid Netmask for ETHERNET 0%s',$ethPos)
					)
			)
		);
		return parent::validates(array('fieldList'=> array('ETH0'.$ethPos.'_IP', 'ETH0'.$ethPos.'_NM')));
	}

	private final function validateEthParams() {
		
		$selSwitchEth2 = $this->data['NewCloudServer']['VLAN_ETH02'];
		$selSwitchEth3 = $this->data['NewCloudServer']['VLAN_ETH03'];
		if (strcmp($selSwitchEth2, $selSwitchEth3) == 0) {			
			return false; // can not connect same switch to two different ethernets
		}
		$selIPEth2 = $this->data['NewCloudServer']['ETH02_IP'];
		$selIPEth3 = $this->data['NewCloudServer']['ETH03_IP'];
		if (strcmp($selIPEth2, $selIPEth3) == 0) {
			return false; // can not bind same IP to different ethernets
		}		
		//return parent::validates(array('fieldList'=> array('Password', 'PasswordChk')));
		return true;		
	}
}
