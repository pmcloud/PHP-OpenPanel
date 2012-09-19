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

class SetEnqueueHardwareUpdate
{

  /**
   * 
   * @var string $jsonp
   * @access public
   */
  public $jsonp;

  /**
   * 
   * @var string $userName
   * @access public
   */
  public $userName;

  /**
   * 
   * @var string $token
   * @access public
   */
  public $token;

  /**
   * 
   * @var string $serverId
   * @access public
   */
  public $serverId;

  /**
   * 
   * @var string $cpuQuantity
   * @access public
   */
  public $cpuQuantity;

  /**
   * 
   * @var string $ramQuantity
   * @access public
   */
  public $ramQuantity;

  /**
   * 
   * @var string $restartAfterExecuted
   * @access public
   */
  public $restartAfterExecuted;

  /**
   * 
   * @param string $jsonp
   * @param string $userName
   * @param string $token
   * @param string $serverId
   * @param string $cpuQuantity
   * @param string $ramQuantity
   * @param string $restartAfterExecuted
   * @access public
   */
  public function __construct($jsonp, $userName, $token, $serverId, $cpuQuantity, $ramQuantity, $restartAfterExecuted)
  {
    $this->jsonp = $jsonp;
    $this->userName = $userName;
    $this->token = $token;
    $this->serverId = $serverId;
    $this->cpuQuantity = $cpuQuantity;
    $this->ramQuantity = $ramQuantity;
    $this->restartAfterExecuted = $restartAfterExecuted;
  }

}
