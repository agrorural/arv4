<section class="section section__category-feed">



				<div class="page-header">	
					<h3>Noticias</h3>
				</div>
				<?php if (!have_posts()) : ?>
				  <div class="alert alert-warning">
				    <?php _e('Sorry, no results were found.', 'sage'); ?>
				  </div>
				  <?php get_search_form(); ?>
				<?php endif; ?>

				<?php while (have_posts()) : the_post(); ?>
				  <?php get_template_part('templates/content', 'category'); ?>
				<?php endwhile; ?>

				<?php the_posts_navigation(); ?>


</section>