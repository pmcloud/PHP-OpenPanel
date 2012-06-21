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
final class AppNetworkAdapterType {
	
	const ETHERNET_0 = "Ethernet0";    
    const ETHERNET_1 = "Ethernet1";    
    const ETHERNET_2 = "Ethernet2";
    
    private $currentValue = null;
    
    public function __construct($currentValue) {
    	$this->currentValue = $currentValue;
    }
    
	/**
	 * @param string $strValue
	 * @return string
	 */
	public final static function get($strValue) {
		if ($strValue != null) {
			switch ($strValue) {
				case self::ETHERNET_0:
					return self::ETHERNET_0;				
				case self::ETHERNET_1:
					return self::ETHERNET_1;
				case self::ETHERNET_2:
					return self::ETHERNET_2;
			};
		}
		return "";
	}
	
	
    public final function getCurrentValue() {
    	return ($this->currentValue != null ? $this->get($this->currentValue) : "");
    }
    
	public final static function isSameValue($enumItem, $strValue) {
		if ($enumItem == null) {
			return false;
		}
		return strcmp($enumItem, $strValue) == 0;
	}
	
    final static function values() {
    	return array(self::ETHERNET_0, self::ETHERNET_1, self::ETHERNET_2);
    }
        
}
?>