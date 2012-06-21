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

class LogModel extends AppModel {

	private $logs = null;
	private $listSize= 0;

	public function find($type = 'first', $query = array()) {

		if ($type === 'count') {
			return $this->listSize;
		}
			
		$endUserClient = $this->getWsEndUserClient();
		return $this->findPaginated($endUserClient, $query);	
	}
	
	public final function findPaginated(WsEndUserClient $endUserClient, $query = array()) {
		
		$lastWeek = 86400 * 7;	// get last-weel logs...	
		$dayStart = getdate( (time()- $lastWeek));
		
		$fromdt = new DateTime();
		$fromdt->setDate($dayStart['year'], $dayStart['mon'], $dayStart['mday']);
		
		$this->logs = $endUserClient->getLogs($fromdt->format('Y-m-d'), null);
		$this->listSize = sizeof($this->logs);
		if ($this->listSize > 0) {
			$this->logs = array_reverse($this->logs);
			
			return $this->adaptList($this->logs,$query);
		}
		return array();
	}
	
}
?>