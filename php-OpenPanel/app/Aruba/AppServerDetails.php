<?php

/** 
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

include_once 'ServerDetails.php';
include_once 'AppServerStatus.php';
include_once 'AppNetworkAdapter.php';
include_once 'AppVirtualDisk.php';
include_once 'AppHypervisorServerTypes.php';


class AppServerDetails
{

	/**
	 *
	 * @var array $ActiveJobs
	 * @access private
	 */
	public $ActiveJobs;

	/**
	 *
	 * @var Cpu $CPUQuantity
	 * @access public
	 */
	public $CPUQuantity;

	/**
	 *
	 * @var int $CompanyId
	 * @access public
	 */
	public $CompanyId;

	/**
	 *
	 * @var dateTime $CreationDate
	 * @access public
	 */
	public $CreationDate;

	/**
	 *
	 * @var int $DatacenterId
	 * @access public
	 */
	public $DatacenterId;

	/**
	 *
	 * @var AppHypervisorServerTypes $HypervisorServerType
	 * @access public
	 */
	public $HypervisorServerType;

	/**
	 *
	 * @var AppHypervisorTypes $HypervisorType
	 * @access public
	 */
	public $HypervisorType;

	/**
	 *
	 * @var string $Name
	 * @access public
	 */
	public $Name;

	/**
	 *
	 * @var array $AppNetworkAdapters
	 * @access public
	 */
	private $NetworkAdapters;

	/**
	 *
	 * @var string $Note
	 * @access public
	 */
	public $Note;

	/**
	 *
	 * @var Template $OSTemplate
	 * @access public
	 */
	public $OSTemplate;

	//  /**
	//   *
	//   * @var array $Parameters
	//   * @access public
	//   */
	//  public $Parameters;

	/**
	 *
	 * @var Ram $RAMQuantity
	 * @access public
	 */
	public $RAMQuantity;

	/**
	 *
	 * @var int $ServerId
	 * @access public
	 */
	public $ServerId;

	/**
	 *
	 * @var ServerStatus $ServerStatus
	 * @access public
	 */
	public $ServerStatus;

	//  /**
	//   *
	//   * @var array $Snapshots
	//   * @access public
	//   */
	//  public $Snapshots;

	/**
	 *
	 * @var boolean $ToolsAvailable
	 * @access public
	 */
	public $ToolsAvailable;

	/**
	 *
	 * @var int $UserId
	 * @access public
	 */
	public $UserId;

	//  /**
	//   *
	//   * @var array $VirtualDVDs
	//   * @access public
	//   */
	//  public $VirtualDVDs;

	/**
	 *
	 * @var array $AppVirtualDisks
	 * @access public
	 */
	private $VirtualDisks;

	/**
	 *
	 * @access public
	 */
	public function __construct($serverDetails)
	{
		if ($serverDetails != null && isset($serverDetails)) {
			$this->ActiveJobs = $serverDetails->ActiveJobs;
			$this->CPUQuantity = $serverDetails->CPUQuantity;
			$this->CompanyId = $serverDetails->CompanyId;
			$this->CreationDate = $serverDetails->CreationDate;
			$this->DatacenterId = $serverDetails->DatacenterId;
			$this->HypervisorServerType = $serverDetails->HypervisorServerType;
			$this->HypervisorType = $serverDetails->HypervisorType;
			$this->Name = $serverDetails->Name;			
			$this->Note = $serverDetails->Note;
			$this->OSTemplate = $serverDetails->OSTemplate;
			//$this->Parameters = $serverDetails->Parameters;
			$this->RAMQuantity = $serverDetails->RAMQuantity;
			$this->ServerId = $serverDetails->ServerId;
			$this->ServerStatus = $serverDetails->ServerStatus;
			//$this->Snapshots = $serverDetails->Snapshots;
			$this->ToolsAvailable = $serverDetails->ToolsAvailable;
			$this->UserId = $serverDetails->UserId;
			//$this->VirtualDVDs = $serverDetails->VirtualDVDs;
			//$this->VirtualDisks = $serverDetails->VirtualDisks;
			//$this->NetworkAdapters = $serverDetails->NetworkAdapters;
			$this->setVirtualDisks($serverDetails);
			$this->setNetworkAdapters($serverDetails);
		}
	}
	
	
	private final function findDiskIndex($vDisk){
		$index=1;
		switch ($vDisk->ResourceType) {
			case 'HardDisk0':
			$index=0;
			break;
			
			case 'HardDisk1':
			$index=1;
			break;
			
			case 'HardDisk2':
			$index=2;
			break;
			
			case 'HardDisk3':
			$index=3;
			break;			
		}
		
		return $index;
	}

	private final function setVirtualDisks($serverDetails) {
		$vector = array();
		if ($serverDetails->VirtualDisks != null && isset($serverDetails->VirtualDisks->VirtualDisk)) {
			$vDisks = $serverDetails->VirtualDisks->VirtualDisk;
			if ($vDisks != null) {
				if (sizeof($vDisks)==1) {
					//$this->addDisk($vDisks,$vector);
					$vector[$this->findDiskIndex($vDisks)] = new AppVirtualDisk($vDisks);
				}
				else {
					foreach($vDisks as $vd) {
						$vector[$this->findDiskIndex($vd)] = new AppVirtualDisk($vd);
						//$this->addDisk($vd,$vector);
					}
				}
			}			
		}
		$this->VirtualDisks = $vector;
	}

	private final function setNetworkAdapters($serverDetails) {
		$vector = array();
		if ($serverDetails->NetworkAdapters != null && isset($serverDetails->NetworkAdapters->NetworkAdapter)) {
			$nads = $serverDetails->NetworkAdapters->NetworkAdapter;
			if ($nads != null) {
				if (sizeof($nads) == 1) {
					$vector[] = new AppNetworkAdapter($nads);
				}
				else {
					foreach ($nads as $nad) {
						$vector[] = new AppNetworkAdapter($nad);
					}
				}
			}
		}
		$this->NetworkAdapters = $vector;
	}
	
	public final function getOSTemplateName() {
		return (($this->OSTemplate != null && $this->OSTemplate->Name != null) ? $this->OSTemplate->Name : "");
	}

	public final function getOSTemplateDescription() {
		return (($this->OSTemplate != null && $this->OSTemplate->Description != null) ? $this->OSTemplate->Description : "");
	}

	public final function getOSTemplateId() {
		return (($this->OSTemplate != null && $this->OSTemplate->Id != null) ? $this->OSTemplate->Id : -1);
	}

	/**
	 * @return a const value from AppServerStatus 'enum'
	 */
	public final function getServerStatus() {
		return AppServerStatus::get($this->ServerStatus);
	}

	public final function getHypervisorType() {
		return AppHypervisorTypes::get($this->HypervisorType);
	}
	
	public final function getHypervisorServerType() {
		return AppHypervisorServerTypes::get($this->HypervisorServerType);
	}
	
	public final function isCreating() {
		return AppServerStatus::isSameValue(AppServerStatus::CREATING, $this->ServerStatus);	
	}
	
	public final function isRunning() {
		return AppServerStatus::isSameValue(AppServerStatus::RUNNING, $this->ServerStatus);	
	}

	public final function isStopped() {
		return AppServerStatus::isSameValue(AppServerStatus::STOPPED, $this->ServerStatus);	
	}

	public final function isArchived() {
		return AppServerStatus::isSameValue(AppServerStatus::ARCHIVED, $this->ServerStatus);	
	}
	
	public final function isUpdating() {
		return (sizeof($this->getActiveJobs()) > 0);	
	}
	
	/**
	 * @return boolean
	 */
	public final function isWindowsBasedOS() {
		$osDesc = $this->getOSTemplateDescription();
		if ($osDesc == null) {
			$osDesc = "null";
		}
		$pos = strpos( strtolower($osDesc), "windows");
		if ($pos !== false) {
			return true;
		}
		return false;
	}


	/**
	 * @return boolean
	 */
	public final function isLinuxBasedOS() {
		$osDesc = $this->getOSTemplateDescription();
		if ($osDesc == null) {
			$osDesc = "null";
		}
		$pos = strpos( strtolower($osDesc), "linux");
		if ($pos !== false) {
			return true;
		}
		return false;
	}

	private final function getActiveJobs() {
		if(!isset($this->ActiveJobs)){
			return array();
		}else{
			if( $this->ActiveJobs instanceof  stdClass){
				if(isset( $this->ActiveJobs->Job)){
				return $this->ActiveJobs->Job;
				}else {
					return array();
				}
			}else{
				return $this->ActiveJobs;
			}
		}
	}
	
	/**
	 *
	 * @return number the total amount of giga-byte 
	 */
	public final function getTotalDiskSize() {
		$totalSize = 0;
		if ($this->VirtualDisks != null) {
			foreach ($this->VirtualDisks as $vd) {
				$totalSize += $vd->Size;
			}
		}
		return $totalSize;
	}
	
