<?php while (have_posts()) : the_post(); ?>
	<?php
		$rde_link = get_field('rde_link');
		$upload_dir = wp_upload_dir();
		$dir = $upload_dir["baseurl"];

		$term_list = wp_get_post_terms($post->ID, 'tipos', array("fields" => "all"));
		$post__slug = $post->post_name;
		$post__slug__up = strtoupper($post__slug);

    	$count = count($term_list);

    	//echo '<pre>';
    	//var_dump($count);
    	//echo '</pre>';
		if($term_list[0]->slug == 'at'){
			$pa__at__1 = get_field_object('pa__at__1');
			$pa__at__2 = get_field_object('pa__at__2');
			$pa__at__3 = get_field_object('pa__at__3');
			$pa__at__3_1 = get_field_object('pa__at__3_1');
			$pa__at__3_1__choices = $pa__at__3_1['choices'];
			$pa__at__3_1__values = $pa__at__3_1['value'];
			echo '<pre>';
			//var_dump($pa__at__3_1);
				var_dump($pa__at__3_1__choices);
				var_dump($pa__at__3_1__values);

			echo '</pre>';

			for ($i=0; $i < count($pa__at__3_1__values); $i++) {
				echo '<li>'. $pa__at__3_1__values[$i] .'</li>';
			}
		}



	?>



  <article <?php post_class(); ?>>
    <header>
      <h1 class="entry-title"><?php the_title(); ?></h1>
      <?php get_template_part('templates/entry-meta'); ?>
      <hr />
    </header>
    <div class="entry-content">
      <?php the_content(); ?>
			<?php if($term_list[0]->slug == 'at') : ?>
				<ul class="fa-ul">
					<li>
						<i class="fa-li fa fa<?php if($pa__at__1["label"] == true) echo '-check'; ?>-square"></i>
						<?php echo $pa__at__1["label"]; ?>
					</li>
					<li>
						<i class="fa-li fa fa<?php if($pa__at__2["label"] == true) echo '-check'; ?>-square"></i>
						<?php echo $pa__at__2["label"]; ?>
					</li>
					<li>
						<i class="fa-li fa fa<?php if($pa__at__3["label"] == true) echo '-check'; ?>-square"></i>
						<?php echo $pa__at__3["label"]; ?>
					</li>
					<li>

					</li>
				</ul>
			<?php endif; ?>
    </div>
    <footer>
      <?php if($rde_link == 'Publicado') {?>
        <?php if ( $count > 1 ) { ?>
        	<?php if ( $term_list[0]->slug == 'pac' || $term_list[0]->slug == 'cds' ) { ?>
          		<a class="cta__link" href="<?php echo $dir.'/transparencia/documentos/rda/'.$post__slug__up.'.PDF'; ?>"><i class="fa fa-file-o"></i> Descargar archivo</a>
          	<?php }else{?>
          		<a class="cta__link" href="<?php echo $dir.'/transparencia/documentos/rde/'.$post__slug__up.'.PDF'; ?>"><i class="fa fa-file-o"></i> Descargar archivo 
							<?php if( have_rows('agregar_documentos') ): ?>
							(Resolución)
							<?php endif; ?>
							</a>
          	<?php } ?>
        <?php }else{ ?>
          <a class="cta__link" href="<?php echo $dir.'/transparencia/documentos/'.$term_list[0]->slug.'/'.$post__slug__up.'.PDF'; ?>"><i class="fa fa-file-o"></i> Descargar archivo</a>
        <?php } ?>

						<?php if( have_rows('agregar_documentos') ): ?>


							<?php while( have_rows('agregar_documentos') ): the_row(); 

								// vars
								$link = get_sub_field('url_doc_extra');
								$title = get_sub_field('name_doc_extra');

								?>

								<div class="slide">
										<a class="cta__link" href="<?php echo $link; ?>"><i class="fa fa-file-o"></i> Descargar archivo (<?php echo $title; ?> )</a>
								</div>

							<?php endwhile; ?>



						<?php endif; ?>


      <?php }else{ ?>
        <p>No Disponible</p>
      <?php } ?>



    </footer>
    <?php comments_template('/templates/comments.php'); ?>
  </article>
<?php endwhile; ?>
