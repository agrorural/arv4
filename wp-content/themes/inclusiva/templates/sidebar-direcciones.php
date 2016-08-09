<?php  
global $wp_query;
	$the__title = $wp_query->post->post_title;

	$page__root = get_page_by_title( $the__title, OBJECT, 'directorios' );
	$dir_responsable = get_field('dir_responsable', $page__root->ID);

	//echo '<pre>';
	//var_dump($page__root->ID);
	//echo '</pre>';

?>
<?php if( $dir_responsable ) { ?>
<section class="widget responsables">
	<h3>Responsable</h3>
	<ul class="plain">
		<?php echo '<li><p>'.$dir_responsable.'</p></li>'; ?>
	</ul>
</section>
<?php } ?>