/**
	 *
	 * @return number amount of giga-byte 
	 */
	public final function getDiskSize($diskNumber) {
		
		if ($this->VirtualDisks != null && isset($this->VirtualDisks[$diskNumber])) {
			$size = $this->VirtualDisks[$diskNumber]->Size;
			if($size==null){
				$size=0;
			}
			return $size;
		}
		return 0;
	}
	
	public final function isDiskInUse($diskNumber) {				
		return $this->getDiskSize($diskNumber)>0;
	}

	/**
	 * @return number the number of disks configured in this server
	 */
	public final function getDiskNumber() {
		$counter = 0;
		if ($this->VirtualDisks != null) {
			$counter += sizeof($this->VirtualDisks);
		}
		return $counter;
	}

	/**
	 * @return an array of AppVirtualDisk
	 */
	public final function getVirtualDisks() {
		return $this->VirtualDisks;
	}

	/**
	 * @return an array of AppNetworkAdapter
	 */
	public final function getNetworkAdapters() {		
		return $this->NetworkAdapters;
	}

	public final function isAssociatedToPublicIPs() {
		
		$ethernets = $this->getNetworkAdapters();
		if ($ethernets != null && sizeof($ethernets) > 0) {
			$associated = false;
			foreach ($ethernets as $ethernet) {
				$associated = $associated || $ethernet->isAssociatedToPublicIPs();
			}
			return $associated;			
		}
		return false;
	}
	
	
	public final function geAvailableNetworkAdapters() {
		
		$ethernets = $this->getNetworkAdapters();
		if ($ethernets != null && sizeof($ethernets) > 0) {
			$response = array();			
			foreach ($ethernets as $ethernet) {
				
				if (! $ethernet->isConnected()) {
					
					if (sizeof($response) == 0) {						
						$response[] = $ethernet;
					}
					else {
						switch ($ethernet->getNetworkAdapterType()) {
							
							case AppNetworkAdapterType::ETHERNET_0:
								$response = array_splice($response, 0,0, $ethernet);
								break;
							case AppNetworkAdapterType::ETHERNET_1:
								// here 'sizeof($response)' returns '1' or '2'
								if (sizeof($response) == 2) {
									$response = array_splice($response, 1,0, $ethernet);
								}
								else {
									$item = end($response); //reset($response);
									if (AppNetworkAdapterType::isSameValue(AppNetworkAdapterType::ETHERNET_2,$item->getNetworkAdapterType())) {
										$response = array_splice($response, 0,0, $ethernet);
									}
									else {
										$response[] = $ethernet;
									}									
								}
								break;
							case AppNetworkAdapterType::ETHERNET_2:
								//$response[] = $ethernet;
								$response = array_splice($response, count($response),0, $ethernet);
								break;
						}
					}					
				}
			}
			return $response;
		}
		return array();
	}
	
	public final function getNetworkAdapter($networkAdapterType) {
		if ($networkAdapterType == null) {
			return null;
		}
		foreach ($this->getNetworkAdapters() as $nad) {
			if ( AppNetworkAdapterType::isSameValue($networkAdapterType, $nad->getNetworkAdapterType()) ) {
				return $nad;
			}			
		}
		return null;
	}
	
}
?>