<?php
	$args = array(
		'post_type' => 'post',
		'tax_query' => array(
			array(
				'taxonomy' => 'post_format',
				'field'    => 'slug',
				'terms'    => array( 'post-format-gallery' ),
			)
		),
		'posts_per_page' => 1
	);
?>
<?php
// The Query
$query1 = new WP_Query( $args );

// The Loop
while ( $query1->have_posts() ) { 
	$query1->the_post(); ?>
<div class="multimedia--1">
	<figure>
		<a title="Contiene falería" href="<?php the_permalink(); ?>" class="format-icon tip">
			<span class="fa-stack fa-lg">
			  <i class="fa fa-circle fa-stack-2x"></i>
			  <i class="fa fa-camera fa-stack-1x fa-inverse"></i>
			</span>
		</a>
		<?php if ( has_post_thumbnail() ){?>
			<?php the_post_thumbnail('thumb-videos', array('class' => 'img-responsive')); ?>
		<?php } else { ?>
			<img src="http://lorempixel.com/400/230/sports/1/" class="img-responsive" />
		<?php } ?>
		<figcaption>
			<?php get_template_part('templates/entry-meta'); ?>
			<h3 class="tab-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
		</figcaption>
	</figure>
</div>
<?php } ?>
<?php

/* Restore original Post Data 
 * NB: Because we are using new WP_Query we aren't stomping on the 
 * original $wp_query and it does not need to be reset with 
 * wp_reset_query(). We just need to set the post data back up with
 * wp_reset_postdata().
 */
wp_reset_postdata(); ?>

<?php $args2 = array(
		'post_type' => 'post',
		'tax_query' => array(
			array(
				'taxonomy' => 'post_format',
				'field'    => 'slug',
				'terms'    => array( 'post-format-gallery' ),
			)
		),
		'posts_per_page' => 2,
		'offset' => 1
	);
?>

<?php $query2 = new WP_Query( $args2 ); ?>
<div class="multimedia--2">
<?php while ( $query2->have_posts() ) { $query2->the_post();  ?>
	<figure>
		<a title="Contiene falería" href="<?php the_permalink(); ?>" class="format-icon tip">
			<span class="fa-stack fa-lg">
			  <i class="fa fa-circle fa-stack-2x"></i>
			  <i class="fa fa-camera fa-stack-1x fa-inverse"></i>
			</span>
		</a>
		<?php if ( has_post_thumbnail() ){?>
			<?php the_post_thumbnail('thumb-videos', array('class' => 'img-responsive')); ?>
		<?php } else { ?>
			<img src="http://lorempixel.com/400/230/sports/1/" class="img-responsive" />
		<?php } ?>
	<figcaption>
	<?php get_template_part('templates/entry-meta'); ?>
	<h3 class="tab-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
	</figcaption>
	</figure>
<?php } ?>
</div>
<?php
// Restore original Post Data
wp_reset_postdata();
?>