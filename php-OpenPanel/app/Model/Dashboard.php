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
 * Dashboard Model
 *
 */
class Dashboard extends AppModel {

	private $credit;
	//private $notifications;
	private $servers;
	private $logs;	
	private $logModel;
	
	

	public function __construct($credit = null, /*$notifications = array(),*/ $servers = array(), $logModel= null) {
		$this->setCredit($credit);
		//$this->setNotifications($notifications);
		$this->setServers($servers);
		$this->setLogModel($logModel);
	}

	public final function getCredit() {
		return $this->credit;
	}

	private final function setCredit($credit) {
		$this->credit = $credit;
	}

//	public final function getNotifications() {
//		return $this->notifications;
//	}
//
//	public final function setNotifications($notifications) {
//		$this->notifications = notifications;
//	}

	public final function getServers() {
		return $this->servers;
	}

	private final function setServers($servers) {
		$this->servers = $servers;
	}

	public final function getLogs() {
		return $this->logs;
	}

	private final function setlogs($logs) {
		$this->logs = $logs;
	}	
	
	public final function getLogModel() {
		return $this->logModel;
	}

	public final function setLogModel($logModel) {
		$this->logModel = $logModel;
	}
	
	public function find($type = 'first', $query = array()) {
		
		if ($type === 'count') {				
				return 1;
		}
		
//		$userData = CakeSession::read(WSEndpoint::SESSION_DATA);
//		$wsEndUserExt = new WsEndUserExt(array());
//		$wsEndUserExt->setSESSION_DATA($userData['user'], $userData['password']);		
//		$endUserClient = new WsEndUserClient($wsEndUserExt);
		$endUserClient = $this->getWsEndUserClient();
					
		if ($endUserClient != null) {
						
			$credit = $endUserClient->getAvailableCredit();
			if ($credit != null) {
				$this->setCredit($credit);
			}
			$vdc = $endUserClient->getVirtualDatacenter();
			if ($vdc != null) {
				$appServers = $this->getServers();
				foreach ($vdc->getServers() as $appServer) {
					if ($appServer->isLinuxBasedOS()) {
						$appServers[] = $appServer;
					}
				}
				foreach ($vdc->getServers() as $appServer) {
					if ($appServer->isWindowsBasedOS()) {
						$appServers[] = $appServer;
					}
				}
				foreach ($vdc->getServers() as $appServer) {
					if (!$appServer->isLinuxBasedOS() && !$appServer->isWindowsBasedOS()) {
						$appServers[] = $appServer;
					}
				}
				
				$this->setServers($appServers);
			}
		}
	}
	
	public function view($id = null) {
		$this->find('first');
	}
	
}
?>