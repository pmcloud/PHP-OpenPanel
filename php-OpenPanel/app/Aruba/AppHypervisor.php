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

include_once 'AppHypervisorTypes.php';
include_once 'AppHypervisorServerTypes.php';
include_once 'AppTemplateDetails.php';


class AppHypervisor
{

	/**
	 *
	 * @var AppHypervisorServerTypes $HypervisorServerType
	 * @access private
	 */
	private $HypervisorServerType;

	/**
	 *
	 * @var AppHypervisorTypes $HypervisorType
	 * @access private
	 */
	private $HypervisorType;

	/**
	 *
	 * @var array $AppTemplatesDetails
	 * @access private
	 */
	private $Templates;

	/**
	 * @access public
	 */
	public function __construct($hypervisor)
	{
		$this->HypervisorType = $hypervisor->HypervisorType;
		$this->HypervisorServerType = $hypervisor->HypervisorServerType;
		//$this->Templates = $hypervisor->Templates;				
		$this->setTemplates($hypervisor);
		
	}

	private final function setTemplates($hypervisor) {
		$vector = array();		
		if ($hypervisor->Templates != null && isset($hypervisor->Templates->TemplateDetails)) {
			$templateDetails = $hypervisor->Templates->TemplateDetails;
			if ($templateDetails != null) {
				if (sizeof($templateDetails)==1) {
					$vector[] = new AppTemplateDetails($templateDetails);					
				}
				else {
					foreach($templateDetails as $templateDetail) {
						$vector[] = new AppTemplateDetails($templateDetail);						
					}
				}
			}			
		}
		$this->Templates = $vector;
	}
	
	public final function getTemplate() {
		return $this->Templates;
	}
	
	public final function getHypervisorType() {
		return AppHypervisorTypes::get($this->HypervisorType);
	}
	
	public final function getHypervisorServerType() {
		return AppHypervisorServerTypes::get($this->HypervisorServerType);
	}
	
	public final function getFullDescription() {
		return $this->getHypervisorType() ."/" . $this->getHypervisorServerType() ."(" .sizeof($this->getTemplate()) .")";
	}
}
