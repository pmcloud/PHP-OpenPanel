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
   * @var string $Description
   * @access public
   */
  public $Description;

  /**
   * 
   * @var int $Id
   * @access public
   */
  public $Id;

  /**
   * 
   * @var string $Name
   * @access public
   */
  public $Name;

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
   * @var TemplateTypes $TemplateType
   * @access public
   */
  public $TemplateType;

  /**
   * 
   * @var boolean $ToolsAvailable
   * @access public
   */
  public $ToolsAvailable;

  /**
   * 
   * @param string $Description
   * @param int $Id
   * @param string $Name
   * @param int $ProductId
   * @param array $ResourceBounds
   * @param TemplateTypes $TemplateType
   * @param boolean $ToolsAvailable
   * @access public
   */
  public function __construct($Description, $Id, $Name, $ProductId, $ResourceBounds, $TemplateType, $ToolsAvailable)
  {
    $this->Description = $Description;
    $this->Id = $Id;
    $this->Name = $Name;
    $this->ProductId = $ProductId;
    $this->ResourceBounds = $ResourceBounds;
    $this->TemplateType = $TemplateType;
    $this->ToolsAvailable = $ToolsAvailable;
  }

}
