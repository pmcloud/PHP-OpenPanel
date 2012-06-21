<?php

/**
 * 
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

App::uses('AppModel', 'Model');
/**
 * VirtualSwitch Model
 *
 */
class VirtualSwitch extends AppModel {
	
	public $Name;	
	public $ResourceId;
	
	
	
	public $validate = array();

	public function find($type = 'first', $query = array()) {
		
		$ad=array();
		$vdc = $this->getWsEndUserClient()->getVirtualDatacenter();
		if ($vdc != null) {
			foreach($vdc->getVLans() as $element) {
				$ad[]=$element;
			}
		}
		if ($type === 'count') {
			return sizeof($ad);
		}

		return $this->adaptList($ad,$query);
	}
	
	
	public function purchaseVlan($vLanName){
		return $this->getWsEndUserClient()->purchaseVlan($vLanName);
	}
	
	
	public function removeVlan($ResourceId){
		return $this->getWsEndUserClient()->removeVLan($ResourceId);
	}
	
	public function validates($options = array()){
		// redefine here the validate array to obtain multilanguage message
		$this->validate = array(
		'Name' => array(
			'notempty' => array(
				'rule' => 'notempty',
				'message' => __('The Name must not be empty'),
				'allowEmpty' => false,
				'required' => true,
				'last' => true, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
				),
			 'regex'=> array(
				'rule' => '/^[a-z,A-Z,0-9,-]*$/i',
				'message' => __('The Name must contains only [a-z,A-Z,0-9,-]')
					
				)	
			)			
		);
		return parent::validates($options);
	}
		


}
