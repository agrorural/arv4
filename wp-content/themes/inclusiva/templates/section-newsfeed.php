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
				
			</aside>
		</div>
	</div>
</section>