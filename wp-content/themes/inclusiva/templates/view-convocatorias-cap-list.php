<?php
	//Globals
	global $paged;
	global $wp_query;
	$post__date = mysql2date("Y", $post->post_date_gmt);
?>
<nav id="navbar-scroll" class="navbar navbar-default navbar-static">
  <div class="container-fluid">
    <div class="navbar-header">
      <button class="navbar-toggle collapsed" type="button" data-toggle="collapse" data-target=".bs-example-js-navbar-scrollspy">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">Proyectos</a>
    </div>
    <div class="collapse navbar-collapse">
      <ul class="nav navbar-nav">
        <li class="active"><a href="#aliados-2">Aliados II</a></li>
        <li class=""><a href="#pipmirs">PIPMIRS</a></li>
        <li class=""><a href="#pssa">PSSA</a></li>
        <li class=""><a href="#ar-cap">CAP</a></li>
      </ul>
    </div>
  </div>
</nav>
<div data-spy="scroll" data-target="#navbar-scroll" data-offset="0" class="scrollspy-example" style="position: relative;
    height: 1000px;
    margin-top: 10px;
    overflow: auto;">
    <h4 id="aliados-2">Aliados II</h4>
		<?php
			$temp = $wp_query; 
			$wp_query = null; 
			$wp_query = new WP_Query(); 
			$wp_query->query('post_type=convocatorias&posts_per_page=-1&cat-convocatorias=ar-aliados-2&year='. $post__date .'&paged='.$paged);
			while ($wp_query->have_posts()) : $wp_query->the_post(); 
		?>

			<?php get_template_part('templates/content', 'convocatorias-list'); ?>

		<?php endwhile; ?>
		
		<?php 
		  $wp_query = null; 
		  $wp_query = $temp; 
		?>

	<h4 id="pipmirs">PIPMIRS</h4>
		<?php
			$temp = $wp_query; 
			$wp_query = null; 
			$wp_query = new WP_Query(); 
			$wp_query->query('post_type=convocatorias&posts_per_page=-1&cat-convocatorias=ar-pipmirs&year='. $post__date .'&paged='.$paged);
			while ($wp_query->have_posts()) : $wp_query->the_post(); 
		?>

			<?php get_template_part('templates/content', 'convocatorias-list'); ?>

		<?php endwhile; ?>

		<?php 
			$wp_query = null; 
			$wp_query = $temp; 
		?>

	<h4 id="pssa">PSSA</h4>
		<?php
			$temp = $wp_query; 
			$wp_query = null; 
			$wp_query = new WP_Query(); 
			$wp_query->query('post_type=convocatorias&posts_per_page=-1&cat-convocatorias=ar-pssa&year='. $post__date .'&paged='.$paged);
			while ($wp_query->have_posts()) : $wp_query->the_post(); 
		?>

			<?php get_template_part('templates/content', 'convocatorias-list'); ?>

		<?php endwhile; ?>

		<?php 
			$wp_query = null; 
			$wp_query = $temp; 
		?>

	<h4 id="ar-cap">CAP</h4>
		<?php
			$temp = $wp_query; 
			$wp_query = null; 
			$wp_query = new WP_Query(); 
			$wp_query->query('post_type=convocatorias&posts_per_page=-1&cat-convocatorias=ar-728&year='. $post__date .'&paged='.$paged);
			while ($wp_query->have_posts()) : $wp_query->the_post(); 
		?>

			<?php get_template_part('templates/content', 'convocatorias-list'); ?>

		<?php endwhile; ?>

		<?php 
			$wp_query = null; 
			$wp_query = $temp; 
		?>
</div>