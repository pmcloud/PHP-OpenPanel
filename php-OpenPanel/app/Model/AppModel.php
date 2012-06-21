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

/**
 * Application model for Cake.
 *
 * This file is application-wide model file. You can put all
 * application-wide model-related methods here.
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
 * @package       app.Model
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('Model', 'Model');

/**
 * Application model for Cake.
 *
 * Add your application-wide methods in the class below, your models
 * will inherit them.
 *
 * @package       app.Model
 */
class AppModel extends Model {

	/**
	 *
	 * Our models don't use database
	 * @var boolean
	 */
	public $useTable=false;


	/**
	 * Enter description here ...
	 * @return WsEndUserClient
	 */
	public function getWsEndUserClient(){
		
		
		$sessionData = CakeSession::read(WSEndpoint::SESSION_DATA);		
		$wsEndUserExt = new WsEndUserExt( array('debug' => $sessionData['debug'],
												'ws_url' => $sessionData['ws_url'],
												'enduser_api_version' => $sessionData['enduser_api_version']
										));
		$wsEndUserExt->setCredentials($sessionData['user'], $sessionData['password']);
		return new WsEndUserClient($wsEndUserExt);
		
	}

	/**
	 * Enter description here ...
	 * @return WsEndUserVDCConfigClient
	 */
	public function getWsEndUserVDCConfigClient(){
		
		$sessionData = CakeSession::read(WSEndpoint::SESSION_DATA);
		$wsEndUserExt = new WsEndUserExt( array('debug' => $sessionData['debug'],
												'ws_url' => $sessionData['ws_url'],
												'enduser_api_version' => $sessionData['enduser_api_version']
										));
		$wsEndUserExt->setCredentials($sessionData['user'], $sessionData['password']);
		return new WsEndUserVDCConfigClient($wsEndUserExt);
	}

	/**
	 * Enter description here ...
	 * @param array $fullList
	 * @param array $query
	 * @return multitype:
	 */
	public function adaptList(array $fullList=array(), array $query=array()){

		$pageSize = $query['limit'];
		$page = $query['page'];
		$startFrom = ($page-1)*$pageSize;

		return array_slice($fullList, $startFrom,$pageSize);
	}


}
