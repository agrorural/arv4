<?php //ACF FIelds
	$terms = get_the_terms( get_the_ID(), 'productor');
	$term_list = get_the_term_list( $post->ID, 'productor', '', ',', '' );

	$prod__precio = get_field( "prod__precio" );
	$prod__pres = get_field( "prod__pres" );
	$prod__envase = get_field( "prod__envase" );
?>
<figure <?php post_class(); ?>>
	<div class="thumbnail">
		<a href="<?php the_permalink(); ?>">
			<?php if ( has_post_thumbnail() ){?>
				<?php the_post_thumbnail('full', array('class' => 'img-responsive')); ?>
			<?php } else { ?>
				<img src="http://lorempixel.com/400/475/sports/1/" class="img-responsive" />
			<?php } ?>
		</a>
		<figcaption>
			<h3 class=""><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
			<?php echo '<h6>S/. '. $prod__precio . ' <small>' . $prod__pres . '</small></h6>'; ?>
			<p class="cta__container"><a href="" class="btn btn-success btn-block"><i class="fa fa-paper-plane"></i> Quiero comprar</a>
		</figcaption>
	</div>
</figure>