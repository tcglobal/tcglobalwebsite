<?php
 /* location display */

function location_shortcode_fun($atts){
$title = $atts['title'];
$outputLocationcode = '';
$cityname = '';
$outputLocation = '<div class="ourlocations-list p-t-60 p-b-40">
          <h2 class="tablet-main-heading">'.$title.'</h2>
          <div class="container-fluid accordion p-t-40" id="accordionExample">';

		$locationCats = get_terms(
			array(
				'taxonomy'   => 'loc_categories',
				'hide_empty' => false,
				'orderby' => 'term_id',
				'order' => 'ASC', // or ASC
				'hierarchical'  => 1,
				'parent'        => 0, // get top level categories
			)
		);

			// Check if any term exists

			if ( ! empty( $locationCats ) && is_array( $locationCats ) ) {
				// Run a loop and print them all term_id slug
				$j = 1;
				foreach ( $locationCats as $locationCat )
				{
					if($j==1){
						$cssheadingvalue = 'active';
						$cssheadingshow = 'show';
						$cssheadingexpend = 'true';
					}
					else
					{
						$cssheadingvalue = '';
						$cssheadingshow = '';
						$cssheadingexpend = 'false';
					}

					$subCats = '';
 					$i = 0;

					$sub_categories = get_terms(
						array(
							'taxonomy'   => 'loc_categories',
							'hide_empty' => false,
							'orderby' => 'name', // term_id
							'order' => 'ASC', // or ASC
							'hierarchical'  => 1,
							'parent'        => $locationCat->term_id, // get child categories
						)
					);
					foreach ( $sub_categories as $sub_category ){
						$placeName = '';
						$post_query = new WP_Query(array(
											'post_type' => 'location',
											'order' => 'ASC',
											//'s' => $faqsearch,
												'tax_query' => array(
													array(
													'taxonomy' => 'loc_categories',   // taxonomy name
													'terms' => $sub_category->term_id,                  // term id, term slug or term name
													)
												)
											));
						$cityname .=	'<li><a href="">'.$sub_category->name.'</a></li>';
						if($post_query->have_posts()) :
							$l = 0;
							if($i==0){
								$cssvalue = 'show active';
								$i++;
							}
							else
							{
								$cssvalue = '';
							}
							$count = $post_query->post_count;

							while ($post_query->have_posts()) :
							$post_query->the_post();


							$locationCourse = get_post_meta( get_the_ID(), 'location_course', true );
								//print_r($locationCourse);
								$displayCourse = '<div class="dropdown-menu d-block">';
								foreach($locationCourse as $key => $value)
								{
									if($value!='') {
										$couseName = 'Global Ed';
										if($value == 'loc_global_learning'){ $couseName = 'Global Learning'; }
										else if($value == 'loc_global_investment'){ $couseName = 'Global Investment'; }
										else if($value == 'loc_global_workspace'){ $couseName = 'Global Workspace'; }

								   		$displayCourse .= '<a class="dropdown-item"><img src="'.get_template_directory_uri().'/images/red-check.png" alt="" class="" />'.$couseName.'</a>';
								   	}

								}
								$wpsladdress = get_post_meta( get_the_ID(), 'wpsl_address', true );
								$displayCourse .= '<a href="javascript:google.maps.event.trigger(gmarkers[\'' . get_the_ID() . '\'],\'click\');" class="marker-link show-link" data-markerid="' . get_the_ID() . '">Show on map</a></div>';

								$placeName .= '<li><a href="javascript:void(0)" class="dropdown-toggle" type="button">'.get_the_title().'</a>'.$displayCourse.'</li>';

								$wpsl_latitude = get_post_meta( get_the_ID(), 'wpsl_latitude', true );
								$wpsl_longitude = get_post_meta( get_the_ID(), 'wpsl_longitude', true );
								$thumb = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'full' );
								$wpsl_address = get_post_meta( get_the_ID(), 'wpsl_address', true );
								$wpsl_state = get_post_meta( get_the_ID(), 'wpsl_state', true );
								$wpsl_city = get_post_meta( get_the_ID(), 'wpsl_city', true );
								$wpsl_zip = get_post_meta( get_the_ID(), 'wpsl_zip', true );
								$location_email_address = get_post_meta( get_the_ID(), 'location_email_address', true );
								$location_fax = get_post_meta( get_the_ID(), 'location_fax', true );
								$wpsl_phone = get_post_meta( get_the_ID(), 'wpsl_phone', true );
								$wpsl_address_two = get_post_meta( get_the_ID(), 'wpsl_address_two', true );
								$outputLocationcode .= "['".get_the_ID()."','<div class=\"map-pointer-detail\" style=\"position:unset\"><img class=\"img-fluid\" src=\"".$thumb[0]."\" width=\"198\" /><h3>".get_the_title()."</h3><p>".$wpsl_address.", <br>".$wpsl_state.",<br>".$wpsl_city." - ".$wpsl_zip.".</p></div>', ".$wpsl_latitude.", ".$wpsl_longitude.", 4],";

								$new_location = '<div class="row"><div class="col-sm-6"><div class="location-detail">
												<img class="img-fluid" src="'.$thumb[0].'" alt="'.get_the_title().'"  />
												<div class="address">
												  <h3>'.get_the_title().'</h3>
												  <p>'.$wpsl_address. ' '.$wpsl_address_two. ', '.$wpsl_state.', '.$wpsl_city.', '.$wpsl_zip.'</p>
												  <h4><span>Tel:</span> '.$wpsl_phone.'</h4>
												  <h4><span>Fax:</span> '.$location_fax.'</h4>
												  <h4><span>Email:</span> '.$location_email_address.'</h4>
												  <button type="button" class="btn btn-theme">schedule a meeting</button>
												  <button type="button" class="btn btn-transparent">explore events<img src="'.get_template_directory_uri().'/images/down_2.png" alt=""  /></button>
												</div>
												</div>
												</div>

												<div class="col-sm-6"><div class="location-detail">
												<img class="img-fluid" src="'.$thumb[0].'" alt="'.get_the_title().'"  />
												<div class="address">
												  <h3>'.get_the_title().'</h3>
												  <p>'.$wpsl_address. ' '.$wpsl_address_two. ', '.$wpsl_state.', '.$wpsl_city.', '.$wpsl_zip.'</p>
												  <h4><span>Tel:</span> '.$wpsl_phone.'</h4>
												  <h4><span>Fax:</span> '.$location_fax.'</h4>
												  <h4><span>Email:</span> '.$location_email_address.'</h4>
												  <button type="button" class="btn btn-theme">schedule a meeting</button>
												  <button type="button" class="btn btn-transparent">explore events<img src="'.get_template_directory_uri().'/images/down_2.png" alt=""  /></button>
												</div>
												</div>
												</div>

											  </div>';

							$l++;
							endwhile;
						else:
								$placeName .= '<li>No record found.</li>';

						endif;
						$subCats .=  '
									<div class="col-sm-6">
									  <a class="btn country-list" data-toggle="collapse" data-target="#'.$sub_category->slug.'" aria-expanded="false" aria-controls="'.$sub_category->slug.'">
										<span>'.$sub_category->name.'</span>
										<img src="'.get_template_directory_uri().'/images/collapse-child-plus.png" alt="" class="" />
									  </a>
									  <div id="'.$sub_category->slug.'" class="collapse" aria-labelledby="'.$sub_category->slug.'" data-parent="#accordionExample1">

										<ul class="place-list">
										  '.$placeName.'
										</ul>


									</div>

								  </div>';

					}

				if($j != 1){ $show_loc = 'show_hidden_loc'; } else{ $show_loc = ''; }

				  $outputLocation .= '<div class="row '.$show_loc.'">
							  <div class="col-sm-12">
								<div class="row">
								  <div class="col-sm-4">
									<a class="btn country-list '.$cssheadingvalue.'" data-toggle="collapse" data-target="#'.$locationCat->slug.'" aria-expanded="'.$cssheadingexpend.'" aria-controls="'.$locationCat->slug.'"><span>'.$locationCat->name.'</span> <img src="'.get_template_directory_uri().'/images/collapse-plus.png" alt="" class="" /></a>
								  </div>
								</div>
								<div id="'.$locationCat->slug.'" class="collapse '.$cssheadingshow .'" aria-labelledby="headingOne" data-parent="#accordionExample">
								  <div class="row accordion ourlocations-list-child" id="accordionExample1">'.$subCats.'</div>
								</div>
							  </div>
							</div>';

					$j++;
				}
			}

