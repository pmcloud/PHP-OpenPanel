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

class IsoDetails
{

  /**
   * 
   * @var string $Description
   * @access public
   */
  public $Description;

  /**
   * 
   * @var int $InvalidityCode
   * @access public
   */
  public $InvalidityCode;

  /**
   * 
   * @var string $InvalidityReason
   * @access public
   */
  public $InvalidityReason;

  /**
   * 
   * @var IsoTypes $IsoType
   * @access public
   */
  public $IsoType;

  /**
   * 
   * @var string $Name
   * @access public
   */
  public $Name;

  /**
   * 
   * @var string $Path
   * @access public
   */
  public $Path;

  /**
   * 
   * @var int $Size
   * @access public
   */
  public $Size;

  /**
   * 
   * @var int $SizeByte
   * @access public
   */
  public $SizeByte;

  /**
   * 
   * @param string $Description
   * @param int $InvalidityCode
   * @param string $InvalidityReason
   * @param IsoTypes $IsoType
   * @param string $Name
   * @param string $Path
   * @param int $Size
   * @param int $SizeByte
   * @access public
   */
  public function __construct($Description, $InvalidityCode, $InvalidityReason, $IsoType, $Name, $Path, $Size, $SizeByte)
  {
    $this->Description = $Description;
    $this->InvalidityCode = $InvalidityCode;
    $this->InvalidityReason = $InvalidityReason;
    $this->IsoType = $IsoType;
    $this->Name = $Name;
    $this->Path = $Path;
    $this->Size = $Size;
    $this->SizeByte = $SizeByte;
  }

}
