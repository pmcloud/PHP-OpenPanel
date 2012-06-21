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
include_once 'VLan.php';

class AppVLan
{
	
	/**
   * 
   * @var int $ResourceId
   * @access public
   */
 	 public $ResourceId;	

	/**
	 *
	 * @var string $Name
	 * @access public
	 */
	public $Name;

	/**
	 *
	 * @var array $ServerIds
	 * @access public
	 */
	public $ServerIds;

	/**
	 *
	 * @var string $VlanCode
	 * @access public
	 */
	public $VlanCode;
	
	/**
	 *
	 * @var string $ServerNames
	 * @access public
	 */
	public $ServerNames;

	/**
	 *
	 * @access public
	 */
	public function __construct($vlan)
	{
		if ($vlan != null) {
			$this->ResourceId=$vlan->ResourceId;
			$this->Name = $vlan->Name;
			$this->VlanCode = $vlan->VlanCode;
			$this->ServerIds = $vlan->ServerIds;
		}
	}

	public final function isConnected() {
		if ($this->ServerIds != null ) {
			if (is_array($this->ServerIds)) {
				return (sizeof($this->ServerIds) > 0);
			}			
			if ($this->ServerIds instanceof  stdClass) {
				return isset($this->ServerIds->int);
			}
		}
		return false;
	}
	
	public final function isConnectedTo($ServerId) {
		if ($this->ServerIds != null ) {
			if (is_array($this->ServerIds)) {
				return in_array($ServerId, $this->ServerIds);
			}			
			if ($this->ServerIds instanceof  stdClass) {
				if(isset($this->ServerIds->int)){
					$tmp = $this->ServerIds->int;
					if(!is_array($tmp)){
						$tmp = array($this->ServerIds->int);
					}
					return in_array($ServerId, $tmp);
				}
			}
		}
		return false;
	}
	
}

?>