<?php  
	global $wp_query;

	$cat = get_query_var('cat'); 
	$get_cat = get_category ($cat); 
	$category_name = $get_cat->name;
	$the__title = $category_name;
	$page__root = get_page_by_title( $the__title, OBJECT, 'directorios' );
	$dir_responsable = get_field('dir_responsable', $page__root->ID);

?>
<?php if( $dir_responsable ) { ?>
<section class="widget responsables">
	<h3>Responsable</h3>
	<ul class="plain">
		<?php echo '<li><p>'.$dir_responsable.'</p></li>'; ?>
	</ul>
</section>
<?php } ?>