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

class NetworkAdapter
{

  /**
   * 
   * @var array $IPAddresses
   * @access public
   */
  public $IPAddresses;

  /**
   * 
   * @var int $Id
   * @access public
   */
  public $Id;

  /**
   * 
   * @var string $MacAddress
   * @access public
   */
  public $MacAddress;

  /**
   * 
   * @var NetworkAdapterTypes $NetworkAdapterType
   * @access public
   */
  public $NetworkAdapterType;

  /**
   * 
   * @var int $ServerId
   * @access public
   */
  public $ServerId;

  /**
   * 
   * @var VLan $VLan
   * @access public
   */
  public $VLan;

  /**
   * 
   * @param array $IPAddresses
   * @param int $Id
   * @param string $MacAddress
   * @param NetworkAdapterTypes $NetworkAdapterType
   * @param int $ServerId
   * @param VLan $VLan
   * @access public
   */
  public function __construct($IPAddresses, $Id, $MacAddress, $NetworkAdapterType, $ServerId, $VLan)
  {
    $this->IPAddresses = $IPAddresses;
    $this->Id = $Id;
    $this->MacAddress = $MacAddress;
    $this->NetworkAdapterType = $NetworkAdapterType;
    $this->ServerId = $ServerId;
    $this->VLan = $VLan;
  }

}
