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

class VirtualDatacenterCost
{

  /**
   * 
   * @var string $CurrencyCode
   * @access public
   */
  public $CurrencyCode;

  /**
   * 
   * @var int $DatacenterId
   * @access public
   */
  public $DatacenterId;

  /**
   * 
   * @var FTPCost $FTPCost
   * @access public
   */
  public $FTPCost;

  /**
   * 
   * @var IpAddressCost $IpAddressCost
   * @access public
   */
  public $IpAddressCost;

  /**
   * 
   * @var array $PleskLicensesCost
   * @access public
   */
  public $PleskLicensesCost;

  /**
   * 
   * @var array $ServerCost
   * @access public
   */
  public $ServerCost;

  /**
   * 
   * @var ResourceCost $VLanCost
   * @access public
   */
  public $VLanCost;

  /**
   * 
   * @param string $CurrencyCode
   * @param int $DatacenterId
   * @param FTPCost $FTPCost
   * @param IpAddressCost $IpAddressCost
   * @param array $PleskLicensesCost
   * @param array $ServerCost
   * @param ResourceCost $VLanCost
   * @access public
   */
  public function __construct($CurrencyCode, $DatacenterId, $IpAddressCost, $ServerCost, $VLanCost, $FTPCost = null,$PleskLicensesCost = null)
  {
    $this->CurrencyCode = $CurrencyCode;
    $this->DatacenterId = $DatacenterId;
    $this->FTPCost = $FTPCost;
    $this->IpAddressCost = $IpAddressCost;
    $this->PleskLicensesCost = $PleskLicensesCost;
    $this->ServerCost = $ServerCost;
    $this->VLanCost = $VLanCost;
  }

}
