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

include_once('GetUserAuthenticationToken.php');
include_once('GetUserAuthenticationTokenResponse.php');
include_once('GetAllServers.php');
include_once('GetAllServersResponse.php');
include_once('GetServers.php');
include_once('GetServersResponse.php');
include_once('GetServerDetails.php');
include_once('GetServerDetailsResponse.php');
include_once('GetVirtualDatacenter.php');
include_once('GetVirtualDatacenterResponse.php');
include_once('GetCredit.php');
include_once('GetCreditResponse.php');
include_once('GetPriceList.php');
include_once('GetPriceListResponse.php');
include_once('SetEnqueueServerStart.php');
include_once('SetEnqueueServerStartResponse.php');
include_once('SetEnqueueServerSnapshot.php');
include_once('SetEnqueueServerSnapshotResponse.php');
include_once('SetEnqueueVirtualDiskExport.php');
include_once('SetEnqueueVirtualDiskExportResponse.php');
include_once('SetEnqueueServerPowerOff.php');
include_once('SetEnqueueServerPowerOffResponse.php');
include_once('SetEnqueueServerReset.php');
include_once('SetEnqueueServerResetResponse.php');
include_once('SetEnqueueServerStop.php');
include_once('SetEnqueueServerStopResponse.php');
include_once('GetVirtualDatacenterCost.php');
include_once('GetVirtualDatacenterCostResponse.php');
include_once('GetDatacenterConfigurations.php');
include_once('GetDatacenterConfigurationsResponse.php');
include_once('ExceptionInfo.php');
include_once('UserToken.php');
include_once('Company.php');
include_once('Hypervisor.php');
include_once('TemplateDetails.php');
include_once('ResourceBound.php');
include_once('VirtualDatacenter.php');
include_once('FTP.php');
include_once('FTPServer.php');
include_once('IPAddress.php');
include_once('CloudEntity.php');
include_once('ServerDetails.php');
include_once('Job.php');
include_once('Cpu.php');
include_once('NetworkAdapter.php');
include_once('VLan.php');
include_once('Template.php');
include_once('KeyValuePair.php');
include_once('Ram.php');
include_once('Snapshot.php');
include_once('VirtualDVD.php');
include_once('VirtualDisk.php');
include_once('VirtualDatacenterCost.php');
include_once('AggregateCost.php');
include_once('IpAddressCost.php');
include_once('ResourceCost.php');
include_once('ServerCost.php');
include_once('VirtualDiskCost.php');
include_once('Server.php');
include_once('Credit.php');
include_once('PriceList.php');
include_once('Price.php');
include_once('PriceModifier.php');
include_once('Log.php');
include_once('DatacenterConfig.php');
include_once('CustomVirtualDisk.php');
include_once('IsoDetails.php');
include_once('UserInfo.php');
include_once('NewServer.php');
include_once('NetworkAdapterConfiguration.php');
include_once('PrivateVLanDetails.php');
include_once('PublicIpAddressDetails.php');
include_once('VirtualDiskDetails.php');
include_once('ServerUpdate.php');
include_once('VirtualDiskUpdate.php');
include_once('ServerRestore.php');
include_once('NewIso.php');
include_once('ExportVirtualDisk.php');
include_once('CompanySettings.php');
include_once('CompanyDataCenterSettings.php');
include_once('CompanySupportSettings.php');
include_once('WsResult.php');
include_once('WsResultOfstring.php');
include_once('WsResultOfUserToken.php');
include_once('WsResultOfCompanySettings.php');
include_once('WsResultOfArrayOfHypervisor.php');
include_once('WsResultOfVirtualDatacenter.php');
include_once('WsResultOfVirtualDatacenterCost.php');
include_once('WsResultOfArrayOfServer.php');
include_once('WsResultOfServerDetails.php');
include_once('WsResultOfCredit.php');
include_once('WsResultOfArrayOfPriceList.php');
include_once('WsResultOfArrayOfVLan.php');
include_once('WsResultOfArrayOfIPAddress.php');
include_once('WsResultOfArrayOfJob.php');
include_once('WsResultOfArrayOfLog.php');
include_once('WsResultOfArrayOfDatacenterConfig.php');
include_once('WsResultOfArrayOfCustomVirtualDisk.php');
include_once('WsResultOfArrayOfIsoDetails.php');
include_once('WsResultOfUserInfo.php');
include_once('WsResultOfFTP.php');
include_once('WsResultOfIPAddress.php');
include_once('WsResultOfVLan.php');
include_once('SetEnqueueAssociateVLan.php');
include_once('SetEnqueueAssociateVLanResponse.php');
include_once('SetEnqueueDeassociateVLan.php');
include_once('SetEnqueueDeassociateVLanResponse.php');
include_once('SetEnqueueCreateFTPAccount.php');
include_once('SetEnqueueCreateFTPAccountResponse.php');
include_once('SetEnqueueResizeFTPAccount.php');
include_once('SetEnqueueResizeFTPAccountResponse.php');
include_once('GetVDCGraph.php');
include_once('GetVDCGraphResponse.php');
include_once('SetAddVDCGraph.php');
include_once('SetAddVDCGraphResponse.php');
include_once('SetUpdateVDCGraph.php');
include_once('SetUpdateVDCGraphResponse.php');
include_once('GetCompanyByUrl.php');
include_once('GetCompanyByUrlResponse.php');
include_once('GetHypervisors.php');
include_once('GetHypervisorsResponse.php');
include_once('GetPurchasedVLans.php');
include_once('GetPurchasedVLansResponse.php');
include_once('GetPurchasedIpAddresses.php');
include_once('GetPurchasedIpAddressesResponse.php');
include_once('GetJobs.php');
include_once('GetJobsResponse.php');
include_once('GetLogs.php');
include_once('GetLogsResponse.php');
include_once('GetCustomVirtualDisks.php');
include_once('GetCustomVirtualDisksResponse.php');
include_once('GetIsos.php');
include_once('GetIsosResponse.php');
include_once('GetUserInfo.php');
include_once('GetUserInfoResponse.php');
include_once('GetPurchasedFTP.php');
include_once('GetPurchasedFTPResponse.php');
include_once('SetEnqueueServerCreation.php');
include_once('SetEnqueueServerCreationResponse.php');
include_once('SetEnqueueServerUpdate.php');
include_once('SetEnqueueServerUpdateResponse.php');
include_once('SetEnqueueServerDeletion.php');
include_once('SetEnqueueServerDeletionResponse.php');
include_once('SetEnqueueServerRestart.php');
include_once('SetEnqueueServerRestartResponse.php');
include_once('SetEnqueueServerArchiviation.php');
include_once('SetEnqueueServerArchiviationResponse.php');
include_once('SetEnqueueServerRestore.php');
include_once('SetEnqueueServerRestoreResponse.php');
include_once('SetRenameServer.php');
include_once('SetRenameServerResponse.php');
include_once('SetEnqueueMountDvdIso.php');
include_once('SetEnqueueMountDvdIsoResponse.php');
include_once('SetEnqueueUnmountDvdIso.php');
include_once('SetEnqueueUnmountDvdIsoResponse.php');
include_once('SetEnqueueVirtualDiskManage.php');
include_once('SetEnqueueVirtualDiskManageResponse.php');
include_once('SetChangeNoteServer.php');
include_once('SetChangeNoteServerResponse.php');
include_once('SetPurchaseIpAddress.php');
include_once('SetPurchaseIpAddressResponse.php');
include_once('SetRemoveIpAddress.php');
include_once('SetRemoveIpAddressResponse.php');
include_once('SetEnqueueAssociateIpAddress.php');
include_once('SetEnqueueAssociateIpAddressResponse.php');
include_once('SetEnqueueDeassociateIpAddress.php');
include_once('SetEnqueueDeassociateIpAddressResponse.php');
include_once('SetPurchaseVLan.php');
include_once('SetPurchaseVLanResponse.php');
include_once('SetRemoveVLan.php');
include_once('SetRemoveVLanResponse.php');
include_once('SetRenameVLan.php');
include_once('SetRenameVLanResponse.php');


