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

<div class="ui-widget-content ui-widget-header ui-corner-all uiactions">
		<div>&nbsp;</div>
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
			<h3 class="<?php echo $selectedLink?>">
				<span class="ui-icon ui-icon-triangle-1-s"></span>
				<?php echo $this->Html->link(__('Cloud Server'), array('controller' => 'cloudServers','action' => 'index')); ?>
			</h3>
			<div class="<?php echo $legend ?>">
				<span style="font-size:0.8em;"><?php echo __('Cloud Servers legend')?></span>
			</div>			
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