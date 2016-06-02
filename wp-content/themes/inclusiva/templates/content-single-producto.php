<?php while (have_posts()) : the_post(); ?>
	<?php //ACF FIelds
		$clasificacion = get_the_term_list( $post->ID, 'clasificacion', '', ',', '' );
		$marca = get_the_term_list( $post->ID, 'marca', '', ',', '' );
		$marca__no_link = strip_tags( $marca );
		

		$prod__precio = get_field( "prod__precio" );
		$prod__pres = get_field( "prod__pres" );
		$prod__envase = get_field( "prod__envase" );
		$prod__ben = get_field( "prod__ben" );
		$prod__otras_pres = get_field( "prod__otras_pres" );
		$prod__reg_sanit = get_field( "prod__reg_sanit" );
		$prod__vol_min = get_field( "prod__vol_min" );
		$prod__vol_max = get_field( "prod__vol_max" );
		$prod__ficha = get_field( "prod__ficha" );

		// load all 'category' terms for the post
		$productores__terms = get_the_terms( get_the_ID(), 'productor');
		$lugares__terms = get_the_terms( get_the_ID(), 'lugar');


		// we will use the first term to load ACF data from
		if( !empty($productores__terms) ) {
			
			$produ__term = array_pop($productores__terms);

			$produ__ruc = get_field('produ__ruc', $produ__term );
			$produ__rep_leg = get_field('produ__rep_leg', $produ__term );
			$produ__cont_com = get_field('produ__cont_com', $produ__term );
			$produ__correo = get_field('produ__correo', $produ__term );
			$produ__telef = get_field('produ__telef', $produ__term );
		}
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
			<h1 class="entry-title"><?php the_title(); ?> <?php if ($marca) echo $marca__no_link; ?></h1>
			<section class="producto__small">
			<ul class="list-inline">
				<li><?php echo '<h5>S/. '. $prod__precio . ' <small>' . $prod__pres . '</small></h5>'; ?></li>
				<li><?php echo '<p>Beneficia a '. $prod__ben . ' familias</p>'; ?></li>
			</ul>
			</section>
		</header>
		<div class="entry-content">
			<?php the_content(); ?>
			<p class="cta__container">
				<a class="btn btn-success btn-lg" href="#b" data-toggle="tab" aria-expanded="false"><i class="fa fa-paper-plane"></i> Quiero comprar</a>
			</p>
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
						<div class="panel-heading">
							<h4>Detalles del Producto</h4>
						</div>
						<div class="panel-body">
							<?php the_excerpt(); ?>
							<?php if ($prod__ficha) echo '<a href="' .$prod__ficha. '">Descargar ficha técnica</a>'; ?>
						</div>
						<table class="table table-striped table-responsive">
							<tbody>
							<?php if ($clasificacion) {?>
								<tr>
									<th scope="row">Clasificación</th>
									<td><?php echo $clasificacion ; ?></td>
								</tr>
							<?php } ?>
							<?php if ($marca) {?>
								<tr>
									<th scope="row">Marca</th>
									<td><?php echo $marca ; ?></td>
								</tr>
							<?php } ?>
							<?php if ($prod__reg_sanit) {?>
								<tr>
									<th scope="row">Registro Sanitario</th>
									<td><?php echo $prod__reg_sanit; ?></td>
								</tr>
							<?php } ?>
							<?php if ($prod__ben) {?>
								<tr>
									<th scope="row">Beneficiarios</th>
									<td><?php echo $prod__ben . ' familias'; ?></td>
								</tr>
							<?php } ?>
							<?php if ($prod__vol_min) {?>
								<tr>
									<th scope="row">Volumen mínimo de compra</th>
									<td><?php echo $prod__vol_min . ' familias'; ?></td>
								</tr>
							<?php } ?>
							<?php if ($prod__vol_max) {?>
								<tr>
									<th scope="row">Volumen máximo de compra</th>
									<td><?php echo $prod__vol_max . ' familias'; ?></td>
								</tr>
							<?php } ?>
							<?php if ($prod__envase) {?>
								<tr>
									<th scope="row">Tipo de envase</th>
									<td><?php echo $prod__envase; ?></td>
								</tr>
							<?php } ?>
							<?php if ($prod__otras_pres) {?>
								<tr>
									<th scope="row">Otras Presentaciones</th>
									<td><?php echo $prod__otras_pres; ?></td>
								</tr>
							<?php } ?>
							<?php if( !empty($lugares__terms) ) { $lugar__term = array_pop($lugares__terms);?>
								<tr>
									<th scope="row">Procedencia geográfica</th>
									<td><?php echo $lugar__term->name; ?></td>
								</tr>
							<?php } ?>
							</tbody> 
						</table>
					</div>
				</div>

				<div class="tab-pane" id="b">
					<div class="panel panel-default">
						<div class="panel-heading">
							<h4>Sobre el Productor</h4>
						</div>
						<div class="panel-body">
							<?php print_r( $produ__term->description ); ?>
						</div>
						<table class="table table-striped table-responsive">
							<tbody>
								<tr>
									<th scope="row">Productor/Empresa/Asociación</th>
									<td><?php echo '<a href="' . get_term_link($produ__term->term_id) . '">' . $produ__term->name . '</a>'; ?> <?php the_field('produ__rep_leg', 'camacho'); ?></td>
								</tr>
								<?php if($produ__ruc) {?>
								<tr>
									<th scope="row">RUC</th>
									<td><?php echo $produ__ruc; ?></td>
								</tr>
								<?php } ?>
								<?php if($produ__rep_leg) {?>
								<tr>
									<th scope="row">Representante Legal</th>
									<td><?php echo $produ__rep_leg; ?></td>
								</tr>
								<?php } ?>
								<?php if($produ__cont_com) {?>
								<tr>
									<th scope="row">Contacto Comercial</th>
									<td><?php echo $produ__cont_com; ?></td>
								</tr>
								<?php } ?>
								<?php if($produ__correo) {?>
								<tr>
									<th scope="row">Correo electrónico</th>
									<td><?php echo $produ__correo; ?></td>
								</tr>
								<?php } ?>
								<?php if($produ__telef) {?>
								<tr>
									<th scope="row">Teléfono</th>
									<td><?php echo $produ__telef; ?></td>
								</tr>
								<?php } ?>
							</tbody>
						</table>
					</div>
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