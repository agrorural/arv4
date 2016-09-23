<?php
/**
 * Month View Template
 * The wrapper template for month view.
 *
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/month.php
 *
 * @package TribeEventsCalendar
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
} ?>

<?php do_action( 'tribe_events_before_template' ) ?>
<!-- Banners Serviagro -->
<?php if( is_tax( 'tribe_events_cat', 'serviagro') ) { ?>
	<?php 

	// Argumentos
	$args  = array(
		'post_type' => 'Banners', 
		'posiciones' => 'Serviagro',
		'post_per_page' => 2
	);
	// the query
	$the_query = new WP_Query( $args ); ?>

	<?php if ( $the_query->have_posts() ) : ?>

			<!-- pagination here -->
	<section class="wrapper">
			<!-- the loop -->
			<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
				<?php // ACF 
					$banner__url = get_field('banner__url');

					//var_dump($banner__pop);
					$hoy = date( 'Ymd', current_time( 'timestamp', 1 ));
					$banner__vig = get_field('banner__vig');
					$content = esc_attr(get_the_content());

					if ( $banner__vig && intval ( $banner__vig ) <= intval( $hoy ) ){
				        change_post_status( $post->ID, 'draft' );
				    } 
				?>
					
						<figure class="banner">
								<a href="<?php if ($banner__url) { echo $banner__url; } else { echo bloginfo( 'url' ); } ?>">
								<?php if ( has_post_thumbnail() ) { the_post_thumbnail('full', array ( 'class' => 'img-responsive' ) ); } ?>
							</a>
						</figure>
					
			<?php endwhile; ?>
			<!-- end of the loop -->
	</section>
			<!-- pagination here -->

			<?php wp_reset_postdata(); ?>
			
	<?php else : ?>
		<?php /* Silence is Golden */  ?>
	<?php endif; ?>	
<?php }	?>
<!-- Banners Serviagro -->
<!-- Tribe Bar -->
<?php tribe_get_template_part( 'modules/bar' ); ?>

<!-- Main Events Content -->
<?php tribe_get_template_part( 'month/content' ); ?>

<?php do_action( 'tribe_events_after_template' ) ?>
