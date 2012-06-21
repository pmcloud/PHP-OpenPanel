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
if ($this->Form->isFieldError('NewCloudServer.Name')) {
    echo $this->Form->error('NewCloudServer.Name');
}
if ($this->Form->isFieldError('NewCloudServer.Password')) {
    echo $this->Form->error('NewCloudServer.Password');
}
if ($this->Form->isFieldError('NewCloudServer.PasswordChk')) {
    echo $this->Form->error('NewCloudServer.PasswordChk');
}
if ($this->Form->isFieldError('NewCloudServer.CPU')) {
    echo $this->Form->error('NewCloudServer.CPU');
}
if ($this->Form->isFieldError('NewCloudServer.RAM')) {
    echo $this->Form->error('NewCloudServer.RAM');
}
if ($this->Form->isFieldError('NewCloudServer.DiskSize0')) {
    echo $this->Form->error('NewCloudServer.DiskSize0');
}
if ($this->Form->isFieldError('NewCloudServer.DiskSize1')) {
    echo $this->Form->error('NewCloudServer.DiskSize1');
}
if ($this->Form->isFieldError('NewCloudServer.DiskSize2')) {
    echo $this->Form->error('NewCloudServer.DiskSize2');
}
if ($this->Form->isFieldError('NewCloudServer.DiskSize3')) {
    echo $this->Form->error('NewCloudServer.DiskSize3');
}
if ($this->Form->isFieldError('NewCloudServer.ETH02_IP')) {
    echo $this->Form->error('NewCloudServer.ETH02_IP');
}
if ($this->Form->isFieldError('NewCloudServer.ETH02_NM')) {
    echo $this->Form->error('NewCloudServer.ETH02_NM');
}
if ($this->Form->isFieldError('NewCloudServer.ETH03_IP')) {
    echo $this->Form->error('NewCloudServer.ETH03_IP');
}
if ($this->Form->isFieldError('NewCloudServer.ETH03_NM')) {
    echo $this->Form->error('NewCloudServer.ETH03_NM');
}

