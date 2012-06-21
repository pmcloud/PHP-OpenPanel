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
 * This is a WSEndUser invocation demo.
 * 
 * You can use this file as an example on WsEndUser methods' invocation, to send requests to the Cloud's API.
 * 
 * We decided to bind WsEndUser's methods to the php classes using a public and open source tool that represents a variant of
 * "wsdl2php" called: WALLE/WSDL2PHPGENERATOR
 * 
 * At this moment, you can download it from this url: https://github.com/walle/wsdl2phpgenerator (v1.5.1-6) (look for "Downloads" link)
 * 
 * NOTE: THE CURRENT VERSION OF THE PROJECT is mapped using the version 1.4  of the WsEndUser API
 *  
 * The main class is "WsEndUserExt" that is the extension of the generated - by WALLE-GENERATOR - class "WsEndUser" used to bind "WsEndUser" WSDL.
 * For truth, the generation process builds a class - WsEndUser - that contains some mistakes, but is very simple remove them using any php editor.
 * 
 * "WsEndUSerExt" add a common authentication method reusable by all ws-clients; in this project we have two WS-Client named "WsEndUserClient" for
 * all those generic methods and  "WsEndUserVDCConfigClient" for some specific VirtualDataCenter Configuration info.
 * 
 */

error_reporting(E_ALL);

include_once 'WsEndUserClient.php';
include_once 'WsEndUserVDCConfigClient.php';
include_once 'AppDatacenterConfig.php';
include_once 'AppCredit.php';
include_once 'WSResultPrompter.php';
include_once 'AppNetworkAdapterType.php';
include_once 'AppPublicIpAddressDetails.php';	
include_once 'AppNetworkAdapterConfiguration.php';
include_once 'AppPrivateVLanDetails.php';
include_once 'AppNewServer.php';
include_once 'AppVirtualDiskTypes.php';

									
$endUserExt = new WsEndUserExt(array(
	 				"debug"=>false							
					//"ws_url" => "https://api.dc1.computing.cloud.it", // if different url is needed
					//"enduser_api_version", "v1.4",					// if different API version is used (after re-mapping classes)
					//"default_timezone" => "Europe/Rome"				// if different localization is needed
					));

/**
 * These two "ws*Clients" MUST share the same  "WsClientExt" instance so the can invoke WS methods using a single security-header
 */				
$endUserClient  = new WsEndUserClient($endUserExt);									
$vdcConfigClient= new WsEndUserVDCConfigClient($endUserExt);

