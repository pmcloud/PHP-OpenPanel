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

final class AppResourceType {

	const CPU= "Cpu";
	const RAM = "Ram";
	const HARD_DISK_0 = "HardDisk0";
	const HARD_DISK_1 = "HardDisk1";
	const HARD_DISK_2 = "HardDisk2";
	const HARD_DISK_3 = "HardDisk3";	
	const V_LAN= "VLan";
	const IP= "Ip";
	
	/**
	 * @param string $strValue
	 * @return string
	 */
	public final static function get($strValue) {
		if ($strValue != null) {
			switch ($strValue) {
				case self::CPU:
					return self::CPU;				
				case self::RAM:
					return self::RAM;
				case self::HARD_DISK_0:
					return self::HARD_DISK_0;
				case self::HARD_DISK_1:
					return self::HARD_DISK_1;
				case self::HARD_DISK_2:
					return self::HARD_DISK_2;
				case self::HARD_DISK_3:
					return self::HARD_DISK_3;
				case self::V_LAN:
					return self::V_LAN;	
				case self::IP:
					return self::IP;
				
			};
		}
		return "";
	}
	
	public final static function isSameValue($enumItem, $strValue) {
		if ($enumItem == null) {
			return false;
		}
		return strcmp($enumItem, $strValue) == 0;
	}
	
	public final static function values() {
		return array(self::CPU, self::RAM, self::HARD_DISK_0, self::HARD_DISK_1, self::HARD_DISK_2, self::HARD_DISK_3, self::V_LAN, self::IP);
	}
	
}
?>