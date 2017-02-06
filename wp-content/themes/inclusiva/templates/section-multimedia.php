<section class="section multimedia__banner">
	<div class="wrap container" role="document">
		<div class="content row">
			<main class="multimedia">
				<div class="page-header">	
				<h3>Multimedia</h3>
				</div>
				<!-- tabs left -->
				<div class="tabbable tabs-left">
					<ul class="nav nav-tabs">
						<li class="active"><a href="#a" data-toggle="tab"><i class="fa fa-youtube-play visible-xs"></i> <span class="hidden-xs">Videos</span></a></li>
						<li><a href="#b" data-toggle="tab"><i class="fa fa-file-image-o visible-xs"></i></i> <span class="hidden-xs">Fotos</span></a></li>
					</ul>
					<div class="tab-content">
						<div class="tab-pane active" id="a">
							<?php get_template_part('templates/tab', 'video'); ?>
						</div>

						<div class="tab-pane" id="b">
							<?php get_template_part('templates/tab', 'gallery'); ?>
						</div>
					</div>
				</div>
				<!-- /tabs -->
			</main>
		</div>
	</div>
</section>