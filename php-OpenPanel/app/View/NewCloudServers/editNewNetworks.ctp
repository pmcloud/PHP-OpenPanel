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
			<br>
			<table cellpadding="0" cellspacing="0" width="100%">
			<tr>
				<th colspan="4"><?php echo __('Network Adapters');?></th>				
			</tr>
			<tr>
				<td nowrap="nowrap" width="15%"><?php echo __('ETHERNET 01'); ?></td>
				<td colspan="3"><span class="server-status-running"><?php echo __('IPAddress will be assigned automatically')?></span></td>
			</tr>
			<tr>
				<td nowrap="nowrap" width="15%"><?php echo __('ETHERNET 02'); ?></td>
				<td width="15%">
				<?php
					$options = array();
					$options[-1] = __('DISCONNECTED');
					if(isset($NewCloudServer->AvailableAppVLANs)){					
						foreach ($NewCloudServer->AvailableAppVLANs as $appvl) {
							$options[$appvl->ResourceId] = $appvl->Name; 
						}
					} 								
					echo $this->Form->input('NewCloudServer.VLAN_ETH02',
						array('id' => 'selectVLAN_ETH02',
							  'label' => false,
							  'div' => false, 
							  'error'=>false,						  		
							  'options' =>  $options
						     ));
				?>
				</td>
				<td nowrap="nowrap">
					<table cellpadding="0" cellspacing="1" width="100%" border="0">
						<tr class="no-alternate">
							<td class="no-alternate"><?php echo __('IP'); ?>:</td>
							<td class="no-alternate">
								<?php echo $this->Form->input('NewCloudServer.ETH02_IP', 
									array('id' => 'ETH02_IP',
									      'label' => false,
										  'div' => false,
										  'error'=>false,
										  'size' => '15',
										  'maxlength'=> '15'										  								  				  
									));?>
							</td>
						</tr>
					</table>
				</td>
				<td nowrap="nowrap">
					<table cellpadding="0" cellspacing="1" width="100%" border="0">
						<tr class="no-alternate">
							<td class="no-alternate"><?php echo __('NETMASK'); ?>:</td>
							<td class="no-alternate">
								<?php echo $this->Form->input('NewCloudServer.ETH02_NM', 
									array('id' => 'ETH02_NM',
									      'label' => false,
										  'div' => false,
										  'error'=>false,
										  'size' => '15',
										  'maxlength'=> '15'								  				  
									));?>
							</td>
						</tr>
					</table>
				</td>									
			</tr>
			<tr>
				<td nowrap="nowrap" width="15%"><?php echo __('ETHERNET 03'); ?></td>
				<td width="15%">
				<?php
					$options = array();
					$options[-1] = __('DISCONNECTED');
					if(isset($NewCloudServer->AvailableAppVLANs)){					
						foreach ($NewCloudServer->AvailableAppVLANs as $appvl) {
							$options[$appvl->ResourceId] = $appvl->Name; 
						}
					} 								
					echo $this->Form->input('NewCloudServer.VLAN_ETH03',
						array('id' => 'selectVLAN_ETH03',
							  'label' => false,
							  'div' => false, 
							  'error'=>false,						  		
							  'options' =>  $options
						     ));
				?>
				</td>
				<td nowrap="nowrap">
					<table cellpadding="0" cellspacing="1" width="100%" border="0">
						<tr class="no-alternate">
							<td class="no-alternate"><?php echo __('IP'); ?>:</td>
							<td class="no-alternate">
								<?php echo $this->Form->input('NewCloudServer.ETH03_IP', 
									array('id' => 'ETH03_IP',
									      'label' => false,
										  'div' => false,
										  'error'=>false,
										  'size' => '15',
										  'maxlength'=> '15'										  								  			
									));?>
							</td>
						</tr>
					</table>
				</td>
				<td nowrap="nowrap">
					<table cellpadding="0" cellspacing="1" width="100%" border="0">
						<tr class="no-alternate">
							<td class="no-alternate"><?php echo __('NETMASK'); ?>:</td>
							<td class="no-alternate">
								<?php echo $this->Form->input('NewCloudServer.ETH03_NM', 
									array('id' => 'ETH03_NM',
									      'label' => false,
										  'div' => false,
										  'error'=>false,
										  'size' => '15',
										  'maxlength'=> '15'								  				  
									));?>
							</td>
						</tr>
					</table>
				</td>									
			</tr>
			</table>						
