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

class ServerDetails
{

  /**
   * 
   * @var array $ActiveJobs
   * @access public
   */
  public $ActiveJobs;

  /**
   * 
   * @var Cpu $CPUQuantity
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
   * @var dateTime $CreationDate
   * @access public
   */
  public $CreationDate;

  /**
   * 
   * @var int $DatacenterId
   * @access public
   */
  public $DatacenterId;

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
   * @var array $NetworkAdapters
   * @access public
   */
  public $NetworkAdapters;

  /**
   * 
   * @var string $Note
   * @access public
   */
  public $Note;

  /**
   * 
   * @var Template $OSTemplate
   * @access public
   */
  public $OSTemplate;

  /**
   * 
   * @var array $Parameters
   * @access public
   */
  public $Parameters;

  /**
   * 
   * @var Ram $RAMQuantity
   * @access public
   */
  public $RAMQuantity;

  /**
   * 
   * @var array $ScheduledOperations
   * @access public
   */
  public $ScheduledOperations;

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
   * @var array $Snapshots
   * @access public
   */
  public $Snapshots;

  /**
   * 
   * @var boolean $ToolsAvailable
   * @access public
   */
  public $ToolsAvailable;

  /**
   * 
   * @var int $UserId
   * @access public
   */
  public $UserId;

  /**
   * 
   * @var array $VirtualDVDs
   * @access public
   */
  public $VirtualDVDs;

  /**
   * 
   * @var array $VirtualDisks
   * @access public
   */
  public $VirtualDisks;

  /**
   * 
   * @param array $ActiveJobs
   * @param Cpu $CPUQuantity
   * @param int $CompanyId
   * @param dateTime $CreationDate
   * @param int $DatacenterId
   * @param HypervisorServerTypes $HypervisorServerType
   * @param HypervisorTypes $HypervisorType
   * @param string $Name
   * @param array $NetworkAdapters
   * @param string $Note
   * @param Template $OSTemplate
   * @param array $Parameters
   * @param Ram $RAMQuantity
   * @param array $ScheduledOperations
   * @param int $ServerId
   * @param ServerStatus $ServerStatus
   * @param array $Snapshots
   * @param boolean $ToolsAvailable
   * @param int $UserId
   * @param array $VirtualDVDs
   * @param array $VirtualDisks
   * @access public
   */
  public function __construct($ActiveJobs, $CPUQuantity, $CompanyId, $CreationDate, $DatacenterId, $HypervisorServerType, $HypervisorType, $Name, $NetworkAdapters, $Note, $OSTemplate, $Parameters, $RAMQuantity, $ServerId, $ServerStatus, $Snapshots, $ToolsAvailable, $UserId, $VirtualDVDs, $VirtualDisks, $ScheduledOperations = null)
  {
    $this->ActiveJobs = $ActiveJobs;
    $this->CPUQuantity = $CPUQuantity;
    $this->CompanyId = $CompanyId;
    $this->CreationDate = $CreationDate;
    $this->DatacenterId = $DatacenterId;
    $this->HypervisorServerType = $HypervisorServerType;
    $this->HypervisorType = $HypervisorType;
    $this->Name = $Name;
    $this->NetworkAdapters = $NetworkAdapters;
    $this->Note = $Note;
    $this->OSTemplate = $OSTemplate;
    $this->Parameters = $Parameters;
    $this->RAMQuantity = $RAMQuantity;
    $this->ScheduledOperations = $ScheduledOperations;
    $this->ServerId = $ServerId;
    $this->ServerStatus = $ServerStatus;
    $this->Snapshots = $Snapshots;
    $this->ToolsAvailable = $ToolsAvailable;
    $this->UserId = $UserId;
    $this->VirtualDVDs = $VirtualDVDs;
    $this->VirtualDisks = $VirtualDisks;
  }

}
