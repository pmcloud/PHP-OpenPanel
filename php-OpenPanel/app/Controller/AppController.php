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

/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2011, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2011, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */


App::uses('Controller', 'Controller');

App::uses('WSEndpoint','Aruba');
App::uses('WsEndUserClient','Aruba');
App::uses('WsEndUserVDCConfigClient','Aruba');
App::uses('WsEndUserExt','Aruba');




/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
	
	const  PAGE_LIST_SIZE = 20;
	
	public $paginate = array(
        'limit' => self::PAGE_LIST_SIZE
    );

	/**
	 * This function is executed before every action in the controller.
	 * It’s a handy place to check for an active session or inspect user permissions.
	 * @see lib/Cake/Controller/Controller::beforeFilter()
	 */
	public function beforeFilter() {
		
		if(CakeSession::check('Config.language')){			
			Configure::write('Config.language', CakeSession::read('Config.language'));
		}

		$this->response->disableCache();
				
		parent::beforeFilter();
		
		if( $this->Session!=null && isset($this->Session)){
			if((strcmp($this->name, "Logins")!=0) && $this->Session->read(WSEndpoint::SESSION_DATA)==null){
				$this->redirect(array('controller'=>'logins','action' => 'login'));
			}
		}
		if (! $this->Session->valid()) {
			$this->Session->renew();
			$this->redirect(array('controller'=>'logins','action' => 'login'));
		}
	}
	
	public function changeLanguage($langCode=null){
		if(isset($langCode)){
			if($this->Session->valid()){
				$this->Session->write("Config.language",$langCode);
			}
		}
		$this->redirect(array('action' => 'index'));
	}	

}
?>
