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

<div class="virtualSwitches index">
	<h2><?php echo __('Virtual Switches');?></h2>
	
	<form id='vsFrom' method='POST' action=''>
	<div style="width:100%" align="right">		
		<button type='button' id="addVsBtn"><?php echo __('New Virtual Switch');?></button>
					<script type="text/javascript">
						$("#addVsBtn").button({
					            icons: {
					                primary: "ui-icon-circle-plus"
					            }					            					            
					    });					    
					    $("#addVsBtn").click(function(){$('#addDlg').dialog('open');});					    							    						    					   
					</script>
	</div>
		<table cellpadding="0" cellspacing="0" border="0">
		
		<tr>
				<th><?php echo __('Virtual Switch');?></th>
				<th><?php echo __('Connected');?></th>
				<th><?php echo __('Cloud Servers');?></th>			
				<th class="actions"><?php echo __('Actions');?></th>
		</tr>
		<?php
		foreach ($VirtualSwitches as $virtualSwitch): $rowId='linkid'.$virtualSwitch->ResourceId ;?>
			<tr>
				<td><?php echo h($virtualSwitch->Name); ?>&nbsp;</td>
				<td><?php if($virtualSwitch->isConnected()){ $isConnected=true; echo __('Yes');}else{$isConnected=false; echo __('No');}; ?>&nbsp;</td>
				<td><?php echo h($virtualSwitch->ServerNames); ?>&nbsp;</td>		
				<td>
				
					<button type='button' id="<?php echo $rowId.'btn1'?>"><?php echo __('Delete');?></button>
					<script type="text/javascript">
						$("#<?php echo $rowId.'btn1' ?>").button({
					            icons: {
					                primary: "ui-icon-trash"
					            }
					            <?php if($isConnected){ ?>
					    			,disabled:true					    							    						    
					    		<?php } ?>
					            
					    });
					    <?php if(!$isConnected){ ?>
					    	$("#<?php echo $rowId.'btn1' ?>").click(function(){postForm('vsFrom','<?php echo $rowId.'btn1' ?>','<?php echo $this->Form->url('delete/'.$virtualSwitch->ResourceId)?>','<?php echo __('Are you sure you want to delete  %s?', $virtualSwitch->Name) ?>',true)});					    							    						    
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
				<?php echo $this->Html->link(__('Cloud Server'), array('controller' => 'cloudServers','action' => 'index')); ?>
			</h3>			
			<h3 class="<?php echo $selectedLink?>">
				<span class="ui-icon ui-icon-triangle-1-s"></span>
				<?php echo $this->Html->link(__('Virtual Swich'), array('controller' => 'virtualSwitches', 'action' => 'index')); ?>
			</h3>
			<div class="<?php echo $legend ?>">
				<span style="font-size:0.8em;"><?php echo __('VirtualSwitch legend')?></span>
			</div>	
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

<div id="addDlg"  title="<?php echo __('Add Virtual Switch'); ?>" class="form">
<?php echo $this->Form->create( null,array('action' => 'add','id'=>'addDlgForm'));?>
	<fieldset>
		
		<?php
			echo $this->Form->input('Name');			
		?>
		<div align='right'><button type='button' id='addOkBtn'><?php echo __('OK')?></button><button type='button' id='addKoBtn'><?php echo __('Cancel')?></button></div>
	</fieldset>
<?php echo $this->Form->end();?>
</div>


<script type="text/javascript">
	$('#addDlg').dialog({ autoOpen:false, modal:true, resizable:false });
	$('#addOkBtn').button({
	        icons: {
	             primary: "ui-icon-circle-check"
	        }
	});
	$('#addKoBtn').button({
	        icons: {
	             primary: "ui-icon-circle-close"
	        }
	});
	$('#addOkBtn').click(function(){
		postForm('addDlgForm','addOkBtn',null,null, true);
	});
	$('#addKoBtn').click(function(){$('#addDlg').dialog('close')});
	<?php if(isset($showDlg) && $showDlg){?>
		$('#addDlg').dialog('open');
	<?php }?>
</script>
