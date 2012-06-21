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
App::uses('WsEndUserExt', 'Aruba');
App::uses('WsEndUserClient', 'Aruba');
App::uses('Dashboard','Model');
App::uses('LogModel', 'Model');

/**
 * DashboardsController Controller
 *
 */
class DashboardsController extends AppController {

	public $paginate = array(
		'LogModel'=>array('limit' => 25)
	);

	/**
	 * view method
	 *
	 * @param string $id
	 * @return void
	 */
	public function view($id = null) {
		$this->redirect(array('action' => 'index'));
	}

	/**
	 * index method
	 *
	 * @return void
	 */
	public function index() {
		
		$dashboard = new Dashboard();
		try {
			$dashboard->find('first');			
		}
		catch (Exception $e) {			
			$this->Session->setFlash(__('Error'));
		}
				
		$logModel = new LogModel();
		$dashboard->setLogModel($logModel);	
		$logs = $this->paginate($logModel);
		
		$this->set('pagingList', $logs);		
		$this->set('dashboard', $dashboard);
	}
		
	
/*
  	public function old_index() {

		$endUserClient= $this->getWsEndUserClient();
		if ($endUserClient != null) {

			$dashboard = new Dashboard();
			try {
				$credit = $endUserClient->getAvailableCredit();
				if ($credit != null) {
					$dashboard->setCredit($credit);
				}
			}
			catch (Exception $e) {
				$this->Session->setFlash(__('Error'));
			}
			try {
				$vdc = $endUserClient->getVirtualDatacenter();
				if ($vdc != null) {
					$appServers = $dashboard->getServers();
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
					$dashboard->setServers($appServers);
				}
			}
			catch (Exception $e) {
				$this->Session->setFlash(__('Error'));
			}

			//	$page = $this->pageForPagination('LogModel');
			//	$this->paginate['LogModel'] = array('limit'=>20, 'page' => $page);
			//	$this->set('pagingList', $this->paginate(new LogModel()); //'LogModel'));

			$pagingOps = array('LogModel' => array('limit'=>25)
			//,'ServerModel' => array(..)
			);
			//$this->Paginator
			$this->set('pagingList', $this->paginate(new LogModel(), $pagingOps));
			//			$lmodel = new LogModel();
			//			$this->paginate($lmodel)
			//			$this->set('pagingList', $lmodel->paginate($pagingOps));
			$this->set('dashboard', $dashboard);

		}
	}
*/

}

?>