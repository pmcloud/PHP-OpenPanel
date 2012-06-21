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

<?php
/**
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2011, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2011, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       Cake.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

$cakeDescription = __d('aruba_cloud', 'Aruba Spa - PHP Cloud Admin Panel');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $cakeDescription ?>:
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css('cake.generic');
		echo $this->Html->css('custom-theme/jquery-ui-1.8.18.custom-aru');		
		echo $this->Html->script('jquery-1.7.1.min');
		echo $this->Html->script('jquery-ui-1.8.18.custom.min');		

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
	<script>
		function postForm(formId, senderId, postAction, confirmMsg, showWaitDlg){	    	    	
	    	confirmed = true;
	    	if(confirmMsg!=null){
	    		if(!confirm(confirmMsg)){
	    			confirmed=false;
	    		}
	    	}	    	
	    	if(confirmed){
		    	if(postAction!=null){
	    			$("#"+formId).attr("action",postAction);
		    	}
	    		$("#"+senderId).button('disable');
	    		$("#"+formId).submit();
	    		
	    		if(showWaitDlg){
	    			var	dialog = $('<div id="waitDialog"  style="display:hidden" title="Please wait...."><br><div align="center"><span id="waitDialog_text"><?php echo __('Please Wait...') ?></span></div></div>').appendTo('body');
	    			$("#waitDialog").dialog({ autoOpen: true, modal:true, resizable:false });	    		
	    			$(".ui-dialog-titlebar").hide();
	    			$("#waitDialog_text").hide();	    				
	    			$("#waitDialog_text").show('slow');		
	    		}
	    	}	    	
	    }
	</script>
</head>
<body class="ui-widget-content">
	<div id="container">
		<div class="ui-widget-content ui-widget-header ui-corner-all">
			<div >
				<table class="no-alternate" width="100%" cellspacing="0" cellpadding="0" border="0">
					<tr>
						<td class="no-alternate" width="200px;">						
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo  $this->Html->image('logo.png', array('title' => 'Logo', 'alt' => 'Logo', 'border' => '0')) ?>
						</td>
						<?php
						$showThemeRoller = false;
						if (CakeSession::valid()) {
								$sessionData = CakeSession::read(WSEndpoint::SESSION_DATA);
								$username = $sessionData['user'];
								$datacenter = $sessionData['vdc_description'];
								$showThemeRoller = true;
						?>						
						<td class="no-alternate">							
						<?php 						
								if (isset($datacenter)) {
						?>
								<table class="no-alternate" width="100%" cellspacing="0" cellpadding="0" border="0">
									<tr class="no-alternate">
										<td class="no-alternate" rowspan="3" nowrap="nowrap">
						<?php 						
									echo __('Datacenter') .": " .$datacenter ."&nbsp;&nbsp;";									
						?>
										</td>
										<td class="no-alternate">&nbsp;</td>
									</tr>									
									<tr class="no-alternate">
										<td class="no-alternate" width="70%">
						<?php
									echo $this->Html->link(__('Change'), array('controller' => 'logins','action' => 'logout'),array('id'=>'header-changeBtn')); 
						?>
										</td>									
								</tr>
									<tr class="no-alternate">
										<td class="no-alternate">&nbsp;</td>
									</tr>								
							</table>						
							<script>
							        $('#header-changeBtn').button();
							</script>
						</td>
						<?php 	}	?>
						<td valign="top" class="no-alternate">
						<?php
								if (isset($username)) {
						?>
								<table class="no-alternate" width="100%" cellspacing="0" cellpadding="0" border="0">
									<tr class="no-alternate">
										<td class="no-alternate" rowspan="3" nowrap="nowrap">
						<?php 
										//$otherLink='ui-accordion-header ui-helper-reset ui-state-default ui-corner-all';
										echo __('Welcome') .": " .$username ."&nbsp;&nbsp;";
						?>
										</td>
										<td class="no-alternate">&nbsp;</td>
									</tr>									
									<tr class="no-alternate">
										<td width="70%" class="no-alternate">
						<?php
									echo $this->Html->link(__('Logout'), array('controller' => 'logins','action' => 'logout'),array('id'=>'header-logoutBtn'));
						?>
									</td>									
								</tr>
									<tr>
										<td class="no-alternate">&nbsp;</td>
									</tr>								
							</table>
							<script>
							        $('#header-logoutBtn').button();
							</script>
						<?php 	} ?>
						</td>
						<?php } ?>
						<td class="no-alternate">&nbsp;&nbsp;
						<?php 
							echo $this->Html->link(
							  $this->Html->image('it_s1.jpg', array('title' => 'Italiano', 'alt' => 'Italiano', 'border' => '0')),				  
							  array('action' => 'changeLanguage', 'ita'),
							  array('escape' => false)
							);
							echo "&nbsp;&nbsp;&nbsp;&nbsp;"; 
							echo $this->Html->link(
								  $this->Html->image('en_s1.jpg', array('title' => 'English', 'alt' => 'English', 'border' => '0')),
								  array('action' => 'changeLanguage', 'en'),
								  array('escape' => false)
								);
						?>
						</td>
					</tr>
				</table>
			</div>

			<?php if ($showThemeRoller) { ?>
			<div>
				<script type="text/javascript"
  					src="http://jqueryui.com/themeroller/themeswitchertool/">
				</script>
				<div id="switcher"></div>
				<script>  		
    				$('#switcher').themeswitcher();  		
  				</script>
			</div>
			<?php } ?>
			<!-- 			
			<div style="text-padding: 10px;">
				<?php /*echo $this->Html->image('logo.png', array('border' => '0'))*/ ?>
			</div>
			 -->			
		</div>
		<div id="content">
			<?php echo $this->Session->flash(); ?>
			<?php echo $this->fetch('content'); ?>
		</div>		
		<div <?php /*id='footer'*/ ?> class="ui-widget-content">&nbsp;
			<?php /*echo $this->Html->link(
				  $this->Html->image('cake.power.gif', array('alt' => $cakeDescription, 'border' => '0')),
				  'http://www.cakephp.org/',
				  array('target' => '_blank', 'escape' => false)
				);
			*/ ?>
		</div>		
	</div>	
</body>
</html>
