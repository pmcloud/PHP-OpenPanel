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

class FTP
{

  /**
   * 
   * @var dateTime $CreationDate
   * @access public
   */
  public $CreationDate;

  /**
   * 
   * @var int $DataCenterID
   * @access public
   */
  public $DataCenterID;

  /**
   * 
   * @var int $FTPAccountID
   * @access public
   */
  public $FTPAccountID;

  /**
   * 
   * @var FTPAccountStatus $FTPAccountStatus
   * @access public
   */
  public $FTPAccountStatus;

  /**
   * 
   * @var FTPServer $FTPServer
   * @access public
   */
  public $FTPServer;

  /**
   * 
   * @var string $Path
   * @access public
   */
  public $Path;

  /**
   * 
   * @var int $ProductID
   * @access public
   */
  public $ProductID;

  /**
   * 
   * @var int $Quantity
   * @access public
   */
  public $Quantity;

  /**
   * 
   * @var int $ResourceID
   * @access public
   */
  public $ResourceID;

  /**
   * 
   * @var int $UsedSpace
   * @access public
   */
  public $UsedSpace;

  /**
   * 
   * @var int $UserID
   * @access public
   */
  public $UserID;

  /**
   * 
   * @param dateTime $CreationDate
   * @param int $DataCenterID
   * @param int $FTPAccountID
   * @param FTPAccountStatus $FTPAccountStatus
   * @param FTPServer $FTPServer
   * @param string $Path
   * @param int $ProductID
   * @param int $Quantity
   * @param int $ResourceID
   * @param int $UsedSpace
   * @param int $UserID
   * @access public
   */
  public function __construct($CreationDate, $DataCenterID, $FTPAccountID, $FTPAccountStatus, $FTPServer, $Path, $ProductID, $Quantity, $ResourceID, $UsedSpace, $UserID)
  {
    $this->CreationDate = $CreationDate;
    $this->DataCenterID = $DataCenterID;
    $this->FTPAccountID = $FTPAccountID;
    $this->FTPAccountStatus = $FTPAccountStatus;
    $this->FTPServer = $FTPServer;
    $this->Path = $Path;
    $this->ProductID = $ProductID;
    $this->Quantity = $Quantity;
    $this->ResourceID = $ResourceID;
    $this->UsedSpace = $UsedSpace;
    $this->UserID = $UserID;
  }

}
