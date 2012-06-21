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

<div class="logins form">
<?php echo $this->Form->create('Login', array('action' => 'dologin'));?>
	<fieldset>
		<legend><?php echo __('Login'); ?></legend>
	</fieldset>
	<div id="login_username" style="width: 40%">		
		<?php echo $this->Form->input('username'); ?>
	</div>
	<div id="login_pwd" style="width: 40%">
		<?php echo $this->Form->input('password'); ?>
	</div>
	<div id="login_vdcs" style="width: 40%">
		<?php 
		// NOTE: the format used for array items is: 'datacenter_id::datacenter_base_url' => 'data center descrption'
		$datacenters = array('1::https://api.dc1.computing.cloud.it' => 'DC1 - Arezzo - Italy', 
							 '2::https://api.dc2.computing.cloud.it' => 'DC2 - Arezzo - Italy',
							 '3::https://api.dc3.computing.cloud.it' => 'DC3 - Repubblica Ceca');
				
		echo $this->Form->input('datacenters', array('type' => 'select', 'label' => __('Datacenters'), 'options' => $datacenters));
		//please don't use: $this->Form->select('datacenters', $datacenters);
		?>
	</div>
	<div style="width: 40%; text-align: right;">
		<?php echo $this->Form->end(__('Login'));?>
	</div>	
</div>
