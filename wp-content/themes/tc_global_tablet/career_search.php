<?php
/* Template Name: Career Search Template */

get_header();

?>

<?php
global $post, $wpdb, $wp_query;

$job_key = $_REQUEST['job_key'];
$tc_country = $_REQUEST['job_country'];
$tc_city = $_REQUEST['job_city'];
$tc_team = $_REQUEST['job_team'];

  $subteam = $_REQUEST['career_team'];
  $subcountry = $_REQUEST['career_country'];
  $Job_order_req = $_REQUEST['sort_val'];

  $banner_image = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'single-post-thumbnail' );
 $banner_title = get_post_meta( $post->ID, 'banner_title', true );
 $tcjob_list= '';
 $job_team_list = '';

 $jobOrdeBy = '';
 $Job_order = 'DESC';

 if($Job_order_req == 'Most recent'){
    $Job_order = 'DESC';
  }
  if($Job_order_req == 'A-Z'){
    $Job_order = 'ASC';
    $jobOrdeBy = 'title';

  }
  if($Job_order_req == 'Z-A'){
    $Job_order = 'DESC';
    $jobOrdeBy = 'title';

  }

  $paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;

	  $relation = 'OR';

      if(!empty($_REQUEST['job_country']) && !empty($_REQUEST['job_city']))
      {
        $relation = 'AND';
      }
      if(!empty($_REQUEST['job_city']) && !empty($_REQUEST['job_team']))
      {
        $relation = 'AND';
      }
      if(!empty($_REQUEST['job_country']) && !empty($_REQUEST['job_team']) || !empty($_REQUEST['career_team']) && !empty($_REQUEST['career_country']))
      {
        $relation = 'AND';
      }

      elseif(!empty($_REQUEST['job_country']) && !empty($_REQUEST['job_city']) && !empty($_REQUEST['job_team']))
      {
        $relation = 'AND';
      }

   $tax_query = array('relation' => $relation);

  if(!empty($_REQUEST['job_country']) || !empty($_REQUEST['career_country']))
    {

        $tax_query[] = array(

                'taxonomy' => 'jobpost_location',
                'field' => 'name',
                //'terms' => $tc_country,  // it's for parent taxonomy
                'terms' => array($tc_country, $subcountry),
                'operator' => 'IN',
          );
    }

    if(!empty($_REQUEST['job_city']))
    {

      $tax_query[] = array(

                    'taxonomy' => 'jobpost_location',
                    'field' => 'name',
                    'terms' => $tc_city,
                    'operator' => 'IN',
          );
    }

    if(!empty($_REQUEST['job_team']) || !empty($_REQUEST['career_team']) )
    {
        $tax_query[] = array(

                    'taxonomy' => 'jobpost_category',
                    'field' => 'name',
                    //'terms' => $tc_team,
                    'terms' => array($tc_team, $subteam),
                    'operator' => 'IN',
          );
    }

    $jobID = $_REQUEST["excludeJob"];
    $exclude_job = explode (",", $jobID);

    $args = array(
          'post_type' => 'jobpost',
          'post__not_in' => $exclude_job,
          'posts_per_page' => 4,
          'orderby'=>$jobOrdeBy,
          'order' => $Job_order,
          's' => $job_key,
          'tax_query' => $tax_query,
          'paged' => $paged
      );

      // Instantiate custom query
      $career_custom_query = new WP_Query( $args );
      $nextexclude_job = '';


  if($career_custom_query->have_posts()) :

   while ($career_custom_query->have_posts()) : $career_custom_query->the_post();

    $career_id = get_the_ID();

    $nextexclude_job .=$career_id.',';

	  $career_category = get_the_terms( $career_id, 'jobpost_category' );
	  $career_state = get_the_terms( $career_id, 'jobpost_location' );
	  $career_cat_id = $career_state[0]->parent;
	  $career_country = get_term_by('id', $career_cat_id, 'jobpost_location');

	  $tcjob_list .='<div class="list-detail border-left-0 border-right-0 bg-transparent border-top-0 px-0 pt-0">
            <div class="row">
              <div class="col-sm-12">
                <a href="'.get_permalink( $career_id ).'"><h3 class="fs-20">'.get_the_title($career_id).'</h3></a>
              </div>
              <div class="col-sm-5">
                <span class="taglabel">'.$career_category[0]->name.'</span>
              </div>';

              if($career_state){

              $tcjob_list .='<div class="col-sm-6">
                <div class="row">
                  <div class="col-2 pr-0">
                    <img src="'.get_template_directory_uri().'/images/map.png" alt="">
                  </div>
                  <div class="col-10 pl-2">
                    <p class="fs-14 mb-2"><span>'.$career_state[0]->name.', </span>'.$career_country->name.'</p>
                  </div>
                </div>
              </div>';
             }

            $tcjob_list .='</div>
          </div>';

		endwhile;

     else:
  		$tcjob_list ='<p class="no_result">Sorry, no results found.</p>';

     endif;

     $total_job = $career_custom_query->found_posts;
     // Reset postdata
     wp_reset_postdata();

    $job_country_list = '';
    $job_city_list = '';

    /** Get parent location only **/

    $country_list = get_terms('jobpost_location', array('hide_empty' => false, 'parent' => 0));

	$job_country_list .= '<ul id="selc_job_country">';
	$job_country_list .='<li><a ><img src="'.get_template_directory_uri().'/images/drop-tick.jpg" alt="">All</a></li>';

    foreach ($country_list as $job_country) {

    	if($_REQUEST['job_country'] == $job_country->name ){$act_cls = 'active'; }
        else {$act_cls = ''; }

    	$job_country_list .='<li id="'.$job_country->name.'"><a class="'.$act_cls.'"><img src="'.get_template_directory_uri().'/images/drop-tick.jpg" alt="">'.$job_country->name.'</a></li>';
    }

    $job_country_list .='</ul>';

    /** Get city list **/

    $job_city_list .='<ul id="selc_job_city">';
    $job_city_list .='<li><a ><img src="'.get_template_directory_uri().'/images/drop-tick.jpg" alt="">All</a></li>';
	foreach ( $country_list as $pcountry ) {
	    //Get the Child terms
	    $city = get_terms( 'jobpost_location', array( 'parent' => $pcountry->term_id, 'orderby' => 'slug', 'hide_empty' => false ) );
	    foreach ( $city as $jobcity ) {

	    	if($_REQUEST['job_city'] == $jobcity->name ){$act_cls = 'active'; }
        	else {$act_cls = ''; }


	         $job_city_list .='<li id="'.$jobcity->name.'"><a><img src="'.get_template_directory_uri().'/images/drop-tick.jpg" alt="">' . $jobcity->name . '</a></li>';
	    }
	}
	$job_city_list .='</ul>';


	/** Get team list **/

	$job_terms = get_terms(
	    array(
	        'taxonomy'   => 'jobpost_category',
	        'hide_empty' => false,
			     'orderby' => 'term_id',
	      	'order' => 'ASC', // or ASC
	    )
	);

	$job_team_list .= '<ul id="selc_job_team">';
	$job_team_list .='<li><a ><img src="'.get_template_directory_uri().'/images/drop-tick.jpg" alt="">All</a></li>';
	foreach ($job_terms as $key => $value) {

		$job_team_list .='<li id="'.$value->name.'"><a><img src="'.get_template_directory_uri().'/images/drop-tick.jpg" alt="">'.$value->name.'</a></li>';
	 }
	$job_team_list .='</ul>';

  //$sort_list = '';
  $sort_list = '<ul id="sel_sort_val">
                <li id="Most recent"><a><img src="'.get_template_directory_uri().'/images/drop-tick.jpg" alt="">Most recent</a></li>
                <li id="A-Z"><a><img src="'.get_template_directory_uri().'/images/drop-tick.jpg" alt="">A-Z</a></li>
                <li id="Z-A"><a><img src="'.get_template_directory_uri().'/images/drop-tick.jpg" alt="">Z-A</a></li>
              </ul>';


