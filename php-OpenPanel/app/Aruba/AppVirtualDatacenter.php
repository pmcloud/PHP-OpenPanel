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

include_once 'VirtualDatacenter.php';
include_once 'Server.php';
include_once 'VLan.php';
include_once 'IPAddress.php';

include_once 'AppServerDetails.php';
include_once 'AppVLan.php';
include_once 'AppIPAddress.php';

class AppVirtualDatacenter
{

	/**
	 *
	 * @var int $DatacenterId
	 * @access private
	 */
	private $DatacenterId;

	/**
	 *
	 * @var array of AppIpAddresses
	 * @access private
	 */
	private $IpAddresses;

	/**
	 *
	 * @var array of AppServerDetails
	 * @access private
	 */
	private $Servers;

	/**
	 *
	 * @var array of AppVLans
	 * @access private
	 */
	private $VLans;

	/**
	 * @param VirtualDatacenter $datacenter
	 */
	public function __construct($datacenter)

	{
		if ($datacenter != null) {
			$this->DatacenterId = $datacenter->DatacenterId;
			//$this->IpAddresses = $datacenter->IpAddresses;
			//$this->Servers = $datacenter->Servers;
			//$this->VLans = $datacenter->VLans;
			$this->setServers($datacenter);
			$this->setIpAddresses($datacenter);			
			$this->setVlans($datacenter);
		}
	}

	private final function setServers($datacenter) {
		$vector = array();
		// $datacenter->Servers returns a stdClass
		if ($datacenter->Servers != null && isset($datacenter->Servers->ServerDetails)) {
			$servers = $datacenter->Servers->ServerDetails;
			if ($servers != null) {
				if (sizeof($servers) == 1) {
					$vector[] = new AppServerDetails($servers);
				}
				else {
					foreach ($servers as $sd) {
						$vector[] = new AppServerDetails($sd);
					}
				}
			}
		} 
		$this->Servers = $vector;
	}
	private final function setIpAddresses($datacenter) {
		$vector = array();
		// $datacenter->IpAddresses returns a stdClass
		if ($datacenter->IpAddresses != null && isset($datacenter->IpAddresses->IPAddress)) {
			$ipAddresses = $datacenter->IpAddresses->IPAddress;
			if ($ipAddresses != null) {
				if (sizeof($ipAddresses) == 1) {
					$tmp = new AppIPAddress($ipAddresses);
					if($tmp->isAssigned()){
						$ss = $this->getAppServersNameById(array($tmp->ServerId));
						$tmp->ServerName=$ss[0];
					}
					$vector[] = $tmp;
				}
				else {
					foreach ($ipAddresses as $ipa) {
						$tmp = new AppIPAddress($ipa);
						if($tmp->isAssigned()){
							$ss = $this->getAppServersNameById(array($tmp->ServerId));
							$tmp->ServerName=$ss[0];
						}
						$vector[] = $tmp;
					}
				}
			}
		}
		$this->IpAddresses = $vector; 
	}

	private final function setVlans($datacenter) {
		$vector = array();
		// $datacenter->Vlans returns a stdClass
		if ($datacenter->VLans != null && isset($datacenter->VLans->VLan)) {
			$vlans = $datacenter->VLans->VLan;
			if ($vlans != null) {
				if (sizeof($vlans) == 1) {
					$tmp = new AppVLan($vlans);
					if($tmp->isConnected()){
						$ss = $this->getAppServersNameById($tmp->ServerIds);
						$names=null;						
						foreach ($ss as $serverName){
							if($names==null){
								$names=$serverName;
							}else{
								$names=$names.", ".$serverName;
							}
							
						}
						$tmp->ServerNames=$names;
					}
					$vector[] = $tmp;
				}
				else {
					foreach ($vlans as $vlan) {
						$tmp = new AppVLan($vlan);
						if($tmp->isConnected()){
							$ss = $this->getAppServersNameById($tmp->ServerIds);
							$names=null;						
							foreach ($ss as $serverName){
								if($names==null){
									$names=$serverName;
								}else{
									$names=$names.", ".$serverName;
								}								
							}
							$tmp->ServerNames=$names;
						}
						$vector[] = $tmp;
					}
				}
			}
		} 
		$this->VLans = $vector;
	}
	
	/**
	 * @return array of AppServerDetails
	 */
	public final function getServers() {
		return $this->Servers;
	}

	/**
	 * @return AppVLan
	 */
	public final function getVLans() {
		return $this->VLans;
	}

	/**
	 * @return AppIPAddress
	 */
	public final function getIPAddresses() {		
		return $this->IpAddresses;
	}

	public final function getAppServersNameById($ids = array()) {
		
		if(sizeof($ids) == 0 || sizeof($this->getServers()) == 0) {
			return array();
		}
		$response = array();
		foreach ($this->getServers() as $appSrvDetail) {
			$servID = $appSrvDetail->ServerId;
			
			if ($ids instanceof stdClass) {
				$tmp = $ids->int;
				if(!is_array($tmp)){
					$tmp = array($ids->int);
				}
				if (in_array($servID, $tmp)) {
					$response[] = $appSrvDetail->Name;
				}
			}
			else if (is_array($ids)) {
				$ints = array();
				if ($ids[0] instanceof stdClass) {
					$ints[] = $ids[0]->int;
				}
				else {
					$ints = $ids;
				}
				if (in_array($servID, $ints)) {
					$response[] = $appSrvDetail->Name;
				}
			}			
		}
		return $response;
	}
	
	public final function getAppServersById($ids = array()) {
		
		if(sizeof($ids) == 0 || sizeof($this->getServers()) == 0) {
			return array();
		}
		$response = array();
		foreach ($this->getServers() as $appSrvDetail) {
			$servID = $appSrvDetail->ServerId;
			
			if (is_array($ids)) {
				if (in_array($servID, $ids)) {
					$response[] = $appSrvDetail;
				}
			}
			else if ($ids instanceof stdClass) {
				$tmp = $ids->int;
				if(!is_array($tmp)){
					$tmp = array($ids->int);
				}
				if (in_array($servID, $tmp)) {
					$response[] = $appSrvDetail;
				}
			}			
			
		}
		return $response;
	}
}
?>