/**
 * 
 */
class WsEndUser extends SoapClient
{

  /**
   * 
   * @var array $classmap The defined classes
   * @access private
   */
  protected static $classmap = array(
    'GetUserAuthenticationToken' => 'GetUserAuthenticationToken',
    'GetUserAuthenticationTokenResponse' => 'GetUserAuthenticationTokenResponse',
    'GetAllServers' => 'GetAllServers',
    'GetAllServersResponse' => 'GetAllServersResponse',
    'GetServers' => 'GetServers',
    'GetServersResponse' => 'GetServersResponse',
    'GetServerDetails' => 'GetServerDetails',
    'GetServerDetailsResponse' => 'GetServerDetailsResponse',
    'GetVirtualDatacenter' => 'GetVirtualDatacenter',
    'GetVirtualDatacenterResponse' => 'GetVirtualDatacenterResponse',
    'GetCredit' => 'GetCredit',
    'GetCreditResponse' => 'GetCreditResponse',
    'GetPriceList' => 'GetPriceList',
    'GetPriceListResponse' => 'GetPriceListResponse',
    'SetEnqueueServerStart' => 'SetEnqueueServerStart',
    'SetEnqueueServerStartResponse' => 'SetEnqueueServerStartResponse',
    'SetEnqueueServerSnapshot' => 'SetEnqueueServerSnapshot',
    'SetEnqueueServerSnapshotResponse' => 'SetEnqueueServerSnapshotResponse',
    'SetEnqueueVirtualDiskExport' => 'SetEnqueueVirtualDiskExport',
    'SetEnqueueVirtualDiskExportResponse' => 'SetEnqueueVirtualDiskExportResponse',
    'SetEnqueueServerPowerOff' => 'SetEnqueueServerPowerOff',
    'SetEnqueueServerPowerOffResponse' => 'SetEnqueueServerPowerOffResponse',
    'SetEnqueueServerReset' => 'SetEnqueueServerReset',
    'SetEnqueueServerResetResponse' => 'SetEnqueueServerResetResponse',
    'SetEnqueueServerStop' => 'SetEnqueueServerStop',
    'SetEnqueueServerStopResponse' => 'SetEnqueueServerStopResponse',
    'GetVirtualDatacenterCost' => 'GetVirtualDatacenterCost',
    'GetVirtualDatacenterCostResponse' => 'GetVirtualDatacenterCostResponse',
    'GetDatacenterConfigurations' => 'GetDatacenterConfigurations',
    'GetDatacenterConfigurationsResponse' => 'GetDatacenterConfigurationsResponse',
    'ExceptionInfo' => 'ExceptionInfo',
    'UserToken' => 'UserToken',
    'Company' => 'Company',
    'Hypervisor' => 'Hypervisor',
    'TemplateDetails' => 'TemplateDetails',
    'ResourceBound' => 'ResourceBound',
    'VirtualDatacenter' => 'VirtualDatacenter',
    'FTP' => 'FTP',
    'FTPServer' => 'FTPServer',
    'IPAddress' => 'IPAddress',
    'CloudEntity' => 'CloudEntity',
    'ServerDetails' => 'ServerDetails',
    'Job' => 'Job',
    'Cpu' => 'Cpu',
    'NetworkAdapter' => 'NetworkAdapter',
    'VLan' => 'VLan',
    'Template' => 'Template',
    'KeyValuePair' => 'KeyValuePair',
    'Ram' => 'Ram',
    'Snapshot' => 'Snapshot',
    'VirtualDVD' => 'VirtualDVD',
    'VirtualDisk' => 'VirtualDisk',
    'VirtualDatacenterCost' => 'VirtualDatacenterCost',
    'AggregateCost' => 'AggregateCost',
    'IpAddressCost' => 'IpAddressCost',
    'ResourceCost' => 'ResourceCost',
    'ServerCost' => 'ServerCost',
    'VirtualDiskCost' => 'VirtualDiskCost',
    'Server' => 'Server',
    'Credit' => 'Credit',
    'PriceList' => 'PriceList',
    'Price' => 'Price',
    'PriceModifier' => 'PriceModifier',
    'Log' => 'Log',
    'DatacenterConfig' => 'DatacenterConfig',
    'CustomVirtualDisk' => 'CustomVirtualDisk',
    'IsoDetails' => 'IsoDetails',
    'UserInfo' => 'UserInfo',
    'NewServer' => 'NewServer',
    'NetworkAdapterConfiguration' => 'NetworkAdapterConfiguration',
    'PrivateVLanDetails' => 'PrivateVLanDetails',
    'PublicIpAddressDetails' => 'PublicIpAddressDetails',
    'VirtualDiskDetails' => 'VirtualDiskDetails',
    'ServerUpdate' => 'ServerUpdate',
    'VirtualDiskUpdate' => 'VirtualDiskUpdate',
    'ServerRestore' => 'ServerRestore',
    'NewIso' => 'NewIso',
    'ExportVirtualDisk' => 'ExportVirtualDisk',
    'CompanySettings' => 'CompanySettings',
    'CompanyDataCenterSettings' => 'CompanyDataCenterSettings',
    'CompanySupportSettings' => 'CompanySupportSettings',
    'WsResult' => 'WsResult',
    'WsResultOfstring' => 'WsResultOfstring',
    'WsResultOfUserToken' => 'WsResultOfUserToken',
    'WsResultOfCompanySettings' => 'WsResultOfCompanySettings',
    'WsResultOfArrayOfHypervisor' => 'WsResultOfArrayOfHypervisor',
    'WsResultOfVirtualDatacenter' => 'WsResultOfVirtualDatacenter',
    'WsResultOfVirtualDatacenterCost' => 'WsResultOfVirtualDatacenterCost',
    'WsResultOfArrayOfServer' => 'WsResultOfArrayOfServer',
    'WsResultOfServerDetails' => 'WsResultOfServerDetails',
    'WsResultOfCredit' => 'WsResultOfCredit',
    'WsResultOfArrayOfPriceList' => 'WsResultOfArrayOfPriceList',
    'WsResultOfArrayOfVLan' => 'WsResultOfArrayOfVLan',
    'WsResultOfArrayOfIPAddress' => 'WsResultOfArrayOfIPAddress',
    'WsResultOfArrayOfJob' => 'WsResultOfArrayOfJob',
    'WsResultOfArrayOfLog' => 'WsResultOfArrayOfLog',
    'WsResultOfArrayOfDatacenterConfig' => 'WsResultOfArrayOfDatacenterConfig',
    'WsResultOfArrayOfCustomVirtualDisk' => 'WsResultOfArrayOfCustomVirtualDisk',
    'WsResultOfArrayOfIsoDetails' => 'WsResultOfArrayOfIsoDetails',
    'WsResultOfUserInfo' => 'WsResultOfUserInfo',
    'WsResultOfFTP' => 'WsResultOfFTP',
    'WsResultOfIPAddress' => 'WsResultOfIPAddress',
    'WsResultOfVLan' => 'WsResultOfVLan',
    'SetEnqueueAssociateVLan' => 'SetEnqueueAssociateVLan',
    'SetEnqueueAssociateVLanResponse' => 'SetEnqueueAssociateVLanResponse',
    'SetEnqueueDeassociateVLan' => 'SetEnqueueDeassociateVLan',
    'SetEnqueueDeassociateVLanResponse' => 'SetEnqueueDeassociateVLanResponse',
    'SetEnqueueCreateFTPAccount' => 'SetEnqueueCreateFTPAccount',
    'SetEnqueueCreateFTPAccountResponse' => 'SetEnqueueCreateFTPAccountResponse',
    'SetEnqueueResizeFTPAccount' => 'SetEnqueueResizeFTPAccount',
    'SetEnqueueResizeFTPAccountResponse' => 'SetEnqueueResizeFTPAccountResponse',
    'GetVDCGraph' => 'GetVDCGraph',
    'GetVDCGraphResponse' => 'GetVDCGraphResponse',
    'SetAddVDCGraph' => 'SetAddVDCGraph',
    'SetAddVDCGraphResponse' => 'SetAddVDCGraphResponse',
    'SetUpdateVDCGraph' => 'SetUpdateVDCGraph',
    'SetUpdateVDCGraphResponse' => 'SetUpdateVDCGraphResponse',
    'GetUserAuthenticationToken' => 'GetUserAuthenticationToken',
    'GetUserAuthenticationTokenResponse' => 'GetUserAuthenticationTokenResponse',
    'GetCompanyByUrl' => 'GetCompanyByUrl',
    'GetCompanyByUrlResponse' => 'GetCompanyByUrlResponse',
    'GetHypervisors' => 'GetHypervisors',
    'GetHypervisorsResponse' => 'GetHypervisorsResponse',
    'GetVirtualDatacenter' => 'GetVirtualDatacenter',
    'GetVirtualDatacenterResponse' => 'GetVirtualDatacenterResponse',
    'GetVirtualDatacenterCost' => 'GetVirtualDatacenterCost',
    'GetVirtualDatacenterCostResponse' => 'GetVirtualDatacenterCostResponse',
    'GetServers' => 'GetServers',
    'GetServersResponse' => 'GetServersResponse',    
    'GetCredit' => 'GetCredit',
    'GetCreditResponse' => 'GetCreditResponse',
    'GetPriceList' => 'GetPriceList',
    'GetPriceListResponse' => 'GetPriceListResponse',
    'GetPurchasedVLans' => 'GetPurchasedVLans',
    'GetPurchasedVLansResponse' => 'GetPurchasedVLansResponse',
    'GetPurchasedIpAddresses' => 'GetPurchasedIpAddresses',
    'GetPurchasedIpAddressesResponse' => 'GetPurchasedIpAddressesResponse',
    'GetJobs' => 'GetJobs',
    'GetJobsResponse' => 'GetJobsResponse',
    'GetLogs' => 'GetLogs',
    'GetLogsResponse' => 'GetLogsResponse',
    'GetDatacenterConfigurations' => 'GetDatacenterConfigurations',
    'GetDatacenterConfigurationsResponse' => 'GetDatacenterConfigurationsResponse',
    'GetCustomVirtualDisks' => 'GetCustomVirtualDisks',
    'GetCustomVirtualDisksResponse' => 'GetCustomVirtualDisksResponse',
    'GetIsos' => 'GetIsos',
    'GetIsosResponse' => 'GetIsosResponse',
    'GetUserInfo' => 'GetUserInfo',
    'GetUserInfoResponse' => 'GetUserInfoResponse',
    'GetPurchasedFTP' => 'GetPurchasedFTP',
    'GetPurchasedFTPResponse' => 'GetPurchasedFTPResponse',
    'SetEnqueueServerCreation' => 'SetEnqueueServerCreation',
    'SetEnqueueServerCreationResponse' => 'SetEnqueueServerCreationResponse',
    'SetEnqueueServerUpdate' => 'SetEnqueueServerUpdate',
    'SetEnqueueServerUpdateResponse' => 'SetEnqueueServerUpdateResponse',
    'SetEnqueueServerStart' => 'SetEnqueueServerStart',
    'SetEnqueueServerStartResponse' => 'SetEnqueueServerStartResponse',
    'SetEnqueueServerStop' => 'SetEnqueueServerStop',
    'SetEnqueueServerStopResponse' => 'SetEnqueueServerStopResponse',
    'SetEnqueueServerDeletion' => 'SetEnqueueServerDeletion',
    'SetEnqueueServerDeletionResponse' => 'SetEnqueueServerDeletionResponse',
    'SetEnqueueServerReset' => 'SetEnqueueServerReset',
    'SetEnqueueServerResetResponse' => 'SetEnqueueServerResetResponse',
    'SetEnqueueServerRestart' => 'SetEnqueueServerRestart',
    'SetEnqueueServerRestartResponse' => 'SetEnqueueServerRestartResponse',
    'SetEnqueueServerPowerOff' => 'SetEnqueueServerPowerOff',
    'SetEnqueueServerPowerOffResponse' => 'SetEnqueueServerPowerOffResponse',
    'SetEnqueueServerArchiviation' => 'SetEnqueueServerArchiviation',
    'SetEnqueueServerArchiviationResponse' => 'SetEnqueueServerArchiviationResponse',
    'SetEnqueueServerRestore' => 'SetEnqueueServerRestore',
    'SetEnqueueServerRestoreResponse' => 'SetEnqueueServerRestoreResponse',
    'SetRenameServer' => 'SetRenameServer',
    'SetRenameServerResponse' => 'SetRenameServerResponse',
    'SetEnqueueMountDvdIso' => 'SetEnqueueMountDvdIso',
    'SetEnqueueMountDvdIsoResponse' => 'SetEnqueueMountDvdIsoResponse',
    'SetEnqueueUnmountDvdIso' => 'SetEnqueueUnmountDvdIso',
    'SetEnqueueUnmountDvdIsoResponse' => 'SetEnqueueUnmountDvdIsoResponse',
    'SetEnqueueVirtualDiskExport' => 'SetEnqueueVirtualDiskExport',
    'SetEnqueueVirtualDiskExportResponse' => 'SetEnqueueVirtualDiskExportResponse',
    'SetEnqueueVirtualDiskManage' => 'SetEnqueueVirtualDiskManage',
    'SetEnqueueVirtualDiskManageResponse' => 'SetEnqueueVirtualDiskManageResponse',
    'SetEnqueueServerSnapshot' => 'SetEnqueueServerSnapshot',
    'SetEnqueueServerSnapshotResponse' => 'SetEnqueueServerSnapshotResponse',
    'SetChangeNoteServer' => 'SetChangeNoteServer',
    'SetChangeNoteServerResponse' => 'SetChangeNoteServerResponse',
    'SetPurchaseIpAddress' => 'SetPurchaseIpAddress',
    'SetPurchaseIpAddressResponse' => 'SetPurchaseIpAddressResponse',
    'SetRemoveIpAddress' => 'SetRemoveIpAddress',
    'SetRemoveIpAddressResponse' => 'SetRemoveIpAddressResponse',
    'SetEnqueueAssociateIpAddress' => 'SetEnqueueAssociateIpAddress',
    'SetEnqueueAssociateIpAddressResponse' => 'SetEnqueueAssociateIpAddressResponse',
    'SetEnqueueDeassociateIpAddress' => 'SetEnqueueDeassociateIpAddress',
    'SetEnqueueDeassociateIpAddressResponse' => 'SetEnqueueDeassociateIpAddressResponse',
    'SetPurchaseVLan' => 'SetPurchaseVLan',
    'SetPurchaseVLanResponse' => 'SetPurchaseVLanResponse',
    'SetRemoveVLan' => 'SetRemoveVLan',
    'SetRemoveVLanResponse' => 'SetRemoveVLanResponse',
    'SetRenameVLan' => 'SetRenameVLan',
    'SetRenameVLanResponse' => 'SetRenameVLanResponse');

