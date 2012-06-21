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

class Job
{

  /**
   * 
   * @var dateTime $CreationDate
   * @access public
   */
  public $CreationDate;

  /**
   * 
   * @var int $JobId
   * @access public
   */
  public $JobId;

  /**
   * 
   * @var dateTime $LastUpdateDate
   * @access public
   */
  public $LastUpdateDate;

  /**
   * 
   * @var string $OperationName
   * @access public
   */
  public $OperationName;

  /**
   * 
   * @var int $Progress
   * @access public
   */
  public $Progress;

  /**
   * 
   * @var int $ResourceId
   * @access public
   */
  public $ResourceId;

  /**
   * 
   * @var string $ResourceValue
   * @access public
   */
  public $ResourceValue;

  /**
   * 
   * @var int $ServerId
   * @access public
   */
  public $ServerId;

  /**
   * 
   * @var string $ServerName
   * @access public
   */
  public $ServerName;

  /**
   * 
   * @var JobStatus $Status
   * @access public
   */
  public $Status;

  /**
   * 
   * @var int $UserId
   * @access public
   */
  public $UserId;

  /**
   * 
   * @var string $Username
   * @access public
   */
  public $Username;

  /**
   * 
   * @param dateTime $CreationDate
   * @param int $JobId
   * @param dateTime $LastUpdateDate
   * @param string $OperationName
   * @param int $Progress
   * @param int $ResourceId
   * @param string $ResourceValue
   * @param int $ServerId
   * @param string $ServerName
   * @param JobStatus $Status
   * @param int $UserId
   * @param string $Username
   * @access public
   */
  public function __construct($CreationDate, $JobId, $LastUpdateDate, $OperationName, $Progress, $ResourceId, $ResourceValue, $ServerId, $ServerName, $Status, $UserId, $Username)
  {
    $this->CreationDate = $CreationDate;
    $this->JobId = $JobId;
    $this->LastUpdateDate = $LastUpdateDate;
    $this->OperationName = $OperationName;
    $this->Progress = $Progress;
    $this->ResourceId = $ResourceId;
    $this->ResourceValue = $ResourceValue;
    $this->ServerId = $ServerId;
    $this->ServerName = $ServerName;
    $this->Status = $Status;
    $this->UserId = $UserId;
    $this->Username = $Username;
  }

}
