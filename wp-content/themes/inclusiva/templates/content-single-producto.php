<?php while (have_posts()) : the_post(); ?>
	<?php //ACF FIelds
		$terms = get_the_terms( get_the_ID(), 'productor');
		$term_list = get_the_term_list( $post->ID, 'productor', '', ',', '' );

		$prod__precio = get_field( "prod__precio" );
		$prod__pres = get_field( "prod__pres" );
		$prod__envase = get_field( "prod__envase" );
		$prod__ben = get_field( "prod__ben" );
	?>
<article <?php post_class(); ?>>
	<section class="producto__imagen">
		<a href="<?php the_permalink(); ?>">
			<?php if ( has_post_thumbnail() ){?>
				<?php the_post_thumbnail('full', array('class' => 'img-responsive')); ?>
			<?php } else { ?>
				<img src="http://lorempixel.com/415/500/people/3/" class="img-responsive" />
			<?php } ?>
		</a>
	</section>
	<section class="producto__descripcion">
		<header>
			<h1 class="entry-title"><?php the_title(); ?></h1>
			<section class="producto__small">
			<ul class="list-inline">
				<li><?php echo '<h5>S/. '. $prod__precio . ' <small>' . $prod__pres . '</small></h5>'; ?></li>
				<li><?php echo '<p>Beneficia a '. $prod__ben . ' familias</p>'; ?></li>
			</ul>
				
				
			</section>
		</header>
		<div class="entry-content">
			<?php the_content(); ?>
			<p class="cta__container"><a href="" class="btn btn-success btn-lg"><i class="fa fa-paper-plane"></i> Quiero comprar</a>
		</div>	
	</section>
	<section class="producto__detalles section">
		<!-- tabs top -->
		<div class="tabbable tabs-top">
			<ul class="nav nav-tabs">
				<li class="active"><a href="#a" data-toggle="tab">Sobre el Producto</a></li>
				<li><a href="#b" data-toggle="tab">Sobre el Productor</a></li>
			</ul>
			<div class="tab-content">
				<div class="tab-pane active" id="a">	
					<div class="panel panel-default">
						<div class="panel-heading"><h4>Detalles del Producto</h4></div>
						<div class="panel-body"><p>Some default panel content here. Nulla vitae elit libero, a pharetra augue. Aenean lacinia bibendum nulla sed consectetur. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum. Nullam id dolor id nibh ultricies vehicula ut id elit.</p></div>
						<table class="table">
							<thead>
								<tr>
									<th>#</th>
									<th>First Name</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<th scope="row">1</th>
									<td>Mark</td>
								</tr>
								<tr>
									<th scope="row">2</th>
									<td>Jacob</td> 
								</tr> 
							</tbody> 
						</table> 
					</div>
				</div>

				<div class="tab-pane" id="b">
				<h4>Detalles del Productor</h4>
					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cumque dolorem quae praesentium obcaecati veritatis nemo porro id eaque. Vero voluptatibus tempore quae. Perferendis error delectus maxime similique accusantium rerum amet.</p>					
				</div>
			</div>
		</div>
		<!-- /tabs -->
	</section>
	<hr>
	<footer>
		<?php wp_link_pages(['before' => '<nav class="page-nav"><p>' . __('Pages:', 'sage'), 'after' => '</p></nav>']); ?>
	</footer>

	<?php comments_template('/templates/comments.php'); ?>
</article>
<?php endwhile; ?>