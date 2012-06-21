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

<div class="dashboards index">	
	<h2><?php echo __('Dashboard');?></h2>
	<form id='dashboardForm' method='POST' action=''>
	<div id="available-credit" style="text-align: right;">
		<span class="ui-button ui-widget ui-state-default ui-corner-all ui-button-text-icon-primary ui-state-focus">
		&nbsp;<?php echo __('Available Credit'); ?>:&nbsp;&nbsp;<font size="12">&euro; <?php echo $dashboard->getCredit()->toString(); ?></font>&nbsp;
		</span>		
	</div>
	<div id="notifications">
	<?php if (false) { ?>
		<h2>TODO !!</h2>
	<?php } ?>
	</div>

	<div id="server-list">
		<h2><?php echo __('Cloud Server List');?></h2>
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
		<?php foreach ($dashboard->getServers() as $appServer):?>
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
					    	postForm('dashboardForm','<?php echo 'manage_'.$appServer->ServerId ?>','<?php echo $this->Html->url(array('controller' => 'cloudServers', 'action' => 'view/'.$appServer->ServerId))?>',null, false);
					    	});					    											    						    							    						    					
					</script>									
				</td>
		</tr>
		<?php endforeach; ?>		
		</table>
	</div>		
	<div id="log-list">
		<br/>
		<h2><?php echo __('Log List');?></h2>
		<?php if (sizeof($pagingList) > 0) { ?>
		<table cellpadding="0" cellspacing="0" width="100%">
		<tr>
			<th><?php echo __('Command');?></th>
			<th><?php echo __('Status');?></th>
			<th><?php echo __('Context');?></th>
			<th><?php echo __('User');?></th>
			<th><?php echo __('Begin Date');?></th>
			<th><?php echo __('End Date');?></th>
		</tr>		
		<?php foreach ($pagingList as $appLog) : ?>
		<tr>
			<td><?php echo h($appLog->OperationName); ?>&nbsp;</td>
			<td class="log-status-<?php echo $appLog->getStatus();?>"><?php echo h($appLog->getStatus()); ?>&nbsp;</td>
			<td><?php echo h($appLog->getTargetResource()); ?>&nbsp;</td>
			<td><?php echo h($appLog->Username); ?>&nbsp;</td>
			<td><?php echo h($appLog->getStartDatetime()); ?>&nbsp;</td>
			<td><?php echo h($appLog->getLastUpdateDatetime()); ?>&nbsp;</td>
		</tr>
		<?php endforeach; ?>		
		</table>
		<?php } ?>	
	</div>
	<div>
	<?php
		$this->Paginator->options(array('model'=>'LogModel'));				
		echo $this->Paginator->counter(array('format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')));		
	?>			
	</div>
	<div class="paging">
	<?php		
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));		
	?>
	</div>
	</form>			
</div>
<div class="ui-widget-content ui-widget-header ui-corner-all uiactions">
		<span>&nbsp;</span>
		<?php 
			$selectedLink='ui-accordion-header ui-helper-reset ui-state-active ui-corner-top';
			$otherLink='ui-accordion-header ui-helper-reset ui-state-default ui-corner-all';
			$legend='ui-accordion-content ui-helper-reset ui-widget-content ui-corner-bottom ui-accordion-content-active';
		 ?>
		<div id="accordion" class="ui-accordion ui-widget ui-helper-reset ui-accordion-icons">
			<h3 class="<?php echo $selectedLink?>">
				<span class="ui-icon ui-icon-triangle-1-s"></span>
				<?php echo $this->Html->link(__('Dashboard'), array('controller' => 'dashboards','action' => 'index')); ?>
			</h3>
			<div class="<?php echo $legend ?>">
				<span style="font-size:0.8em;"><?php echo __('Dashboard legend')?></span>
			</div>			
			<h3 class="<?php echo $otherLink?>">
				<span class="ui-icon ui-icon-triangle-1-e"></span>
				<?php echo $this->Html->link(__('Cloud Server'), array('controller' => 'cloudServers','action' => 'index')); ?></h3>			
			<h3 class="<?php echo $otherLink?>">
				<span class="ui-icon ui-icon-triangle-1-e"></span>
				<?php echo $this->Html->link(__('Virtual Swich'), array('controller' => 'virtualSwitches', 'action' => 'index')); ?></h3>			
			<h3 class="<?php echo $otherLink?>">
				<span class="ui-icon ui-icon-triangle-1-e"></span>
				<?php echo $this->Html->link(__('Public IP'), array('controller' => 'publicIps','action' => 'index')); ?>
			</h3>			
			<h3 class="<?php echo $otherLink?>">
				<span class="ui-icon ui-icon-triangle-1-e"></span>
				<?php echo $this->Html->link(__('Logs and Jobs'), array('controller' => 'logAndJobs','action' => 'index')); ?>
			</h3>
			<?php /*
			<h3 class="<?php echo $otherLink?>">
				<span class="ui-icon ui-icon-triangle-1-e"></span>
				<?php echo $this->Html->link(__('Logout'), array('controller' => 'logins','action' => 'logout')); ?>
			</h3>
			*/?>
		</div>
		<span>&nbsp;</span>				
</div>