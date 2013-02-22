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

include_once 'AppJobStatus.php';

class AppLog
{

	/**
	 *
	 * @var int $JobId
	 * @access public
	 */
	public $JobId;

	/**
	 *
	 * @var dateTime $LogDate
	 * @access private
	 */
	private $LogDate;

	/**
	 *
	 * @var int $LogId
	 * @access public
	 */
	public $LogId;

	/**
	 *
	 * @var dateTime $LogLastUpdateDate
	 * @access private
	 */
	private $LogLastUpdateDate;

	/**
	 *
	 * @var string $Message
	 * @access public
	 */
	public $Message;

	/**
	 *
	 * @var int $MessageId
	 * @access public
	 */
	public $MessageId;

	/**
	 *
	 * @var string $OperationName
	 * @access public
	 */
	public $OperationName;

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
	 * @access private
	 */
	private $Status;

	//  /**
	//   *
	//   * @var int $UserId
	//   * @access public
	//   */
	//  public $UserId;

	/**
	 *
	 * @var string $Username
	 * @access public
	 */
	public $Username;

	/**
	 * @access public
	 */
	public function __construct($log)
	{
		$this->JobId = $log->JobId;
		$this->LogDate = $log->LogDate;
		$this->LogId = $log->LogId;
		$this->LogLastUpdateDate = $log->LogLastUpdateDate;
		$this->Message = $log->Message;
		$this->MessageId = $log->MessageId;
		$this->OperationName = $log->OperationName;
		$this->ResourceId = $log->ResourceId;
		$this->ResourceValue = $log->ResourceValue;
		$this->ServerId = $log->ServerId;
		$this->ServerName = $log->ServerName;
		$this->Status = $log->Status;
		//$this->UserId = $log->UserId;
		$this->Username = $log->Username;
	}

	public final function getTargetResource() {
		$resource = $this->ServerName;
		if ($resource == null && sizeof($resource) == 0) {
			$resource = $this->ResourceValue;
		}
		if ($resource === 0) {
			$resource = "---";
		}
		return $resource;
	}


	public final function getStartDatetime() {
		$dt = $this->LogDate;
		//if (is_a($dt, 'dateTime')) {
		if ($dt instanceof DateTime) {
			return $dt->format("Y-m-d H:i:s");
		}
		//date_default_timezone_set("Europe/Rome");
		$ts = strtotime($dt);
		if ($ts > 0) {

			return date("Y-m-d H:i:s", $ts);
		}
		return "---";
	}

	public final function getLastUpdateDatetime() {
		$dt = $this->LogLastUpdateDate;
		//if (is_a($dt, 'dateTime')) {
		if ($dt instanceof DateTime) {		
			return $dt->format("Y-m-d H:i:s");
		}
		$ts = strtotime($dt);
		if ($ts > 0) {
			return date("Y-m-d H:i:s", $ts);
		}
		return "---";
	}

	/**
	 * @return a const value from AppJobStatus 'enum'
	 */
	public final function getStatus() {
		return AppJobStatus::get($this->Status);
	}
	
	/**
	 * @return boolean
	 */
	public final function isInErrorState() {
		return AppJobStatus::isSameValue(AppJobStatus::ERROR, $this->Status);
	}
}
?>
