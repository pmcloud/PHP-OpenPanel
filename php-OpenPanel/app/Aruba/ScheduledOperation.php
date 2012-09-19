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

class ScheduledOperation
{

  /**
   * 
   * @var ScheduledOperationTypes $Operation
   * @access public
   */
  public $Operation;

  /**
   * 
   * @var ScheduledOwnerTypes $OwnerType
   * @access public
   */
  public $OwnerType;

  /**
   * 
   * @var int $ScheduledOperationID
   * @access public
   */
  public $ScheduledOperationID;

  /**
   * 
   * @var string $ScheduledOperationLabel
   * @access public
   */
  public $ScheduledOperationLabel;

  /**
   * 
   * @var dateTime $ScheduledStartDate
   * @access public
   */
  public $ScheduledStartDate;

  /**
   * 
   * @var string $ServerName
   * @access public
   */
  public $ServerName;

  /**
   * 
   * @param ScheduledOperationTypes $Operation
   * @param ScheduledOwnerTypes $OwnerType
   * @param int $ScheduledOperationID
   * @param string $ScheduledOperationLabel
   * @param dateTime $ScheduledStartDate
   * @param string $ServerName
   * @access public
   */
  public function __construct($Operation, $OwnerType, $ScheduledOperationID, $ScheduledOperationLabel, $ScheduledStartDate, $ServerName)
  {
    $this->Operation = $Operation;
    $this->OwnerType = $OwnerType;
    $this->ScheduledOperationID = $ScheduledOperationID;
    $this->ScheduledOperationLabel = $ScheduledOperationLabel;
    $this->ScheduledStartDate = $ScheduledStartDate;
    $this->ServerName = $ServerName;
  }

}