  /**
   * 
   * @param array $config A array of config values
   * @param string $wsdl The wsdl file to use
   * @access public
   */
  public function __construct(array $options = array(), $wsdl = 'wsEndUser14.wsdl')
  {
    foreach(self::$classmap as $key => $value)
    {
      if(!isset($options['classmap'][$key]))
      {
        $options['classmap'][$key] = $value;
      }
    }
    
    parent::__construct($wsdl, $options);
  }

  /**
   * 
   * @param SetEnqueueAssociateVLan $parameters
   * @access public
   */
  public function SetEnqueueAssociateVLan(SetEnqueueAssociateVLan $parameters)
  {
    return $this->__soapCall('SetEnqueueAssociateVLan', array($parameters));
  }

  /**
   * 
   * @param SetEnqueueDeassociateVLan $parameters
   * @access public
   */
  public function SetEnqueueDeassociateVLan(SetEnqueueDeassociateVLan $parameters)
  {
    return $this->__soapCall('SetEnqueueDeassociateVLan', array($parameters));
  }

  /**
   * 
   * @param SetEnqueueCreateFTPAccount $parameters
   * @access public
   */
  public function SetEnqueueCreateFTPAccount(SetEnqueueCreateFTPAccount $parameters)
  {
    return $this->__soapCall('SetEnqueueCreateFTPAccount', array($parameters));
  }

