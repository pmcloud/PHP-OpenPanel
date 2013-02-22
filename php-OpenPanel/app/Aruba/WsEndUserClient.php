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

include_once 'WsEndUserExt.php';
include_once 'UserToken.php';

include_once 'AppUserToken.php';
include_once 'AppDatacenterConfig.php';
include_once 'AppCredit.php';
include_once 'AppVirtualDatacenter.php';
include_once 'AppLog.php';
include_once 'AppJob.php';
include_once 'AppHypervisor.php';
include_once 'AppWsResult.php';
include_once 'AppNewServer.php';
include_once 'AppVirtualDisk.php';
include_once 'VirtualDisk.php';
include_once 'VirtualDiskUpdate.php';
include_once 'AppVirtualDiskTypes.php';


class WsEndUserClient {

	private $wsEndUserExt;


	/**
	 *
	 * @param array $options
	 */
	public function  __construct($wsEndpointExt) {
		$this->wsEndUserExt = $wsEndpointExt;
	}


	/**
	 * @param string $username
	 * @param string $password
	 * @throws Exception throw an Exception where login fails.
	 * @return AppUserToken
	 */
	public function loginAs($username, $password) {

		$input = new GetUserAuthenticationToken();
		$this->wsEndUserExt->setCredentials($username, $password);
		$userToken = null;
		try {
			$userToken = $this->getUserAuthenticationToken($input);// invoke the private method (below)

			if ($userToken != null) {
				$applicationToken = new AppUserToken($userToken->UserName, $userToken->Token);
				if ($applicationToken->isValid()) {
					// change the credentials using (username, token) from AppUserToken instead of $username, $password
					$this->wsEndUserExt->setCredentials($applicationToken->getUsername(), $applicationToken->getToken());
				}
				return $applicationToken;
			}
		}
		catch (Exception $e) {
			//			//if ($e instanceof Soap)// ?? Token not valid anymore...
			//			if ($e->getCode() > 0) {
			//				$this->invalidateCredentials();
			//			}
			throw new Exception($e->getMessage(), $e->getCode());
		}
		if ($userToken == null) {
			$message = "Login failed"; //TODO !!!
			$code= 999;
			throw new Exception($message, $code);
		}
	}

	/**
	 * Use this function to invalidate current credentials (used for authentication in WS calls)
	 */
	public final function invalidateCredentials() {
		$this->wsEndUserExt->setCredentials(null, null);
	}

	/**
	 * @param GetUserAuthenticationToken $input
	 * @return UserToken
	 */
	private final function getUserAuthenticationToken(GetUserAuthenticationToken  $input) {
		$result = $this->wsEndUserExt->GetUserAuthenticationToken($input);
		return $result->GetUserAuthenticationTokenResult->Value;
	}

