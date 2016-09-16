<?php
/**
 * Month View Template
 * The wrapper template for month view.
 *
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/month.php
 *
 * @package TribeEventsCalendar
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
} ?>

<?php do_action( 'tribe_events_before_template' ) ?>
<!-- Banners Serviagro -->
<?php if( is_tax( 'tribe_events_cat', 'serviagro') ) { ?>
		<div class="wrapper">
			<div class="banner">
				<a href="https://issuu.com/serviagro/stacks/3b64c2c809e14c068f1bf043f4b786a9" target="_blank"><img src="<?php echo bloginfo('template_url'); ?>/dist/images/bn__serviagro.png" class="img-responsive" /></a>
			</div>
		</div>
<?php }	?>
<!-- Banners Serviagro -->
<!-- Tribe Bar -->
<?php tribe_get_template_part( 'modules/bar' ); ?>

<!-- Main Events Content -->
<?php tribe_get_template_part( 'month/content' ); ?>

<?php do_action( 'tribe_events_after_template' ) ?>
