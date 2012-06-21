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

class AppPrivateVLanDetails
{

  /**
   * 
   * @var string $Gateway
   * @access public
   */
  public $Gateway;

  /**
   * 
   * @var string $IPAddress
   * @access public
   */
  public $IPAddress;

  /**
   * 
   * @var int $PrivateVLanResourceId
   * @access public
   */
  public $PrivateVLanResourceId;

  /**
   * 
   * @var string $SubNetMask
   * @access public
   */
  public $SubNetMask;

  /**
   * 
   * @param int $PrivateVLanResourceId
   * @param string $IPAddress
   * @param string $SubNetMask
   * @param string $Gateway
   * @access public
   */
  public function __construct($PrivateVLanResourceId, $IPAddress, $SubNetMask, $Gateway = "")
  {
    $this->Gateway = $Gateway;
    $this->IPAddress = $IPAddress;
    $this->PrivateVLanResourceId = $PrivateVLanResourceId;
    $this->SubNetMask = $SubNetMask;
  }

}

?>
