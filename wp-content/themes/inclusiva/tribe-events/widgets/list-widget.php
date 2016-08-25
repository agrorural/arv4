<?php
/**
 * Events List Widget Template
 * This is the template for the output of the events list widget.
 * All the items are turned on and off through the widget admin.
 * There is currently no default styling, which is needed.
 *
 * This view contains the filters required to create an effective events list widget view.
 *
 * You can recreate an ENTIRELY new events list widget view by doing a template override,
 * and placing a list-widget.php file in a tribe-events/widgets/ directory
 * within your theme directory, which will override the /views/widgets/list-widget.php.
 *
 * You can use any or all filters included in this file or create your own filters in
 * your functions.php. In order to modify or extend a single filter, please see our
 * readme on templates hooks and filters (TO-DO)
 *
 * @return string
 *
 * @package TribeEventsCalendar
 *
 */
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

$events_label_plural = tribe_get_event_label_plural();

$posts = tribe_get_list_widget_events();

// Check if any event posts are found.
if ( $posts ) : ?>

	<ol class="hfeed vcalendar media-list">
		<?php
		// Setup the post data for each event.
		foreach ( $posts as $post ) :
			setup_postdata( $post );
			?>
			<li class="tribe-events-list-widget-events media <?php tribe_events_event_classes() ?>">

				<div class="media-left">
					<div class="event-date">
					<?php 
						$event__date__month = tribe_get_start_date ( $post->ID, false, 'M' ); //var_dump($event__date__month);
						$event__date__day = tribe_get_start_date ( $post->ID, false, 'd' ); //var_dump($event__date__day); 
						$event__date__hour = tribe_get_start_date ( $post->ID, true, 'H:i a' ); //var_dump($event__date__hour); 
					?>
						<div class="date-month"><?php echo $event__date__month; ?></div>
						<div class="date-day"><?php echo $event__date__day; ?></div>
					</div>
				</div>
				
				<div class="media-body">
					<?php do_action( 'tribe_events_list_widget_before_the_event_title' ); ?>
					<!-- Event Title -->
					<h4 class="entry-title summary">
						<a href="<?php echo esc_url( tribe_get_event_link() ); ?>" rel="bookmark"><?php the_title(); ?></a>
					</h4>

					<?php do_action( 'tribe_events_list_widget_after_the_event_title' ); ?>
					<!-- Event Time -->

					<?php do_action( 'tribe_events_list_widget_before_the_meta' ) ?>

					<div class="duration">
						<?php 
							$event__venue = tribe_get_venue ( $post->ID ); //var_dump($event__venue);
							$all_day = tribe_event_is_all_day();					
						?>
						<time>
							<?php if ( $all_day ) {
								echo 'Todo el día'; 
							} else {
								echo $event__date__hour; 
							} ?>
							<?php echo ' @ ' . $event__venue; ?>
						</time>
						<?php /*echo tribe_events_event_schedule_details(); */?>
					</div>
					<?php do_action( 'tribe_events_list_widget_after_the_meta' ) ?>
				</div>
			</li>
		<?php
		endforeach;
		?>
	</ol><!-- .hfeed -->
<?php /*
	<p class="tribe-events-widget-link cta__container">
		<a class="cta__link" href="<?php echo esc_url( tribe_get_events_link() ); ?>" rel="bookmark"><?php printf( __( 'Ver Todos los Eventos' ), '' ); ?></a>
	</p>
*/ ?>
<?php
// No events were found.
else : ?>
	<p><?php printf( __( 'There are no upcoming %s at this time.', 'the-events-calendar' ), strtolower( $events_label_plural ) ); ?></p>
<?php
endif;
