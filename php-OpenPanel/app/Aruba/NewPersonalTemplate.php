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

class NewPersonalTemplate
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
   * @var base64Binary $Icon
   * @access public
   */
  public $Icon;

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
   * @var array $TemplateBound
   * @access public
   */
  public $TemplateBound;

  /**
   * 
   * @var string $TemplateDescription
   * @access public
   */
  public $TemplateDescription;

  /**
   * 
   * @var string $TemplateExternalDescription
   * @access public
   */
  public $TemplateExternalDescription;

  /**
   * 
   * @var string $TemplatePassword
   * @access public
   */
  public $TemplatePassword;

  /**
   * 
   * @var string $TemplateUsername
   * @access public
   */
  public $TemplateUsername;

  /**
   * 
   * @var int $VirtualMachineID
   * @access public
   */
  public $VirtualMachineID;

  /**
   * 
   * @param int $ApplianceTypeID
   * @param int $ArchitectureTypeID
   * @param base64Binary $Icon
   * @param int $OSFamilyID
   * @param string $OSVersion
   * @param string $Revision
   * @param array $TemplateBound
   * @param string $TemplateDescription
   * @param string $TemplateExternalDescription
   * @param string $TemplatePassword
   * @param string $TemplateUsername
   * @param int $VirtualMachineID
   * @access public
   */
  public function __construct($ApplianceTypeID, $ArchitectureTypeID, $Icon, $OSFamilyID, $OSVersion, $Revision, $TemplateBound, $TemplateDescription, $TemplateExternalDescription, $TemplatePassword, $TemplateUsername, $VirtualMachineID)
  {
    $this->ApplianceTypeID = $ApplianceTypeID;
    $this->ArchitectureTypeID = $ArchitectureTypeID;
    $this->Icon = $Icon;
    $this->OSFamilyID = $OSFamilyID;
    $this->OSVersion = $OSVersion;
    $this->Revision = $Revision;
    $this->TemplateBound = $TemplateBound;
    $this->TemplateDescription = $TemplateDescription;
    $this->TemplateExternalDescription = $TemplateExternalDescription;
    $this->TemplatePassword = $TemplatePassword;
    $this->TemplateUsername = $TemplateUsername;
    $this->VirtualMachineID = $VirtualMachineID;
  }

}