$outputLocation .= '<div class="row justify-content-center m-t-30 m-b-20">
	<div class="col-sm-5">
		<button type="button" class="btn btn-theme btn-block">load all locations<img class="w-auto h-auto" src="'.get_template_directory_uri().'/images/tab-downarrow-btn.png" alt=""></button>
	</div>
</div>';

$outputLocation .= '</div>
        </div>

        <div class="locations-mapplace-center">
        	<div class="row mx-0 justify-content-center"><h2 class="tablet-main-heading col-sm-6">Find Centre location on map</h2></div>


    		<div class="map-view">
			<div id="google-map-display" style="width: 100%; height: 100%;"></div>
              <!--/*<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d15720.436787687939!2d78.14503004999999!3d9.9248631!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sin!4v1567579853159!5m2!1sen!2sin" width="100%" height="100%" frameborder="0" style="border:0;" allowfullscreen=""></iframe> */-->
               <div class="map-pointer-detail" style="display:none">
                <img class="close-icon" src="'.get_template_directory_uri().'/images/map-close.png" alt=""  />
                <img class="img-fluid" src="'.get_template_directory_uri().'/images/office-location-on-map.jpg" alt=""  />
                <h3>Nehru Palace</h3>
                <p>Business Point, 2nd Floor, <br>
                  Paliram Road, Off S.V. Road, <br>
                  Mumbai - 400058.</p>
                </div>
              </div>

          <div class="container-fluid">
          <div class="find-locations">
           <div class="row">
           <div class="col-sm-6">
            <div class="drop-down">
              <!--<span>Find Experience Centre location</span>-->
              <input type="text" class="form-control" placeholder="Find Experience Centre location" /><img src="'.get_template_directory_uri().'/images/dropdown.png" alt=""  /></div>
              <div class="dropdown-list" style="display:none">
                <h3 ><img src="'.get_template_directory_uri().'/images/location-cursor.png" alt=""  />Find Experience Centre near you</h3>
                <ul style="display:none">
                  '.$cityname.'
                </ul>
              </div>
             </div>
             </div>
              '.$new_location.'

			<div class="row justify-content-center m-t-30 m-b-20">
				<div class="col-sm-5">
					<button type="button" class="btn btn-theme btn-block">load all locations<img class="w-auto h-auto" src="'.get_template_directory_uri().'/images/tab-downarrow-btn.png" alt=""></button>
				</div>
			</div>

            </div>
            </div>
            </div> <script type="text/javascript">';

	$outputLocation .= '
	var locations = [
		'.rtrim($outputLocationcode,",").'
		];
	';
	$outputLocation .= '

	var mapStyles = [{
    "featureType": "landscape",
    "stylers": [{
      "saturation": -100
    }, {
      "lightness": 65
    }, {
      "visibility": "on"
    }]
  }, {
    "featureType": "poi",
    "stylers": [{
      "saturation": -100
    }, {
      "lightness": 51
    }, {
      "visibility": "simplified"
    }]
  }, {
    "featureType": "road.highway",
    "stylers": [{
      "saturation": -100
    }, {
      "visibility": "simplified"
    }]
  }, {
    "featureType": "road.arterial",
    "stylers": [{
      "saturation": -100
    }, {
      "lightness": 30
    }, {
      "visibility": "on"
    }]
  }, {
    "featureType": "road.local",
    "stylers": [{
      "saturation": -100
    }, {
      "lightness": 40
    }, {
      "visibility": "on"
    }]
  }, {
    "featureType": "transit",
    "stylers": [{
      "saturation": -100
    }, {
      "visibility": "simplified"
    }]
  }, {
    "featureType": "administrative.province",
    "stylers": [{
      "visibility": "on"
    }]
  }, {
    "featureType": "water",
    "elementType": "labels",
    "stylers": [{
      "visibility": "on"
    }, {
      "lightness": -25
    }, {
      "saturation": -100
    }]
  }, {
    "featureType": "water",
    "elementType": "geometry",
    "stylers": [{
      "hue": "#ffff00"
    }, {
      "lightness": -25
    }, {
      "saturation": -97
    }]
  }];
	var markers = new Array();
	gmarkers = [];
	var map = new google.maps.Map(document.getElementById(\'google-map-display\'), {
      zoom: 5,
	  styles: mapStyles,
      center: new google.maps.LatLng(21.3167609,75.9432911),
      mapTypeId: google.maps.MapTypeId.ROADMAP,
	  mapTypeControl: false,
	  streetViewControl: false,
	  zoomControlOptions: {
        	position: google.maps.ControlPosition.TOP_LEFT
    	},
	  fullscreenControl: false
    });
    var infowindow = new google.maps.InfoWindow();
    var marker, i;
    for (i = 0; i < locations.length; i++) {
	  	// Add marker to markers array
		gmarkers[locations[i][0]] =
    createMarker(new google.maps.LatLng(locations[i][2], locations[i][3]), locations[i][1]);
    }

	function createMarker(latlng, html) {
		var marker = new google.maps.Marker({
			position: latlng,
			map: map,
			icon: \''.get_template_directory_uri().'/images/map-pointer-icon-sm.png\'
		});

		google.maps.event.addListener(marker, \'click\', function() {
			infowindow.setContent(html);
			infowindow.open(map, marker);
		});
		return marker;
	}

	jQuery(document).ready(function($){
	 $(".marker-link").on(\'click\', function () {
		window.scrollTo($(\'#google-map-display\'), 1000);
    });
	});

	</script>';
	return trim($outputLocation);
	}
	add_shortcode('location_display', 'location_shortcode_fun');

	/* display location scroll */
	function new_location_scroll_fun($atts)
	{
		$loc_title = $atts['title'];
		$loc_sub_title = $atts['subtitle'];

		$display = '<div class="locations-newlocations-list p-b-80">
                  <div class="container-fluid">
                    <h2 class="tablet-main-heading">'.$loc_title.'</h2>
                    <div class="row justify-content-center">
                      <div class="col-sm-8 m-b-40 m-t-20">
                        <h4>'.$loc_sub_title.'</h4>
                      </div>
                    </div>';

	$locationMaps = get_terms(
				array(
					'taxonomy'   => 'loc_categories',
					'hide_empty' => false,
					'orderby' => 'term_id',
					'order' => 'ASC', // or ASC
					'hierarchical'  => 1,
					'parent'        => 0, // get top level categories
				)
			);

	if ( ! empty( $locationMaps ) && is_array( $locationMaps ) ) {


	//$outputLocation = '';
	// Run a loop and print them all term_id slug
		$j = 1;
		foreach ( $locationMaps as $locationMap )
		{


			$location_categories = get_terms(
				array(
					'taxonomy'   => 'loc_categories',
					'hide_empty' => false,
					'orderby' => 'term_id',
					'order' => 'ASC', // or ASC
					'hierarchical'  => 1,
					'parent'        => $locationMap->term_id, // get child categories
				)
			);

				foreach( $location_categories as $location_categorie ){


					$location_post_query = new WP_Query(array(
							'post_type' => 'location',
							'posts_per_page'=> '6',
							'order' => 'DESC',
								'tax_query' => array(
									array(
									'taxonomy' => 'loc_categories',   // taxonomy name
									'terms' => $location_categorie->term_id,                  // term id, term slug or term name
									)
								)
							));


				if($location_post_query->have_posts()) :
					while ($location_post_query->have_posts()) :
					$location_post_query->the_post();

					/** get only new location list **/
					$newbranch = get_post_meta( get_the_ID(), 'tcglobal_new_location', true );

					if($newbranch)
					{

						$wpsl_latitude = get_post_meta( get_the_ID(), 'wpsl_latitude', true );
						$wpsl_longitude = get_post_meta( get_the_ID(), 'wpsl_longitude', true );
						$thumb = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'full' );
						$wpsl_address = get_post_meta( get_the_ID(), 'wpsl_address', true );
						$wpsl_state = get_post_meta( get_the_ID(), 'wpsl_state', true );
						$wpsl_city = get_post_meta( get_the_ID(), 'wpsl_city', true );
						$wpsl_zip = get_post_meta( get_the_ID(), 'wpsl_zip', true );
						$wpsl_address_two = get_post_meta( get_the_ID(), 'wpsl_address_two', true );
						$displayLocation .= '<div>
	                        <div class="list-item">
	                          <img class="img-fluid" src="'.$thumb[0].'" alt="" style="width:100%"  />
	                          <h2>'.get_the_title().'</h2>
	                          <p>'.$wpsl_address. ' '. $wpsl_address_two. ', '.$wpsl_state.', '.$wpsl_city.', '.$wpsl_zip.'</p>
	                        </div>
	                      </div>';
	                }      

					endwhile;
					endif;

				}
			}

			$display .= '
                    <section class="loc_carousel slider">
						'.$displayLocation.'
					</section>
                  </div>
                </div>';

	}
	$display .= '</div></div>';
	return trim($display);
	}

	add_shortcode('location_scroll', 'new_location_scroll_fun');




