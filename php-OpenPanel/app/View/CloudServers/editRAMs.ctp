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

<button type="button" id='changeRamsBtn'><?php echo __('Edit')?></button>
<span id='editServerRams'>
	<?php 
		$options = array();
		if(isset($CloudServer->AppRAMsBound)){
			
			for ($i = $CloudServer->AppRAMsBound->getMin(); $i <= $CloudServer->AppRAMsBound->getMax(); $i++) {
				$options[$i]=$i;
			}
		}		
		echo $this->Form->select('CloudServer.Rams',$options,array('empty' => false,'error'=>false,'div'=>false,'label'=>false));		
	?>
	
	<button type="button" id='changeRamsOkBtn'><?php echo __('Apply')?></button>
	<button type="button" id='changeRamsKOBtn'><?php echo __('Abort')?></button>
</span>
<script type="text/javascript">
	$('#editServerRams').hide();
	
	$('#changeRamsBtn').button({text:false,icons:{primary:'ui-icon-pencil'}});
	$('#changeRamsOkBtn').button({text:false,icons:{primary:'ui-icon-check'}});
	$('#changeRamsKOBtn').button({text:false,icons:{primary:'ui-icon-closethick'}});
	$('#changeRamsBtn').click(function(){
		$('#editServerRams').show();
		$(':button').button('disable');
		$('#changeRamsOkBtn').button('enable');
		$('#changeRamsKOBtn').button('enable');
	});

	$('#changeRamsKOBtn').click(function(){
		$('#editServerRams').hide();
		$(':button').button('enable');	
	});
	$('#changeRamsOkBtn').click(function(){
		postForm('cloudServersForm',
				'changeRamsOkBtn',
				'<?php echo $this->Html->url(array('controller' => 'cloudServers', 'action' => 'modifyRams/'.$CloudServer->AppServerDetail->ServerId))?>',
				'<?php echo __('Proceed modify RAMs for Cloud Server?')?>',
				true);			
	});	

	<?php if(isset($showServerRamsEdit) && $showServerRamsEdit ){?>
		$(document).ready(function(){
			$('#editServerRams').show();
			$(':button').button('disable');
			$('#changeRamsOkBtn').button('enable');
			$('#changeRamsKOBtn').button('enable');
		});
		
	<?php }?>
	<?php if(!$CloudServer->AppServerDetail->isStopped()){?>
		$('#changeRamsBtn').button('disable');	
	<?php }?>
</script>
