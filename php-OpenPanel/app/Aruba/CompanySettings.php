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

class CompanySettings
{

  /**
   * 
   * @var array $DataCenterSettings
   * @access public
   */
  public $DataCenterSettings;

  /**
   * 
   * @var array $SupportSettings
   * @access public
   */
  public $SupportSettings;

  /**
   * 
   * @var string $TechnicalPanelDomainUrl
   * @access public
   */
  public $TechnicalPanelDomainUrl;

  /**
   * 
   * @var string $TechnicalPanelFooterLabel
   * @access public
   */
  public $TechnicalPanelFooterLabel;

  /**
   * 
   * @var int $TechnicalPanelHeaderColor
   * @access public
   */
  public $TechnicalPanelHeaderColor;

  /**
   * 
   * @var boolean $TechnicalPanelKbEnabled
   * @access public
   */
  public $TechnicalPanelKbEnabled;

  /**
   * 
   * @var base64Binary $TechnicalPanelLogoGif
   * @access public
   */
  public $TechnicalPanelLogoGif;

  /**
   * 
   * @var string $TechnicalPanelLostPasswordUrl
   * @access public
   */
  public $TechnicalPanelLostPasswordUrl;

  /**
   * 
   * @var boolean $TechnicalPanelSupportEnabled
   * @access public
   */
  public $TechnicalPanelSupportEnabled;

  /**
   * 
   * @var string $TechnicalPanelTelerikSkin
   * @access public
   */
  public $TechnicalPanelTelerikSkin;

  /**
   * 
   * @var boolean $TechnicalPanelVisualCloudEnabled
   * @access public
   */
  public $TechnicalPanelVisualCloudEnabled;

  /**
   * 
   * @param array $DataCenterSettings
   * @param array $SupportSettings
   * @param string $TechnicalPanelDomainUrl
   * @param string $TechnicalPanelFooterLabel
   * @param int $TechnicalPanelHeaderColor
   * @param boolean $TechnicalPanelKbEnabled
   * @param base64Binary $TechnicalPanelLogoGif
   * @param string $TechnicalPanelLostPasswordUrl
   * @param boolean $TechnicalPanelSupportEnabled
   * @param string $TechnicalPanelTelerikSkin
   * @param boolean $TechnicalPanelVisualCloudEnabled
   * @access public
   */
  public function __construct($DataCenterSettings, $SupportSettings, $TechnicalPanelDomainUrl, $TechnicalPanelFooterLabel, $TechnicalPanelHeaderColor, $TechnicalPanelKbEnabled, $TechnicalPanelLogoGif, $TechnicalPanelLostPasswordUrl, $TechnicalPanelSupportEnabled, $TechnicalPanelTelerikSkin, $TechnicalPanelVisualCloudEnabled)
  {
    $this->DataCenterSettings = $DataCenterSettings;
    $this->SupportSettings = $SupportSettings;
    $this->TechnicalPanelDomainUrl = $TechnicalPanelDomainUrl;
    $this->TechnicalPanelFooterLabel = $TechnicalPanelFooterLabel;
    $this->TechnicalPanelHeaderColor = $TechnicalPanelHeaderColor;
    $this->TechnicalPanelKbEnabled = $TechnicalPanelKbEnabled;
    $this->TechnicalPanelLogoGif = $TechnicalPanelLogoGif;
    $this->TechnicalPanelLostPasswordUrl = $TechnicalPanelLostPasswordUrl;
    $this->TechnicalPanelSupportEnabled = $TechnicalPanelSupportEnabled;
    $this->TechnicalPanelTelerikSkin = $TechnicalPanelTelerikSkin;
    $this->TechnicalPanelVisualCloudEnabled = $TechnicalPanelVisualCloudEnabled;
  }

}
