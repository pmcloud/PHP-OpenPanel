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

class SetUpdateServerScheduledOperation
{

  /**
   * 
   * @var int $scheduledOperationID
   * @access public
   */
  public $scheduledOperationID;

  /**
   * 
   * @var ScheduledOperationTypes $operation
   * @access public
   */
  public $operation;

  /**
   * 
   * @var dateTime $scheduledStartDate
   * @access public
   */
  public $scheduledStartDate;

  /**
   * 
   * @var string $scheduledOperationLabel
   * @access public
   */
  public $scheduledOperationLabel;

  /**
   * 
   * @param int $scheduledOperationID
   * @param ScheduledOperationTypes $operation
   * @param dateTime $scheduledStartDate
   * @param string $scheduledOperationLabel
   * @access public
   */
  public function __construct($scheduledOperationID, $operation, $scheduledStartDate, $scheduledOperationLabel)
  {
    $this->scheduledOperationID = $scheduledOperationID;
    $this->operation = $operation;
    $this->scheduledStartDate = $scheduledStartDate;
    $this->scheduledOperationLabel = $scheduledOperationLabel;
  }

}
