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

class PleskLicense
{

  /**
   * 
   * @var array $AddonLicenses
   * @access public
   */
  public $AddonLicenses;

  /**
   * 
   * @var dateTime $CreationDate
   * @access public
   */
  public $CreationDate;

  /**
   * 
   * @var string $LicenseCode
   * @access public
   */
  public $LicenseCode;

  /**
   * 
   * @var string $LicenseDescription
   * @access public
   */
  public $LicenseDescription;

  /**
   * 
   * @var int $LicenseID
   * @access public
   */
  public $LicenseID;

  /**
   * 
   * @var array $LicenseKeys
   * @access public
   */
  public $LicenseKeys;

  /**
   * 
   * @var int $LicensePleskTypeID
   * @access public
   */
  public $LicensePleskTypeID;

  /**
   * 
   * @var LicenseStatusTypes $LicenseStatus
   * @access public
   */
  public $LicenseStatus;

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
   * @param array $AddonLicenses
   * @param dateTime $CreationDate
   * @param string $LicenseCode
   * @param string $LicenseDescription
   * @param int $LicenseID
   * @param array $LicenseKeys
   * @param int $LicensePleskTypeID
   * @param LicenseStatusTypes $LicenseStatus
   * @param int $ProductID
   * @param int $Quantity
   * @param int $ResourceID
   * @access public
   */
  public function __construct($AddonLicenses, $CreationDate, $LicenseCode, $LicenseDescription, $LicenseID, $LicenseKeys, $LicensePleskTypeID, $LicenseStatus, $ProductID, $Quantity, $ResourceID)
  {
    $this->AddonLicenses = $AddonLicenses;
    $this->CreationDate = $CreationDate;
    $this->LicenseCode = $LicenseCode;
    $this->LicenseDescription = $LicenseDescription;
    $this->LicenseID = $LicenseID;
    $this->LicenseKeys = $LicenseKeys;
    $this->LicensePleskTypeID = $LicensePleskTypeID;
    $this->LicenseStatus = $LicenseStatus;
    $this->ProductID = $ProductID;
    $this->Quantity = $Quantity;
    $this->ResourceID = $ResourceID;
  }

}
