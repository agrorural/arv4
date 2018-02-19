<?php
	global $paged;
	global $wp_query;
	$temp = $wp_query; 
	$wp_query = null; 
	$wp_query = new WP_Query();
	$args = array( 
		'post_type' => 'directorios',
		'posts_per_page' => -1,
		'orderby' => 'menu_order title',
		'order' => 'ASC',
		'paged' => $paged
	);
	$wp_query->query($args);
	$group = "";
	?>

	<?php while ($wp_query->have_posts()) : $wp_query->the_post(); ?>

		<?php 
			$terms = wp_get_object_terms($post->ID, 'grupos');
			$tempTerm = $terms[0]->name;
			$loopTerm = $terms[0]->name;
			$loopSlug = $terms[0]->slug;

			if( $tempTerm!== $group && $group !== ""){
				echo '</div>';
			}
			if( $group !== $loopTerm ){
				echo '<h3 class="ap__list__title">';
				echo '<a role="button" data-toggle="collapse" data-parent="#accordion" href="#'.$loopSlug.'" aria-expanded="true" aria-controls="' .$loopSlug. '">';
				echo $loopTerm;
				echo '</a>';
				echo '</h3>';
				echo '<div id="'.$loopSlug.'" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="'.$loopSlug.'">';
				$group = $loopTerm;
			}
			
			get_template_part('templates/content', 'directorios-list'); 
			
		?>

	<?php endwhile; ?>

<?php 
  $wp_query = null; 
  $wp_query = $temp; 
?>