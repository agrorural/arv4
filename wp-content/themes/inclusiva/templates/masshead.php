<?php use Roots\Sage\Titles; ?>

<?php
	global $post;
	$upload_dir = wp_upload_dir();
	$default_masshead_uri = $upload_dir['baseurl'].'/2013/11/masshead-sierra-sur.jpg';
?>

<?php if ( !is_404() && has_post_thumbnail( $post->ID ) ){ ?>
    <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full', false ); ?>
  	<div class="masshead" style="background: url('<?php echo $image[0]; ?>')  no-repeat top left; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover;">
<?php } else if (is_page('Contacto')) { ?>
	<div class="masshead page">
		<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15605.896965231093!2d-77.0425728!3d-12.0796521!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x6f311078be8946fa!2sAGRO+RURAL!5e0!3m2!1ses-419!2spe!4v1443559449840" width="100%" height="300" frameborder="0" style="border:0" allowfullscreen></iframe>
<?php }else{?>
  	<div class="masshead servicios" style="background: url('<?php echo $default_masshead_uri; ?>')  no-repeat top left; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover;">
<?php } ?>
	<div class="container">
		<?php if ( is_page_template('template-noticias.php') ) { ?>
			<?php get_template_part('templates/page','header-noticias'); ?>
		<?php } else if ( is_post_type_archive('servicios') ) { ?>
			<?php get_template_part('templates/page','header-servicios'); ?>
		<?php } else if ( is_post_type_archive('producto') ) { ?>
			<?php get_template_part('templates/page','header-producto'); ?>
		<?php } else if ( is_post_type_archive('tribe_events') || is_singular('tribe_events') ) { ?>
      		<?php get_template_part('templates/page', 'header-events'); ?>
      	<?php } else if ( is_category() ) { ?>
      		<?php get_template_part('templates/page', 'header-category'); ?>
		<?php } else if( is_tax( 'post_format', 'post-format-gallery' ) ){ ?>
			<?php get_template_part('templates/page', 'header-gallery'); ?>
		<?php } else if( is_tax( 'post_format', 'post-format-video' ) ){ ?>
			<?php get_template_part('templates/page', 'header-video'); ?>
		<?php } else if( is_tax( 'post_format', 'post-format-link' ) ){ ?>
			<?php get_template_part('templates/page', 'header-link'); ?>
		<?php } else if( is_search() ){ ?>
			<?php get_template_part('templates/page', 'header-search'); ?>
		<?php } else if(is_singular()){ ?>
			<?php get_template_part('templates/page-header', get_post_type() != 'post' ? get_post_type() : get_post_format()); ?>
		<?php } else if(is_page()){ ?>
			<?php get_template_part('templates/page','header'); ?>
		<?php } else { ?>
			<?php get_template_part('templates/page','header'); ?>
		<?php } ?>
		</div>
  </div>
