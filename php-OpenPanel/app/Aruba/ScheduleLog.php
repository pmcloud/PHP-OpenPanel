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

class ScheduleLog
{

  /**
   * 
   * @var dateTime $LastExecutionDate
   * @access public
   */
  public $LastExecutionDate;

  /**
   * 
   * @var int $LogCodeID
   * @access public
   */
  public $LogCodeID;

  /**
   * 
   * @var dateTime $LogDate
   * @access public
   */
  public $LogDate;

  /**
   * 
   * @var string $LogMessage
   * @access public
   */
  public $LogMessage;

  /**
   * 
   * @var ScheduledOperationTypes $Operation
   * @access public
   */
  public $Operation;

  /**
   * 
   * @var int $ScheduleID
   * @access public
   */
  public $ScheduleID;

  /**
   * 
   * @var string $ScheduleLabel
   * @access public
   */
  public $ScheduleLabel;

  /**
   * 
   * @var int $ServerID
   * @access public
   */
  public $ServerID;

  /**
   * 
   * @var string $ServerName
   * @access public
   */
  public $ServerName;

  /**
   * 
   * @var dateTime $StartDate
   * @access public
   */
  public $StartDate;

  /**
   * 
   * @param dateTime $LastExecutionDate
   * @param int $LogCodeID
   * @param dateTime $LogDate
   * @param string $LogMessage
   * @param ScheduledOperationTypes $Operation
   * @param int $ScheduleID
   * @param string $ScheduleLabel
   * @param int $ServerID
   * @param string $ServerName
   * @param dateTime $StartDate
   * @access public
   */
  public function __construct($LastExecutionDate, $LogCodeID, $LogDate, $LogMessage, $Operation, $ScheduleID, $ScheduleLabel, $ServerID, $ServerName, $StartDate)
  {
    $this->LastExecutionDate = $LastExecutionDate;
    $this->LogCodeID = $LogCodeID;
    $this->LogDate = $LogDate;
    $this->LogMessage = $LogMessage;
    $this->Operation = $Operation;
    $this->ScheduleID = $ScheduleID;
    $this->ScheduleLabel = $ScheduleLabel;
    $this->ServerID = $ServerID;
    $this->ServerName = $ServerName;
    $this->StartDate = $StartDate;
  }

}