  /**
   * 
   * @param SetEnqueueResizeFTPAccount $parameters
   * @access public
   */
  public function SetEnqueueResizeFTPAccount(SetEnqueueResizeFTPAccount $parameters)
  {
    return $this->__soapCall('SetEnqueueResizeFTPAccount', array($parameters));
  }

  /**
   * 
   * @param GetVDCGraph $parameters
   * @access public
   */
  public function GetVDCGraph(GetVDCGraph $parameters)
  {
    return $this->__soapCall('GetVDCGraph', array($parameters));
  }

  /**
   * 
   * @param SetAddVDCGraph $parameters
   * @access public
   */
  public function SetAddVDCGraph(SetAddVDCGraph $parameters)
  {
    return $this->__soapCall('SetAddVDCGraph', array($parameters));
  }

  /**
   * 
   * @param SetUpdateVDCGraph $parameters
   * @access public
   */
  public function SetUpdateVDCGraph(SetUpdateVDCGraph $parameters)
  {
    return $this->__soapCall('SetUpdateVDCGraph', array($parameters));
  }

  /**
   * 
   * @param GetUserAuthenticationToken $parameters
   * @access public
   */
  public function GetUserAuthenticationToken(GetUserAuthenticationToken $parameters)
  {
    return $this->__soapCall('GetUserAuthenticationToken', array($parameters));
  }

