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

<td>
		<?php if($CloudServer->AppServerDetail->isDiskInUse($diskNum)){?>
					<b><?php $diskSize=$CloudServer->AppServerDetail->getDiskSize($diskNum); echo $diskSize ?>GB</b>
		<?php }else{ $diskSize=0; ?>	
			<b>----</b>
		<?php }?>					
</td>

<td nowrap="nowrap">
		<?php if($CloudServer->AppServerDetail->isDiskInUse($diskNum)){?>
			<button type="button" id='changeHd<?php echo $diskNum ?>Btn'><?php echo __('Edit Disk Size')?></button>
			<?php if($diskNum>0){?>
				<button type="button" id='removeHd<?php echo $diskNum ?>Btn'><?php echo __('Remove Virtual Disk')?></button>
			<?php }?>
		<?php }else if($diskNum>0){?>
			<button type="button" id='addHd<?php echo $diskNum ?>Btn'><?php echo __('Add Virtual Disk')?></button>
		<?php }?>
		
		
</td>

<td nowrap="nowrap">
	<span id="diskSizeDiv_<?php echo $diskNum ?>">	
		<!-- <input type="text" value="<?php echo $diskSize?>" id="diskSize_<?php echo $diskNum ?>" size="4" maxlength="3"/> -->
		<?php			
			echo $this->Form->input('CloudServer.DiskSize'.$diskNum,array('id'=>'diskSize_'.$diskNum,'label' => false,'div' => false,'error'=>false));
		?>		
		<button type="button" id="diskOk_<?php echo $diskNum ?>"><?php echo __('Apply')?></button>
		<button type="button" id="diskKo_<?php echo $diskNum ?>"><?php echo __('Abort')?></button>
	</span>
</td>


<script type="text/javascript">
		
		$('#diskSizeDiv_<?php echo $diskNum ?>').hide();

		$('#changeHd<?php echo $diskNum ?>Btn').button({text:false,icons:{primary:'ui-icon-pencil'}});
		<?php if($diskNum>0){?>
			$('#addHd<?php echo $diskNum ?>Btn').button({text:false,icons:{primary:'ui-icon-circle-plus'}});
			$('#removeHd<?php echo $diskNum ?>Btn').button({text:false,icons:{primary:'ui-icon-circle-minus'}});
		<?php }?>
		$('#diskOk_<?php echo $diskNum ?>').button({text:false,icons:{primary:'ui-icon-check'}});
		$('#diskKo_<?php echo $diskNum ?>').button({text:false,icons:{primary:'ui-icon-closethick'}});

		<?php if($CloudServer->AppServerDetail->isDiskInUse($diskNum)){?>
			$('#changeHd<?php echo $diskNum ?>Btn').click(function(){
				$('#diskSizeDiv_<?php echo $diskNum ?>').show();
				$(':button').button('disable');
				$('#diskOk_<?php echo $diskNum ?>').button('enable');
				$('#diskKo_<?php echo $diskNum ?>').button('enable');
			});
			
		<?php }else{?>
			$('#addHd<?php echo $diskNum ?>Btn').click(function(){
				$('#diskSizeDiv_<?php echo $diskNum ?>').show();
				$(':button').button('disable');
				$('#diskOk_<?php echo $diskNum ?>').button('enable');
				$('#diskKo_<?php echo $diskNum ?>').button('enable');
			});
		<?php }?>

		$('#diskKo_<?php echo $diskNum ?>').click(function(){
			$('#diskSizeDiv_<?php echo $diskNum ?>').hide();
			$(':button').button('enable');	
		});

		$('#removeHd<?php echo $diskNum ?>Btn').click(function(){
			postForm('cloudServersForm',
					'removeHd<?php echo $diskNum ?>Btn',
					'<?php echo $this->Html->url(array('controller' => 'cloudServers', 'action' => 'removeDisk/'.$CloudServer->AppServerDetail->ServerId.'/'.$diskNum))?>',
					'<?php echo __('Proceed to delete HD%s?',$diskNum)?>',
					true);			
		});

		$('#diskOk_<?php echo $diskNum ?>').click(function(){
			diskSize = $('#diskSize_<?php echo $diskNum ?>').attr('value');
			postForm('cloudServersForm',
					'removeHd<?php echo $diskNum ?>Btn',
					'<?php echo $this->Html->url(array('controller' => 'cloudServers', 'action' => 'updateDisk/'.$CloudServer->AppServerDetail->ServerId.'/'.$diskNum))?>'+'/'+diskSize,
					'<?php echo __('Proceed to update HD%s?',$diskNum)?>',
					true);			
		});

		<?php if(!$CloudServer->AppServerDetail->isStopped()){?>
			$('#addHd<?php echo $diskNum ?>Btn').button('disable');
			$('#removeHd<?php echo $diskNum ?>Btn').button('disable');
			$('#changeHd<?php echo $diskNum ?>Btn').button('disable');
		<?php }?>

		<?php if(isset($showServerDiskEdit) && isset($showServerDiskEdit[$diskNum]) && $showServerDiskEdit[$diskNum] ){?>
			
			$(document).ready(function(){
				$('#diskSizeDiv_<?php echo $diskNum ?>').show();
				$(':button').button('disable');
				$('#diskOk_<?php echo $diskNum ?>').button('enable');
				$('#diskKo_<?php echo $diskNum ?>').button('enable');
			});
		<?php }?>
		
</script>