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

class ServerUpdate
{

  /**
   * 
   * @var int $CPUQuantity
   * @access public
   */
  public $CPUQuantity;

  /**
   * 
   * @var int $RAMQuantity
   * @access public
   */
  public $RAMQuantity;

  /**
   * 
   * @var boolean $RestartAfterExecuted
   * @access public
   */
  public $RestartAfterExecuted;

  /**
   * 
   * @var int $ServerId
   * @access public
   */
  public $ServerId;

  /**
   * 
   * @var array $VirtualDisks
   * @access public
   */
  public $VirtualDisks;

  /**
   * 
   * @param int $CPUQuantity
   * @param int $RAMQuantity
   * @param boolean $RestartAfterExecuted
   * @param int $ServerId
   * @param array $VirtualDisks
   * @access public
   */
  public function __construct($CPUQuantity, $RAMQuantity, $RestartAfterExecuted, $ServerId, $VirtualDisks)
  {
    $this->CPUQuantity = $CPUQuantity;
    $this->RAMQuantity = $RAMQuantity;
    $this->RestartAfterExecuted = $RestartAfterExecuted;
    $this->ServerId = $ServerId;
    $this->VirtualDisks = $VirtualDisks;
  }

}
