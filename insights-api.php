<?php
	
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Origin: http://localhost:4200");
header("Access-Control-Allow-Methods: PUT, GET, POST, DELETE");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Authorization");
header('Content-Type: application/json; charset=utf-8');

 require_once($_SERVER['DOCUMENT_ROOT'] . '/wp-load.php');
 global $post, $wpdb;
 
	$apidata = array(
	  "status" => false,
	  "totalRecords" => 0,
	  "results" => array()
	);

	$insightapi_query = new WP_Query(
			array('post_type' => 'post',
					'order' => 'DESC',
					'post_status' => 'publish',
					'posts_per_page' => -1,
				)
		);

$total = $insightapi_query->found_posts;

if($insightapi_query->have_posts()) :
  while ($insightapi_query->have_posts()) : $insightapi_query->the_post();

  	 	$insightCount = $insightapi_query->post_count;
		$category_name = '';
  		$items = array();
  		$topicname = '';
  		$insightimgurl = "";

  	 	$insight_dataID = get_the_ID();
  	 	$title = get_the_title($insight_dataID);
  	 	$tag_name = get_the_terms( $insight_dataID, 'post_tag' );
  	 	$insight_category = get_the_terms( $insight_dataID, 'category' );
  	 	$insight_date = get_the_date('d.m.Y', $insight_dataID);
  		$img = wp_get_attachment_image_src( get_post_thumbnail_id($insight_dataID), 'full' );
		$business = get_post_meta( $insight_dataID, 'choose_business', true );
		//$insightcontent = get_post_field('post_content', $insight_dataID);
		$insight_link = get_permalink( $insight_dataID );
		$insightcontent = get_kc_excerpt();

		if($img){
			$insightimgurl = $img[0];
		}
		else{
			$insightimgurl = "";
		}

		for($i=1; $i<=5; $i++)
		{
			$invitename = ''; $inviterole = ''; $invite_pic = ''; $inviteimag = '';
			$invitename =  get_post_meta( $insight_dataID, 'invite_name_'.$i, true );
			$inviterole =  get_post_meta( $insight_dataID, 'role_'.$i, true );
			$inviteimag =  get_post_meta( $insight_dataID, 'image_'.$i, true );
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

		foreach ($insight_category as $value) {
			$category_name .= $value->name.',';
		}

		foreach ($tag_name as $value) {
			$topicname .= $value->name.',';
		}

		$apidata['results'][] = array(
			'id' => $insight_dataID,		
		    'title' => html_entity_decode($title),
		    'date' => $insight_date,
		    'type' => rtrim($topicname, ','),
		    'topics' => rtrim($category_name, ','),
		    'business_type' => $business,
		    'image_url' => $insightimgurl,
		    'insight_page_link' => $insight_link,
		    'content' =>$insightcontent,
		    'insight_organizer' => $items
		);

		
  	endwhile;

endif;

if($insightCount > 0){
	$apidata['status'] = true;
	$apidata['totalRecords'] = $total;
}
 

echo $insightresult = json_encode($apidata);


?>