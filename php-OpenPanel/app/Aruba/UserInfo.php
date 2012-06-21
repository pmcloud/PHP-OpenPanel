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

class UserInfo
{

  /**
   * 
   * @var int $CompanyID
   * @access public
   */
  public $CompanyID;

  /**
   * 
   * @var string $CompanyName
   * @access public
   */
  public $CompanyName;

  /**
   * 
   * @var int $UserID
   * @access public
   */
  public $UserID;

  /**
   * 
   * @var string $UserName
   * @access public
   */
  public $UserName;

  /**
   * 
   * @var Roles $UserRole
   * @access public
   */
  public $UserRole;

  /**
   * 
   * @var UserStatus $UserStatus
   * @access public
   */
  public $UserStatus;

  /**
   * 
   * @param int $CompanyID
   * @param string $CompanyName
   * @param int $UserID
   * @param string $UserName
   * @param Roles $UserRole
   * @param UserStatus $UserStatus
   * @access public
   */
  public function __construct($CompanyID, $CompanyName, $UserID, $UserName, $UserRole, $UserStatus)
  {
    $this->CompanyID = $CompanyID;
    $this->CompanyName = $CompanyName;
    $this->UserID = $UserID;
    $this->UserName = $UserName;
    $this->UserRole = $UserRole;
    $this->UserStatus = $UserStatus;
  }

}
