<?php 
	// ACF 
	global $post;
	$banner__url = get_field('banner__url'); 
	$banner__txt = get_field('banner__txt'); 
	$banner__btn_title = get_field('banner__btn_title');
	$banner__ht = get_field('banner__ht');
	$banner__ht_url = get_field('banner__ht_url');
	$hoy = date( 'Ymd', current_time( 'timestamp', 1 ));
	$banner__vig = get_field('banner__vig');

	if ( $banner__vig && intval ( $banner__vig ) <= intval( $hoy ) ){
        change_post_status( $post->ID, 'draft' );
    }	
?>
         
<!-- Modal -->
<div class="modal fade" id="fontPageModal" tabindex="-1" role="dialog" aria-labelledby="fontPageModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    <?php if ($banner__txt) {?>
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title"><?php the_title(); ?></h4>
		</div>
		<div class="modal-body">
			<?php the_content(); ?>
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-default ctaNotShowAgain" data-dismiss="modal">Cerrar</button>
			<?php if( $banner__url ){ ?>
				<a href="<?php echo $banner__url; ?>" class="btn btn-primary"><?php if( $banner__btn_title ) echo $banner__btn_title; else echo "Más información"; ?></a>
			<?php } ?>
		</div>
	<?php }else{ ?>
		<div class="modal-body banner-only">
	        <figure>
	        	<button type="button" class="close btn btn-default" data-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i></button>
				<?php if ( has_post_thumbnail() ) { ?>
					<?php $url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) ); ?>
					<?php if ($banner__url){ ?>
						<a href="<?php echo $banner__url; ?>" title="<?php the_title(); ?>" target="_blank">
							<img src="<?php echo $url; ?>" class="img-responsive" alt="">
						</a>
					<?php }?>
				<?php } ?>
			</figure>
	      </div>
	<?php } ?>
    </div>
  </div>
</div>