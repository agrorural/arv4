<?php //ACF FIelds
	$terms = get_the_terms( get_the_ID(), 'productor');
	$term_list = get_the_term_list( $post->ID, 'productor', '', ',', '' );
?>
<figure <?php post_class(); ?>>
	<div class="thumbnail">
		<a href="<?php the_permalink(); ?>">
			<?php if ( has_post_thumbnail() ){?>
				<?php the_post_thumbnail('thumbnail', array('class' => 'img-responsive')); ?>
			<?php } else { ?>
				<img src="http://lorempixel.com/400/230/sports/1/" class="img-responsive" />
			<?php } ?>
		</a>
		<figcaption>
			<h3 class=""><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
			<p class="cta__container"><a href="" class="cta__link"><i class="fa fa-paper-plane"></i> Contactar</a>
		</figcaption>
	</div>
</figure>

<?php
//				if( !empty($terms) ) {
//					echo $term_list;
//
//					$term = array_pop($terms);
//
//					$strProdRepresentante = get_field('strProdRepresentante', $term );
//					$strProdcorreo = get_field('strProdcorreo', $term );
//					$strProdUbicacion = get_field('strProdUbicacion', $term );
//					// do something with $custom_field
//					echo '<br />'.$strProdRepresentante.'<br/>';
//					echo $strProdUbicacion.'<br/>';
//					echo '<a href="mailto:'.$strProdcorreo.'">Contactar al productor</a>';
//				}
?>