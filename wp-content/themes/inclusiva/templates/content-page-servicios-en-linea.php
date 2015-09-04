<?php // ACF 
	$servicio__url = get_field('servicio__url'); 
	$servicio__url__txt = get_field('servicio__url__txt'); 
?>
<div class="inner">
	<div class="thumbnail">
		<?php if ( has_post_thumbnail() ){ 
			the_post_thumbnail('full', array('class'=>'img-responsive'));
		} ?>
	  <div class="caption">
	    <h3><?php the_title(); ?></h3>
	    <p><?php the_content(); ?></p>
	    <p>
	    	<a href="<?php if ( $servicio__url ){ echo $servicio__url; } else { echo '#'; } ?>" class="btn btn-success" role="button">
	    		<?php if ( $servicio__url ){ echo $servicio__url__txt; } else { echo 'Ir al Servicio'; } ?>
	    	</a>
	    </p>
	  </div>
	</div>
</div>