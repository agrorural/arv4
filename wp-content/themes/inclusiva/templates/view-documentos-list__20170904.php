<?php
	// ACF Archive Page
	$doc__tipo = get_field('doc__tipo');
	$term = get_term( $doc__tipo, 'tipos' );
	$term__slug = $term->slug;
	$post__date = mysql2date("Y", $post->post_date_gmt);
	global $paged;
	global $wp_query;
	$temp = $wp_query;
	$wp_query = null;
	$wp_query = new WP_Query();
	$wp_query->query('post_type=documentos&posts_per_page=10&year='.$post__date.'&tipos='. $term->slug .'&paged='.$paged);
	while ($wp_query->have_posts()) : $wp_query->the_post();
?>
<?php if ($term__slug && $term__slug == 'directivas'){ ?>
	<?php get_template_part('templates/content', 'documentos-directivas'); ?>
<?php } else if ($term__slug && $term__slug == 'pac'){ ?>
	<?php get_template_part('templates/content', 'documentos-pac'); ?>
<?php } else if ($term__slug && $term__slug == 'rde'){ ?>
	<?php get_template_part('templates/content', 'documentos-rde'); ?>
<?php } else if ($term__slug && $term__slug == 'rda'){ ?>
		<?php get_template_part('templates/content', 'documentos-rda'); ?>
<?php } else if ($term__slug && $term__slug == 'rdc'){ ?>
		<?php get_template_part('templates/content', 'documentos-rdc'); ?>
<?php } else { ?>
	<?php get_template_part('templates/content', 'documentos-list'); ?>
<?php } ?>
<?php endwhile; ?>

    <?php wp_pagenavi(); ?>

<?php
  $wp_query = null;
  $wp_query = $temp;
?>
