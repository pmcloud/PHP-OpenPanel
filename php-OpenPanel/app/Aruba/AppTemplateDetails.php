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

include_once 'AppResourceBound.php';
include_once 'AppTemplateType.php';

class AppTemplateDetails
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
	 * @var array $AppResourceBounds
	 * @access private
	 */
	private $ResourceBounds;

	/**
	 *
	 * @var TemplateTypes $AppTemplateType
	 * @access private
	 */
	private $TemplateType;

	/**
	 *
	 * @var boolean $ToolsAvailable
	 * @access public
	 */
	public $ToolsAvailable;

	/**
	 * @access public
	 */
	public function __construct($templateDetails)
	{
		if ($templateDetails != null) {
			$this->Id = $templateDetails->Id;
			$this->Name = $templateDetails->Name;
			$this->Description = $templateDetails->Description;

			$this->ProductId = $templateDetails->ProductId;
			$this->ToolsAvailable = $templateDetails->ToolsAvailable;			
			$this->TemplateType = $templateDetails->TemplateType;
			//$this->ResourceBounds = $templateDetails->ResourceBounds;
			$this->setResourceBounds($templateDetails);
				
		}
	}

	private final function setResourceBounds($templateDetails) {
		$vector = array();
		if ($templateDetails->ResourceBounds != null && isset($templateDetails->ResourceBounds->ResourceBound)) {
	  		$rbs = $templateDetails->ResourceBounds->ResourceBound;
	  		if ($rbs != null) {
	  			if (sizeof($rbs) == 1) {
	  				$vector[] = new AppResourceBound($rbs);
	  			}
	  			else {
		  			foreach ($rbs as $rb) {
		  				$vector[] = new AppResourceBound($rb);
		  			}
	  			}
		  	}
  		}  		
		$this->ResourceBounds = $vector;
	}

	
	public final function getResourceBounds() {
		return $this->ResourceBounds;
	}
	
	public final function getTemplateType() {
		return AppTemplateType::get($this->TemplateType);
	}
	
}

?>