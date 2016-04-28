<?php
	// ACF Archive Page
	$doc__tipo = get_field('doc__tipo');
	$term = get_term( $doc__tipo, 'tipos' );
	$term__name = $term->name;
	$post__date = mysql2date("Y", $post->post_date_gmt);
	global $paged;
	global $wp_query;
	$temp = $wp_query; 
	$wp_query = null; 
	$wp_query = new WP_Query(); 
	$wp_query->query('post_type=documentos&posts_per_page=10&year='.$post__date.'&tipos='. $term__name .'&paged='.$paged);
	while ($wp_query->have_posts()) : $wp_query->the_post(); 
?>
<?php if ($term__name && $term__name == 'Directivas'){ ?>
	<?php get_template_part('templates/content', 'documentos-directivas'); ?>
<?php } else if ($term__name && $term__name == 'PAC'){ ?>
	<?php get_template_part('templates/content', 'documentos-pac'); ?>
<?php } else { ?>
	<?php get_template_part('templates/content', 'documentos-list'); ?>
<?php } ?>
<?php endwhile; ?>

    <?php wp_pagenavi(); ?>

<?php 
  $wp_query = null; 
  $wp_query = $temp; 
?>