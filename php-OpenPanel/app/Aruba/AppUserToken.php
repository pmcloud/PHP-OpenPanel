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

final class AppUserToken
{

  /**
   * @var string $token
   * @access private
   */
  private $token;

  /**
   * @var string $userName
   * @access private
   */
  private $userName;

  /**
   * @var boolean
   */
  private $valid = false;
  
  
//  /**
//   * @param UserToken $userToken
//   */
//  public function __construct($userToken = null)
//  {
//  	if ($userToken != null) {
//    	$this->token = $userToken->Token;
//    	$this->userName = $userToken->UserName;
//    	if ($this->userName != null && $this->token != null) {
//    		$this->valid = true;
//    	}
//  	}
//  }
  
  /**
   * 
   * @param string $Token
   * @param string $UserName
   * @access public
   */
  public function __construct($userName, $token)
  {
    if ($token != null) {
  		$this->token = $token;
    }
    if ($userName != null) {
    	$this->userName = $userName;
    }
    if ($this->userName != null && $this->token != null) {
    	$this->valid = true;
    }    
  }
  
  /**
   * @return string
   */
  public function getUsername() {
  	return $this->userName;
  }
  

  /**
   * @return string
   */
  public function getToken() {
  	return $this->token;  	
  }

  /**
   * @return boolean
   */
  public function isValid() {
  	return $this->valid;
  }
  
}