  /**
   * 
   * @param GetCompanyByUrl $parameters
   * @access public
   */
  public function GetCompanyByUrl(GetCompanyByUrl $parameters)
  {
    return $this->__soapCall('GetCompanyByUrl', array($parameters));
  }

  /**
   * 
   * @param GetHypervisors $parameters
   * @access public
   */
  public function GetHypervisors(GetHypervisors $parameters)
  {
    $result = $this->__soapCall('GetHypervisors', array($parameters));
    return $result;
  }

  /**
   * 
   * @param GetVirtualDatacenter $parameters
   * @access public
   */
  public function GetVirtualDatacenter(GetVirtualDatacenter $parameters)
  {
    return $this->__soapCall('GetVirtualDatacenter', array($parameters));
  }

  /**
   * 
   * @param GetVirtualDatacenterCost $parameters
   * @access public
   */
  public function GetVirtualDatacenterCost(GetVirtualDatacenterCost $parameters)
  {
    return $this->__soapCall('GetVirtualDatacenterCost', array($parameters));
  }

  /**
   * 
   * @param GetServers $parameters
   * @access public
   */
  public function GetServers(GetServers $parameters)
  {
    return $this->__soapCall('GetServers', array($parameters));
  }

  /**
   * 
   * @param GetServerDetails $parameters
   * @access public
   */
  public function GetServerDetails(GetServerDetails $parameters)
  {
    return $this->__soapCall('GetServerDetails', array($parameters));
  }