?>


<?php

    if(!empty($_REQUEST['job_country'])) {
      $sel_country_val = $_REQUEST['job_country'];
    }
    else{
      $sel_country_val = "Choose country";
    }

    if(!empty($_REQUEST['job_city'])) {
      $sel_city_val = $_REQUEST['job_city'];
    }
    else{
      $sel_city_val = "Choose city";
    }

    if(!empty($_REQUEST['job_team'])) {
      $sel_team_val = $_REQUEST['job_team'];
    }
    else{
      $sel_team_val = "Choose team";
    }

    if(!empty($_REQUEST['sort_val'])) {
      $sel_sort_val = $_REQUEST['sort_val'];
    }
    else{
      $sel_sort_val = "Most Recent";
    }

?>

<div class="searchtool-banner careers-banner">
  <div class="container-fluid position-relative">
    <div class="row align-items-center">
      <div class="col">
        <h2 class="main-heading"><?php echo $banner_title; ?></h2>
      </div>
    </div>
  </div>
</div>

<form name="career_list_form" method="get" id="career_list_form" action="" role="search">

  <div class="search-result p-t-40 p-b-60">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-12">
            <div class="row">

              <div class="col-sm-4">
                <div class="careers-filter">
                  <h2>Refine your search</h2>

                  <div class="dropdown select-theme filter-dropdown pl-0 m-b-40">
                    <button id="job_btn1" class="btn btn-secondary dropdown-toggle career_country" type="button"><span><?php echo $sel_country_val; ?></span></button>
                    <div class="dropdown-menu career_country_show">
                      <?php echo $job_country_list; ?>
                    </div>
                    <input type="hidden" name="job_country" value="<?php echo $_GET['job_country']; ?>">
                  </div>

                  <div class="dropdown select-theme filter-dropdown pl-0 m-b-40">
                    <button id="job_btn2" class="btn btn-secondary dropdown-toggle career_city" type="button"><span><?php echo $sel_city_val; ?></span></button>
                    <div class="dropdown-menu career_city_show">
                      <?php echo $job_city_list; ?>
                    </div>
                    <input type="hidden" name="job_city" value="<?php echo $_GET['job_city']; ?>">
                  </div>

                  <div class="dropdown select-theme filter-dropdown pl-0 m-b-30">
                    <button id="job_btn3" class="btn btn-secondary dropdown-toggle tc_career-team" type="button"><span><?php echo $sel_team_val; ?></span></button>
                    <div class="dropdown-menu tc_career-team-show">
                       <?php echo $job_team_list; ?>
                    </div>
                    <input type="hidden" name="job_team" value="<?php echo $_GET['job_team']; ?>">
                  </div>

                  <a href="javascript:void(0);" onclick="document.getElementById('career_list_form').submit();"><button type="button" class="btn btn-theme btn-block">apply filters</button></a>
                </div>
              </div>

              <div class="col-sm-8">
                <div class="searchlist-topfilter careers-list-topactions pl-0 p-b-20 m-b-10 mt-0">
                  <div class="row justify-content-between">
                    <div class="col-sm-6">
                      <div class="seach-textbox">
                        <input type="text" name="job_key" placeholder="Search from the list below" class="form-control" value="<?php echo $_GET['job_key']; ?>">
                        <a href="javascript:void(0);" onclick="document.getElementById('career_list_form').submit();"><img class="search-icon" src="<?php echo get_template_directory_uri(); ?>/images/searchbar-icon.png" alt=""></a>
                      </div>
                    </div>
                    <div class="col-sm-6">
                      <ul class="filter-dropdown clearfix p-t-10">
                        <li><label>Sort by:</label></li>
                        <li><div class="dropdown pl-0">
                          <button class="btn btn-secondary dropdown-toggle job-sort" type="button"><span><?php echo $sel_sort_val; ?></span></button>
                          <div class="dropdown-menu job-sort-show">
                             <?php echo $sort_list; ?>
                          </div>
                          <input type="hidden" name="sort_val" value="<?php echo $_GET['sort_val']; ?>">
                        </div>
                      </li>
                      </ul>
                    </div>
                  </div>
                </div>
                <div class="careers-current-position p-0">
                  <?php echo $tcjob_list; ?>
                </div>

                <div id="job_post_ajax" class="careers-current-position p-0">

                </div>

                <?php

                  $exclude_jobPost = rtrim($nextexclude_job, ',');

                  if($jobID){
                      $totalexclude = $jobID.$exclude_jobPost;
                    }
                    else{
                       $totalexclude = $exclude_jobPost;
                    }


                ?>
                <input type="hidden" name="exclude_job_post" value="<?php echo $totalexclude; ?>">
                <input type="hidden" name="subcareer_country" value="<?php $_GET['career_team']; ?>">
                <input type="hidden" name="subcareer_team" value="<?php echo $_GET['career_country']; ?>">

                <?php
                $maxpage = $career_custom_query->max_num_pages;
                if($maxpage > 1)
                {
                  ?>
                <div class="row">
                  <div class="col-sm-8 m-t-40">
                    <button id="load_job" class="btn btn-theme btn-block">more results</button>
                  </div>
                </div>

                <?php } ?>

            </div>
          </div>
      </div>
    </div>
  </div>
</div>

</form>



<?php

get_footer();

?>
