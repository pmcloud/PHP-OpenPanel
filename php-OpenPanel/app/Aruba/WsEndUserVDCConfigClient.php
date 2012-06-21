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

include_once 'WsEndUserExt.php';

include_once 'AppDatacenterConfig.php';
include_once 'AppVirtualDatacenter.php';
include_once 'AppHypervisor.php';

include_once 'VDCResourceBoundsConfig.php';


class WsEndUserVDCConfigClient {
	
	private $wsEndUserExt;
	
		
	/**
	 * 
	 * @param array $options
	 */
	public function  __construct($wsEndpointExt) {									
		$this->wsEndUserExt = $wsEndpointExt;
	}
	
	/**
	 * @return array of AppDatacenterConfig or null if nothing found
	 */
	public final function getAllDatacenterConfigurations() {
		$response = array();
		try {			
			$result= $this->wsEndUserExt->GetDatacenterConfigurations(new GetDatacenterConfigurations());			
			if ($result != null) { 				
				//obj is a stdClass
				$obj = $result->GetDatacenterConfigurationsResult->Value;					
				if ($obj != null && isset($obj->DatacenterConfig)) {
					$dcConfig = $obj->DatacenterConfig;
					if (sizeof($dcConfig) == 1) {
						$response[] = new AppDatacenterConfig($dcConfig);
					}
					else {
						foreach ($dcConfig as $dcc) {												
							$response[] = new AppDatacenterConfig($dcc);					
						}
					}
				}			
				return $response;
			}
		} 
		catch (Exception $e) {
			//if ($e instanceof Soap)// ?? Token not valid anymore...
			if ($e->getCode() > 0) { 
				$this->invalidateCredentials();				 	
			}
			throw new Exception($e->getMessage(), $e->getCode());
		}
	}
	
	/**
	 * @return array of enabled AppDatacenterConfig or null if nothing found
	 */
	public final function getEnabledDatacenterConfigurations() {
		$response = array();
		$dcs = $this->getAllDatacenterConfigurations();
		if ($dcs != null && sizeof($dcs) > 0) {
			foreach ($dcs as $value) {
				if ("enabled" == strtolower($value->Status)) {
					$response[] = $value;					
				}
			}			
		}
		return $response;
	}
	
	
	/**
	 * @return AppVirtualDatacenter
	 */
	public final function getVirtualDatacenter() {
		try {
			$result= $this->wsEndUserExt->GetVirtualDatacenter(new GetVirtualDatacenter());
			if ($result != null) {
				$vdc = $result->GetVirtualDatacenterResult->Value;
				if ($vdc != null) {
					return new AppVirtualDatacenter($vdc);
				}
			}
		} 
		catch (Exception $e) {
			//if ($e instanceof Soap)// ?? Token not valid anymore...
			if ($e->getCode() > 0) { 
				$this->invalidateCredentials();				 	
			}
			throw new Exception($e->getMessage(), $e->getCode());
		}
	}
	

	private final function getHypervisors() {
		$response = array();
		try {			
			$result = $this->wsEndUserExt->GetHypervisors(new GetHypervisors());
			if ($result != null) {
				$hyps = $result->GetHypervisorsResult->Value;
				if ($hyps != null && isset($hyps->Hypervisor)) {
					if (sizeof($hyps->Hypervisor) == 1) {
						$response[] = new AppHypervisor($hyps);
					}
					else {
						foreach ($hyps->Hypervisor as $hyp) {
							$response[] = new AppHypervisor($hyp);
						}
					}
				} 
			}
			return $response;
		}
		catch (Exception $e) {
			if ($e->getCode() > 0) { 
				$this->invalidateCredentials();				 	
			}
			throw new Exception($e->getMessage(), $e->getCode());
		}
	}
		
	/**
	 * @return VDCResourceConfiguration
	 */
	public final function getVDCResourceConfiguration() {
		$vdcConfig = new VDCResourceBoundsConfig();
		$hypervisors = $this->getHypervisors();
		
		$commonTemplates = null;		
		foreach ($hypervisors as $hypervisor) {
			// if hypervisor-type is NOT  'ALL'
			if ( ! AppHypervisorTypes::isSameValue(AppHypervisorTypes::ALL, $hypervisor->getHypervisorType())) {
				$templateMap = array();
				foreach ($hypervisor->getTemplate() as $atd) {
					$templateMap[$atd->ProductId] = $atd;
				}
				// registration of hypervisor and its OSTemplates
				$vdcConfig->addHypervitorResource($hypervisor->getHypervisorType(), $templateMap, $hypervisor);				
			}
			else { //handle common (to all hypervisors) templates 
				$commonTemplates = $hypervisor->getTemplates();
			}
		}
		
		if ($commonTemplates != null && $sizeof(commonTemplates) >0) {
			
			//for ALL registered hypervisors
			foreach($vdcConfig->getRegisteredHypervisorTypes() as $registeredType) {
				
				$commonTemplateMap = array();								
				foreach ($commonTemplates as $atd) {
					$commonTemplateMap[$atd->ProductId] = $atd;
				}
				// add commons templates
				$vdcConfig->addHypervitorResource($registeredType, $commonTemplateMap);				
			}
		}
		return $vdcConfig;	
	}
	
}

?>