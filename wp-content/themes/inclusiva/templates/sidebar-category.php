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

	<section class="widget">
		<?php $category_list_args = array(
			'show_option_all'    => 'Seleccionar',
			'show_option_none'   => '',
			'option_none_value'  => '-1',
			'orderby'            => 'ID', 
			'order'              => 'ASC',
			'show_count'         => 0,
			'hide_empty'         => 1, 
			'child_of'           => 0,
			'exclude'            => $category_id_agro_rural,
			'echo'               => 1,
			'selected'           => 0,
			'hierarchical'       => 0, 
			'name'               => 'cat',
			'id'                 => '',
			'class'              => 'postform form-control',
			'depth'              => 0,
			'tab_index'          => 0,
			'taxonomy'           => 'category',
			'hide_if_empty'      => false,
			'value_field'	     => 'term_id',	
		); ?>
		<h3><?php _e( 'Otras Sedes' ); ?></h3>
		
		<form id="category-select" class="category-select" action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get">
			<div class="input-group">
				<?php wp_dropdown_categories( $category_list_args ); ?> 
				<span class="input-group-btn">
					<input type="submit" class="btn btn-default" name="submit" value="Ir" />
				</span>
			</div>
		</form>
	</section>

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