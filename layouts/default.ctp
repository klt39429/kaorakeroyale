<?php
/**
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2011, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2011, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       cake
 * @subpackage    cake.cake.console.libs.templates.skel.views.layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $title_for_layout; ?>
	</title>
	
	<link rel="shortcut icon" href="<?= $html->webroot('img/mike.png');?>" />

	<?php 
		echo isset($pageDescription) ? ($this->Html->meta('description', $pageDescription, array('escape' => false))."\n") : "";
		echo $javascript->link("jquery.min.js");
	?>

 	
<!-- ********************* Google Analytic Tracking Code ********************* -->

<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-26348646-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();
  
</script> 	
	
<!-- ********************* Set the current controller color on navbar ********************* -->

<script type="text/javascript">
	
	$(function(){
		
		var controller_name = '<?php echo $this->params['controller']; ?>';
		$('#nav_' + controller_name).css('color','yellow');

	});  
	
</script>

<!-- ********************* Junk Stuff ********************* -->
	
	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css('kr_app');
		echo $this->Html->css('cake.generic');

		echo $scripts_for_layout;
	?>
		
	
</head>
<body>
	<div id="container">
		
		<!-- ********************* Header ********************* -->
		<div id='header'>
				Live Karaoke App
		</div>
		
		
		<!-- ********************* Content ********************* -->
		<div id="content">

			<?php echo $this->Session->flash(); ?>

			<?php echo $content_for_layout; ?>

		</div>
		
		<br />
		
		<!-- ********************* Footer ********************* -->
		
		<div id="footer">

		</div>
	</div>

</body>
</html>