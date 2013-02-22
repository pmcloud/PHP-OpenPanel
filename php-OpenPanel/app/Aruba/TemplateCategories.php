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

class TemplateCategories
{

  /**
   * 
   * @var array $ApplianceType
   * @access public
   */
  public $ApplianceType;

  /**
   * 
   * @var array $ArchitectureType
   * @access public
   */
  public $ArchitectureType;

  /**
   * 
   * @var array $FeatureType
   * @access public
   */
  public $FeatureType;

  /**
   * 
   * @var array $HypervisorTemplateBounds
   * @access public
   */
  public $HypervisorTemplateBounds;

  /**
   * 
   * @var array $OperatingSystemFamily
   * @access public
   */
  public $OperatingSystemFamily;

  /**
   * 
   * @var array $TemplateType
   * @access public
   */
  public $TemplateType;

  /**
   * 
   * @param array $ApplianceType
   * @param array $ArchitectureType
   * @param array $FeatureType
   * @param array $HypervisorTemplateBounds
   * @param array $OperatingSystemFamily
   * @param array $TemplateType
   * @access public
   */
  public function __construct($ApplianceType, $ArchitectureType, $FeatureType, $HypervisorTemplateBounds, $OperatingSystemFamily, $TemplateType)
  {
    $this->ApplianceType = $ApplianceType;
    $this->ArchitectureType = $ArchitectureType;
    $this->FeatureType = $FeatureType;
    $this->HypervisorTemplateBounds = $HypervisorTemplateBounds;
    $this->OperatingSystemFamily = $OperatingSystemFamily;
    $this->TemplateType = $TemplateType;
  }

}
