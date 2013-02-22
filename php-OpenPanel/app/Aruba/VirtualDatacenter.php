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

class VirtualDatacenter
{

  /**
   * 
   * @var int $DatacenterId
   * @access public
   */
  public $DatacenterId;

  /**
   * 
   * @var FTP $FTP
   * @access public
   */
  public $FTP;

  /**
   * 
   * @var array $IpAddresses
   * @access public
   */
  public $IpAddresses;

  /**
   * 
   * @var array $PleskLicenses
   * @access public
   */
  public $PleskLicenses;

  /**
   * 
   * @var array $Servers
   * @access public
   */
  public $Servers;

  /**
   * 
   * @var array $VLans
   * @access public
   */
  public $VLans;

  /**
   * 
   * @param int $DatacenterId
   * @param FTP $FTP
   * @param array $IpAddresses
   * @param array $PleskLicenses
   * @param array $Servers
   * @param array $VLans
   * @access public
   */
  public function __construct($DatacenterId, $FTP, $IpAddresses, $Servers, $VLans, $PleskLicenses = null)
  {
    $this->DatacenterId = $DatacenterId;
    $this->FTP = $FTP;
    $this->IpAddresses = $IpAddresses;
    $this->PleskLicenses = $PleskLicenses;
    $this->Servers = $Servers;
    $this->VLans = $VLans;
  }

}