/** single_content page   **/
function single_content_fun($atts){
global $post, $wpdb, $tc_head, $tc_subhead;
$category_id = $atts['id'];
$single_content = '';
$single_content_query = new WP_Query(
        array('post_type' => 'citizenship',
                'order' => 'ASC',
				  'tax_query' => array(
					array(
						'taxonomy' => 'global-cat',   // taxonomy name
						'terms' => $category_id,                  // term id, term slug or term name
					  )
					)
			)
		);

if($single_content_query->have_posts()) :
while ($single_content_query->have_posts()) : $single_content_query->the_post();

	$singleid = get_the_ID();

	$single_img = wp_get_attachment_image_src( get_post_thumbnail_id($singleid), 'full' );
	$link = get_post_meta( $singleid, 'citizenship_link', true );
	$additional_cls = get_post_meta( $singleid, 'class_name_for_web', true );
	if($additional_cls){ $cls_val = $additional_cls; }
	if($link){
		$button ='<div class="pl-5 ml-3"><a href="'.$link.'"><button type="button" class="btn btn-outline '.$cls_val.'">'.get_post_meta( $become_global_id, 'citizenship_button', true ).'</button></a></div>';
	}
    	$single_content .= '<div class="locations-experience-centres p-t-40 p-b-30">
							<img class="img-fluid" src="'.$single_img[0].'" alt=""  />
					  	<div class="container-fluid">
							<div class="row justify-content-center">
							  <div class="col-sm-10">
									<h3 class="fs-20">'.get_the_title($singleid).'</h3>
									<p class="fs-14 mb-4">'.nl2br(get_post_field('post_content', $singleid)).'</p>
									'.$button.'
								  </div>
								</div>
							 </div>
						</div>';

endwhile;
wp_reset_postdata();
endif;
return trim($single_content);
}
add_shortcode('single_content', 'single_content_fun');
