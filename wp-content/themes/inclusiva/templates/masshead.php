<?php use Roots\Sage\Titles; ?>

<?php  global $post; ?>

<?php if ( !is_404() && has_post_thumbnail( $post->ID ) ){ ?>
    <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full', false ); ?>
  	<div class="masshead" style="background: url('<?php echo $image[0]; ?>')  no-repeat top left; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover;">
<?php } else { ?>
  	<div class="masshead">
<?php } ?>
	<div class="container">
		<?php if ( is_page_template('template-noticias.php') ) { ?>
			<?php get_template_part('templates/page','header-noticias'); ?>
		<?php } else if ( is_post_type_archive('servicios') ) { ?>
			<?php get_template_part('templates/page','header-servicios'); ?>
		<?php } else if ( is_post_type_archive('tribe_events') || is_singular('tribe_events') ) { ?>
      		<?php get_template_part('templates/page', 'header-events'); ?>
		<?php } else if( is_tax( 'post_format', 'post-format-gallery' ) ){ ?>
			<?php get_template_part('templates/page', 'header-gallery'); ?>
		<?php } else if( is_tax( 'post_format', 'post-format-video' ) ){ ?>
			<?php get_template_part('templates/page', 'header-video'); ?>
		<?php } else if( is_tax( 'post_format', 'post-format-link' ) ){ ?>
			<?php get_template_part('templates/page', 'header-link'); ?>
		<?php } else if(is_singular()){ ?>
			<?php get_template_part('templates/page-header', get_post_type() != 'post' ? get_post_type() : get_post_format()); ?>
		<?php } else if(is_page()){ ?>
			<?php get_template_part('templates/page','header'); ?>
		<?php } else { ?>
			<?php get_template_part('templates/page','header'); ?>
		<?php } ?>
	</div>
  </div>
    