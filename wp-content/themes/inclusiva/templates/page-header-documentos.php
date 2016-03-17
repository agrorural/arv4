<?php use Roots\Sage\Titles; ?>
<?php global $post; ?>
<?php $term_list = wp_get_post_terms($post->ID, 'tipos', array("fields" => "all")); ?>
<?php $term_name = $term_list[0]->name; ?>
<div class="page-header">
	<h1><?php echo $term_name; ?></h1>
</div>
