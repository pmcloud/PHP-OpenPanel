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

include_once 'AppVLan.php';
include_once 'AppIPAddress.php';
include_once 'AppNetworkAdapterType.php';

class AppNetworkAdapter
{

	/**
	 * @var array $IPAddresses
	 * @access private
	 */
	private $IPAddresses;

	/**
	 *
	 * @var int $Id
	 * @access private
	 */
	private $Id;

	/**
	 *
	 * @var string $MacAddress
	 * @access private
	 */
	private $MacAddress;

	/**
	 *
	 * @var NetworkAdapterTypes $NetworkAdapterType
	 * @access private
	 */
	private $NetworkAdapterType;

	/**
	 *
	 * @var int $ServerId
	 * @access private
	 */
	private $ServerId;

	/**
	 *
	 * @var AppVLan $VLan
	 * @access private
	 */
	private $VLan;

	/**
	 * @access public
	 */
	public function __construct($networkAdapter)
	{
		if ($networkAdapter != null) {			
			$this->Id = $networkAdapter->Id;		
			$this->MacAddress = $networkAdapter->MacAddress;
			$this->NetworkAdapterType = $networkAdapter->NetworkAdapterType;
			$this->ServerId = $networkAdapter->ServerId;
			
			$this->setVlan($networkAdapter);
			$this->setIPAddresses($networkAdapter);
		}
	}

	private final function setVlan($networkAdapter) {
		if ($networkAdapter->VLan != null) {
			$this->VLan = new AppVLan($networkAdapter->VLan);		
		}
	}
	
	private final function setIPAddresses($networkAdapter) {
		$vector = array();
		// $networkAdapter->IpAddresses returns a stdClass
  		if ($networkAdapter->IPAddresses != null && isset($networkAdapter->IPAddresses->IPAddress)) {
	  		$ips = $networkAdapter->IPAddresses->IPAddress;
	  		if ($ips != null) {
	  			if (sizeof($ips) == 1) {	  				
	  				$vector[] = new AppIPAddress($ips);
	  			}
	  			else {
		  			foreach ($ips as $ip) {
		  				$vector[] = new AppIPAddress($ip);
		  			}
	  			}
		  	}
  		}	
  		$this->IPAddresses = $vector;
	}
	
	public final function getId() {
		return $this->Id;
	}
	
	public final function getIpAddresses() {
		return $this->IPAddresses;		
	}
	
	public final function getMacAddress() {
		return $this->MacAddress;
	}
	
	public final function getNetworkAdapterType() {
		return AppNetworkAdapterType::get($this->NetworkAdapterType);
	}

	public final function getServerId() {
		return $this->ServerId;
	}
	
	public final function getVLan() {
		return $this->VLan;
	}
	public final function getVLanName() {
		return ($this->getVLan() != null ? $this->getVLan()->Name : "");
	}
	
	public final function isAssociatedToPublicIPs() {
		return (sizeof($this->getIpAddresses()) > 0);
	}
	
	public final function isAssociatedToVirtualSwitch() {
		return $this->getVLan() != null;
	}
	
	public final function isConnected() {
		return ($this->isAssociatedToPublicIPs() || $this->isAssociatedToVirtualSwitch()); 
	}
	
	
}
?>