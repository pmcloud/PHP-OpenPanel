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

<div class="iPAddresses index">
	<h2><?php echo __('IP Addresses');?></h2>
	
	<form id='ipFrom' method='POST' action=''>
	<div style="width:100%" align="right">		
		<button type='button' id="addIpBtn"><?php echo __('New IP Address');?></button>
					<script type="text/javascript">
						$("#addIpBtn").button({
					            icons: {
					                primary: "ui-icon-circle-plus"
					            }					            					            
					    });					    
					    $("#addIpBtn").click(function(){postForm('ipFrom','addIpBtn','<?php echo $this->Form->url('add')?>','<?php echo __('Are you sure you want to add a new IP Address?') ?>',true)});					    							    						    					   
					</script>
	</div>
		<table cellpadding="0" cellspacing="0" border="0">
		
		<tr>
				<th><?php echo __('IP Address');?></th>
				<th><?php echo __('Assigned');?></th>
				<th><?php echo __('Cloud Server');?></th>			
				<th class="actions"><?php echo __('Actions');?></th>
		</tr>
		<?php
		foreach ($publicIps as $iPAddress): $rowId='linkid'.$iPAddress->ResourceId ;?>
			<tr>
				<td><?php echo h($iPAddress->Value); ?>&nbsp;</td>
				<td><?php if($iPAddress->isAssigned()){ $isAssigned=true; echo __('Yes');}else{$isAssigned=false; echo __('No');}; ?>&nbsp;</td>
				<td><?php echo h($iPAddress->ServerName); ?>&nbsp;</td>		
				<td>
				
					<button type='button' id="<?php echo $rowId.'btn1'?>"><?php echo __('Delete');?></button>
					<script type="text/javascript">
						$("#<?php echo $rowId.'btn1' ?>").button({
					            icons: {
					                primary: "ui-icon-trash"
					            }
					            <?php if($isAssigned){ ?>
					    			,disabled:true					    							    						    
					    		<?php } ?>
					            
					    });
					    <?php if(!$isAssigned){ ?>
					    	$("#<?php echo $rowId.'btn1' ?>").click(function(){postForm('ipFrom','<?php echo $rowId.'btn1' ?>','<?php echo $this->Form->url('delete/'.$iPAddress->ResourceId)?>','<?php echo __('Are you sure you want to delete  %s?', $iPAddress->Value) ?>',true)});					    							    						    
					    <?php } ?>
					</script>									
				</td>
			</tr>
		<?php endforeach; ?>
		</table>
	</form>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>

	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="ui-widget-content ui-widget-header ui-corner-all uiactions">	
		<span>&nbsp;</span>
		<?php 
			$selectedLink='ui-accordion-header ui-helper-reset ui-state-active ui-corner-top';
			$otherLink='ui-accordion-header ui-helper-reset ui-state-default ui-corner-all';
			$legend='ui-accordion-content ui-helper-reset ui-widget-content ui-corner-bottom ui-accordion-content-active';
		 ?>
		<div id="accordion" class="ui-accordion ui-widget ui-helper-reset ui-accordion-icons">
			<h3 class="<?php echo $otherLink?>">
				<span class="ui-icon ui-icon-triangle-1-e"></span>
				<?php echo $this->Html->link(__('Dashboard'), array('controller' => 'dashboards','action' => 'index')); ?>
			</h3>			
			<h3 class="<?php echo $otherLink?>">
				<span class="ui-icon ui-icon-triangle-1-e"></span>
				<?php echo $this->Html->link(__('Cloud Server'), array('controller' => 'cloudServers','action' => 'index')); ?></h3>			
			<h3 class="<?php echo $otherLink?>">
				<span class="ui-icon ui-icon-triangle-1-e"></span>
				<?php echo $this->Html->link(__('Virtual Swich'), array('controller' => 'virtualSwitches', 'action' => 'index')); ?></h3>			
			<h3 class="<?php echo $selectedLink?>">
				<span class="ui-icon ui-icon-triangle-1-s"></span>
				<?php echo $this->Html->link(__('Public IP'), array('controller' => 'publicIps','action' => 'index')); ?>
			</h3>
			<div class="<?php echo $legend ?>">
				<span style="font-size:0.8em;"><?php echo __('Public IP legend')?></span>
			</div>
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
