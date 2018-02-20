<section class="section newsfeed">
	<div class="wrap container" role="document">
		<div class="content row">
			<main class="multimedia">
				<div class="page-header">	
				<h3>Noticias <small><a href="<?php echo bloginfo( 'url' ); ?>/noticias" class="">Ver todas <span class="icon long-arrow-right"></span></a></small></h3>
				</div>
				<div class="media-list">
					<?php get_template_part('templates/view', 'news-list'); ?>
				</div>
			</main>
			<aside class="sidebar eventos">
				<p><a href="<?php echo bloginfo('url'); ?>/la-peruanisima/"><img src="<?php echo bloginfo('url'); ?>/wp-content/uploads/2018/02/la_peruanisima__banner-2.jpg" alt="" class="img-responsive"></a></p>
				<p><a href="<?php echo bloginfo('url'); ?>/reconstruccion-con-cambios/"><img src="<?php echo  get_template_directory_uri(); ?>/dist/images/banner__reconstruccion_3.jpg" alt="" class="img-responsive"></a></p>
				
				<div class="page-header">	
					<h3>Eventos <small><a href="<?php echo bloginfo( 'url' ); ?>/eventos" class="">Ver todos <span class="icon long-arrow-right"></span></a></small></h3>
				</div>
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
								$banner__pop = get_field('banner__pop');
								//var_dump($banner__pop);
								$hoy = date( 'Ymd', current_time( 'timestamp', 1 ));
								$banner__vig = get_field('banner__vig');
								$content = esc_attr(get_the_content());

								if ( $banner__vig && (intval ( $banner__vig ) < intval( $hoy )) ){
							        change_post_status( $post->ID, 'draft' ); 
							    } 
							?>
								<section class="widget">
									<figure>
										<?php if ($banner__pop) {?>
											<a tabindex="0" class="" role="button" data-toggle="popover" data-placement="top" title="<?php the_title_attribute(); ?>" data-content="<?php echo $content; ?>">
										<?php }else{ ?>
											<a href="<?php if ($banner__url) { echo $banner__url; } else { echo bloginfo( 'url' ); } ?>">
										<?php } ?>
											<?php if ( has_post_thumbnail() ) { the_post_thumbnail('thumb-category-bn', array ( 'class' => 'img-responsive' ) ); } ?>
										</a>
									</figure>
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
								$banner__pop = get_field('banner__pop');
								//var_dump($banner__pop);
								$hoy = date( 'Ymd', current_time( 'timestamp', 1 ));
								$banner__vig = get_field('banner__vig');
								$content = esc_attr(get_the_content());

								if ( $banner__vig && intval ( $banner__vig ) <= intval( $hoy ) ){
							        change_post_status( $post->ID, 'draft' );
							    } 
							?>
								<section class="widget">
									<figure>
										<?php if ($banner__pop) {?>
											<a tabindex="0" class="" role="button" data-toggle="popover" data-placement="top" title="<?php the_title_attribute(); ?>" data-content="<?php echo $content; ?>">
										<?php }else{ ?>
											<a href="<?php if ($banner__url) { echo $banner__url; } else { echo bloginfo( 'url' ); } ?>">
										<?php } ?>
											<?php if ( has_post_thumbnail() ) { the_post_thumbnail('thumb-category-bn', array ( 'class' => 'img-responsive' ) ); } ?>
										</a>
									</figure>
								</section>
						<?php endwhile; ?>
						<!-- end of the loop -->

						<!-- pagination here -->

						<?php wp_reset_postdata(); ?>
				<?php endif; ?>	
			</aside>
		</div>
	</div>
</section>