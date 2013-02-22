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

class TemplateDetails
{

  /**
   * 
   * @var ApplianceTypes $ApplianceType
   * @access public
   */
  public $ApplianceType;

  /**
   * 
   * @var ArchitectureTypes $ArchitectureType
   * @access public
   */
  public $ArchitectureType;

  /**
   * 
   * @var int $CompanyID
   * @access public
   */
  public $CompanyID;

  /**
   * 
   * @var string $Description
   * @access public
   */
  public $Description;

  /**
   * 
   * @var boolean $Enabled
   * @access public
   */
  public $Enabled;

  /**
   * 
   * @var boolean $ExportEnabled
   * @access public
   */
  public $ExportEnabled;

  /**
   * 
   * @var array $FeatureTypes
   * @access public
   */
  public $FeatureTypes;

  /**
   * 
   * @var base64Binary $Icon
   * @access public
   */
  public $Icon;

  /**
   * 
   * @var int $Id
   * @access public
   */
  public $Id;

  /**
   * 
   * @var string $IdentificationCode
   * @access public
   */
  public $IdentificationCode;

  /**
   * 
   * @var string $Name
   * @access public
   */
  public $Name;

  /**
   * 
   * @var OSFamilyTypes $OSFamily
   * @access public
   */
  public $OSFamily;

  /**
   * 
   * @var string $OSVersion
   * @access public
   */
  public $OSVersion;

  /**
   * 
   * @var int $OwnerUserId
   * @access public
   */
  public $OwnerUserId;

  /**
   * 
   * @var int $ParentTemplateID
   * @access public
   */
  public $ParentTemplateID;

  /**
   * 
   * @var int $ProductId
   * @access public
   */
  public $ProductId;

  /**
   * 
   * @var array $ResourceBounds
   * @access public
   */
  public $ResourceBounds;

  /**
   * 
   * @var string $Revision
   * @access public
   */
  public $Revision;

  /**
   * 
   * @var string $TemplateExtendedDescription
   * @access public
   */
  public $TemplateExtendedDescription;

  /**
   * 
   * @var TemplateOwnershipTypes $TemplateOwnershipType
   * @access public
   */
  public $TemplateOwnershipType;

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
   * @var boolean $ToolsAvailable
   * @access public
   */
  public $ToolsAvailable;

  /**
   * 
   * @param ApplianceTypes $ApplianceType
   * @param ArchitectureTypes $ArchitectureType
   * @param int $CompanyID
   * @param string $Description
   * @param boolean $Enabled
   * @param boolean $ExportEnabled
   * @param array $FeatureTypes
   * @param base64Binary $Icon
   * @param int $Id
   * @param string $IdentificationCode
   * @param string $Name
   * @param OSFamilyTypes $OSFamily
   * @param string $OSVersion
   * @param int $OwnerUserId
   * @param int $ParentTemplateID
   * @param int $ProductId
   * @param array $ResourceBounds
   * @param string $Revision
   * @param string $TemplateExtendedDescription
   * @param TemplateOwnershipTypes $TemplateOwnershipType
   * @param string $TemplatePassword
   * @param TemplateSellingStatus $TemplateSellingStatus
   * @param TemplateStatus $TemplateStatus
   * @param TemplateTypes $TemplateType
   * @param string $TemplateUsername
   * @param boolean $ToolsAvailable
   * @access public
   */
  public function __construct($Description, $Id, $Name, $ProductId, $ResourceBounds, $TemplateType, $ToolsAvailable, $ApplianceType=null, $ArchitectureType=null, $CompanyID=null, $Enabled=null, $ExportEnabled=null, $FeatureTypes=null, $Icon=null,$IdentificationCode=null, $OSFamily=null, $OSVersion=null, $OwnerUserId=null, $ParentTemplateID=null, $Revision=null, $TemplateExtendedDescription=null, $TemplateOwnershipType=null, $TemplatePassword=null, $TemplateSellingStatus=null, $TemplateStatus=null, $TemplateUsername=null)
  {
    $this->ApplianceType = $ApplianceType;
    $this->ArchitectureType = $ArchitectureType;
    $this->CompanyID = $CompanyID;
    $this->Description = $Description;
    $this->Enabled = $Enabled;
    $this->ExportEnabled = $ExportEnabled;
    $this->FeatureTypes = $FeatureTypes;
    $this->Icon = $Icon;
    $this->Id = $Id;
    $this->IdentificationCode = $IdentificationCode;
    $this->Name = $Name;
    $this->OSFamily = $OSFamily;
    $this->OSVersion = $OSVersion;
    $this->OwnerUserId = $OwnerUserId;
    $this->ParentTemplateID = $ParentTemplateID;
    $this->ProductId = $ProductId;
    $this->ResourceBounds = $ResourceBounds;
    $this->Revision = $Revision;
    $this->TemplateExtendedDescription = $TemplateExtendedDescription;
    $this->TemplateOwnershipType = $TemplateOwnershipType;
    $this->TemplatePassword = $TemplatePassword;
    $this->TemplateSellingStatus = $TemplateSellingStatus;
    $this->TemplateStatus = $TemplateStatus;
    $this->TemplateType = $TemplateType;
    $this->TemplateUsername = $TemplateUsername;
    $this->ToolsAvailable = $ToolsAvailable;
  }

}
