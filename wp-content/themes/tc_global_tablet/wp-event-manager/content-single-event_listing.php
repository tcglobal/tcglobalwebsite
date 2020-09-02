
<?php

global $post;
$start_date = get_event_start_date ();
$end_date = get_event_end_date ();
wp_enqueue_script('wp-event-manager-slick-script');
wp_enqueue_style( 'wp-event-manager-slick-style');
do_action('set_single_listing_view_count');

?>

<div class="wpem-single-event-body-content">

<?php do_action('single_event_overview_start');?>
<?php 
echo apply_filters( 'display_event_description', get_the_content() ); 
?>
<?php do_action('single_event_overview_end');?>



</div>



