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

App::uses('AppController', 'Controller');
/**
 * VirtualSwitches Controller
 *
 * @property VirtualSwitch $VirtualSwitch
 */
class VirtualSwitchesController extends AppController {
		

/**
 * Helpers
 *
 * @var array
 */
	public $helpers = array('Html', 'Form');

/**
 * index method
 *
 * @return void
 */
	public function index() {
				
		$this->set('VirtualSwitches', $this->paginate());
	}



/**
 * add method
 *
 * @return void
 */
	public function add() {
		
		
		if ($this->request->is('post')) {

			
			$this->VirtualSwitch->set($this->request->data);
			if($this->VirtualSwitch->validates()){
				$result = $this->VirtualSwitch->purchaseVlan($this->request->data['VirtualSwitch']['Name']);						
				
				if ($result->isSuccess()) {
					$this->Session->setFlash(__('The Virtual Switch has been saved'));
					
				} else {
					$this->Session->setFlash(__('The Virtual Switch could not be saved. Please, try again.').$result->getErrorDescription());
				}
				$this->redirect(array('action' => 'index'));
			}else{
				$this->set("showDlg",true);
				$this->index();
				$this->render('index');
			}						
		}else{
			$this->index();
			$this->render('index');
		}
	}


/**
 * delete method
 *
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		if (!$this->request->is('post')) {
			throw new MethodNotAllowedException();
		}
		
			$result = $this->VirtualSwitch->removeVLan($id);						
			
			if ($result->isSuccess()) {
				$this->Session->setFlash(__('The Virtual Switch has been removed'));
				
			} else {
				$this->Session->setFlash(__('The Virtual Switch could not be removed. Please, try again.').$result->getErrorDescription());
			}
			
			$this->redirect(array('action' => 'index'));		
	}
}