	public final function getUsername() {
		return $this->wsEndUserExt->getUsername();
	}

//	/**
//	 * @return array of AppDatacenterConfig or null if nothing found
//	 */
//	public final function getAllDatacenterConfigurations() {
//		$response = array();
//		try {
//			$result= $this->wsEndUserExt->GetDatacenterConfigurations(new GetDatacenterConfigurations());
//			if ($result != null) {
//				//obj is a stdClass
//				$obj = $result->GetDatacenterConfigurationsResult->Value;
//				if ($obj != null && isset($obj->DatacenterConfig)) {
//					$dcConfig = $obj->DatacenterConfig;
//					if (sizeof($dcConfig) == 1) {
//						$response[] = new AppDatacenterConfig($dcConfig);
//					}
//					else {
//						foreach ($dcConfig as $dcc) {
//							$response[] = new AppDatacenterConfig($dcc);
//						}
//					}
//				}
//				return $response;
//			}
//		}
//		catch (Exception $e) {
//			//if ($e instanceof Soap)// ?? Token not valid anymore...
//			if ($e->getCode() > 0) {
//				$this->invalidateCredentials();
//			}
//			throw new Exception($e->getMessage(), $e->getCode());
//		}
//	}
//
//	/**
//	 * @return array of enabled AppDatacenterConfig or null if nothing found
//	 */
//	public final function getEnabledDatacenterConfigurations() {
//		$response = array();
//		$dcs = $this->getAllDatacenterConfigurations();
//		if ($dcs != null && sizeof($dcs) > 0) {
//			foreach ($dcs as $value) {
//				if ("enabled" == strtolower($value->Status)) {
//					$response[] = $value;
//				}
//			}
//		}
//		return $response;
//	}
//
//	public final function getHypervisors() {
//		$response = array();
//		try {
//			$result = $this->wsEndUserExt->GetHypervisors(new GetHypervisors());
//			if ($result != null) {
//				$hyps = $result->GetHypervisorsResult->Value;
//				if ($hyps != null && isset($hyps->Hypervisor)) {
//					if (sizeof($hyps->Hypervisor) == 1) {
//						$response[] = new AppHypervisor($hyps);
//					}
//					else {
//						foreach ($hyps->Hypervisor as $hyp) {
//							$response[] = new AppHypervisor($hyp);
//						}
//					}
//				}
//			}
//			return $response;
//		}
//		catch (Exception $e) {
//			if ($e->getCode() > 0) {
//				$this->invalidateCredentials();
//			}
//			throw new Exception($e->getMessage(), $e->getCode());
//		}
//	}
	
	/**
	 * @return AppCredit
	 */
	public final function getAvailableCredit() {

		try {
			$result= $this->wsEndUserExt->GetCredit(new GetCredit());
			if ($result != null) {
				$credit = $result->GetCreditResult->Value;
				if ($credit != null) {
					return new AppCredit($credit);
				}
			}
		}
		catch (Exception $e) {
			//if ($e instanceof Soap)// ?? Token not valid anymore...
			if ($e->getCode() > 0) {
				$this->invalidateCredentials();
			}
			throw new Exception($e->getMessage(), $e->getCode());
		}
	}

	/**
	 * @return AppVirtualDatacenter
	 */
	public final function getVirtualDatacenter() {
		try {
			$result= $this->wsEndUserExt->GetVirtualDatacenter(new GetVirtualDatacenter());
			if ($result != null) {
				$vdc = $result->GetVirtualDatacenterResult->Value;
				if ($vdc != null) {
					return new AppVirtualDatacenter($vdc);
				}
			}
		}
		catch (Exception $e) {
			//if ($e instanceof Soap)// ?? Token not valid anymore...
			if ($e->getCode() > 0) {
				$this->invalidateCredentials();
			}
			throw new Exception($e->getMessage(), $e->getCode());
		}
	}

	public final function getServerDetails($ServerId) {
		try {
			$input = new GetServerDetails($ServerId);
			$result= $this->wsEndUserExt->GetServerDetails($input);
			if ($result != null) {
				$serverDetails = $result->GetServerDetailsResult->Value;
				if ($serverDetails != null) {
					return new AppServerDetails($serverDetails);
				}
			}
		}
		catch (Exception $e) {
			//if ($e instanceof Soap)// ?? Token not valid anymore...
			if ($e->getCode() > 0) {
				$this->invalidateCredentials();
			}
			throw new Exception($e->getMessage(), $e->getCode());
		}
	}

	public final function getLogs($fromDate = null, $toDate = null) {
		$response = array();
		try {
			$input = new GetLogs(null, $fromDate, $toDate);
			$result = $this->wsEndUserExt->GetLogs($input);
			if ($result != null) {
				$logs = $result->GetLogsResult->Value;
				if ($logs != null && isset($logs->Log)) {
					if (sizeof($logs->Log) == 1) {
						$response[] = new AppLog($logs->Log);
					}
					else {
						foreach ($logs->Log as $log) {
							$response[] = new AppLog($log);
						}
					}
				}
			}
			return $response;
		}
		catch (Exception $e) {
			if ($e->getCode() > 0) {
				$this->invalidateCredentials();
			}
			throw new Exception($e->getMessage(), $e->getCode());
		}
	}

