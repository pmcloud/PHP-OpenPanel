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

class JobModel extends AppModel {

	private $jobs = null; //array();
	private $listSize= 0;

	public function find($type = 'first', $query = array()) {
			

		if ($type === 'count') {
			return $this->listSize;
		}
			
//		$userData = CakeSession::read(WSEndpoint::SESSION_DATA);
//		$wsEndUserExt = new WsEndUserExt(array());
//		$wsEndUserExt->setSESSION_DATA($userData['user'], $userData['password']);
//		$endUserClient = new WsEndUserClient($wsEndUserExt);
		$endUserClient = $this->getWsEndUserClient();

		$this->jobs = $endUserClient->getJobs();
		$this->listSize = sizeof($this->jobs);
		if ($this->listSize > 0) {
			
			$this->jobs = array_reverse($this->jobs);

			return $this->adaptList($this->jobs,$query);
		}
		return array();
	}

}
?>