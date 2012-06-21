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
App::uses('Login', 'Model');

/**
 * Login Controller
 *
 */
class LoginsController extends AppController {

	/**
	 * login method
	 *
	 * @return void
	 */
	public function login() {
		$this->set('Login', $this->Login);
	}
	
	public function index() {	
		$this->redirect(array('action' => 'login'));
	}
	
	public function tokenExpired() {
		
		CakeSession::destroy();
		CakeSession::renew();
		$this->Session->write(WSEndpoint::SESSION_DATA, null);
		$this->Session->setFlash(__('Security WSToken is expired. New login is required.'));
		$this->index();
	}

	/**
	 * Enter description here ...
	 */
	public function dologin(){

		if ($this->request->is('post')) {

			$isLoginFailed = false;
			try {
				// get request-data
				$user= $this->request->data['Login']['username'];
				$pwd = $this->request->data['Login']['password'];
				$selectedVdc = $this->request->data['Login']['datacenters'];

				$url = false;
				$vdcID=false;
				if($selectedVdc != null) {
					try {
						$splits = explode('::', $selectedVdc);
						$url = $splits[1];
						$vdcID= $splits[0];
					}catch (Exception $dontCare){
						
					}					
				}
				if ($url === false) {
					$url = WSEndpoint::DEF_WS_URL;
				}
				else {
					$url = strstr($url, 'http');
				}

				if ($vdcID === false) {
					throw new Exception('Virtual datacenter id', 'APP1');
				}

				// definition of the WSEndUserExt(ension) that points to selected WS_location
				$endUserExt = new WsEndUserExt(array(
					//"debug"=>true,
					"ws_url" => $url,
					//"enduser_api_version" => "v1.4",
					//"default_timezone" => "Europe/Berlin"
				));

				// Every WS-client that point to a ws_base_url have to share same WsClientExt object to use the same security-header
				$endUserClient = new WsEndUserClient($endUserExt);
				$login = $endUserClient->loginAs($user, $pwd);

				if ($login->isValid()) {
					
					$vdcConfigClient= new WsEndUserVDCConfigClient($endUserExt);
					$datacentersCfg = $vdcConfigClient->getEnabledDatacenterConfigurations();
					$vdcDescription = '';
					$isEnabled = false;
					if ($datacentersCfg != null) {
						foreach ($datacentersCfg as $dc) {
							//print $dc->getDatacenterDescription() ."  admin-url: " .$dc->AdminPanelBaseUrl ."  base-url: " . $dc->WsBaseUrl . "\n";
							if ($vdcID == $dc->DatacenterId) {
								$isEnabled = true;
								$vdcDescription = $dc->getDatacenterDescription();
								break;
							}
						}
					}
					if ($isEnabled) {
						$sd = array(
						'user'=> $login->getUsername(),
						'password'=> $login->getToken(), //$pwd
						'debug'=>false,
						'ws_url' => $url,
						'enduser_api_version' => WSEndpoint::DEF_ENDUSER_API_VERSION,
						'vdc_id' => $vdcID,
						'vdc_description' => $vdcDescription,
						'language' => 'ita');

						$this->Session->write(WSEndpoint::SESSION_DATA,$sd);						
						$this->redirect(array('controller'=>'dashboards','action' => 'index'));
					}
					else {
						$isLoginFailed = true;
						$this->Session->setFlash(__('Datacenter not enabled'));
					}
				}
				else {
					$isLoginFailed = true;
					$this->Session->setFlash(__('Login failed'));
				}
			}
			catch (Exception $e) {
				$isLoginFailed = true;
				$this->Session->setFlash(__('Login failed') ." (".$e->getMessage() .")");
			}
				
			if($isLoginFailed){				
				$this->redirect(array('action' => 'login'));
			}
		}
		$this->Session->setFlash(__('Login failed'));
		$this->redirect(array('action' => 'login'));
	}


	/**
	 * Enter description here ...
	 */
	public function logout(){
		CakeSession::destroy();
		CakeSession::renew();
		$this->Session->write(WSEndpoint::SESSION_DATA, null);
		//$this->redirect(array('controller'=>'dashboards','action' => 'index'));
		$this->index();
	}


}

?>