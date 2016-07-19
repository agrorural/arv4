<?php get_template_part('templates/section', 'producto-clasificacion-starred'); ?>
<?php if (is_tax()) {?>
	<?php
		global $paged;
		global $wp_query;
		$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );
		$tax = $term->taxonomy;
		$term_name = $term->name;
		$temp = $wp_query; 
		$wp_query = null; 
		$wp_query = new WP_Query(); 
		$wp_query->query('post_type=producto&'.$tax.'='.$term_name.'&posts_per_page=12&paged='.$paged);
		while ($wp_query->have_posts()) : $wp_query->the_post(); 
	?>
	  <?php get_template_part('templates/content', 'producto'); ?>
	<?php endwhile; ?>

	<?php wp_pagenavi(); ?>

	<?php 
	  $wp_query = null; 
	  $wp_query = $temp; 
	?>
<?php }else{ ?>
	<?php
		global $paged;
		global $wp_query;
		$temp = $wp_query; 
		$wp_query = null; 
		$wp_query = new WP_Query(); 
		$wp_query->query('post_type=producto&posts_per_page=12&paged='.$paged);
		while ($wp_query->have_posts()) : $wp_query->the_post(); 
		?>
		<?php get_template_part('templates/content', 'producto'); ?>
		<?php endwhile; ?>

	<?php wp_pagenavi(); ?>

	<?php 
		$wp_query = null; 
		$wp_query = $temp; 
	?>
<?php } ?>