?>
<form id='NewCloudServersForm' method='POST' action='<?php echo $this->Html->url(array('controller' => 'NewCloudServers', 'action' => 'createServer/'))?>'>		
	<h2><?php  echo __('New Cloud Server definition');?></h2>
				
	<table class="no-alternate" cellpadding="2" cellspacing="0" width="100%" border="0">
		<tr class="no-alternate">
			<td nowrap="nowrap" class="no-alternate"><b><?php echo __('Cloud Server Name'); ?>:</b></td>			
			<td class="no-alternate">			
				<?php echo $this->Form->input('NewCloudServer.Name', 
					array('label' => false,
						  'div' => false,
						  'error'=>false						  
					));?>
			</td>			
			<td class="no-alternate" width="30%"><?php echo __('Define cloud server name (unique within this datacenter)'); ?></td>
		</tr>		
		<tr class="no-alternate">
			<td nowrap="nowrap" class="no-alternate"><b><?php echo __('Hypervisor'); ?>:</b></td>			
			<td class="no-alternate">
				<?php											
				echo $this->Form->input('NewCloudServer.Hypervisor',
						array('id' => 'hypervisorSelect',
							  'label' => false,
							  'div' => false,
							  'error'=>false,
							  'options' => $NewCloudServer->HypervisorTypes,
							  'selected'=> $NewCloudServer->SelectedHypervisorType						  
						));
				//if ($selectedHyper == null) {
				//$selectedHyper = $NewCloudServer->DefaultHypervisor;
				//}
				?>				
			</td>			
			<td class="no-alternate" width="30%"><?php echo __('Choose your Hypervisor'); ?></td>			
		</tr>
		<tr class="no-alternate">
			<td nowrap="nowrap" class="no-alternate"><b><?php echo __('OS-template'); ?>:</b></td>			
			<td class="no-alternate" colspan="2">
				<?php 				
				
				echo $this->Form->input('NewCloudServer.OSTemplate',
					array('id' => 'templateSelect',
						  'label' => false,
						  'div' => false, 
						  'error'=>false,						   					
						  'options' =>  $NewCloudServer->TemplateList,
						  'selected' => $NewCloudServer->SelectedTemplateProdId				  
					     ));
				?>
			</td>					
		</tr>
		<tr class="no-alternate">
			<td class="no-alternate">&nbsp;</td>
			<td class="no-alternate" colspan="2" align="center"><h3><?php echo __('Definition of user administrator password'); ?></h3></td>			
		</tr>
		<tr class="no-alternate">
			<td nowrap="nowrap" class="no-alternate"><b><?php echo __('Password'); ?>:</b></td>			
			<td class="no-alternate">
				<?php 
				echo $this->Form->input('NewCloudServer.Password',
					array('label' => false,
					'div' => false,
					'error'=>false,
					'type' =>'password',
					'size' => '20',
					'maxlength'=> '20'));
					?>
			</td>			
			<td class="no-alternate"><?php echo __('Min 7 char with at least a number and a capital letter'); ?></td>			
		</tr>
		<tr class="no-alternate">
			<td nowrap="nowrap" class="no-alternate"><b><?php echo __('Password check'); ?>:</b></td>			
			<td class="no-alternate">
				<?php 
				echo $this->Form->input('NewCloudServer.PasswordChk',
					array('label' => false,
						  'div' => false,
						  'error'=>false,
						  'type' =>'password',
						  'size' => '20',
						  'maxlength'=> '20'));
				?>
			</td>			
			<td class="no-alternate"><?php echo __('Retype the previus password to compare'); ?></td>			
		</tr>
		<tr class="no-alternate">
			<td class="no-alternate">&nbsp;</td>
			<td class="no-alternate" colspan="2" align="center"><h3><?php echo __('CPU and RAM definition'); ?></h3></td>			
		</tr>
		<tr class="no-alternate">
			<td nowrap="nowrap" class="no-alternate"><b><?php echo __('CPU'); ?>:</b></td>			
			<td class="no-alternate">
				<?php
				$options = array();
				if(isset($NewCloudServer->AppCPUsBound)){				
					for ($i = $NewCloudServer->AppCPUsBound->getMin(); $i <= $NewCloudServer->AppCPUsBound->getMax(); $i++) {
						$options[$i]=$i;
					}
				}								
				echo $this->Form->input('NewCloudServer.CPU',
					array('id' => 'cpuSelect',
						  'label' => false,
						  'div' => false, 
						  'error'=>false,						   					
						  'options' =>  $options,
						  'selected' => $NewCloudServer->SelectedCPUNum					  
					     ));
				echo "&nbsp;&nbsp; (" .__('Core') .")";
				?>
			</td>			
			<td class="no-alternate"><?php echo __('Select how many cores you need'); ?></td>			
		</tr>
		<tr class="no-alternate">
			<td nowrap="nowrap" class="no-alternate"><b><?php echo __('RAM'); ?>:</b></td>			
			<td class="no-alternate">
				<?php
				$options = array();
				if(isset($NewCloudServer->AppRAMsBound)){					
					for ($i = $NewCloudServer->AppRAMsBound->getMin(); $i <= $NewCloudServer->AppRAMsBound->getMax(); $i++) {
						$options[$i]=$i;
					}
				} 								
				echo $this->Form->input('NewCloudServer.RAM',
					array('id' => 'ramSelect',
						  'label' => false,
						  'div' => false, 
						  'error'=>false,						  		
						  'options' =>  $options,
						  'selected' => $NewCloudServer->SelectedRAMNum						  
					     ));
				echo "&nbsp;&nbsp; (" .__('GB') .")";
				?>
			</td>			
			<td class="no-alternate"><?php echo __('Define how many GB you want'); ?></td>			
		</tr>		
		<tr class="no-alternate">
			<td class="no-alternate">&nbsp;</td>
			<td class="no-alternate" colspan="2" align="center"><h3><?php echo __('Hard disk(s) definition'); ?></h3></td>			
		</tr>
		<tr class="no-alternate">
			<td nowrap="nowrap" class="no-alternate"><b><?php echo __('Hard disk #0'); ?>:</b></td>			
			<td class="no-alternate">
				<?php 
					echo $this->Form->input('NewCloudServer.DiskSize0',
						array('id'=>'diskSize_0',
							  'label' => false,
							  'div' => false,
							  'error'=>false,
							  'size' => '3',
						  	  'maxlength'=> '3',
							  'value'=>$NewCloudServer->SelectedDisksSize[0]
							)); 
					echo " (" .__('GB') .")&nbsp;&nbsp;";
				?>
			</td>			
			<td class="no-alternate">
				<span id="diskBounds0">
				<?php 
					echo "Min: " .$NewCloudServer->AppHDxBound[0]->getMin() ."  " 
					    ."Default: " .$NewCloudServer->AppHDxBound[0]->getDefault() ."  "
					    ."Max: " .$NewCloudServer->AppHDxBound[0]->getMax();
				?>
				</span>
			</td>			
		</tr>
		<tr class="no-alternate">
			<td nowrap="nowrap" class="no-alternate"><b><?php echo __('Hard disk #1'); ?>:</b></td>			
			<td class="no-alternate">
				<?php 
					echo $this->Form->input('NewCloudServer.DiskSize1',
						array('id'=>'diskSize_1',
							  'label' => false,
							  'div' => false,
							  'error'=> false,
							  'size' => '3',
						  	  'maxlength'=> '3',
							  'value'=> ($NewCloudServer->SelectedDisksSize[1] > 0 ? $NewCloudServer->SelectedDisksSize[1] : $NewCloudServer->AppHDxBound[1]->getDefault()),
							  'disabled' => ($NewCloudServer->SelectedDisksSize[1] <= 0)
						));
					echo " (" .__('GB') .")&nbsp;&nbsp;";
					 
				?>
				<button type="button" id='addHdBtn1'><?php echo __('Activate disk')?></button>
			</td>			
			<td class="no-alternate">
				<span id="diskBounds1">
				<?php 
					echo "Min: " .$NewCloudServer->AppHDxBound[1]->getMin() ."  " 
					    ."Default: " .$NewCloudServer->AppHDxBound[1]->getDefault() ."  "
					    ."Max: " .$NewCloudServer->AppHDxBound[1]->getMax();
				?>
				</span>
			</td>					
		</tr>
		<tr class="no-alternate">
			<td nowrap="nowrap" class="no-alternate"><b><?php echo __('Hard disk #2'); ?>:</b></td>			
			<td class="no-alternate">
				<?php 
					echo $this->Form->input('NewCloudServer.DiskSize2',
						array('id'=>'diskSize_2',
							  'label' => false,
							  'div' => false,
							  'error'=> false,
							  'size' => '3',
						  	  'maxlength'=> '3',
							  'value'=> ($NewCloudServer->SelectedDisksSize[2] > 0 ? $NewCloudServer->SelectedDisksSize[2] : $NewCloudServer->AppHDxBound[2]->getDefault()),
							  'disabled' => ($NewCloudServer->SelectedDisksSize[2] <=0)
						));
					echo " (" .__('GB') .")&nbsp;&nbsp;";
				?>
				<button type="button" id='addHdBtn2'><?php echo __('Activate disk')?></button>
			</td>			
			<td class="no-alternate">
				<span id="diskBounds2">
				<?php 
					echo "Min: " .$NewCloudServer->AppHDxBound[2]->getMin() ."  " 
					    ."Default: " .$NewCloudServer->AppHDxBound[2]->getDefault() ."  "
					    ."Max: " .$NewCloudServer->AppHDxBound[2]->getMax();
				?>
				</span>
			</td>			
		</tr>
		<tr class="no-alternate">
			<td nowrap="nowrap" class="no-alternate"><b><?php echo __('Hard disk #3'); ?>:</b></td>			
			<td class="no-alternate">
				<?php 
					echo $this->Form->input('NewCloudServer.DiskSize3',
						array('id'=>'diskSize_3',
							  'label' => false,
							  'div' => false,
							  'error'=>false,
							  'size' => '3',
						  	  'maxlength'=> '3',
							  'value'=> ($NewCloudServer->SelectedDisksSize[3] > 0 ? $NewCloudServer->SelectedDisksSize[3] : $NewCloudServer->AppHDxBound[3]->getDefault()),
							  'disabled' => ($NewCloudServer->SelectedDisksSize[3] <= 0)
							));
					echo " (" .__('GB') .")&nbsp;&nbsp;";
				?>
				<button type="button" id='addHdBtn3'><?php echo __('Activate disk') ?></button>
			</td>			
			<td class="no-alternate">
				<span id="diskBounds3">
				<?php 
					echo "Min: " .$NewCloudServer->AppHDxBound[3]->getMin() ."  " 
					    ."Default: " .$NewCloudServer->AppHDxBound[3]->getDefault() ."  "
					    ."Max: " .$NewCloudServer->AppHDxBound[3]->getMax();
				?>
				</span>
			</td>			
		</tr>		
	</table>
	<?php include("editNewNetworks.ctp")?>
	<br/>
	<div style="width:100%; text-align:right;">
			<button type="button" id="createServer"><?php echo __('Create server')?></button>			
	</div>		