	public final function getJobs($fromDate = null, $toDate = null) {
		$response = array();
		try {
			$input = new GetJobs(null, $fromDate, $toDate);
			$result = $this->wsEndUserExt->GetJobs($input);
			if ($result != null) {
				$jobs = $result->GetJobsResult->Value;
				if ($jobs != null && isset($jobs->Job)) {
					if (sizeof($jobs->Job) == 1) {
						$response[] = new AppJob($jobs->Job);
					}
					else {
						foreach ($jobs->Job as $job) {
							$response[] = new AppJob($job);
						}
					}
				}
			}
			return $response;
		}
		catch (Exception $e) {
			if ($e->getCode() > 0) {
				$this->invalidateCredentials();
			}
			throw new Exception($e->getMessage(), $e->getCode());
		}
	}


	public final function renameServer($serverId, $newServerName) {
		$wsResult = null;
		try {
			$input = new SetRenameServer($serverId, $newServerName);
			$result = $this->wsEndUserExt->SetRenameServer($input);
			if ($result != null) {
				$wsResult = $result->SetRenameServerResult;
			}
		}
		catch (Exception $e) {
			if ($e->getCode() > 0) {
				$this->invalidateCredentials();
			}
			throw new Exception($e->getMessage(), $e->getCode());
		}
		return ($wsResult != null ? new AppWsResult($wsResult) : null);
	}

	public final function renameVLan($vlanId, $newVlanName) {
		$wsResult = null;
		try {
			$input = new SetRenameVLan($vlanId, $newVlanName);
			$result = $this->wsEndUserExt->SetRenameVLan($input);
			if ($result != null) {
				$wsResult = $result->SetRenameVLanResult;
			}
		}
		catch (Exception $e) {
			if ($e->getCode() > 0) {
				$this->invalidateCredentials();
			}
			throw new Exception($e->getMessage(), $e->getCode());
		}
		return ($wsResult != null ? new AppWsResult($wsResult) : null);
	}


	public final function removeVLan($vlanId) {
		// DEASSOCIATE CALL BEFORE  ????
		$wsResult = null;
		try {
			$input = new SetRemoveVLan($vlanId);
			$result = $this->wsEndUserExt->SetRemoveVLan($input);
			if ($result != null) {
				$wsResult = $result->SetRemoveVLanResult;
			}
		}
		catch (Exception $e) {
			if ($e->getCode() > 0) {
				$this->invalidateCredentials();
			}
			throw new Exception($e->getMessage(), $e->getCode());
		}
		return ($wsResult != null ? new AppWsResult($wsResult) : null);
	}

	public final function removeIpAddress($ipAddressResourceId) {
		// DEASSOCIATE CALL BEFORE  ????
		$wsResult = null;
		try {
			$input = new SetRemoveIpAddress($ipAddressResourceId);
			$result = $this->wsEndUserExt->SetRemoveIpAddress($input);
			if ($result != null) {
				$wsResult = $result->SetRemoveIpAddressResult;
			}
		}
		catch (Exception $e) {
			if ($e->getCode() > 0) {
				$this->invalidateCredentials();
			}
			throw new Exception($e->getMessage(), $e->getCode());
		}
		return ($wsResult != null ? new AppWsResult($wsResult) : null);
	}

	public final function purchaseIpAddress() {

		$wsResult = null;
		try {
			$input = new SetPurchaseIpAddress();
			$result = $this->wsEndUserExt->SetPurchaseIpAddress($input);
			if ($result != null) {
				$wsResult = $result->SetPurchaseIpAddressResult;
			}
		}
		catch (Exception $e) {
			if ($e->getCode() > 0) {
				$this->invalidateCredentials();
			}
			throw new Exception($e->getMessage(), $e->getCode());
		}
		return ($wsResult != null ? new AppWsResult($wsResult) : null);
	}

