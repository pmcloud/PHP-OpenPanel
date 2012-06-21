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
class VDCResourceBoundsConfig {
	
	
	private $hypervisorTemplates = array();	
	private $hypervisors = array();
	
	/**
	 * 
	 * @param AppHypervisorTypes $appHypervisorType
	 * @param AppHypervisor $appHypervisor
	 * @param array $hypervisorTemplates   [key:AppTemplateDetails->ProductID, value:AppTemplateDetails]
	 */
	public final function addHypervitorResource($appHypervisorType, $hypervisorTemplatesArray, $appHypervisor = null) {
		
		if ($appHypervisorType != null && $hypervisorTemplatesArray != null &&  sizeof($hypervisorTemplatesArray) > 0) {
			
			if (!isset( $this->hypervisorTemplates[$appHypervisorType])) {
				$this->hypervisorTemplates[$appHypervisorType] = array();
				if ($appHypervisor != null) {
					$this->hypervisors[$appHypervisorType] = $appHypervisor;
				}
			}
			foreach($hypervisorTemplatesArray as $key => $value) {
				//if (!isset( $this->hypervisorTemplates[$appHypervisorType][$key]) ) {
					$this->hypervisorTemplates[$appHypervisorType][$key] = $value;
				//}
			}	
			//uksort($this->hypervisors, "hypSort");		
		} 
	}
	
//	final function hypSort($v1) {
//		if ($v1 != null) {
//			print "aaa";
//		}
//		return null;	
//	}
	
	public final function getRegisteredHypervisorTypes() {
		//return array_keys($this->hypervisorTemplates);
		return array_keys($this->hypervisors);
	}
	
	public final function getRegisteredHypervisor($hypervisorType) {
		return $this->hypervisors[$hypervisorType];
	}
	
	public final function getAllRegisteredHypervisors() {
		return array_values($this->hypervisors);	
	}
	
	public final function getTemplatesFor($appHypervisorType) {
		return $this->hypervisorTemplates[$appHypervisorType];		
	}
	
	public final function getTemplate($appHypervisorType, $templateProductId) {
		return $this->hypervisorTemplates[$appHypervisorType][$templateProductId];		
	}
	
	public final function getResourceBounds($appHypervisorType, $templateProdId, $resourceType) {
		
		if ($appHypervisorType != null && $templateProdId != null && $resourceType != null) {
			
			$templateDetails = $this->hypervisorTemplates[$appHypervisorType][$templateProdId];	
					
			foreach($templateDetails->getResourceBounds() as $resource) {
				if ( AppResourceType::isSameValue($resourceType, $resource->getResourceType()) ) {
					return $resource;
				}
			}
		}
		return null;
	}
	
} 
?>