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

class Price
{

  /**
   * 
   * @var BillingTypes $BillingType
   * @access public
   */
  public $BillingType;

  /**
   * 
   * @var HypervisorTypes $HypervisorType
   * @access public
   */
  public $HypervisorType;

  /**
   * 
   * @var array $Modifiers
   * @access public
   */
  public $Modifiers;

  /**
   * 
   * @var int $ProductID
   * @access public
   */
  public $ProductID;

  /**
   * 
   * @var ResourceTypes $ResourceType
   * @access public
   */
  public $ResourceType;

  /**
   * 
   * @var int $TimeUnitInHours
   * @access public
   */
  public $TimeUnitInHours;

  /**
   * 
   * @var float $Value
   * @access public
   */
  public $Value;

  /**
   * 
   * @param BillingTypes $BillingType
   * @param HypervisorTypes $HypervisorType
   * @param array $Modifiers
   * @param int $ProductID
   * @param ResourceTypes $ResourceType
   * @param int $TimeUnitInHours
   * @param float $Value
   * @access public
   */
  public function __construct($BillingType, $HypervisorType, $Modifiers, $ProductID, $ResourceType, $TimeUnitInHours, $Value)
  {
    $this->BillingType = $BillingType;
    $this->HypervisorType = $HypervisorType;
    $this->Modifiers = $Modifiers;
    $this->ProductID = $ProductID;
    $this->ResourceType = $ResourceType;
    $this->TimeUnitInHours = $TimeUnitInHours;
    $this->Value = $Value;
  }

}