	public final function purchaseVlan($vLanName) {

		$wsResult = null;
		try {
			$input = new SetPurchaseVLan($vLanName);
			$result = $this->wsEndUserExt->SetPurchaseVLan($input);
			if ($result != null) {
				$wsResult = $result->SetPurchaseVLanResult;
			}
		}
		catch (Exception $e) {
			if ($e->getCode() > 0) {
				$this->invalidateCredentials();
			}
			throw new Exception($e->getMessage(), $e->getCode());
		}
		return ($wsResult != null ? new AppWsResult($wsResult) : null);
	}


	public final function SetEnqueueServerStart($serverId) {
		$wsResult = null;
		try {
			$input = new SetEnqueueServerStart($serverId);
			$result = $this->wsEndUserExt->SetEnqueueServerStart($input);
			if ($result != null) {
				$wsResult = $result->SetEnqueueServerStartResult;
			}
		}
		catch (Exception $e) {
			if ($e->getCode() > 0) {
				$this->invalidateCredentials();
			}
			throw new Exception($e->getMessage(), $e->getCode());
		}
		return ($wsResult != null ? new AppWsResult($wsResult) : null);
	}


	public final function SetEnqueueServerRestart($serverId) {
		$wsResult = null;
		try {
			$input = new SetEnqueueServerRestart($serverId);
			$result = $this->wsEndUserExt->SetEnqueueServerRestart($input);
			if ($result != null) {
				$wsResult = $result->SetEnqueueServerRestartResult;
			}
		}
		catch (Exception $e) {
			if ($e->getCode() > 0) {
				$this->invalidateCredentials();
			}
			throw new Exception($e->getMessage(), $e->getCode());
		}
		return ($wsResult != null ? new AppWsResult($wsResult) : null);
	}

	public final function setEnqueueServerStop($serverId) {
		$wsResult = null;
		try {
			$input = new SetEnqueueServerStop($serverId);
			$result = $this->wsEndUserExt->SetEnqueueServerStop($input);
			if ($result != null) {
				$wsResult = $result->SetEnqueueServerStopResult;
			}
		}
		catch (Exception $e) {
			if ($e->getCode() > 0) {
				$this->invalidateCredentials();
			}
			throw new Exception($e->getMessage(), $e->getCode());
		}
		return ($wsResult != null ? new AppWsResult($wsResult) : null);
	}

	public final function SetEnqueueServerPowerOff($serverId) {
		$wsResult = null;
		try {
			$input = new SetEnqueueServerPowerOff($serverId);
			$result = $this->wsEndUserExt->SetEnqueueServerPowerOff($input);
			if ($result != null) {
				$wsResult = $result->SetEnqueueServerPowerOffResult;
			}
		}
		catch (Exception $e) {
			if ($e->getCode() > 0) {
				$this->invalidateCredentials();
			}
			throw new Exception($e->getMessage(), $e->getCode());
		}
		return ($wsResult != null ? new AppWsResult($wsResult) : null);
	}

	public final function SetEnqueueServerReset($serverId) {
		$wsResult = null;
		try {
			$input = new SetEnqueueServerReset($serverId);
			$result = $this->wsEndUserExt->SetEnqueueServerReset($input);
			if ($result != null) {
				$wsResult = $result->SetEnqueueServerResetResult;
			}
		}
		catch (Exception $e) {
			if ($e->getCode() > 0) {
				$this->invalidateCredentials();
			}
			throw new Exception($e->getMessage(), $e->getCode());
		}
		return ($wsResult != null ? new AppWsResult($wsResult) : null);
	}

