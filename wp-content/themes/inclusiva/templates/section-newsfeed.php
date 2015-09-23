<section class="section newsfeed">
	<div class="wrap container" role="document">
		<div class="content row">
			<main class="multimedia">
				<div class="page-header">	
				<h3>Noticias</h3>
				</div>
				<?php get_template_part('templates/view', 'news-list'); ?>
			</main>
			<aside class="sidebar eventos">
				<?php dynamic_sidebar('sidebar-events'); ?>
			</aside>
			<aside class="sidebar banner">
				<?php 

				// Argumentos
				$args  = array(
					'post_type' => 'Banners', 
					'posiciones' => 'Sidebar Home 1',
					'post_per_page' => -1
				);
				// the query
				$the_query = new WP_Query( $args ); ?>

				<?php if ( $the_query->have_posts() ) : ?>
					<section class="widget">
						<div class="owl-carousel sb__category">

						<!-- pagination here -->

						<!-- the loop -->
						<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
							<?php // ACF 
								$banner__url = get_field('banner__url'); 
							?>
							<figure class="item">			
								<?php if ( has_post_thumbnail() ) { the_post_thumbnail('thumb-category-bn', array ( 'class' => 'img-responsive' ) ); } ?>

								<figcaption>
									<h4><a href="<?php if ($banner__url) { echo $banner__url; } else { echo bloginfo( 'url' ); } ?>" target="_blank"><?php the_title();?></a></h4>
									<p><?php the_content(); ?></p>
								</figcaption>
							
							</figure>
						<?php endwhile; ?>
						<!-- end of the loop -->

						<!-- pagination here -->

						<?php wp_reset_postdata(); ?>
						</div>
					</section>
				<?php else : ?>
					<?php /* Silence is Golden */  ?>
				<?php endif; ?>

				<?php 

				// Argumentos
				$args  = array(
					'post_type' => 'Banners', 
					'posiciones' => 'Sidebar Home 2',
					'post_per_page' => -1
				);
				// the query
				$the_query = new WP_Query( $args ); ?>

				<?php if ( $the_query->have_posts() ) : ?>
					<section class="widget">
						<div class="owl-carousel sb__category">

						<!-- pagination here -->

						<!-- the loop -->
						<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
							<?php // ACF 
								$banner__url = get_field('banner__url'); 
							?>
							<figure class="item">			
								<?php if ( has_post_thumbnail() ) { the_post_thumbnail('thumb-category-bn', array ( 'class' => 'img-responsive' ) ); } ?>

								<figcaption>
									<h4><a href="<?php if ($banner__url) { echo $banner__url; } else { echo bloginfo( 'url' ); } ?>" target="_blank"><?php the_title();?></a></h4>
									<p><?php the_content(); ?></p>
								</figcaption>
							
							</figure>
						<?php endwhile; ?>
						<!-- end of the loop -->

						<!-- pagination here -->

						<?php wp_reset_postdata(); ?>
						</div>
					</section>
				<?php else : ?>
					<?php /* Silence is Golden */  ?>
				<?php endif; ?>
			</aside>
		</div>
	</div>
</section>