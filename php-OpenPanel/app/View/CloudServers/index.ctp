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

<div class="cloudServers index">
<h2><?php echo __('Cloud Server List');?></h2>		
	<form id='cloudServersForm' method='POST' action=''>
	<div style="width:100%" align="right">		
		<button type='button' id="addServerBtn"><?php echo __('New Cloud Server');?></button>
					<script type="text/javascript">
						$("#addServerBtn").button({
					            icons: {
					                primary: "ui-icon-circle-plus"
					            }
					            /*,disabled:true */						            					            
					    });					    
					    $("#addServerBtn").click(function(){postForm('cloudServersForm','addServerBtn','<?php echo $this->Html->url(array('controller' => 'newCloudServers', 'action' => 'view'))?>',null,false)});					    			    							    						    					  
					</script>
	</div>	
	<div id="server-list">
		
		<table cellpadding="0" cellspacing="0" width="100%">
		<tr>
			<th><?php echo __('Name');?></th>
			<th><?php echo __('Status');?></th>
			<th><?php echo __('Template');?></th>
			<th><?php echo __('Hypervisor');?></th>
			<th><?php echo __('CPU (core)');?></th>
			<th><?php echo __('RAM (GB)');?></th>
			<th><?php echo __('Disk space (GB)');?></th>			
			<th class="actions"><?php echo __('Actions');?></th>
		</tr>		
		<?php foreach ($CloudServers as $appServer):?>
		<tr>
			<td><?php echo h($appServer->Name); ?>&nbsp;<?php if ($appServer->isUpdating()) echo  $this->Html->image('rounder.gif', array('title' => 'Updating', 'alt' => 'Updating', 'border' => '0')) ?></td>
			<td class="server-status-<?php echo $appServer->getServerStatus();?>"><?php echo __($appServer->getServerStatus()); ?>&nbsp;</td>
			<td><?php echo h($appServer->getOSTemplateDescription()); ?>&nbsp;</td>
			<td><?php echo h($appServer->getHypervisorType()); ?>&nbsp;</td>
			<td><?php echo h($appServer->CPUQuantity->Quantity); ?>&nbsp;</td>
			<td><?php echo h($appServer->RAMQuantity->Quantity); ?>&nbsp;</td>
			<td><?php echo h($appServer->getTotalDiskSize()); ?>&nbsp;</td>
			<td>				
					<button type='button' id="<?php echo 'manage_'.$appServer->ServerId ?>"><?php echo __('Manage');?></button>
					<script type="text/javascript">
						$("#<?php echo 'manage_'.$appServer->ServerId ?>").button({
					            icons: {
					                primary: "ui-icon-wrench"
					            }					            
					    });					    
					    $("#<?php echo 'manage_'.$appServer->ServerId ?>").click(function(){
					    	postForm('cloudServersForm','<?php echo 'manage_'.$appServer->ServerId ?>','<?php echo $this->Html->url(array('controller' => 'cloudServers', 'action' => 'view/'.$appServer->ServerId))?>',null, false);
					    	});					    											    						    							    						    					
					</script>									
				</td>
		</tr>
		<?php endforeach; ?>		
		</table>
	</div>
	</form>				
</div>

<?php include("menu.ctp")?>