</form>		
</div>
<script type="text/javascript">
<!--
$('#createServer').button({icons:{primary:'ui-icon-plusthick'}});
$('#createServer').click(function() {
	postForm('NewCloudServersForm','createServer','<?php echo $this->Html->url(array('controller' => 'NewCloudServers', 'action' => 'createServer/'))?>',null, false);
});
function liveAddHD(hdProg) {
	var disab = $('#diskSize_'+hdProg).attr('disabled');
	$('#diskSize_'+hdProg).attr('disabled', !disab);	
};

$('#addHdBtn1').button({text:false,icons:{primary:'ui-icon-cart'}});
$('#addHdBtn1').click(function() {
	liveAddHD(1);
});

$('#addHdBtn2').button({text:false,icons:{primary:'ui-icon-cart'}});
$('#addHdBtn2').click(function() {
	liveAddHD(2);
});

$('#addHdBtn3').button({text:false,icons:{primary:'ui-icon-cart'}});
$('#addHdBtn3').click(function() {
	liveAddHD(3);
});

function ajaxHDBoundsChange() {
	
	$.getJSON("<?php echo $this->Html->url(array('controller' => 'NewCloudServers', 'action' => 'loadHDBounds/'))?>"
          	+"/"+ $('#hypervisorSelect').val()
          	+"/"+ $('#templateSelect').val()
          	, null
          	, function(jsonResp) {
          	
          		var info = '';
          		//alert('SIZE: ' + jsonResp.length);
          		for (var i = 0; i < jsonResp.length; i++) {

          			$('#diskBounds'+i).empty();
          			var currentSize = $('#diskSize_'+i).val();
          			var disabled = $('#diskSize_'+i).attr('disabled'); 
          			for (var k = 0; k < 3; k++) {                 		
              			info += jsonResp[i][k].boundKey + " " + jsonResp[i][k].boundValue + " ";
          				if (!disabled && k == 0 && currentSize < jsonResp[i][k].boundValue) {
          					$('#diskSize_'+i).val(jsonResp[i][k].boundValue);
          				}
          				if (!disabled && k == 2 && currentSize > jsonResp[i][k].boundValue) {
          					$('#diskSize_'+i).val(jsonResp[i][k].boundValue);
          				}
          			}              			              	
              		$('#diskBounds' + i).html(info);              		
              		info = '';
          		}          		
		});
};

