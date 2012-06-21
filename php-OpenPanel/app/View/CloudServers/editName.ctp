
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

<button type="button" id='changeNameBtn'><?php echo __('Edit')?></button>
<span id='editServerName'>
	<?php echo $this->Form->input('CloudServer.Name',array('id'=>'serverNameId','label' => false,'div' => false,'error'=>false));?>
	<button type="button" id='changeNameOkBtn'><?php echo __('Apply')?></button>
	<button type="button" id='changeNameKOBtn'><?php echo __('Abort')?></button>
</span>
<script type="text/javascript">
	$('#editServerName').hide();
	
	$('#changeNameBtn').button({text:false,icons:{primary:'ui-icon-pencil'}});
	$('#changeNameOkBtn').button({text:false,icons:{primary:'ui-icon-check'}});
	$('#changeNameKOBtn').button({text:false,icons:{primary:'ui-icon-closethick'}});
	$('#changeNameBtn').click(function(){
		$('#editServerName').show();
		$(':button').button('disable');
		$('#changeNameOkBtn').button('enable');
		$('#changeNameKOBtn').button('enable');
	});

	$('#changeNameKOBtn').click(function(){
		$('#editServerName').hide();
		$('#changeNameBtn').button('enable');
		<?php if($CloudServer->AppServerDetail->isStopped()){?>
			$(':button').button('enable');
		<?php } ?>	
	});
	$('#changeNameOkBtn').click(function(){
		postForm('cloudServersForm',
				'changeNameOkBtn',
				'<?php echo $this->Html->url(array('controller' => 'cloudServers', 'action' => 'renameServer/'.$CloudServer->AppServerDetail->ServerId))?>',
				'<?php echo __('Proceed to rename Cloud Server?')?>',
				true);			
	});	

	<?php if(isset($showServerNameEdit) && $showServerNameEdit ){?>
		$(document).ready(function(){
			$('#editServerName').show();
			$(':button').button('disable');
			$('#changeNameOkBtn').button('enable');
			$('#changeNameKOBtn').button('enable');
		});
		
	<?php }?>
</script>
