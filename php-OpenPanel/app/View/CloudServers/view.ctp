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

<div class="CloudServers view">

<?php 
if ($this->Form->isFieldError('CloudServer.Name')) {
    echo $this->Form->error('CloudServer.Name');
}
if ($this->Form->isFieldError('CloudServer.Cpus')) {
    echo $this->Form->error('CloudServer.Cpus');
}
if ($this->Form->isFieldError('CloudServer.Rams')) {
    echo $this->Form->error('CloudServer.Rams');
}
if ($this->Form->isFieldError('CloudServer.DiskSize0')) {
    echo $this->Form->error('CloudServer.DiskSize0');
}
if ($this->Form->isFieldError('CloudServer.DiskSize1')) {
    echo $this->Form->error('CloudServer.DiskSize1');
}
if ($this->Form->isFieldError('CloudServer.DiskSize2')) {
    echo $this->Form->error('CloudServer.DiskSize2');
}
if ($this->Form->isFieldError('CloudServer.DiskSize3')) {
    echo $this->Form->error('CloudServer.DiskSize3');
}
?>
<form id='cloudServersForm' method='POST' action=''>		
	<h2><?php  echo __('Manage Cloud Server');?></h2>
	<div>
		<?php echo $this->Html->link(__('Refresh'), array('controller' => 'cloudServers','action' => 'view',$CloudServer->AppServerDetail->ServerId),array('id'=>'refreshBtn')); ?>
	</div>
	<script type="text/javascript">
			$('#refreshBtn').button({text:true, icons:{primary:'ui-icon-refresh'}});
	</script>
		
		<table  border="0" cellpadding="2" cellspacing="0">
		<tr >
			<td nowrap="nowrap" ><b><?php echo __('Cloud Server Name'); ?>:</b></td>			
			<td>
				<span id="serverNameLbl"><?php echo h($CloudServer->AppServerDetail->Name); ?></span>				
			</td>
			<td nowrap="nowrap">				
				<?php include 'editName.ctp';?>
			</td>
			<td width="20%">&nbsp;</td>
			<td nowrap="nowrap"><b><?php echo __('Cloud Server State'); ?>:</b></td>
			<td class="server-status-<?php echo $CloudServer->AppServerDetail->getServerStatus();?>">
				<?php echo __($CloudServer->AppServerDetail->getServerStatus()); ?>
				<?php if ($CloudServer->AppServerDetail->isUpdating()) echo  $this->Html->image('rounder.gif', array('title' => 'Updating', 'alt' => 'Updating', 'border' => '0')) ?>								
			</td>
			<td>
				<?php if($CloudServer->AppServerDetail->isRunning()){?>
					<button type="button" id='poweroffBtn'><?php echo __('Shutdown')?></button>
				<?php }?>
				<?php if($CloudServer->AppServerDetail->isStopped()){?>
					<button id='startBtn'><?php echo __('Start')?></button>
					<button id='archiveBtn'><?php echo __('Archive')?></button>
				<?php }?>
				<?php if($CloudServer->AppServerDetail->isArchived()){?>
					<button id='restoreBtn'><?php echo __('Restore')?></button>
				<?php }?>			
			</td>
		</tr>		
		</table>
		<script type="text/javascript">			
			$('#poweroffBtn').button({text:true, icons:{primary:'ui-icon-power'}});
			$('#startBtn').button({text:true, icons:{primary:'ui-icon-power'}});			
			$('#archiveBtn').button({text:true, icons:{primary:'ui-icon-arrowreturnthick-1-s'}});
			$('#restoreBtn').button({text:true, icons:{primary:'ui-icon-arrowreturnthick-1-n'}});
			<?php if($CloudServer->AppServerDetail->isUpdating()){?>
				$('#poweroffBtn').button('disable');
				$('#startBtn').button('disable');
				$('#changeNameBtn').button('disable');				
			<?php }else{?>
			$("#startBtn").click(function(){
		    	postForm('cloudServersForm','startBtn','<?php echo $this->Html->url(array('controller' => 'cloudServers', 'action' => 'start/'.$CloudServer->AppServerDetail->ServerId))?>',null, true);
		    	});	
			$("#poweroffBtn").click(function(){
				$('#srvStopDlg').dialog('open');
				});				
			$("#archiveBtn").click(function(){
				postForm('cloudServersForm','archiveBtn','<?php echo $this->Html->url(array('controller' => 'cloudServers', 'action' => 'archive/'.$CloudServer->AppServerDetail->ServerId))?>',null, true);
		    	});
			$("#restoreBtn").click(function(){				
				postForm('cloudServersForm','restoreBtn','<?php echo $this->Html->url(array('controller' => 'cloudServers', 'action' => 'restore/'.$CloudServer->AppServerDetail->ServerId))?>',null, true);					
				});	
			<?php } ?>
		</script>
		
		<table  border="0" cellpadding="2" cellspacing="0">
		<tr>
			<td nowrap="nowrap" ><?php echo __('Hypervisor'); ?>:</td>			
			<td colspan="2"><b><?php echo h($CloudServer->AppServerDetail->getHypervisorType()); ?></b></td>			
			<td>&nbsp;</td>
			<td nowrap="nowrap" ><?php echo __('HD0 Size'); ?>:</td>			
			
			<?php $diskNum=0; include('editDisk.ctp'); ?>			
		</tr>
		<tr>
			<td nowrap="nowrap" ><?php echo __('S/O template'); ?>:</td>			
			<td colspan="2"><b><?php echo h($CloudServer->AppServerDetail->OSTemplate->Description); ?></b></td>
			<td>&nbsp;</td>
			<td nowrap="nowrap" ><?php echo __('HD1 Size'); ?>:</td>			
			
			<?php $diskNum=1; include('editDisk.ctp'); ?>							
					
		</tr>
		<tr>
			<td nowrap="nowrap" ><?php echo __('Virtual CPUs'); ?>:</td>			
			<td nowrap="nowrap">
				<b><?php echo $CloudServer->AppServerDetail->CPUQuantity->Quantity ?></b>								
			</td>
			<td >
				<?php include('editCPUs.ctp'); ?>
			</td>
			<td >&nbsp;</td>
			<td nowrap="nowrap" ><?php echo __('HD2 Size'); ?>:</td>			
			
			<?php $diskNum=2; include('editDisk.ctp'); ?>
					
		</tr>		
		<tr>
			<td nowrap="nowrap" ><?php echo __('RAM'); ?>:</td>			
			<td>
				<b><?php echo $CloudServer->AppServerDetail->RAMQuantity->Quantity ?>&nbsp;GB</b>								
			</td>
			<td>
				<?php include('editRAMs.ctp'); ?>
			</td>
			<td>&nbsp;</td>
			<td nowrap="nowrap" ><?php echo __('HD3 Size'); ?>:</td>			
			
			<?php $diskNum=3; include('editDisk.ctp'); ?>					
		</tr>
		</table>		
	</form>		
		
	<?php include("editNetworks.ctp")?>
		
</div>

<?php if($CloudServer->AppServerDetail->isUpdating()){?>
<script type="text/javascript">	
	$(':button').button('disable');				
</script>				
<?php }?>				
	
<?php include("menu.ctp")?>
<?php include("serverStop.ctp")?>