function ajaxSelectChange(selectedId, ajaxUrl, ajaxParams) {
		
    $.getJSON(ajaxUrl, ajaxParams, function(jsonResp) {
						
    		$('#'+selectedId).empty();
            var options = ''; //'<option value="">...</option>';
            for (var i = 0; i < jsonResp.length; i++) {
                    options += '<option value="' + jsonResp[i].itemId + '">' + jsonResp[i].description + '</option>';
            }                        
            $('#'+selectedId).html(options);            
    });
}

function hypervSelectChange() {
	
    $.getJSON("<?php echo $this->Html->url(array('controller' => 'NewCloudServers', 'action' => 'loadTemplates/'))?>"+"/"+ $('#hypervisorSelect').val()
    	    , null
    	    , function(jsonResp) {						
	    		$('#templateSelect').empty();
	            var options = ''; 
	            for (var i = 0; i < jsonResp.length; i++) {
	                    options += '<option value="' + jsonResp[i].itemId + '"';
	                    if (i == 0) {
		                    options += ' selected="selected" ';
	                    }
	                    options +=  '>' + jsonResp[i].description + '</option>';
	            }                        
	            $('#templateSelect').html(options);

	          	//---- change CPU select --- 
	          	ajaxSelectChange("cpuSelect"	    	          	
	    	          	,"<?php echo $this->Html->url(array('controller' => 'NewCloudServers', 'action' => 'loadCPUs/'))?>"
	    	          	+"/"+ $('#hypervisorSelect').val()
	    	          	+"/"+ $('#templateSelect').val()
	    	          	,null);
	            //---- change RAM select ---
	            ajaxSelectChange("ramSelect"
	    	            ,"<?php echo $this->Html->url(array('controller' => 'NewCloudServers', 'action' => 'loadRAMs/'))?>"
	    	            +"/"+ $('#hypervisorSelect').val()
	    	            +"/"+ $('#templateSelect').val()
	    	            ,null);
	            //---- change HDs bounds ---
	            ajaxHDBoundsChange();
    		}); // end of "main" json-callback
}