	/**
	 * Enter description here ...
	 * @param int $serverId
	 * @param int $CPUQuantity
	 * @param int $RAMQuantity
	 * @param array AppVirtualDisk $VirtualDisks
	 * @param boolean $RestartAfterExecuted
	 * @throws Exception
	 * @return Ambigous <NULL, AppWsResult>
	 */
	public final function SetEnqueueServerUpdate($serverId, $CPUQuantity = null, $RAMQuantity = null, array $VirtualDisks= array(), $RestartAfterExecuted = false) {

		$wsResult = null;
		try {
			$vDisks = array();
			foreach($VirtualDisks as $appVD) {
				$vDisks[] = new VirtualDisk($appVD->CreationDate, $appVD->Size);
			}
			$server_update = new ServerUpdate($CPUQuantity, $RAMQuantity, $RestartAfterExecuted, $serverId, $vDisks);
			$input = new SetEnqueueServerUpdate($server_update);
			$result = $this->wsEndUserExt->SetEnqueueServerUpdate($input);
			if ($result != null) {
				$wsResult = $result->SetEnqueueServerUpdateResult;
			}
		}
		catch (Exception $e) {
			if ($e->getCode() > 0) {
				$this->invalidateCredentials();
			}
			throw new Exception($e->getMessage(), $e->getCode());
		}
		return ($wsResult != null ? new AppWsResult($wsResult) : null);
	}
	
/**
	 * Enter description here ...
	 * @param int $serverId
	 * @param int $CPUQuantity
	 * @param int $RAMQuantity	 
	 * @param boolean $RestartAfterExecuted
	 * @throws Exception
	 * @return Ambigous <NULL, AppWsResult>
	 */
	public final function SetEnqueueServerUpdateCPU($serverId, $CPUQuantity, $RestartAfterExecuted = false) {

		$wsResult = null;
		try {
			$vDisks = array();			
			$server_update = new ServerUpdate($CPUQuantity, null, $RestartAfterExecuted, $serverId, $vDisks);
			$input = new SetEnqueueServerUpdate($server_update);
			$result = $this->wsEndUserExt->SetEnqueueServerUpdate($input);
			if ($result != null) {
				$wsResult = $result->SetEnqueueServerUpdateResult;
			}
		}
		catch (Exception $e) {
			if ($e->getCode() > 0) {
				$this->invalidateCredentials();
			}
			throw new Exception($e->getMessage(), $e->getCode());
		}
		return ($wsResult != null ? new AppWsResult($wsResult) : null);
	}
	
	public final function SetEnqueueServerUpdateRAM($serverId, $RAMQuantity, $RestartAfterExecuted = false) {

		$wsResult = null;
		try {
			$vDisks = array();			
			$server_update = new ServerUpdate(null, $RAMQuantity, $RestartAfterExecuted, $serverId, $vDisks);
			$input = new SetEnqueueServerUpdate($server_update);
			$result = $this->wsEndUserExt->SetEnqueueServerUpdate($input);
			if ($result != null) {
				$wsResult = $result->SetEnqueueServerUpdateResult;
			}
		}
		catch (Exception $e) {
			if ($e->getCode() > 0) {
				$this->invalidateCredentials();
			}
			throw new Exception($e->getMessage(), $e->getCode());
		}
		return ($wsResult != null ? new AppWsResult($wsResult) : null);
	}
	
/**
	 * Enter description here ...
	 * @param int $serverId	
	 * @param boolean $RestartAfterExecuted
	 * @throws Exception
	 * @return Ambigous <NULL, AppWsResult>
	 */
	public final function SetEnqueueServerUpdateDiskResize($serverId, $diskNumber, $newSize , $RestartAfterExecuted = false) {

		$wsResult = null;
		try {			
			$vDisks = array();
			switch ($diskNumber) {
				case 0:
				$VirtualDiskType=AppVirtualDiskTypes::PRIMARY_VIRTUAL_DISK;
				break;
				case 1:
				$VirtualDiskType=AppVirtualDiskTypes::ADDITIONAL_VIRTUAL_DISK_1;
				break;
				case 2:
				$VirtualDiskType=AppVirtualDiskTypes::ADDITIONAL_VIRTUAL_DISK_2;
				break;
				case 3:
				$VirtualDiskType=AppVirtualDiskTypes::ADDITIONAL_VIRTUAL_DISK_3;
				break;	
				default:
				$VirtualDiskType="UNKNOWN";
				break;						
			}
			
			$vDisk = new VirtualDiskUpdate(AppVirtualDiskOperationType::RESIZE, null, $newSize, $VirtualDiskType);	
			$vDisks[]=$vDisk;		
			$server_update = new ServerUpdate(null, null, $RestartAfterExecuted, $serverId, $vDisks);
			$input = new SetEnqueueServerUpdate($server_update);
			$result = $this->wsEndUserExt->SetEnqueueServerUpdate($input);
			if ($result != null) {
				$wsResult = $result->SetEnqueueServerUpdateResult;
			}
		}
		catch (Exception $e) {
			if ($e->getCode() > 0) {
				$this->invalidateCredentials();
			}
			throw new Exception($e->getMessage(), $e->getCode());
		}
		return ($wsResult != null ? new AppWsResult($wsResult) : null);
	}
	