  /**
   * 
   * @param GetCredit $parameters
   * @access public
   */
  public function GetCredit(GetCredit $parameters)
  {
    return $this->__soapCall('GetCredit', array($parameters));
  }

  /**
   * 
   * @param GetPriceList $parameters
   * @access public
   */
  public function GetPriceList(GetPriceList $parameters)
  {
    return $this->__soapCall('GetPriceList', array($parameters));
  }

  /**
   * 
   * @param GetPurchasedVLans $parameters
   * @access public
   */
  public function GetPurchasedVLans(GetPurchasedVLans $parameters)
  {
    return $this->__soapCall('GetPurchasedVLans', array($parameters));
  }

  /**
   * 
   * @param GetPurchasedIpAddresses $parameters
   * @access public
   */
  public function GetPurchasedIpAddresses(GetPurchasedIpAddresses $parameters)
  {
    return $this->__soapCall('GetPurchasedIpAddresses', array($parameters));
  }

  /**
   * 
   * @param GetJobs $parameters
   * @access public
   */
  public function GetJobs(GetJobs $parameters)
  {
    return $this->__soapCall('GetJobs', array($parameters));
  }

  /**
   * 
   * @param GetLogs $parameters
   * @access public
   */
  public function GetLogs(GetLogs $parameters)
  {
    return $this->__soapCall('GetLogs', array($parameters));
  }

