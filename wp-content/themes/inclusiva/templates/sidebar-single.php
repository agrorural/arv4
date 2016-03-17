<section class="widget">
<h3>Noticias relacionadas</h3>
<ul class="related-posts">
<?php
        $orig_post = $post;
        global $post;
        $tags = wp_get_post_tags($post->ID);
        
        if ($tags) {
	        $tag_ids = array();
	        foreach($tags as $individual_tag) $tag_ids[] = $individual_tag->term_id;
	        $args=array(
	        'tag__in' => $tag_ids,
	        'post__not_in' => array($post->ID),
	        'posts_per_page'=>5, // Número de entradas relacionadas a mostrar.
	        'ignore_sticky_posts'=>1
	        );
	        
	        $my_query = new wp_query( $args );

	        while( $my_query->have_posts() ) {
	        $my_query->the_post();
	        ?>
	        
	        <li class="">
				<?php get_template_part('templates/entry-meta'); ?>
				<a rel="external" href="<?php the_permalink()?>">
				<?php the_title(); ?>
				</a>
	        </li>
	        
	        <?php } ?>
        <?php }else{ ?>
        <li><p>No hay noticias relacionadas</p></li>
        <?php } ?>
        <?php $post = $orig_post;
        wp_reset_query();
?>
</ul>
</section>