<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Origin: http://localhost:4200");
header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Authorization");
header('Content-Type: application/json; charset=utf-8');

 require_once($_SERVER['DOCUMENT_ROOT'] . '/wp-load.php');
 global $post, $wpdb;
 

	$data = array(
	  "status" => false,
	  "results" => array()
	);

	$event_query = new WP_Query(
			array('post_type' => 'event_listing',
					'orderby' => '_event_start_date',
					'order' => 'ASC',
					'post_status' => 'publish',
					'posts_per_page' => -1,
				)
		);
       
if($event_query->have_posts()) :
  while ($event_query->have_posts()) : $event_query->the_post();

  	$event_count = $event_query->post_count;

  		$category_name = '';
  		$items = array();

  	 	$event_id = get_the_ID();
  	 	$title = get_the_title($event_id);
  		$event_addr = get_post_meta( $event_id, '_event_address', true );
        $event_stime = get_post_meta( $event_id, '_event_start_time', true );
        $event_etime = get_post_meta( $event_id, '_event_end_time', true );
        $event_sdate = get_post_meta( $event_id, '_event_start_date', true );
		$event_category = get_the_terms( $event_id, 'event_categories' );
		$featured_event = get_post_meta( $event_id, '_featured', true );
		$location = get_post_meta( $event_id, '_event_location', true );
		$event_content = get_post_field('post_content', $event_id);
		$img = wp_get_attachment_image_src( get_post_thumbnail_id($event_id), 'full' );

		$business = get_post_meta( $event_id, 'choose_business', true );
		$event_link = get_permalink( $event_id );

		for($i=1; $i<=5; $i++)
		{
			$invitename = ''; $inviterole = ''; $invite_pic = ''; $inviteimag = '';
			
			$invitename =  get_post_meta( $event_id, 'invite_name_'.$i, true );
			$inviterole =  get_post_meta( $event_id, 'role_'.$i, true );
			$inviteimag =  get_post_meta( $event_id, 'image_'.$i, true );
			if($inviteimag){
				$invite_imgurl = wp_get_attachment_image_src($inviteimag);
				$invite_pic = $invite_imgurl[0];
			}

			$items[] = array(
				'name' => $invitename,
				'role' => $inviterole,
				'image' => $invite_pic
			);
		}
		
		foreach ($event_category as $value) {
			$category_name .= $value->name.',';
		}

		$data['results'][] = array(
			'id' => $event_id,		
		    'title' => html_entity_decode($title),
		    'location' => $location,
		    'address' => $event_addr,
		    'start_time' => $event_stime,
		    'end_time' => $event_etime,
		    'start_date' => $event_sdate,
		    'topics' => rtrim($category_name, ','),
		    'business_type' => $business,
		    'featured_event' => $featured_event,
		    'image_url' => $img[0],
		    'event_page_link' => $event_link,
		    'content' =>$event_content,
		    'event_organizer' => $items
		);

		
  	endwhile;

endif;

if($event_count > 0){
	$data['status'] = true;
}
 
//header('Content-type:application/json;charset=utf-8');

echo $event_response = json_encode($data);

?>