  /**
   * 
   * @param GetDatacenterConfigurations $parameters
   * @access public
   */
  public function GetDatacenterConfigurations(GetDatacenterConfigurations $parameters)
  {
    return $this->__soapCall('GetDatacenterConfigurations', array($parameters));
  }

  /**
   * 
   * @param GetCustomVirtualDisks $parameters
   * @access public
   */
  public function GetCustomVirtualDisks(GetCustomVirtualDisks $parameters)
  {
    return $this->__soapCall('GetCustomVirtualDisks', array($parameters));
  }

  /**
   * 
   * @param GetIsos $parameters
   * @access public
   */
  public function GetIsos(GetIsos $parameters)
  {
    return $this->__soapCall('GetIsos', array($parameters));
  }

  /**
   * 
   * @param GetUserInfo $parameters
   * @access public
   */
  public function GetUserInfo(GetUserInfo $parameters)
  {
    return $this->__soapCall('GetUserInfo', array($parameters));
  }

  /**
   * 
   * @param GetPurchasedFTP $parameters
   * @access public
   */
  public function GetPurchasedFTP(GetPurchasedFTP $parameters)
  {
    return $this->__soapCall('GetPurchasedFTP', array($parameters));
  }

  /**
   * 
   * @param SetEnqueueServerCreation $parameters
   * @access public
   */
  public function SetEnqueueServerCreation(SetEnqueueServerCreation $parameters)
  {
    return $this->__soapCall('SetEnqueueServerCreation', array($parameters));
  }

  /**
   * 
   * @param SetEnqueueServerUpdate $parameters
   * @access public
   */
  public function SetEnqueueServerUpdate(SetEnqueueServerUpdate $parameters)
  {
    return $this->__soapCall('SetEnqueueServerUpdate', array($parameters));
  }

  /**
   * 
   * @param SetEnqueueServerStart $parameters
   * @access public
   */
  public function SetEnqueueServerStart(SetEnqueueServerStart $parameters)
  {
    return $this->__soapCall('SetEnqueueServerStart', array($parameters));
  }

  /**
   * 
   * @param SetEnqueueServerStop $parameters
   * @access public
   */
  public function SetEnqueueServerStop(SetEnqueueServerStop $parameters)
  {
    return $this->__soapCall('SetEnqueueServerStop', array($parameters));
  }

  /**
   * 
   * @param SetEnqueueServerDeletion $parameters
   * @access public
   */
  public function SetEnqueueServerDeletion(SetEnqueueServerDeletion $parameters)
  {
    return $this->__soapCall('SetEnqueueServerDeletion', array($parameters));
  }

  /**
   * 
   * @param SetEnqueueServerReset $parameters
   * @access public
   */
  public function SetEnqueueServerReset(SetEnqueueServerReset $parameters)
  {
    return $this->__soapCall('SetEnqueueServerReset', array($parameters));
  }

  /**
   * 
   * @param SetEnqueueServerRestart $parameters
   * @access public
   */
  public function SetEnqueueServerRestart(SetEnqueueServerRestart $parameters)
  {
    return $this->__soapCall('SetEnqueueServerRestart', array($parameters));
  }

  /**
   * 
   * @param SetEnqueueServerPowerOff $parameters
   * @access public
   */
  public function SetEnqueueServerPowerOff(SetEnqueueServerPowerOff $parameters)
  {
    return $this->__soapCall('SetEnqueueServerPowerOff', array($parameters));
  }

