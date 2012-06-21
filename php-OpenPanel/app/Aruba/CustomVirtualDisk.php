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

class CustomVirtualDisk
{

  /**
   * 
   * @var string $FileName
   * @access public
   */
  public $FileName;

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
   * @var boolean $IsEligible
   * @access public
   */
  public $IsEligible;

  /**
   * 
   * @var string $RelativePath
   * @access public
   */
  public $RelativePath;

  /**
   * 
   * @var string $RelativePathFile
   * @access public
   */
  public $RelativePathFile;

  /**
   * 
   * @var int $SizeByte
   * @access public
   */
  public $SizeByte;

  /**
   * 
   * @var int $SizeGBNormalized
   * @access public
   */
  public $SizeGBNormalized;

  /**
   * 
   * @var string $VirtualDiskType
   * @access public
   */
  public $VirtualDiskType;

  /**
   * 
   * @param string $FileName
   * @param int $InvalidityCode
   * @param string $InvalidityReason
   * @param boolean $IsEligible
   * @param string $RelativePath
   * @param string $RelativePathFile
   * @param int $SizeByte
   * @param int $SizeGBNormalized
   * @param string $VirtualDiskType
   * @access public
   */
  public function __construct($FileName, $InvalidityCode, $InvalidityReason, $IsEligible, $RelativePath, $RelativePathFile, $SizeByte, $SizeGBNormalized, $VirtualDiskType)
  {
    $this->FileName = $FileName;
    $this->InvalidityCode = $InvalidityCode;
    $this->InvalidityReason = $InvalidityReason;
    $this->IsEligible = $IsEligible;
    $this->RelativePath = $RelativePath;
    $this->RelativePathFile = $RelativePathFile;
    $this->SizeByte = $SizeByte;
    $this->SizeGBNormalized = $SizeGBNormalized;
    $this->VirtualDiskType = $VirtualDiskType;
  }

}
