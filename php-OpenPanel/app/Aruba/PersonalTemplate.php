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

class PersonalTemplate
{

  /**
   * 
   * @var int $ApplianceTypeID
   * @access public
   */
  public $ApplianceTypeID;

  /**
   * 
   * @var int $ArchitectureTypeID
   * @access public
   */
  public $ArchitectureTypeID;

  /**
   * 
   * @var int $CompanyID
   * @access public
   */
  public $CompanyID;

  /**
   * 
   * @var dateTime $DateEnd
   * @access public
   */
  public $DateEnd;

  /**
   * 
   * @var dateTime $DateStart
   * @access public
   */
  public $DateStart;

  /**
   * 
   * @var boolean $Exportable
   * @access public
   */
  public $Exportable;

  /**
   * 
   * @var HypervisorTypes $HypervisorType
   * @access public
   */
  public $HypervisorType;

  /**
   * 
   * @var base64Binary $Icon
   * @access public
   */
  public $Icon;

  /**
   * 
   * @var string $IdentificationCode
   * @access public
   */
  public $IdentificationCode;

  /**
   * 
   * @var dateTime $InsertDate
   * @access public
   */
  public $InsertDate;

  /**
   * 
   * @var int $OSFamilyID
   * @access public
   */
  public $OSFamilyID;

  /**
   * 
   * @var string $OSVersion
   * @access public
   */
  public $OSVersion;

  /**
   * 
   * @var string $Revision
   * @access public
   */
  public $Revision;

  /**
   * 
   * @var float $Size
   * @access public
   */
  public $Size;

  /**
   * 
   * @var array $TemplateBounds
   * @access public
   */
  public $TemplateBounds;

  /**
   * 
   * @var string $TemplateDescription
   * @access public
   */
  public $TemplateDescription;

  /**
   * 
   * @var string $TemplateExtendedDescription
   * @access public
   */
  public $TemplateExtendedDescription;

  /**
   * 
   * @var array $TemplateFeatures
   * @access public
   */
  public $TemplateFeatures;

  /**
   * 
   * @var int $TemplateID
   * @access public
   */
  public $TemplateID;

  /**
   * 
   * @var string $TemplateName
   * @access public
   */
  public $TemplateName;

  /**
   * 
   * @var string $TemplatePassword
   * @access public
   */
  public $TemplatePassword;

  /**
   * 
   * @var TemplateSellingStatus $TemplateSellingStatus
   * @access public
   */
  public $TemplateSellingStatus;

  /**
   * 
   * @var TemplateStatus $TemplateStatus
   * @access public
   */
  public $TemplateStatus;

  /**
   * 
   * @var TemplateTypes $TemplateType
   * @access public
   */
  public $TemplateType;

  /**
   * 
   * @var string $TemplateUsername
   * @access public
   */
  public $TemplateUsername;

  /**
   * 
   * @var int $UserID
   * @access public
   */
  public $UserID;

  /**
   * 
   * @param int $ApplianceTypeID
   * @param int $ArchitectureTypeID
   * @param int $CompanyID
   * @param dateTime $DateEnd
   * @param dateTime $DateStart
   * @param boolean $Exportable
   * @param HypervisorTypes $HypervisorType
   * @param base64Binary $Icon
   * @param string $IdentificationCode
   * @param dateTime $InsertDate
   * @param int $OSFamilyID
   * @param string $OSVersion
   * @param string $Revision
   * @param float $Size
   * @param array $TemplateBounds
   * @param string $TemplateDescription
   * @param string $TemplateExtendedDescription
   * @param array $TemplateFeatures
   * @param int $TemplateID
   * @param string $TemplateName
   * @param string $TemplatePassword
   * @param TemplateSellingStatus $TemplateSellingStatus
   * @param TemplateStatus $TemplateStatus
   * @param TemplateTypes $TemplateType
   * @param string $TemplateUsername
   * @param int $UserID
   * @access public
   */
  public function __construct($ApplianceTypeID, $ArchitectureTypeID, $CompanyID, $DateEnd, $DateStart, $Exportable, $HypervisorType, $Icon, $IdentificationCode, $InsertDate, $OSFamilyID, $OSVersion, $Revision, $Size, $TemplateBounds, $TemplateDescription, $TemplateExtendedDescription, $TemplateFeatures, $TemplateID, $TemplateName, $TemplatePassword, $TemplateSellingStatus, $TemplateStatus, $TemplateType, $TemplateUsername, $UserID)
  {
    $this->ApplianceTypeID = $ApplianceTypeID;
    $this->ArchitectureTypeID = $ArchitectureTypeID;
    $this->CompanyID = $CompanyID;
    $this->DateEnd = $DateEnd;
    $this->DateStart = $DateStart;
    $this->Exportable = $Exportable;
    $this->HypervisorType = $HypervisorType;
    $this->Icon = $Icon;
    $this->IdentificationCode = $IdentificationCode;
    $this->InsertDate = $InsertDate;
    $this->OSFamilyID = $OSFamilyID;
    $this->OSVersion = $OSVersion;
    $this->Revision = $Revision;
    $this->Size = $Size;
    $this->TemplateBounds = $TemplateBounds;
    $this->TemplateDescription = $TemplateDescription;
    $this->TemplateExtendedDescription = $TemplateExtendedDescription;
    $this->TemplateFeatures = $TemplateFeatures;
    $this->TemplateID = $TemplateID;
    $this->TemplateName = $TemplateName;
    $this->TemplatePassword = $TemplatePassword;
    $this->TemplateSellingStatus = $TemplateSellingStatus;
    $this->TemplateStatus = $TemplateStatus;
    $this->TemplateType = $TemplateType;
    $this->TemplateUsername = $TemplateUsername;
    $this->UserID = $UserID;
  }

}
