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

class News
{

  /**
   * 
   * @var NewsCategoryTypes $Category
   * @access public
   */
  public $Category;

  /**
   * 
   * @var string $MessageText
   * @access public
   */
  public $MessageText;

  /**
   * 
   * @var int $NewsID
   * @access public
   */
  public $NewsID;

  /**
   * 
   * @var NewsPriorityTypes $Priority
   * @access public
   */
  public $Priority;

  /**
   * 
   * @var NewsSenderTypes $Sender
   * @access public
   */
  public $Sender;

  /**
   * 
   * @var dateTime $StartDate
   * @access public
   */
  public $StartDate;

  /**
   * 
   * @param NewsCategoryTypes $Category
   * @param string $MessageText
   * @param int $NewsID
   * @param NewsPriorityTypes $Priority
   * @param NewsSenderTypes $Sender
   * @param dateTime $StartDate
   * @access public
   */
  public function __construct($Category, $MessageText, $NewsID, $Priority, $Sender, $StartDate)
  {
    $this->Category = $Category;
    $this->MessageText = $MessageText;
    $this->NewsID = $NewsID;
    $this->Priority = $Priority;
    $this->Sender = $Sender;
    $this->StartDate = $StartDate;
  }

}
