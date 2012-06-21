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

<div id="srvStopDlg"  title="<?php echo __('Server stop options'); ?>" class="form">
	<?php echo $this->Form->create( null, array('controller' => 'cloudServers','action' => 'stop/'.$CloudServer->AppServerDetail->ServerId, 'id'=>'srvStopDlgForm'));?>				
			<div><?php echo __('Choose which method invoke to stop the server')?></div>			
			<div align="center" style="width: 100%;">
				<button type='button' id='srvStopShutdownBtn'><?php echo __('Shutdown')?></button>
				<button type='button' id='srvStopPowerOffBtn'><?php echo __('Power Off')?></button>
				<button type='button' id='srvStopResetBtn'><?php echo __('Reset')?></button>
			</div>
	<?php echo $this->Form->end();?>
</div>

<script type="text/javascript">
		$('#srvStopDlg').dialog({width:500, autoOpen:false, modal:true, resizable:false });
		$('#srvStopShutdownBtn').button({
		        icons: {
		             primary: "ui-icon-power"
		        }
				<?php if(! $CloudServer->isShutdownAvailable()) { ?>
				,disabled:true					    							    						    
				<?php } ?>
		});
		$('#srvStopPowerOffBtn').button({
		        icons: {
		             primary: "ui-icon-power"
		        }
		});
		$('#srvStopResetBtn').button({
	        icons: {
	             primary: "ui-icon-power"
	        }
		});
		$('#srvStopShutdownBtn').click(function(){
			postForm('srvStopDlgForm','srvStopShutdownBtn','<?php echo $this->Html->url(array('controller' => 'cloudServers', 'action' => 'stop/'.$CloudServer->AppServerDetail->ServerId))?>',null, true);					
		});
		
		$('#srvStopPowerOffBtn').click(function(){
			postForm('srvStopDlgForm','srvStopPowerOffBtn','<?php echo $this->Html->url(array('controller' => 'cloudServers', 'action' => 'powerOff/'.$CloudServer->AppServerDetail->ServerId))?>',null, true);			
		});
		$('#srvStopResetBtn').click(function(){
			postForm('srvStopDlgForm','srvStopResetBtn','<?php echo $this->Html->url(array('controller' => 'cloudServers', 'action' => 'reset/'.$CloudServer->AppServerDetail->ServerId))?>',null, true);			
		});
</script>
