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
?>

			<br>
			<table cellpadding="0" cellspacing="0" width="100%">
			<tr>
				<th colspan="4"><?php echo __('Network Adapters');?></th>				
			</tr>
			<?php
				$num =1;				
				foreach ($CloudServer->AppServerDetail->getNetworkAdapters() as $NetworkAdapter){?>			
			<tr>
				<td nowrap="nowrap"><?php echo __('ETHERNET 0'.$num); ?></td>
				<td>
					<?php if($NetworkAdapter->isConnected()){?>
						<span style="color:green;"><?php echo __('CONNECTED');?></span>
					<?php }else{?>
						<span style="color:gray;"><?php echo __('DISCONNECTED');?></span>
					<?php }?>					
				</td>
				<td><?php if($NetworkAdapter->isConnected()){?>
						<?php if($NetworkAdapter->isAssociatedToPublicIPs()){?>
							<?php foreach ($NetworkAdapter->getIpAddresses() as $IpAddress){ echo '['.$IpAddress->Value.'] ';}?>							
						
						<?php }else{?>
							<?php echo $NetworkAdapter->getVlanName()?>
						<?php }?>
						
					<?php }else{?>
						---
					<?php }?>
				</td>
				<td nowrap="nowrap">
					<?php if($num==1){?>
						<?php if(!$NetworkAdapter->isConnected()){?>
							<button type="button" id="addIpBtn"><?php echo __('Add IPs')?></button>
						<?php } else if($NetworkAdapter->isAssociatedToPublicIPs()){?>
								<button type="button" id="addIpBtn"><?php echo __('Add IPs')?></button>					
								<button type="button" id="delIpBtn"><?php echo __('Remove IPs')?></button>	
						<?php }?>
						<script type="text/javascript">
							
							$('#addIpBtn').button({
							        icons: {
						             primary: "ui-icon-circle-plus"
						        }
							});

							$('#addIpBtn').click(function(){
								$('#ipAddNetAdpId').attr('value',<?php echo $NetworkAdapter->getId() ?>);
								$('#addIpDlg').dialog('open');
								}); 
							$('#delIpBtn').button({
						        	icons: {
					             		primary: "ui-icon-circle-minus"
					        		}							
							});
							$('#delIpBtn').click(function(){
								$('#ipDelNetAdpId').attr('value',<?php echo $NetworkAdapter->getId() ?>);
								$('#delIpDlg').dialog('open');
							}); 
						</script>									
					<?php }?>
													
					<?php if(!$NetworkAdapter->isConnected()){?>
						<button type="button" id="addVlan<?php echo $num?>Btn"><?php echo __('Connect Virtual Switch')?></button>
						<script type="text/javascript">
							$('#addVlan<?php echo $num?>Btn').button({
							        icons: {
						             primary: "ui-icon-circle-plus"
						        }
							});
							$('#addVlan<?php echo $num?>Btn').click(function(){
								$('#vlanNetAdpId').attr('value',<?php echo $NetworkAdapter->getId() ?>);
								$('#addVlanDlg').dialog('open');
							});
						</script>
					<?php } else if($NetworkAdapter->isAssociatedToVirtualSwitch()){?>
						<button  type="button" id="delVlan<?php echo $num?>Btn"><?php echo __('Disconnect')?></button>
						<script type="text/javascript">
							$('#delVlan<?php echo $num?>Btn').button({
							        icons: {
						             primary: "ui-icon-circle-minus"
						        }
							});
							$('#delVlan<?php echo $num?>Btn').click(function(){
								$('#delVlanForm_vlanNetAdpId').attr('value',<?php echo $NetworkAdapter->getId() ?>);
								$('#delVlanForm_vlanResourceId').attr('value',<?php echo $NetworkAdapter->getVlan()->ResourceId ?>);
								postForm('delVlanForm','delVlan<?php echo $num?>Btn',null,'<?php echo __('Proceed to disconnect %s?',$NetworkAdapter->getVlanName()); ?>', true);
							});
						</script>
					<?php }?>
				</td>
			</tr>
			<?php $num++;}?>
			</table>
							
	


	<?php echo $this->Form->create(null,array('action' => 'disconnectVirtualSwitch','id'=>'delVlanForm'));?>	
					<input type="hidden" id="delVlanForm_vlanNetAdpId" name="vlanNetAdpId" value=""/>
					<input type="hidden" id="delVlanForm_vlanResourceId" name="VlanResourceId" value=""/>
					<input type="hidden" id="delVlanForm_vlanEthId_ServerId" name="serverId" value="<?php echo $CloudServer->AppServerDetail->ServerId?>"/>
	<?php echo $this->Form->end();?>	
	
	<div id="addVlanDlg"  title="<?php echo __('Connect Virtual Switch'); ?>" class="form">
	<?php echo $this->Form->create( null,array('action' => 'connectVirtualSwitch','id'=>'addVlanForm'));?>
		<fieldset>			
			<?php
				$options = array();
				foreach ($CloudServer->AvailableVirtualSwitches as $vs){
					$options[$vs->ResourceId]=$vs->Name;
				}
				echo $this->Form->select('VlanResourceId',$options,array('empty' => false,'label'=>__('Virtual Switch to connect')));			
			?>
			<div align='right'><button type='button' id='addVlanOkBtn'><?php echo __('OK')?></button><button type='button' id='addVlanKoBtn'><?php echo __('Cancel')?></button></div>
		</fieldset>
		<input type="hidden" id="vlanNetAdpId" name="vlanNetAdpId" value=""/>
		<input type="hidden" id="vlanEthId_ServerId" name="serverId" value="<?php echo $CloudServer->AppServerDetail->ServerId?>"/>
	<?php echo $this->Form->end();?>
	</div>

	<script type="text/javascript">
		$('#addVlanDlg').dialog({ autoOpen:false, modal:true, resizable:false });
		$('#addVlanOkBtn').button({
		        icons: {
		             primary: "ui-icon-circle-check"
		        }
		});
		$('#addVlanKoBtn').button({
		        icons: {
		             primary: "ui-icon-circle-close"
		        }
		});
		$('#addVlanOkBtn').click(function(){
			postForm('addVlanForm','addVlanOkBtn',null,null, true);
		});
		
		$('#addVlanKoBtn').click(function(){$('#addVlanDlg').dialog('close')});
		<?php if(isset($showAddVlanDlg) && $showAddVlanDlg){?>
			$('#addVlanDlg').dialog('open');
		<?php }?>
	</script>
	
	<div id="addIpDlg"  title="<?php echo __('Connect Public IPs'); ?>" class="form">
	<?php echo $this->Form->create( null,array('action' => 'connectIps','id'=>'addIpsForm'));?>
		<fieldset>
			<?php if(isset($addIpDlg_message)){?>			
				<div id="addIpDlg_message" class="error"><?php echo $addIpDlg_message ?></div>
			<?php }?>
			<div><?php echo __('Select IPs that you want to add')?></div>
			<table cellpadding="0" cellspacing="0" width="100%">
			<tr>
				<th></th>
				<th><?php echo __('Public IP');?></th>
				<th><?php echo __('Subnet Mask');?></th>
				<th><?php echo __('Gateway');?></th>				
			</tr>
			<?php
				
				foreach ($CloudServer->AvailableIps as $ip){ ?>
					<tr>
						<td>							
							<?php echo $this->Form->checkbox('ipResourceId_'.($ip->ResourceId),array('value'=>$ip->ResourceId));?>
						</td>
						<td><?php echo $ip->Value; ?></td>
						<td><?php echo $ip->SubNetMask; ?></td>
						<td><?php echo $ip->Gateway; ?></td>
					</tr>
			<?php }?>
			</table>
			
			<div align='right'><button type='button' id='addIpOkBtn'><?php echo __('OK')?></button><button type='button' id='addIpKoBtn'><?php echo __('Cancel')?></button></div>
		</fieldset>
		<input type="hidden" id="ipAddNetAdpId" name="ipNetAdpId" value=""/>
		<input type="hidden" name="serverId" value="<?php echo $CloudServer->AppServerDetail->ServerId?>"/>
	<?php echo $this->Form->end();?>
	</div>

	<script type="text/javascript">
		$('#addIpDlg').dialog({width:450, autoOpen:false, modal:true, resizable:false });
		$('#addIpOkBtn').button({
		        icons: {
		             primary: "ui-icon-circle-check"
		        }
		});
		$('#addIpKoBtn').button({
		        icons: {
		             primary: "ui-icon-circle-close"
		        }
		});
		$('#addIpOkBtn').click(function(){
			postForm('addIpsForm','addIpOkBtn',null,null, true);
		});
		
		$('#addIpKoBtn').click(function(){$('#addIpDlg').dialog('close');});
		<?php if(isset($showAddIpDlg) && $showAddIpDlg){?>
			$('#addIpDlg').dialog('open');
		<?php }?>
	</script>
	
	
	
	<div id="delIpDlg"  title="<?php echo __('Disconnect Public IPs'); ?>" class="form">
	<?php echo $this->Form->create( null,array('action' => 'disconnectIps','id'=>'delIpsForm'));?>
		<fieldset>
			<?php if(isset($delIpDlg_message)){?>			
				<div id="delIpDlg_message" class="error"><?php echo $delIpDlg_message ?></div>
			<?php }?>
			<div><?php echo __('Select the IPs that you want to disconnect')?></div>
			<table cellpadding="0" cellspacing="0" width="100%">
			<tr>
				<th></th>
				<th><?php echo __('Public IP');?></th>
				<th><?php echo __('Subnet Mask');?></th>
				<th><?php echo __('Gateway');?></th>				
			</tr>
			<?php
				$netIp = $CloudServer->AppServerDetail->getNetworkAdapters();
				if($netIp[0]->isAssociatedToPublicIPs()){
				foreach ($netIp[0]->getIpAddresses() as $ip){ ?>
					<tr>
						<td>							
							<?php echo $this->Form->checkbox('ipResourceId_'.($ip->ResourceId),array('value'=>$ip->ResourceId));?>
						</td>
						<td><?php echo $ip->Value; ?></td>
						<td><?php echo $ip->SubNetMask; ?></td>
						<td><?php echo $ip->Gateway; ?></td>
					</tr>
			<?php }}?>
			</table>
			
			<div align='right'><button type='button' id='delIpOkBtn'><?php echo __('OK')?></button><button type='button' id='delIpKoBtn'><?php echo __('Cancel')?></button></div>
		</fieldset>
		<input type="hidden" id="ipDelNetAdpId" name="ipNetAdpId" value=""/>
		<input type="hidden" name="serverId" value="<?php echo $CloudServer->AppServerDetail->ServerId?>"/>
	<?php echo $this->Form->end();?>
	</div>

	<script type="text/javascript">
		$('#delIpDlg').dialog({width:450, autoOpen:false, modal:true, resizable:false });
		$('#delIpOkBtn').button({
		        icons: {
		             primary: "ui-icon-circle-check"
		        }
		});
		$('#delIpKoBtn').button({
		        icons: {
		             primary: "ui-icon-circle-close"
		        }
		});
		$('#delIpOkBtn').click(function(){
			postForm('delIpsForm','delIpOkBtn',null,null, true);
		});
		
		$('#delIpKoBtn').click(function(){$('#delIpDlg').dialog('close');});
		<?php if(isset($showDelIpDlg) && $showDelIpDlg){?>
			$('#delIpDlg').dialog('open');
		<?php }?>

		<?php
			$sState = $CloudServer->AppServerDetail->getServerStatus();  
			if (AppServerStatus::isSameValue(AppServerStatus::ARCHIVED, $sState)) {
		?>		
				$('#addIpBtn').button('disable');
				$('#delIpBtn').button('disable');
				
		<?php
			for ($tmp=1;$tmp<4;$tmp++){
			?>
				$('#addVlan<?php echo $tmp?>Btn').button('disable');
				$('#delVlan<?php echo $tmp?>Btn').button('disable');
			<?php 
				}
			}
		?>
	</script>