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

final class AppTemplateType {
	
	const WINDOWS= "Windows";    
    const LINUX= "Linux";    
    const CUSTOM = "Custom";    
    
    
	/**
	 * @param string $strValue
	 * @return string
	 */
	public final static function get($strValue) {
		if ($strValue != null) {
			switch ($strValue) {
				case self::WINDOWS:
					return self::WINDOWS;				
				case self::LINUX:
					return self::LINUX;
				case self::CUSTOM:
					return self::CUSTOM;
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
		return array(self::WINDOWS, self::LINUX, self::CUSTOM);
	}
	
}
?>