  /**
   * 
   * @param SetEnqueueServerArchiviation $parameters
   * @access public
   */
  public function SetEnqueueServerArchiviation(SetEnqueueServerArchiviation $parameters)
  {
    return $this->__soapCall('SetEnqueueServerArchiviation', array($parameters));
  }

  /**
   * 
   * @param SetEnqueueServerRestore $parameters
   * @access public
   */
  public function SetEnqueueServerRestore(SetEnqueueServerRestore $parameters)
  {
    return $this->__soapCall('SetEnqueueServerRestore', array($parameters));
  }

  /**
   * 
   * @param SetRenameServer $parameters
   * @access public
   */
  public function SetRenameServer(SetRenameServer $parameters)
  {
    return $this->__soapCall('SetRenameServer', array($parameters));
  }

  /**
   * 
   * @param SetEnqueueMountDvdIso $parameters
   * @access public
   */
  public function SetEnqueueMountDvdIso(SetEnqueueMountDvdIso $parameters)
  {
    return $this->__soapCall('SetEnqueueMountDvdIso', array($parameters));
  }

  /**
   * 
   * @param SetEnqueueUnmountDvdIso $parameters
   * @access public
   */
  public function SetEnqueueUnmountDvdIso(SetEnqueueUnmountDvdIso $parameters)
  {
    return $this->__soapCall('SetEnqueueUnmountDvdIso', array($parameters));
  }

  /**
   * 
   * @param SetEnqueueVirtualDiskExport $parameters
   * @access public
   */
  public function SetEnqueueVirtualDiskExport(SetEnqueueVirtualDiskExport $parameters)
  {
    return $this->__soapCall('SetEnqueueVirtualDiskExport', array($parameters));
  }

  /**
   * 
   * @param SetEnqueueVirtualDiskManage $parameters
   * @access public
   */
  public function SetEnqueueVirtualDiskManage(SetEnqueueVirtualDiskManage $parameters)
  {
    return $this->__soapCall('SetEnqueueVirtualDiskManage', array($parameters));
  }

  /**
   * 
   * @param SetEnqueueServerSnapshot $parameters
   * @access public
   */
  public function SetEnqueueServerSnapshot(SetEnqueueServerSnapshot $parameters)
  {
    return $this->__soapCall('SetEnqueueServerSnapshot', array($parameters));
  }

  /**
   * 
   * @param SetChangeNoteServer $parameters
   * @access public
   */
  public function SetChangeNoteServer(SetChangeNoteServer $parameters)
  {
    return $this->__soapCall('SetChangeNoteServer', array($parameters));
  }

  /**
   * 
   * @param SetPurchaseIpAddress $parameters
   * @access public
   */
  public function SetPurchaseIpAddress(SetPurchaseIpAddress $parameters)
  {
    return $this->__soapCall('SetPurchaseIpAddress', array($parameters));
  }

  /**
   * 
   * @param SetRemoveIpAddress $parameters
   * @access public
   */
  public function SetRemoveIpAddress(SetRemoveIpAddress $parameters)
  {
    return $this->__soapCall('SetRemoveIpAddress', array($parameters));
  }

  /**
   * 
   * @param SetEnqueueAssociateIpAddress $parameters
   * @access public
   */
  public function SetEnqueueAssociateIpAddress(SetEnqueueAssociateIpAddress $parameters)
  {
    return $this->__soapCall('SetEnqueueAssociateIpAddress', array($parameters));
  }

  /**
   * 
   * @param SetEnqueueDeassociateIpAddress $parameters
   * @access public
   */
  public function SetEnqueueDeassociateIpAddress(SetEnqueueDeassociateIpAddress $parameters)
  {
    return $this->__soapCall('SetEnqueueDeassociateIpAddress', array($parameters));
  }

  /**
   * 
   * @param SetPurchaseVLan $parameters
   * @access public
   */
  public function SetPurchaseVLan(SetPurchaseVLan $parameters)
  {
    return $this->__soapCall('SetPurchaseVLan', array($parameters));
  }

  /**
   * 
   * @param SetRemoveVLan $parameters
   * @access public
   */
  public function SetRemoveVLan(SetRemoveVLan $parameters)
  {
    return $this->__soapCall('SetRemoveVLan', array($parameters));
  }

  /**
   * 
   * @param SetRenameVLan $parameters
   * @access public
   */
  public function SetRenameVLan(SetRenameVLan $parameters)
  {
    return $this->__soapCall('SetRenameVLan', array($parameters));
  }

}
?>