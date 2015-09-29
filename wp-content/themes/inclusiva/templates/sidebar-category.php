<?php 
	$cat = get_query_var('cat'); $get_cat = get_category ($cat); 
	$category_id = get_cat_ID( $get_cat->name );
	$category_link = get_category_link( $category_id );
	$category_name = $get_cat->name;
	$category_slug = $get_cat->slug;
	$category_id_agro_rural = get_cat_ID('AGRO RURAL');
?>

<?php if ( has_nav_menu( 'sede_'.$category_slug.'_navigation' ) ){ ?>
	<section class="widget">
		<h3>Menú de Navegación</h3>
		<?php wp_nav_menu(['theme_location' => 'sede_'.$category_slug.'_navigation', 'walker' => new wp_bootstrap_navwalker(), 'menu_class' => 'nav nav-sidebar']); ?>
	</section>
<?php }else{ ?>
	No hay menu
<?php } ?>

 <?php get_template_part('templates/widget', 'sedes'); ?>

<?php 

// Argumentos
$args  = array(
	'post_type' => 'Banners', 
	'posiciones' => 'Sidebar '.$category_name,
	'post_per_page' => -1
);
// the query
$the_query = new WP_Query( $args ); ?>

<?php if ( $the_query->have_posts() ) : ?>
	<section class="widget">
		<h3><?php _e( 'Anuncios' ); ?></h3>
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