try {

	print "\n-------------------------------------------------------------\n";
	print "Login into the VDC...";
	print "\n-------------------------------------------------------------\n";
	
	/**
	 * >>> TODO Here, you have to obtain from Aruba an account/password pair to be able to log in the system <<<
	 */
	//$login is a "AppUserToken" element
	$someUsername = "ARU00000";
	$someUserPwd  = "some.user.pwd";	
	$login = $endUserClient->loginAs($someUsername, $someUserPwd);
	
	if ($login->isValid()) {
		print "login DONE as:\nUsername: ".$login->getUsername(). "\nToken: ".$login->getToken();
	}
	else {
		print "login FAILED!";
	}


	print "\n-------------------------------------------------------------\n";
	print "Retrieving  ALL  Datacenters...";
	print "\n-------------------------------------------------------------\n";
  	$datacentersCfg = $vdcConfigClient->getAllDatacenterConfigurations();
	/**
	 * USE:  $datacentersCfg = $vdcConfigClient->getEnabledDatacenterConfigurations(); // when ONLY ACTIVE datacenter are needed
	 */	
	if ($datacentersCfg != null) {
		foreach ($datacentersCfg as $dc) {
			print $dc->getDatacenterDescription() ."   Admin-url: " .$dc->AdminPanelBaseUrl ."   Base-url: " . $dc->WsBaseUrl
			.("enabled" == strtolower($dc->Status) ? "  ENABLED" : "  DISABLED") 
			."\n";
		}
	}
	
	$credito = $endUserClient->getAvailableCredit();
	if ($credito != null) {
		print "\n\nAvalable credit for ". $endUserClient->getUsername() ." is: ". $credito->toString();
	}

	
	$testingServerID = null;
	
	print "\n\n-------------------------------------------------------------\n";
	print "Datacenter structural information";
	print "\n-------------------------------------------------------------\n";
	$vdc = $endUserClient->getVirtualDatacenter();
	if ($vdc != null) {
		
		print " Server's list\n";
		print "  Windows\n";
		
		foreach ($vdc->getServers() as $appServer) {
			if ($appServer->isWindowsBasedOS()) {
				
				if ($testingServerID == null) {
					$testingServerID = $appServer->ServerId;
				}
									
				print "   id:" . $appServer->ServerId . " Name:" . $appServer->Name . " State:" . $appServer->getServerStatus()
					." OS/Template:" . $appServer->getOSTemplateDescription() . " Hypervisor:" . $appServer->getHypervisorType()
					." CPU:" .$appServer->CPUQuantity->Quantity 
					." RAM:" .$appServer->RAMQuantity->Quantity ."Disk n.:" .$appServer->getDiskNumber() ." DisK-space:" .$appServer->getTotalDiskSize() ."\n";
					
				foreach( $appServer->getVirtualDisks() as $value) {
					print "SIZE: " . $value->Size . "\n";
				}
				foreach ($appServer->getNetworkAdapters() as $na) {
					print "  -->Network-id: " .$na->getId() ."  Network-name: " .$na->getVlanName() 
					."  TYPE: " .$na->getNetworkAdapterType()
					." IP(s): " .sizeof($na->getIpAddresses());
				
					if (sizeof($na->getIpAddresses()) > 0) {
						foreach($na->getIpAddresses() as $ipa) {
							print $ipa->Value .",";
						} 
					}
					print ($na->isConnected() ? "    CONNECTED" : "    disconnected");
					if ($na->isConnected()) {
						print "   to: "; 
						$ss = $vdc->getAppServersNameById(array($na->getServerId()));
						foreach($ss as $ssx) {
							print $ssx ." ";
						}
					}
					print "\n";
				}
				
				$available = $appServer->geAvailableNetworkAdapters();
				print "Available Ethernets: ";
				if ($available != null && sizeof($available) >0) {
										 
					foreach( $available as $a) {
						print $a->getNetworkAdapterType() .", "; 	
					}
					print "\n";
				}
				else {
					print "NONE\n";
				}
				$nx = $appServer->getNetworkAdapter(AppNetworkAdapterType::ETHERNET_1);
				if ($nx != null) {
					print $nx->getNetworkAdapterType() ." IS: " .($nx->isConnected() ? "CONNECTED" : "disconnected") ."\n";
				}
			}
		}
		print "\n  Linux\n";
		foreach ($vdc->getServers() as $appServer) {
			if ($appServer->isLinuxBasedOS()) {
				
				if ($testingServerID == null) {
					$testingServerID = $appServer->ServerId;
				}
					
				print "   id:" . $appServer->ServerId . " Name:" . $appServer->Name . " State:" . $appServer->getServerStatus()
					." OS/Template:" . $appServer->getOSTemplateDescription() . " Hypervisor:" . $appServer->getHypervisorType()
					." CPU:" .$appServer->CPUQuantity->Quantity 
					." RAM:" .$appServer->RAMQuantity->Quantity ."Disk n.:" .$appServer->getDiskNumber() ." Disk-space:" .$appServer->getTotalDiskSize() ."\n";
					
				foreach( $appServer->getVirtualDisks() as $value) {
					print "  -->DiskSIZE: " . $value->Size . "\n";
				}
				foreach ($appServer->getNetworkAdapters() as $na) {
					print "  -->Network-id: " .$na->getId() ."  Network-name: " .$na->getVlanName() 
					."  TYPE: " .$na->getNetworkAdapterType()
					." IP(s): " .sizeof($na->getIpAddresses());
				
					if (sizeof($na->getIpAddresses()) > 0) {
						foreach($na->getIpAddresses() as $ipa) {
							print $ipa->Value .",";
						} 
					}
					print ($na->isConnected() ? "     CONNECTED" : "    disconnected");
					if ($na->isConnected()) {
						print "   to: ";
						$ss = $vdc->getAppServersNameById(array($na->getServerId()));
						foreach($ss as $ssx) {
							print $ssx ." ";
						}						
					}
					print "\n";				
				}
				
				$available = $appServer->geAvailableNetworkAdapters();
				print "Available Ethernets: ";
				if ($available != null && sizeof($available) >0) {
										 
					foreach( $available as $a) {
						print $a->getNetworkAdapterType() .", "; 	
					}
					print "\n";
				}
				else {
					print "NONE\n";
				}
				$nx = $appServer->getNetworkAdapter(AppNetworkAdapterType::ETHERNET_2);
				if ($nx != null) {
					print $nx->getNetworkAdapterType() ." IS: " .($nx->isConnected() ? "CONNECTED" : "disconnected") ."\n";
				}
			}
		}
		
		print "\nList of swithces\n";
		foreach($vdc->getVLans() as $appVlan) {
			print "ResourceId=".$appVlan->ResourceId." VLan: name=" . $appVlan->Name . " code=". $appVlan->VlanCode ." connected: " . ($appVlan->isConnected() ? "YES" : "NO");
			if ($appVlan->isConnected()) {
				print "  to: ";
				$ss = $vdc->getAppServersNameById(array($appVlan->ServerIds));
				foreach($ss as $ssx) {
					print $ssx .", ";
				}				
			}
			print "\n";
		}
		print "\nList of Public IPs\n";
		foreach($vdc->getIPAddresses() as $ip) {
			print "ResourceId=".$ip->ResourceId." IP: value=" . $ip->Value . " Subnet=" . $ip->SubNetMask ." assigned: " . ($ip->isAssigned() ? "YES" : "NO");
			if ($ip->isAssigned()) {
				print "  to the server: ";
				$ss = $vdc->getAppServersNameById(array($ip->ServerId));
				foreach($ss as $ssx) {
					print $ssx ." ";
				}
			}
			print "\n";
		}
	}

	print "\n\n-------------------------------------------------------------\n";
	print "Available Hypervisor(s)";
	print "\n-------------------------------------------------------------\n";
	$vdcConfig = $vdcConfigClient->getVDCResourceConfiguration();	
	foreach($vdcConfig->getAllRegisteredHypervisors() as $rhyp) {
		print " Registered-HYP: " .$rhyp->getFullDescription() ."\n";
	}
	print "\n";
	foreach($vdcConfig->getRegisteredHypervisorTypes() as $aht) {
		print "Type: " .$aht ."\n";
		foreach ($vdcConfig->getTemplatesFor($aht) as $atd) {
			print "   OS-template id: " . $atd->Id ."   product-id: " .$atd->ProductId ."  Name: " .$atd->Name 
					  ."  tipo:" .$atd->getTemplateType() ."\n";
			
			foreach(AppResourceType::values() as $art) {
				$rb = $vdcConfig->getResourceBounds($aht, $atd->ProductId, $art);
				if ($rb != null) {
					print "     ->". $rb->getResourceType() ."  Min: " .$rb->getMin() ."  Max: " .$rb->getMax() ."  Def: " .$rb->getDefault() ."\n";
				}	
			}			
		}
	}
	
	$lastWeek = 86400 * 7;	// get logs for the last-week	
	$dayStart = getdate( (time()- $lastWeek));
		
	$fromdt = new DateTime();
	$fromdt->setDate($dayStart['year'], $dayStart['mon'], $dayStart['mday']);
	
	$logs = $endUserClient->getLogs($fromdt->format('Y-m-d'), null);
	print "\n\n-------------------------------------------------------------\n";
	print "LOGs (last week)";
	print "\n-------------------------------------------------------------\n";
		
	foreach ($logs as $log) {
		print  $log->OperationName ."     ".$log->getStatus() .($log->isInErrorState() ? "!!" : "") ."      ".$log->getTargetResource()
		."     ".$log->Username ."      " .$log->getStartDatetime() ."      ".$log->getLastUpdateDatetime() ."\n";
	}
	
	/**
	 * If find at least one server...
	 */
	if ($testingServerID != null ) {
		
		print "\n\n-------------------------------------------------------------\n";
		print "*** SUBMIT some commands... ***";
		print "\n-------------------------------------------------------------\n";
	
		print "\n\n-------------------------------------------------------------\n";
		print "Server START  (it fails if yet running)\n";
		print "-------------------------------------------------------------\n";
		
		$appWSResult = $endUserClient->SetEnqueueServerStart($testingServerID);
		if ($appWSResult == null) {
			print "START request is failed!!";
		}
		else {
			if ($appWSResult->isSuccess()) {
				print "SUCCESS!! - " .$appWSResult->getSuccessMessage();
			}
			else {
				print "FAILED!! - (" .$appWSResult->getErrorCode() .") " .$appWSResult->getErrorMessage();
				if ($appWSResult->hasException()) {
					print "\nException: " . $appWSResult->getExceptionInfo();
				}
				$tip = WSResultPrompter::getLocalizedTipKey($appWSResult->getErrorCode()); 
				if ($tip != null) {
					print "\n" .$tip;
				}
			}
		}
		
		print "\n\n-------------------------------------------------------------\n";
		print "Server STOP  (it fails if not yet running) \n";
		print "-------------------------------------------------------------\n";
		$appWSResult = $endUserClient->setEnqueueServerStop($testingServerID);
		if ($appWSResult == null) {
			print "STOP request is failed!!!";
		}
		else {
			if ($appWSResult->isSuccess()) {
				print "SUCCESS!! - " .$appWSResult->getSuccessMessage();
			}
			else {
				print "FAILED!! - (" .$appWSResult->getErrorCode() .") " .$appWSResult->getErrorMessage();
				if ($appWSResult->hasException()) {
					print "\nException: " . $appWSResult->getExceptionInfo();
				}
				$tip = WSResultPrompter::getLocalizedTipKey($appWSResult->getErrorCode()); 
				if ($tip != null) {
					print "\n" .$tip;
				}
			}
		}
		
		print "\n\n-------------------------------------------------------------\n";
		print "Server RENAME, Disk CREATING, UPDATING or DELETING are commented \n";
		print ">Look for these commands in the 'invocation-example' source code <\n";
		print "-------------------------------------------------------------\n";
		
		/*
		print "\n\n-------------------------------------------------------------\n";
		print "Server RENAMING...\n";
		print "-------------------------------------------------------------\n";
		$appWSResult = $endUserClient->renameServer($testingServerID, 'NewSRVName-' .$testingServerID);	
		if ($appWSResult == null) {
			print "RENAMING Request is failed!!";
		}
		else {
			if ($appWSResult->isSuccess()) {
				print "SUCCESS!! - " .$appWSResult->getSuccessMessage();
			}
			else {
				print "FAILED!! - (" .$appWSResult->getErrorCode() .") " .$appWSResult->getErrorMessage();
				if ($appWSResult->hasException()) {
					print "\nException: " . $appWSResult->getExceptionInfo();
				}
				$tip = WSResultPrompter::getLocalizedTipKey($appWSResult->getErrorCode()); 
				if ($tip != null) {
					print "\n" .$tip;
				}
			}
		}		
		
		print "\n\n-------------------------------------------------------------\n";
		print "Server UPDATE: adding a NEW disk..\n";
		print "-------------------------------------------------------------\n";
		$appWSResult = $endUserClient->SetEnqueueServerUpdateDiskCreate($testingServerID, 2, 30);
		if ($appWSResult == null) {
			print "Disk creation request is failed!!";
		}
		else {
			if ($appWSResult->isSuccess()) {
				print "SUCCESS!! - " .$appWSResult->getSuccessMessage();
			}
			else {
				print "FAILED!! - (" .$appWSResult->getErrorCode() .") " .$appWSResult->getErrorMessage();
				if ($appWSResult->hasException()) {
					print "\nException: " . $appWSResult->getExceptionInfo();
				}
				$tip = WSResultPrompter::getLocalizedTipKey($appWSResult->getErrorCode()); 
				if ($tip != null) {
					print "\n" .$tip;
				}
			}
		}		
		
		print "\n\n-------------------------------------------------------------\n";
		print "Server UPDATE: updating disk size..\n";
		print "-------------------------------------------------------------\n";
		$appWSResult = $endUserClient->SetEnqueueServerUpdateDiskUpdate($testingServerID, 2, 40);
		if ($appWSResult == null) {
			print "Disk size update request is failed!!";
		}
		else {
			if ($appWSResult->isSuccess()) {
				print "SUCCESS!! - " .$appWSResult->getSuccessMessage();
			}
			else {
				print "FAILED!! - (" .$appWSResult->getErrorCode() .") " .$appWSResult->getErrorMessage();
				if ($appWSResult->hasException()) {
					print "\nException: " . $appWSResult->getExceptionInfo();
				}
				$tip = WSResultPrompter::getLocalizedTipKey($appWSResult->getErrorCode()); 
				if ($tip != null) {
					print "\n" .$tip;
				}
			}
		}		
		
		print "\n\n-------------------------------------------------------------\n";
		print "Server UPDATE: deleting a disk\n";
		print "-------------------------------------------------------------\n";
		$appWSResult = $endUserClient->SetEnqueueServerUpdateDiskDelete($testingServerID, 2);
		if ($appWSResult == null) {
			print "RICHIESTA di UPDATE del server non riuscita.";
		}
		else {
			if ($appWSResult->isSuccess()) {
				print "SUCCESS!! - " .$appWSResult->getSuccessMessage();
			}
			else {
				print "FAILED!! - (" .$appWSResult->getErrorCode() .") " .$appWSResult->getErrorMessage();
				if ($appWSResult->hasException()) {
					print "\nException: " . $appWSResult->getExceptionInfo();
				}
				$tip = WSResultPrompter::getLocalizedTipKey($appWSResult->getErrorCode()); 
				if ($tip != null) {
					print "\n" .$tip;
				}
			}
		}
		*/
		
	} // end of block
	
	
	print "\n\n-------------------------------------------------------------\n";
	print "SERVER CREATION code is commented \n";
	print ">Look how to create a new server in the 'invocation-example' source code <\n";
	print "-------------------------------------------------------------\n";
		
/*
	print "\n\n-------------------------------------------------------------\n";
	print "NEW Server creation\n";
	print "-------------------------------------------------------------\n";
	
	// FIRST: Define some server components...
	$AppVirtualDisk1 = new AppVirtualDisk();
	$AppVirtualDisk1->VirtualDiskType = AppVirtualDiskTypes::PRIMARY_VIRTUAL_DISK;
	$AppVirtualDisk1->Size = 30;
	
	$AppVirtualDisk2 = new AppVirtualDisk();
	$AppVirtualDisk2->VirtualDiskType = AppVirtualDiskTypes::ADDITIONAL_VIRTUAL_DISK_1;	
	$AppVirtualDisk2->Size = 10;
	
	$appVDISKS = array($AppVirtualDisk1, $AppVirtualDisk2);
	
	// SECOND: network adapters....
	$somePublicIPId = -1000; 		// set this value to a valid id
	$someVlanResourceId = -2000;	// set this value to a valid id
	$privateIPExample = "192.168.1.111";
	$privateNetmaskExample = "255.255.255.0";
	
	$eth0 = new AppNetworkAdapterType(AppNetworkAdapterType::ETHERNET_0);
	$pip0 = new AppPublicIpAddressDetails($somePublicIPId, true);			
	$appNAC0 = new AppNetworkAdapterConfiguration($eth0, null, array($pip0));
	
	$eth1 = new AppNetworkAdapterType(AppNetworkAdapterType::ETHERNET_1);
	$vlan1= new AppPrivateVLanDetails($someVlanResourceId, $privateIPExample, $privateNetmaskExample);
	$appNAC1 = new AppNetworkAdapterConfiguration($eth1, $vlan1, null);
	
	$appNACs = array($appNAC0, $appNAC1);
	
	// THIRD: define template id (server OS), CPU and RAM (Gb)..
	$OSTemplateId = -3000;  // set this value to a valid template-id
	$srvCpu = 2;
	$srvRam = 2;
	$appNewServer = new AppNewServer("MyNewServer", "ServerPassword2012", $OSTemplateId, $srvCpu, $srvRam, $appVDISKS, $appNACs);
	
	//FOURTH: invoke server creation method...
	$appResult = $endUserClient->SetEnqueueServerCreation($appNewServer);
	
*/
	
	print "\n\n-------------- END OF TESTs ---------------";
}
catch (Exception $e){

	print $e;   
}

?>