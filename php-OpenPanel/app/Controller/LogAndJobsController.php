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
App::uses('LogAndJob','Model');
App::uses('LogModel', 'Model');
App::uses('JobModel', 'Model');

/**
 * DashboardsController Controller
 *
 */
class LogAndJobsController extends AppController {
	
	public $paginate = array(
		'LogModel'=>array('limit' => AppController::PAGE_LIST_SIZE),
		'JobModel'=>array('limit' => AppController::PAGE_LIST_SIZE)
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

		$lm = new LogModel();
		$jm = new JobModel();
		
		$logsAndJob = new LogAndJob($lm, $jm);
		
		
			
		$logs = $this->paginate($logsAndJob->getLogModel());
		$jobs = $this->paginate($logsAndJob->getJobModel());
		$this->set('logPagingList', $logs);
		$this->set('jobPagingList', $jobs);		
	}

}

?>