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

class WsResult
{

  /**
   * 
   * @var ExceptionInfo $ExceptionInfo
   * @access public
   */
  public $ExceptionInfo;

  /**
   * 
   * @var int $ResultCode
   * @access public
   */
  public $ResultCode;

  /**
   * 
   * @var string $ResultMessage
   * @access public
   */
  public $ResultMessage;

  /**
   * 
   * @var boolean $Success
   * @access public
   */
  public $Success;

  /**
   * 
   * @param ExceptionInfo $ExceptionInfo
   * @param int $ResultCode
   * @param string $ResultMessage
   * @param boolean $Success
   * @access public
   */
  public function __construct($ExceptionInfo, $ResultCode, $ResultMessage, $Success)
  {
    $this->ExceptionInfo = $ExceptionInfo;
    $this->ResultCode = $ResultCode;
    $this->ResultMessage = $ResultMessage;
    $this->Success = $Success;
  }

}
