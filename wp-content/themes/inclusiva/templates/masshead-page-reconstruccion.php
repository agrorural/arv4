<?php use Roots\Sage\Titles; ?>

<?php
	global $post;
	$upload_dir = wp_upload_dir();
	$default_masshead_uri = $upload_dir['baseurl'].'/2013/11/masshead-sierra-sur.jpg';
?>
<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full', false ); ?>
<div class="masshead" style="background: url('<?php echo $image[0]; ?>')  no-repeat top left; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover;">
    <div class="container">
        <?php get_template_part('templates/page','header-reconstruccion'); ?>
    </div>
</div>
