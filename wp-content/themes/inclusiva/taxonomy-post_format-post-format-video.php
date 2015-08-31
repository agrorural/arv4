<?php if (!have_posts()) : ?>
  <div class="alert alert-warning">
    <?php _e('Sorry, no results were found.', 'sage'); ?>
  </div>
  <?php get_search_form(); ?>
<?php endif; ?>

<?php
	$paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1; 

	$args = array(
		'post_type' => 'post',
		'tax_query' => array(
			array(
				'taxonomy' => 'post_format',
				'field'    => 'slug',
				'terms'    => array( 'post-format-video' ),
			)
		),
		'posts_per_page' => 1,
		'paged' => $paged

	);
?>

<?php $my_query = new WP_Query( $args );
while ( $my_query->have_posts() ) : $my_query->the_post();
$do_not_duplicate = $post->ID; ?>
	<?php get_template_part('templates/content', 'video-one'); ?>
<?php endwhile; ?>

<?php $count = 0; ?>

<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); 
if ( $post->ID == $do_not_duplicate ) continue; ?>
	<?php get_template_part('templates/content', 'video');  $count++; ?>
<?php endwhile; endif; ?>

<?php wp_pagenavi(); ?>