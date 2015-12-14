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
	    <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
	    <p><?php the_excerpt(); ?></p>
	  </div>
	</div>
</div>