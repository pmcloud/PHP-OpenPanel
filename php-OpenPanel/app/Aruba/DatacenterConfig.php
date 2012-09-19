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

class DatacenterConfig
{

  /**
   * 
   * @var string $AdminPanelBaseUrl
   * @access public
   */
  public $AdminPanelBaseUrl;

  /**
   * 
   * @var string $Country
   * @access public
   */
  public $Country;

  /**
   * 
   * @var int $DatacenterId
   * @access public
   */
  public $DatacenterId;

  /**
   * 
   * @var string $Name
   * @access public
   */
  public $Name;

  /**
   * 
   * @var int $Priority
   * @access public
   */
  public $Priority;

  /**
   * 
   * @var DatacenterConfigStatus $Status
   * @access public
   */
  public $Status;

  /**
   * 
   * @var string $WsBaseUrl
   * @access public
   */
  public $WsBaseUrl;

  /**
   * 
   * @param string $AdminPanelBaseUrl
   * @param string $Country
   * @param int $DatacenterId
   * @param string $Name
   * @param int $Priority
   * @param DatacenterConfigStatus $Status
   * @param string $WsBaseUrl
   * @access public
   */
  public function __construct($AdminPanelBaseUrl, $Country, $DatacenterId, $Name, $Priority, $Status, $WsBaseUrl)
  {
    $this->AdminPanelBaseUrl = $AdminPanelBaseUrl;
    $this->Country = $Country;
    $this->DatacenterId = $DatacenterId;
    $this->Name = $Name;
    $this->Priority = $Priority;
    $this->Status = $Status;
    $this->WsBaseUrl = $WsBaseUrl;
  }

}
