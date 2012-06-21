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

$cakeDescription = __d('cake_dev', 'CakePHP: the rapid development php framework');
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
		echo $this->Html->css('custom-theme/jquery-ui-1.8.18.custom.css');
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
	    	if(confirmed && postAction!=null){
	    		$("#"+formId).attr("action",postAction);
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
<body>
	<div id="container">
		<div id="header">
			<h1><?php echo $this->Html->link($cakeDescription, 'http://cakephp.org'); ?></h1>
		</div>
		<div id="content">

			<?php echo $this->Session->flash(); ?>

			<?php echo $this->fetch('content'); ?>
		</div>		
		<div id="footer">
			<?php echo $this->Html->link(
				  $this->Html->image('cake.power.gif', array('alt' => $cakeDescription, 'border' => '0')),
				  'http://www.cakephp.org/',
				  array('target' => '_blank', 'escape' => false)
				);
			?>
		</div>		
	</div>	
</body>
</html>