	/**
	 * Enter description here ...
	 * @param int $serverId	
	 * @param boolean $RestartAfterExecuted
	 * @throws Exception
	 * @return Ambigous <NULL, AppWsResult>
	 */
	public final function SetEnqueueServerUpdateDiskCreate($serverId, $diskNumber, $newSize , $RestartAfterExecuted = false) {

		$wsResult = null;
		try {
			$vDisks = array();		
			$vDisks = array();
			switch ($diskNumber) {
				case 0:
				$VirtualDiskType=AppVirtualDiskTypes::PRIMARY_VIRTUAL_DISK;
				break;
				case 1:
				$VirtualDiskType=AppVirtualDiskTypes::ADDITIONAL_VIRTUAL_DISK_1;
				break;
				case 2:
				$VirtualDiskType=AppVirtualDiskTypes::ADDITIONAL_VIRTUAL_DISK_2;
				break;
				case 3:
				$VirtualDiskType=AppVirtualDiskTypes::ADDITIONAL_VIRTUAL_DISK_3;
				break;	
				default:
				$VirtualDiskType="UNKNOWN";
				break;						
			}
			$vDisk = new VirtualDiskUpdate(AppVirtualDiskOperationType::CREATE, null, $newSize, $VirtualDiskType);	
			$vDisks[]=$vDisk;	
			$server_update = new ServerUpdate(null, null, $RestartAfterExecuted, $serverId, $vDisks);
			$input = new SetEnqueueServerUpdate($server_update);
			$result = $this->wsEndUserExt->SetEnqueueServerUpdate($input);
			if ($result != null) {
				$wsResult = $result->SetEnqueueServerUpdateResult;
			}
		}
		catch (Exception $e) {
			if ($e->getCode() > 0) {
				$this->invalidateCredentials();
			}
			throw new Exception($e->getMessage(), $e->getCode());
		}
		return ($wsResult != null ? new AppWsResult($wsResult) : null);
	}
	
/**
	 * Enter description here ...
	 * @param int $serverId	
	 * @param boolean $RestartAfterExecuted
	 * @throws Exception
	 * @return Ambigous <NULL, AppWsResult>
	 */
	public final function SetEnqueueServerUpdateDiskDelete($serverId, $diskNumber, $RestartAfterExecuted = false) {

		$wsResult = null;
		try {
			$vDisks = array();
			switch ($diskNumber) {
				case 0:
				$VirtualDiskType=AppVirtualDiskTypes::PRIMARY_VIRTUAL_DISK;
				break;
				case 1:
				$VirtualDiskType=AppVirtualDiskTypes::ADDITIONAL_VIRTUAL_DISK_1;
				break;
				case 2:
				$VirtualDiskType=AppVirtualDiskTypes::ADDITIONAL_VIRTUAL_DISK_2;
				break;
				case 3:
				$VirtualDiskType=AppVirtualDiskTypes::ADDITIONAL_VIRTUAL_DISK_3;
				break;	
				default:
				$VirtualDiskType="UNKNOWN";
				break;						
			}
			$vDisk = new VirtualDiskUpdate(AppVirtualDiskOperationType::DELETE, null, null, $VirtualDiskType);	
			$vDisks[]=$vDisk;
			$server_update = new ServerUpdate(null, null, $RestartAfterExecuted, $serverId, $vDisks);
			$input = new SetEnqueueServerUpdate($server_update);
			$result = $this->wsEndUserExt->SetEnqueueServerUpdate($input);
			if ($result != null) {
				$wsResult = $result->SetEnqueueServerUpdateResult;
			}
		}
		catch (Exception $e) {
			if ($e->getCode() > 0) {
				$this->invalidateCredentials();
			}
			throw new Exception($e->getMessage(), $e->getCode());
		}
		return ($wsResult != null ? new AppWsResult($wsResult) : null);
	}
	



