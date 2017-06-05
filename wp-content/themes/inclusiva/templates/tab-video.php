<?php
$objVideo = get_term_by( 'name', 'post-format-video', 'post_format' );
?>

<?php
	$args = array(
		'post_type' => 'post',
		'tax_query' => array(
			array(
				'taxonomy' => 'post_format',
				'field'    => 'slug',
				'terms'    => array( 'post-format-video' ),
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
	$query1->the_post();
//var_dump($query1);
	?>
<div class="multimedia--1">
	<figure>
		<a title="Ver video" href="<?php the_permalink(); ?>" class="">
			<?php if ( has_post_thumbnail() ){?>
				<div class="media-img">
					<i class="fa fa-video"></i>
					<?php the_post_thumbnail('thumb-videos', array('class' => 'img-responsive')); ?>
				</div>
			<?php } ?>
			<figcaption>
				<?php get_template_part('templates/entry-meta'); ?>
				<h3 class="tab-title"><?php the_title(); ?></h3>
			</figcaption>
		</a>
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
				'terms'    => array( 'post-format-video' ),
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
		<a title="Ver video" href="<?php the_permalink(); ?>" class="">
			<?php if ( has_post_thumbnail() ){?>
				<div class="media-img">
					  <i class="fa fa-video"></i>
					</span>
					<?php the_post_thumbnail('thumb-videos', array('class' => 'img-responsive')); ?>
				</div>
			<?php } ?>
			<figcaption>
				<?php get_template_part('templates/entry-meta'); ?>
				<h3 class="tab-title"><?php the_title(); ?></h3>
			</figcaption>
		</a>
	</figure>
<?php } ?>
	<figure>
		<a title="" href="<?php echo get_post_format_link('video'); ?>">
			<div class="figure-thumb">
				<?php echo '<span class="formatCount">' . $objVideo->count . '+</span>'; ?>
				<img width="400" height="230" src="<?php echo bloginfo('template_url'); ?>/dist/images/video_gallery__thumb.png" class="img-responsive wp-post-image" alt="">
			</div>
			<figcaption>
				<time class="updated" datetime="">Ver</time>
				<h3 class="tab-title">Todos los videos</h3>
			</figcaption>
		</a>
	</figure>
</div>
<?php
// Restore original Post Data
wp_reset_postdata();
?>
