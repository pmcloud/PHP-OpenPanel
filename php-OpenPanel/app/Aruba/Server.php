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

class Server
{

  /**
   * 
   * @var int $CPUQuantity
   * @access public
   */
  public $CPUQuantity;

  /**
   * 
   * @var int $CompanyId
   * @access public
   */
  public $CompanyId;

  /**
   * 
   * @var int $DatacenterId
   * @access public
   */
  public $DatacenterId;

  /**
   * 
   * @var int $HDQuantity
   * @access public
   */
  public $HDQuantity;

  /**
   * 
   * @var int $HDTotalSize
   * @access public
   */
  public $HDTotalSize;

  /**
   * 
   * @var HypervisorServerTypes $HypervisorServerType
   * @access public
   */
  public $HypervisorServerType;

  /**
   * 
   * @var HypervisorTypes $HypervisorType
   * @access public
   */
  public $HypervisorType;

  /**
   * 
   * @var string $Name
   * @access public
   */
  public $Name;

  /**
   * 
   * @var int $OSTemplateId
   * @access public
   */
  public $OSTemplateId;

  /**
   * 
   * @var int $RAMQuantity
   * @access public
   */
  public $RAMQuantity;

  /**
   * 
   * @var int $ServerId
   * @access public
   */
  public $ServerId;

  /**
   * 
   * @var ServerStatus $ServerStatus
   * @access public
   */
  public $ServerStatus;

  /**
   * 
   * @var int $UserId
   * @access public
   */
  public $UserId;

  /**
   * 
   * @param int $CPUQuantity
   * @param int $CompanyId
   * @param int $DatacenterId
   * @param int $HDQuantity
   * @param int $HDTotalSize
   * @param HypervisorServerTypes $HypervisorServerType
   * @param HypervisorTypes $HypervisorType
   * @param string $Name
   * @param int $OSTemplateId
   * @param int $RAMQuantity
   * @param int $ServerId
   * @param ServerStatus $ServerStatus
   * @param int $UserId
   * @access public
   */
  public function __construct($CPUQuantity, $CompanyId, $DatacenterId, $HDQuantity, $HDTotalSize, $HypervisorServerType, $HypervisorType, $Name, $OSTemplateId, $RAMQuantity, $ServerId, $ServerStatus, $UserId)
  {
    $this->CPUQuantity = $CPUQuantity;
    $this->CompanyId = $CompanyId;
    $this->DatacenterId = $DatacenterId;
    $this->HDQuantity = $HDQuantity;
    $this->HDTotalSize = $HDTotalSize;
    $this->HypervisorServerType = $HypervisorServerType;
    $this->HypervisorType = $HypervisorType;
    $this->Name = $Name;
    $this->OSTemplateId = $OSTemplateId;
    $this->RAMQuantity = $RAMQuantity;
    $this->ServerId = $ServerId;
    $this->ServerStatus = $ServerStatus;
    $this->UserId = $UserId;
  }

}