	public final function SetEnqueueServerArchiviation($serverId) {

		$wsResult = null;
		try {
			$input = new SetEnqueueServerArchiviation($serverId);
			$result = $this->wsEndUserExt->SetEnqueueServerArchiviation($input);
			if ($result != null) {
				$wsResult = $result->SetEnqueueServerArchiviationResult;
			}
		}
		catch (Exception $e) {
			if ($e->getCode() > 0) {
				$this->invalidateCredentials();
			}
			throw new Exception($e->getMessage(), $e->getCode());
		}
		return ($wsResult != null ? new AppWsResult($wsResult) : null);
	}


	public final function SetEnqueueServerRestore($serverId, $cpu, $ram) {

		$wsResult = null;
		try {
			$restore = new ServerRestore($cpu, $ram, $serverId);
			$input = new SetEnqueueServerRestore($restore);
			$result = $this->wsEndUserExt->SetEnqueueServerRestore($input);
			if ($result != null) {
				$wsResult = $result->SetEnqueueServerRestoreResult;
			}
		}
		catch (Exception $e) {
			if ($e->getCode() > 0) {
				$this->invalidateCredentials();
			}
			throw new Exception($e->getMessage(), $e->getCode());
		}
		return ($wsResult != null ? new AppWsResult($wsResult) : null);
	}


	public final function SetEnqueueServerCreation(AppNewServer $appNewServer) {

		$wsResult = null;
		try {
			// data type "wrapping"
			$vDisks = array();
			foreach($appNewServer->VirtualDisks as $appVD) {
				$vDisks[] = new VirtualDiskDetails(null, $appVD->Size, $appVD->VirtualDiskType);
				//$vDisks[] = new VirtualDisk($appVD->CreationDate, $appVD->Size);
			}
						
			$naConfigs = array();			
			foreach($appNewServer->NetworkAdaptersConfiguration as $appNAC) {
				
				$naType = $appNAC->NetworkAdapterType->getCurrentValue();
				$appPVL = $appNAC->PrivateVLan;
				$pvl = null;
				if ($appPVL != null && isset($appPVL)) {				
					$pvl = new PrivateVLanDetails(utf8_encode($appPVL->Gateway), utf8_encode($appPVL->IPAddress), 
												  $appPVL->PrivateVLanResourceId, utf8_encode($appPVL->SubNetMask));
				}
				$pias = array();
				if ($appNAC->PublicIpAddresses != null && isset($appNAC->PublicIpAddresses) && sizeof($appNAC->PublicIpAddresses) > 0) {
					foreach($appNAC->PublicIpAddresses as $appPIA) {
						$pias[] = new PublicIpAddressDetails($appPIA->PrimaryIPAddress, $appPIA->PublicIpAddressResourceId);
					}
				}
				$naConfigs[] = new NetworkAdapterConfiguration($naType, $pvl, $pias);				
			}
					
			// creation of NewServer type
			$newServerWS = new NewServer($appNewServer->AdministratorPassword, $appNewServer->CPUQuantity, 
										 $appNewServer->Name, $naConfigs, "", $appNewServer->OSTemplateId,
										 $appNewServer->RAMQuantity, $vDisks);

			// WS method population
			$input = new SetEnqueueServerCreation($newServerWS);
			$result = $this->wsEndUserExt->SetEnqueueServerCreation($input);
			if ($result != null) {
				$wsResult = $result->SetEnqueueServerCreationResult;
			}
		}
		catch (Exception $e) {
			if ($e->getCode() > 0) {
				$this->invalidateCredentials();
			}
			throw new Exception($e->getMessage(), $e->getCode());
		}
		return ($wsResult != null ? new AppWsResult($wsResult) : null);
	}



