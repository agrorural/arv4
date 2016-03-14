<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  	<?php 
  		//Gravity Forms llamado correcto
  		gravity_form_enqueue_scripts('form_id', 'ajax');
		gravity_form_enqueue_scripts(4, true);
	?>
  <?php wp_head(); ?>
</head>
