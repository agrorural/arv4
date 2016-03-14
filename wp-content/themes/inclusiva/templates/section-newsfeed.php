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
				<?php 

				// Argumentos
				$args  = array(
					'post_type' => 'Banners', 
					'posiciones' => 'Sidebar Home Left',
					'post_per_page' => 5
				);
				// the query
				$the_query = new WP_Query( $args ); ?>

				<?php if ( $the_query->have_posts() ) : ?>

						<!-- pagination here -->

						<!-- the loop -->
						<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
							<?php // ACF 
								$banner__url = get_field('banner__url');
								$banner__txt = get_field('banner__txt'); 
							?>
								<section class="widget banner">
									<?php if ($banner__txt) {?>
										<figure class="shadow">
											<?php if ( has_post_thumbnail() ) { the_post_thumbnail('thumb-category-bn', array ( 'class' => 'img-responsive' ) ); } ?>
											<figcaption>
												<h4><a href="<?php if ($banner__url) { echo $banner__url; } else { echo bloginfo( 'url' ); } ?>"><?php the_title();?></a></h4>
												<p><?php the_content(); ?></p>
											</figcaption>
										</figure>
									<?php }else{ ?>
										<figure>
											<a href="<?php if ($banner__url) { echo $banner__url; } else { echo bloginfo( 'url' ); } ?>" target="_blank">
												<?php if ( has_post_thumbnail() ) { the_post_thumbnail('thumb-category-bn', array ( 'class' => 'img-responsive' ) ); } ?>
											</a>
										</figure>
									<?php } ?>
								</section>
						<?php endwhile; ?>
						<!-- end of the loop -->

						<!-- pagination here -->

						<?php wp_reset_postdata(); ?>
						
				<?php else : ?>
					<?php /* Silence is Golden */  ?>
				<?php endif; ?>	
			</aside>
			<aside class="sidebar banner">
				<?php 

				// Argumentos
				$args  = array(
					'post_type' => 'Banners', 
					'posiciones' => 'Sidebar Home Right',
					'post_per_page' => 5
				);
				// the query
				$the_query = new WP_Query( $args ); ?>

				<?php if ( $the_query->have_posts() ) : ?>

						<!-- pagination here -->

						<!-- the loop -->
						<?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
							<?php // ACF 
								$banner__url = get_field('banner__url');
								$banner__txt = get_field('banner__txt'); 
							?>
								<section class="widget banner">
									<?php if ($banner__txt) {?>
										<figure class="shadow">
											<?php if ( has_post_thumbnail() ) { the_post_thumbnail('thumb-category-bn', array ( 'class' => 'img-responsive' ) ); } ?>
											<figcaption>
												<h4><a href="<?php if ($banner__url) { echo $banner__url; } else { echo bloginfo( 'url' ); } ?>"><?php the_title();?></a></h4>
												<p><?php the_content(); ?></p>
											</figcaption>
										</figure>
									<?php }else{ ?>
										<figure>
											<a href="<?php if ($banner__url) { echo $banner__url; } else { echo bloginfo( 'url' ); } ?>" target="_blank">
												<?php if ( has_post_thumbnail() ) { the_post_thumbnail('thumb-category-bn', array ( 'class' => 'img-responsive' ) ); } ?>
											</a>
										</figure>
									<?php } ?>
								</section>
						<?php endwhile; ?>
						<!-- end of the loop -->

						<!-- pagination here -->

						<?php wp_reset_postdata(); ?>
						
				<?php else : ?>
					<?php /* Silence is Golden */  ?>
				<?php endif; ?>	
			</aside>
		</div>
	</div>
</section>