	public final function SetEnqueueServerDeletion($serverId) {

		$wsResult = null;
		try {
			$input = new SetEnqueueServerDeletion($serverId);
			$result = $this->wsEndUserExt->SetEnqueueServerDeletion($input);
			if ($result != null) {
				$wsResult = $result->SetEnqueueServerDeletionResult;
			}
		}
		catch (Exception $e) {
			if ($e->getCode() > 0) {
				$this->invalidateCredentials();
			}
			throw new Exception($e->getMessage(), $e->getCode());
		}
		return ($wsResult != null ? new AppWsResult($wsResult) : null);
	}
	
	
	public final function SetEnqueueAssociateVLan($vLanResourceId, $networkAdapterId) {

		$wsResult = null;
		try {
			$input = new SetEnqueueAssociateVLan($vLanResourceId, $networkAdapterId);
			$result = $this->wsEndUserExt->SetEnqueueAssociateVLan($input);
			if ($result != null) {
				$wsResult = $result->SetEnqueueAssociateVLanResult;
			}
		}
		catch (Exception $e) {
			if ($e->getCode() > 0) {
				$this->invalidateCredentials();
			}
			throw new Exception($e->getMessage(), $e->getCode());
		}
		return ($wsResult != null ? new AppWsResult($wsResult) : null);
	}
	
	public final function SetEnqueueDeassociateVLan($vLanResourceId, $networkAdapterId) {

		$wsResult = null;
		try {
			$input = new SetEnqueueDeassociateVLan($vLanResourceId, $networkAdapterId);
			$result = $this->wsEndUserExt->SetEnqueueDeassociateVLan($input);
			if ($result != null) {
				$wsResult = $result->SetEnqueueDeassociateVLanResult;
			}
		}
		catch (Exception $e) {
			if ($e->getCode() > 0) {
				$this->invalidateCredentials();
			}
			throw new Exception($e->getMessage(), $e->getCode());
		}
		return ($wsResult != null ? new AppWsResult($wsResult) : null);
	}
	
	public final function SetEnqueueAssociateIpAddress($ipAddressResourceIds, $networkAdapterId) {

		$wsResult = null;
		try {
			$input = new SetEnqueueAssociateIpAddress($ipAddressResourceIds, $networkAdapterId);
			$result = $this->wsEndUserExt->SetEnqueueAssociateIpAddress($input);
			if ($result != null) {
				$wsResult = $result->SetEnqueueAssociateIpAddressResult;
			}
		}
		catch (Exception $e) {
			if ($e->getCode() > 0) {
				$this->invalidateCredentials();
			}
			throw new Exception($e->getMessage(), $e->getCode());
		}
		return ($wsResult != null ? new AppWsResult($wsResult) : null);
	}
	
	
	public final function SetEnqueueDeassociateIpAddress($ipAddressResourceIds, $networkAdapterId) {

		$wsResult = null;
		try {
			$input = new SetEnqueueDeassociateIpAddress($ipAddressResourceIds, $networkAdapterId);
			$result = $this->wsEndUserExt->SetEnqueueDeassociateIpAddress($input);
			if ($result != null) {
				$wsResult = $result->SetEnqueueDeassociateIpAddressResult;
			}
		}
		catch (Exception $e) {
			if ($e->getCode() > 0) {
				$this->invalidateCredentials();
			}
			throw new Exception($e->getMessage(), $e->getCode());
		}
		return ($wsResult != null ? new AppWsResult($wsResult) : null);
	}
	
	


}

?>