function templateSelectChange() {
	
	//---- change CPU select --- 
  	ajaxSelectChange("cpuSelect"	    	          	
          	,"<?php echo $this->Html->url(array('controller' => 'NewCloudServers', 'action' => 'loadCPUs/'))?>"
          	+"/"+ $('#hypervisorSelect').val()
          	+"/"+ $('#templateSelect').val()
          	,null);
    //---- change RAM select ---
    ajaxSelectChange("ramSelect"
            ,"<?php echo $this->Html->url(array('controller' => 'NewCloudServers', 'action' => 'loadRAMs/'))?>"
            +"/"+ $('#hypervisorSelect').val()
            +"/"+ $('#templateSelect').val()
            ,null);
    //---- change HDs bounds ---
    ajaxHDBoundsChange();
}

$('#hypervisorSelect').change(function() {
	hypervSelectChange();
});	

$('#templateSelect').change(function() {
	templateSelectChange();
});	

$(document).ready(function() {
	var sel = $('#selectVLAN_ETH02 option:selected').attr('value');
	$('#ETH02_IP').attr('disabled', (sel == null || sel < 0));
	$('#ETH02_NM').attr('disabled', (sel == null || sel < 0));
	
	sel = $('#selectVLAN_ETH03 option:selected').attr('value');
	$('#ETH03_IP').attr('disabled', (sel == null || sel < 0));
	$('#ETH03_NM').attr('disabled', (sel == null || sel < 0));
});

$('#selectVLAN_ETH02').change(function() {
	var sel = $('#selectVLAN_ETH02 option:selected').attr('value');
	$('#ETH02_IP').attr('disabled', (sel < 0));
	$('#ETH02_NM').attr('disabled', (sel < 0));
});	

$('#selectVLAN_ETH03').change(function() {
	var sel = $('#selectVLAN_ETH03 option:selected').attr('value');
	$('#ETH03_IP').attr('disabled', (sel < 0));
	$('#ETH03_NM').attr('disabled', (sel < 0));
});	


//-->
</script>
<?php include("menu.ctp")?>

