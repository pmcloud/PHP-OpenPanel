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

class NewServer
{

  /**
   * 
   * @var string $AdministratorPassword
   * @access public
   */
  public $AdministratorPassword;

  /**
   * 
   * @var int $CPUQuantity
   * @access public
   */
  public $CPUQuantity;

  /**
   * 
   * @var string $Name
   * @access public
   */
  public $Name;

  /**
   * 
   * @var array $NetworkAdaptersConfiguration
   * @access public
   */
  public $NetworkAdaptersConfiguration;

  /**
   * 
   * @var string $Note
   * @access public
   */
  public $Note;

  /**
   * 
   * @var int $OSTemplateId
   * @access public
   */
  public $OSTemplateId;

  /**
   * 
   * @var int $RAMQuantity
   * @access public
   */
  public $RAMQuantity;

  /**
   * 
   * @var array $VirtualDisks
   * @access public
   */
  public $VirtualDisks;

  /**
   * 
   * @param string $AdministratorPassword
   * @param int $CPUQuantity
   * @param string $Name
   * @param array $NetworkAdaptersConfiguration
   * @param string $Note
   * @param int $OSTemplateId
   * @param int $RAMQuantity
   * @param array $VirtualDisks
   * @access public
   */
  public function __construct($AdministratorPassword, $CPUQuantity, $Name, $NetworkAdaptersConfiguration, $Note, $OSTemplateId, $RAMQuantity, $VirtualDisks)
  {
    $this->AdministratorPassword = $AdministratorPassword;
    $this->CPUQuantity = $CPUQuantity;
    $this->Name = $Name;
    $this->NetworkAdaptersConfiguration = $NetworkAdaptersConfiguration;
    $this->Note = $Note;
    $this->OSTemplateId = $OSTemplateId;
    $this->RAMQuantity = $RAMQuantity;
    $this->VirtualDisks = $VirtualDisks;
  }

}
