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

final class AppWsResult
{

  /**
   * 
   * @var ExceptionInfo $ExceptionInfo
   * @access private
   */
  private $ExceptionInfo;

  /**
   * 
   * @var int $ResultCode
   * @access private
   */
  private $ResultCode;

  /**
   * 
   * @var string $ResultMessage
   * @access private
   */
  private $ResultMessage;

  /**
   * 
   * @var boolean $Success
   * @access private
   */
  private $Success;
  
  
  /**
   * 
   * Result Value of method (if any)
   * @var Object
   */
  private $Value;

  /**
   * @access public
   */
  public function __construct($wsResult)
  {
  	if ($wsResult != null) { 
	    $this->ExceptionInfo = $wsResult->ExceptionInfo;
	    $this->ResultCode = $wsResult->ResultCode;
	    $this->ResultMessage = $wsResult->ResultMessage;
	    $this->Success = $wsResult->Success;
	    
	    try {
	    	if (isset($wsResult->Value)) {
	    		$this->Value = $wsResult->Value;
	    	}
	    } 
	    catch (Exception $dontCare) {}
  	}
  	else {
  		 $this->Success = false;
  	}
  }

  public final function isSuccess() {
  	return $this->Success;	
  }
  
  public final function getSuccessMessage() {
  	return (($this->isSuccess() && $this->ResultMessage) ? $this->ResultMessage : "");
  }
  
  public final function getSuccessCode() {
  	return ($this->isSuccess() ? $this->ResultCode : null);
  }

  public final function getErrorMessage() {
  	return ((!$this->isSuccess() && $this->ResultMessage) ? $this->ResultMessage : "");
  }
  
  public final function getErrorCode() {
  	return (!$this->isSuccess() ? $this->ResultCode : null);
  }

  public final function hasException() {
  	return ($this->ExceptionInfo == true);
  }
  
  public final function getExceptionInfo() {
  	return ($this->hasException() ? $this->ExceptionInfo : "");
  }
  
  public final function getValue() {
  	return $this->Value!=null?$this->Value:array();
  }
  
	public function getErrorDescription(){
  	if(!$Success){
  		return '<br>'.__('[Web Service Error] ').__($this->ResultMessage);
  	}
  }
  
  
}

?>