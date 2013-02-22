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
include_once 'Credit.php';

class AppCredit
{

  /**
   * 
   * @var float $OverdraftLimit
   * @access public
   */
  public $OverdraftLimit;

  /**
   * 
   * @var float $Value
   * @access public
   */
  public $Value;

  
  /**
   * @param Credit $credit
   */
  public function __construct($credit)
  {
	if ($credit != null) {
	  	$this->OverdraftLimit = $credit->OverdraftLimit;
	    $this->Value = $credit->Value;		
	}
  }

  
  public final function toString($locale = 'it_IT') {
  	
  	//setlocale(LC_MONETARY, "it_IT");
  	//money_format ??
  	$myCredit = 0;
  	if ($this->Value != null) {
  		$myCredit = $this->Value;
  	}
  	//setlocale(LC_NUMERIC, $locale); // ??
  	if ("it_IT" == $locale) {
  		return number_format($myCredit, 2, ',', '.');
  	} 
  	else {
  		return number_format($myCredit, 2);
  	}
  	
  }
  
  
}
?>