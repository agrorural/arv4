<?php //ACF FIelds
	$clasificacion = get_the_term_list( $post->ID, 'clasificacion', '', ',', '' );
	$marca = get_the_term_list( $post->ID, 'marca', '', ',', '' );
	$marca__no_link = strip_tags( $marca );	

	$prod__precio = get_field( "prod__precio" );
	$prod__pres = get_field( "prod__pres" );
	$prod__envase = get_field( "prod__envase" );
	$prod__ben = get_field( "prod__ben" );
	$prod__otras_pres = get_field( "prod__otras_pres" );
	$prod__reg_sanit = get_field( "prod__reg_sanit" );
	$prod__vol_min = get_field( "prod__vol_min" );
	$prod__vol_max = get_field( "prod__vol_max" );
	$prod__ficha = get_field( "prod__ficha" );

	// load all 'category' terms for the post
	$productores__terms = get_the_terms( get_the_ID(), 'productor');
	$lugares__terms = get_the_terms( get_the_ID(), 'lugar');


	// we will use the first term to load ACF data from
	if( !empty($productores__terms) ) {
		
		$produ__term = array_pop($productores__terms);

		$produ__ruc = get_field('produ__ruc', $produ__term );
		$produ__rep_leg = get_field('produ__rep_leg', $produ__term );
		$produ__cont_com = get_field('produ__cont_com', $produ__term );
		$produ__correo = get_field('produ__correo', $produ__term );
		$produ__telef = get_field('produ__telef', $produ__term );
	}
?>
<figure <?php post_class(); ?>>
	<div class="thumbnail">
		<a href="<?php the_permalink(); ?>">
			<?php if ( has_post_thumbnail() ){?>
				<?php the_post_thumbnail('full', array('class' => 'img-responsive')); ?>
			<?php } else { ?>
				<img src="<?php echo get_template_directory_uri(); ?>/dist/images/producto--default.jpg" class="img-responsive" />
			<?php } ?>
		</a>
		<figcaption>
			<h3 class=""><a href="<?php the_permalink(); ?>" class="" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h3>
			<?php echo '<h6>S/. '. $prod__precio . ' <small> / ' . $prod__pres . '</small></h6>'; ?>
		</figcaption>
	</div>
</figure>