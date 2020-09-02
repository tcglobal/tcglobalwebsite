<?php
/* Template Name: Career Template */

get_header();

?>

<?php
global $post, $wpdb;

$job_team_list = ''; $job_country_list = '';
  $banner_image = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'single-post-thumbnail' );
  $banner_title = get_post_meta( $post->ID, 'banner_title', true );

  $job_cat_list = '';
  $job_cat_list_show = '';
  $contentDetail = '';
  $i =1; $j = 1;

  $show_teamBtn = 'style=display:none';
  $cat_array = array(
               'taxonomy' => 'jobpost_category',
               'hide_empty'=> 0,
               'orderby' => 'id',
               'order'   => 'ASC'
           );

   $assigncat = get_categories($cat_array);


   foreach ($assigncat as $key => $value) {

      $catid = $value->term_id;
       $cat_name = $value->name;
       $postcount = $value->count;

      /*$post_args = array(
                        'post_type' => 'jobpost',
                        'order' => 'DESC',
                        'posts_per_page' => 1,
                        'tax_query' => array(
                            array(
                                'taxonomy' => 'jobpost_category',
                                'field' => 'id',
                                'terms' => $catid,
                            )
                        )

                    );*/

        $image = get_term_meta( $catid, 'category_image', true);

        $cat_img = wp_get_attachment_image_src($image);

        $jobCatDes = category_description($catid);  // get category description content


        /*$loop = new WP_Query( $post_args );
        while ( $loop->have_posts() ) : $loop->the_post();

        if($jobCatDes){
          $contentDetail = $jobCatDes;
        }
        else{
          $contentDetail = get_kc_excerpt();
        }*/

        $contentDetail = $jobCatDes;

        if($i <= 6)
        {
          $job_cat_list .='<div class="col-sm-4 m-b-30">
              <div class="content-list">';
              if($cat_img) {
                $job_cat_list .='<img class="icon" src="'.$cat_img[0].'" />';
              }
                $job_cat_list .='<h5>'.$cat_name.'</h5>
                <h6 class="fs-14"><a href="/careers?job_position=&job_team='.$cat_name.'&job_country=&career_team=&career_country="><span>'.$postcount.'</span> Open job positions</a></h6>
                <p class="fs-14">'.$contentDetail.'</p>
              </div>
            </div>';

        }

        else{
          $show_teamBtn = 'style=display:block';

          $job_cat_list_show .='<div class="col-sm-4 m-b-30">
              <div class="content-list">';
              if($cat_img) {
                 $job_cat_list_show .='<img class="icon" src="'.$cat_img[0].'" />';
                }
              $job_cat_list_show .='<h5>'.$cat_name.'</h5>
                <h6 class="fs-14"><a href="/careers?job_position=&job_team='.$cat_name.'&job_country=&career_team=&career_country="><span>'.$postcount.'</span> Open job positions</a></h6>
                <p class="fs-14">'.$contentDetail.'</p>
              </div>
            </div>';
        }

        /*endwhile;
        wp_reset_postdata();*/

      $i++;

  }


$career_slider_cat = array('114', '115', '116', '117');
$active_slider_tab = '';
$section_one = '';

foreach ( $career_slider_cat as $key => $value) {

  $slider_category_id =  $value;

  $slider_args = array(
                        'post_type' => 'solutions',
                        'order' => 'ASC',

                        'tax_query' => array(
                            array(
                                'taxonomy' => 'solution-cat',
                                'field' => 'id',
                                'terms' => $slider_category_id,
                            )
                        )

                    );

      $sliderloop = new WP_Query( $slider_args );
      while ( $sliderloop->have_posts() ) : $sliderloop->the_post();

      $slider_postid = get_the_ID();

        $attach_img = wp_get_attachment_image_src( get_post_thumbnail_id($slider_postid), 'full' );

        if($j == 1){

              $section_one .='<div>
                <div class="tab-pane show">
                  <div class="row">
                    <div class="col-sm-6 p-t-80">
                      <h6 class="desktop-sub-heading text-left mb-3">Our values</h6>
                      <h2 class="mt-0">'.get_the_title($slider_postid).'</h2>
                      <p class="mb-0">'.get_post_field('post_content', $slider_postid).'</p>
                      </div>
                      <div class="col-sm-6">
                        <img class="img-fluid career-img-load" src="'.$attach_img[0].'" alt="" />
                      </div>
                    </div>
                  </div>
                </div>';
          }
          if($j == 2){

              $section_two .='<div>
                <div class="tab-pane show">
                  <div class="row">
                    <div class="col-sm-6 p-t-80">
                      <h6 class="desktop-sub-heading text-left mb-3">Our values</h6>
                      <h2 class="mt-0">'.get_the_title($slider_postid).'</h2>
                      <p class="mb-0">'.get_post_field('post_content', $slider_postid).'</p>
                      </div>
                      <div class="col-sm-6">
                        <img class="img-fluid career-img-load" src="'.$attach_img[0].'" alt="" />
                      </div>
                    </div>
                  </div>
                </div>';
          }
          if($j == 3){

              $section_three .='<div>
                <div class="tab-pane show">
                  <div class="row">
                    <div class="col-sm-6 p-t-80">
                      <h6 class="desktop-sub-heading text-left mb-3">Our values</h6>
                      <h2 class="mt-0">'.get_the_title($slider_postid).'</h2>
                      <p class="mb-0">'.get_post_field('post_content', $slider_postid).'</p>
                      </div>
                      <div class="col-sm-6">
                        <img class="img-fluid career-img-load" src="'.$attach_img[0].'" alt="" />
                      </div>
                    </div>
                  </div>
                </div>';
          }
          if($j == 4){

              $section_four .='<div>
                <div class="tab-pane show">
                  <div class="row">
                    <div class="col-sm-6 p-t-80">
                      <h6 class="desktop-sub-heading text-left mb-3">Our values</h6>
                      <h2 class="mt-0">'.get_the_title($slider_postid).'</h2>
                      <p class="mb-0">'.get_post_field('post_content', $slider_postid).'</p>
                      </div>
                      <div class="col-sm-6">
                        <img class="img-fluid career-img-load" src="'.$attach_img[0].'" alt="" />
                      </div>
                    </div>
                  </div>
                </div>';
          }


        endwhile;
        wp_reset_postdata();

        $j++;
  }


  $job_tilte_list = '';
  $title_args = array(
      'post_type'   => 'jobpost',
      'numberposts'   => -1,
      'order'     => 'DESC',
    );
  // Get the posts
  $jobList = get_posts($title_args);

  $myposts = array();
    foreach( $jobList as $value ) {
      $tiltevalues = get_the_title($value->ID);
      $myposts[] = $tiltevalues;
    }

  $myposts = array_unique($myposts); // get unique job tilte remove duplicate

  $job_tilte_list .='<ul id="selc_position">';
  foreach ($myposts as $mypost){
    //$job_tilte_list .='<li id="'.get_the_title($mypost->ID).'"><a><img src="'.get_template_directory_uri().'/images/drop-tick.jpg" alt="">'.get_the_title($mypost->ID).'</a></li>';
    $job_tilte_list .='<li id="'.$mypost.'"><a><img src="'.get_template_directory_uri().'/images/drop-tick.jpg" alt="">'.$mypost.'</a></li>';
  }
  $job_tilte_list .='</ul>';

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


  $career_team .= '<ul id="selc_career_team">';
  $career_team .='<li><a ><img src="'.get_template_directory_uri().'/images/drop-tick.jpg" alt="">All</a></li>';
  foreach ($job_terms as $key => $value) {

    $career_team .='<li id="'.$value->name.'"><a><img src="'.get_template_directory_uri().'/images/drop-tick.jpg" alt="">'.$value->name.'</a></li>';
   }
  $career_team .='</ul>';



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


  $career_country.= '<ul id="selc_career_country">';
  $career_country .='<li><a ><img src="'.get_template_directory_uri().'/images/drop-tick.jpg" alt="">All</a></li>';

    foreach ($country_list as $job_country) {

      if($_REQUEST['career_country'] == $job_country->name ){$act_cls = 'active'; }
        else {$act_cls = ''; }

      $career_country .='<li id="'.$job_country->name.'"><a class="'.$act_cls.'"><img src="'.get_template_directory_uri().'/images/drop-tick.jpg" alt="">'.$job_country->name.'</a></li>';
    }

    $career_country .='</ul>';

  /** Get job list and search list **/
  $career_list='';

  $team = $_REQUEST['job_team'];
  $country = $_REQUEST['job_country'];

  $subteam = $_REQUEST['career_team'];
  $subcountry = $_REQUEST['career_country'];
  $job_searchkey = $_REQUEST['job_position'];

  $relation = 'OR';

  if(!empty($_REQUEST['job_country']) && !empty($_REQUEST['job_team']) || !empty($_REQUEST['career_team']) && !empty($_REQUEST['career_country']))
    {
      $relation = 'AND';
    }

  $tax_query = array('relation' => $relation);

  if(!empty($_REQUEST['job_country']) || !empty($_REQUEST['career_country']))
    {

        $tax_query[] = array(

                'taxonomy' => 'jobpost_location',
                'field' => 'name',
                'terms' => array($country, $subcountry),  // it's for parent taxonomy
                'operator' => 'IN',
          );
    }

   if(!empty($_REQUEST['job_team']) || !empty($_REQUEST['career_team']) )
    {
        $tax_query[] = array(

                    'taxonomy' => 'jobpost_category',
                    'field' => 'name',
                    'terms' => array($team, $subteam),
                    'operator' => 'IN',
          );
    }

  /*$args = array(
        'post_type' => 'jobpost',
        'order' => 'ASC',
        'posts_per_page' => 4
    );*/

  $args = array(
          'post_type' => 'jobpost',
          'posts_per_page' => 4,
          'order' => 'DESC',
          's' => $job_searchkey,
          'tax_query' => $tax_query,

      );

  //print_r($args);

  $ex_job_id = '';
  $career_query = new WP_Query( $args );

  if($career_query->have_posts()) :
  while ($career_query->have_posts()) : $career_query->the_post();

  $job_id = get_the_ID();
  $job_category = get_the_terms( $job_id, 'jobpost_category' );
  $job_state = get_the_terms( $job_id, 'jobpost_location' );
  $parent_cat_id = $job_state[0]->parent;
  $job_country = get_term_by('id', $parent_cat_id, 'jobpost_location');

  $ex_job_id .=$job_id.','; //exclude job id

  $jobLocName = $job_state[0]->name;

  $career_list .='<div class="col-sm-3">
            <div class="list-detail">
              <span class="taglabel">'.$job_category[0]->name.'</span>
              <a href="'.get_permalink( $job_id ).'"><h3 class="fs-20">'.get_the_title($job_id).'</h3></a>';

            if($jobLocName){  
                $career_list .='<div class="row">
                  <div class="col-2 pr-0">
                    <img src="'.get_template_directory_uri().'/images/map.png" alt="">
                  </div>
                  <div class="col-10 pl-2">
                    <p class="fs-14"><span>'.$job_state[0]->name.', </span>'.$job_country->name.'</p>
                  </div>
                </div>';
             } 

            $career_list .='<a class="fs-14 apply-link" href="'.get_permalink( $job_id ).'">Apply now<img src="'.get_template_directory_uri().'/images/down_2.png" alt=""></a>
            </div>
          </div>';

  endwhile;

   else:
      $career_list ='<p class="no_result">Sorry, no results found.</p>';

  endif;
  wp_reset_postdata();

  $max_pagenum = $career_query->max_num_pages;
  //echo $ex_job_id;

?>

<?php

    if(!empty($_REQUEST['job_position'])) {
      $job_position_value = $_REQUEST['job_position'];
    }
    else{
      $job_position_value = "Job position";
    }

    if(!empty($_REQUEST['job_team'])) {
      $career_team_val = $_REQUEST['job_team'];
    }
    else{
      $career_team_val = "Choose team";
    }


    if(!empty($_REQUEST['job_country'])) {
      $career_country_val = $_REQUEST['job_country'];
    }
    else{
      $career_country_val = "Choose the country";
    }

    if(!empty($_REQUEST['career_team'])) {
      $sub_team_val = $_REQUEST['career_team'];
    }
    else{
      $sub_team_val = "Team";
    }

    if(!empty($_REQUEST['career_country'])) {
      $sub_country_val = $_REQUEST['career_country'];
    }
    else{
      $sub_country_val = "Country";
    }

?>

<form name="career_search_form" method="get" id="career_search_form" action="" role="search">
<div class="searchtool-banner careers-banner" style="background-image: url(<?php echo $banner_image[0]; ?>) !important;">
      <div class="container position-relative">
        <div class="row align-items-center">
          <div class="col">
            <h2 class="main-heading"><?php echo $banner_title; ?></h2>
          </div>
        </div>
        <div class="search-form-fields">
          <div class="row">
            <div class="col-sm-11 pr-0">
              <div class="row">
                <div class="col">
                  <label class="d-block">Who would you like to be?</label>
                  <div class="dropdown select-theme filter-dropdown pl-0 careers-form-border float-none">
                    <button id="title-btn" class="btn btn-secondary dropdown-toggle job-position" type="button"><span><?php echo $job_position_value; ?></span></button>
                    <div class="dropdown-menu job-position-show">
                      <?php echo $job_tilte_list; ?>
                    </div>
                    <input type="hidden" name="job_position" value="<?php echo $_GET['job_position']; ?>">
                  </div>
                </div>
                <div class="col">
                  <label class="d-block">Which team woild you like to join?</label>
                  <div class="dropdown select-theme filter-dropdown pl-0 careers-form-border float-none">
                    <button class="btn btn-secondary dropdown-toggle tc_career-team" id="job_btn3" type="button"><span><?php echo $career_team_val; ?></span></button>
                    <div class="dropdown-menu tc_career-team-show">
                      <?php echo $job_team_list; ?>
                    </div>
                    <input type="hidden" name="job_team" value="<?php echo $_GET['job_team']; ?>">
                  </div>
                </div>
                <div class="col">
                  <label class="d-block">Where?</label>
                  <div class="dropdown select-theme filter-dropdown pl-0 careers-form-border float-none">
                    <button id="job_btn1" class="btn btn-secondary dropdown-toggle career_country" type="button"><span><?php echo $career_country_val; ?></span></button>
                    <div class="dropdown-menu career_country_show">
                      <?php echo $job_country_list; ?>
                    </div>
                    <input type="hidden" name="job_country" value="<?php echo $_GET['job_country']; ?>">
                  </div>
                </div>
              </div>
            </div>
            <div class="col-sm-1 text-right pt-4">
              <a href="javascript:void(0);" onclick="document.getElementById('career_search_form').submit();"><img src="<?php echo get_template_directory_uri(); ?>/images/searchbar-icon.png" alt="Search" /></a>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="careers-current-position">
      <div class="container">
        <div class="row align-items-end m-b-50">
          <div class="col-sm-8">
            <h2 class="main-heading text-left"><span class="d-block">Current open</span>job positions</h2>
          </div>
          <div class="col-sm-2">
            <div class="dropdown">
              <button class="btn btn-secondary dropdown-toggle sub-career"  type="button"><span><?php echo $sub_team_val; ?></span></button>
              <div class="dropdown-menu sub-career-show">
                <?php echo $career_team; ?>
              </div>
              <input type="hidden" name="career_team" value="<?php echo $_GET['career_team']; ?>">

            </div>
          </div>
          <div class="col-sm-2">
            <div class="dropdown">
              <button class="btn btn-secondary dropdown-toggle sub-country" type="button">
              <span><?php echo $sub_country_val; ?></span>
              </button>
              <div class="dropdown-menu sub-country-show">
                <?php echo $career_country; ?>
              </div>
              <input type="hidden" name="career_country" value="<?php echo $_GET['career_country']; ?>">
            </div>
          </div>
        </div>

        <div class="row">
          <?php echo $career_list; ?>
        </div>

        <div class="row justify-content-center">
          <div class="col-sm-5 text-center m-t-50">
            <?php if($max_pagenum > 1) {

                  $query_param = '';

                if(!empty($_REQUEST['job_position']))
                {
                  $query_param .= '&job_key='.$job_searchkey;
                }

                if(!empty($_REQUEST['job_team']))
                {
                  $query_param .= '&job_team='.$team;

                }
                if(!empty($_REQUEST['job_country']))
                {
                  $query_param .= '&job_country='.$country;
                }
                if(!empty($_REQUEST['career_team']))
                {
                  $query_param .= '&career_team='.$subteam;
                }
                if(!empty($_REQUEST['career_country']))
                {
                  $query_param .= '&career_country='.$subcountry;
                }


              ?>

              <a href="/career-search?excludeJob=<?php echo $ex_job_id;?><?php echo $query_param; ?>"><button type="button" class="btn btn-theme">more open positions<img src="<?php echo get_template_directory_uri(); ?>/images/whiteforward.png" /></button></a>


            <?php } ?>

          </div>
        </div>
      </div>
    </div>
  </form>

  <div class="gray-bg clearfix careers-jobs-team p-b-80 p-t-80">
      <div class="container">
        <h2 class="main-heading m-b-80">Browse jobs by team</h2>
        <div class="row">
          <?php echo $job_cat_list; ?>
        </div>
        <div class="row career_team_hide">
          <?php echo $job_cat_list_show; ?>
        </div>

          <div class="row justify-content-center">
            <div class="col-sm-12 text-center m-t-50 career_team_show" <?php echo $show_teamBtn; ?>>
              <button type="button" class="btn btn-theme show_team_btn">show all teams<img class="w-auto h-auto" src="<?php echo get_template_directory_uri(); ?>/images/down-white.png" /></button>
            </div>
            <div class="col-sm-12 text-center m-t-50 career_team_hide">
              <button type="button" class="btn btn-theme hide_team_btn">Hide teams<img class="w-auto h-auto" src="<?php echo get_template_directory_uri(); ?>/images/down-white.png" /></button>
            </div>
          </div>

        </div>
      </div>

<?php

  echo do_shortcode('[we_are_tcglobal id=573 layout="style_two"]');

  echo do_shortcode('[global_partner id=113 title="We exist to catalyze world citizenship" subtitle="Why Join TC Global" bgclass="p-t-80"]');

?>


  <div class="desktop-icon-verticaltab careers-verticaltab gray-bg p-t-60 p-b-80 m-t-80">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-sm-10">
            <div class="tab-content carousel-section-one slider">
              <?php echo $section_one; ?>
            </div>
            <div class="tab-content carousel-section-two slider">
              <?php echo $section_two; ?>
            </div>
            <div class="tab-content carousel-section-three slider">
              <?php echo $section_three; ?>
            </div>
            <div class="tab-content carousel-section-four slider">
              <?php echo $section_four; ?>
            </div>
          </div>
          <div class="col-sm-10">
            <div class="nav flex-column nav-pills career_section_tab">
              <a class="nav-link active" id="carousel-section-one">
              <img class="default career-img-load" src="<?php echo get_template_directory_uri(); ?>/images/vtab-default-icon1.jpg" alt="" />
              <img class="current career-img-load" src="<?php echo get_template_directory_uri(); ?>/images/vtab-active-icon1.png" alt="" />
              <span>Be Consumer centric</span></a>

              <a class="nav-link" id="carousel-section-two">
                <img class="default career-img-load" src="<?php echo get_template_directory_uri(); ?>/images/vtab-default-icon5.jpg" alt="" />
                <img class="current career-img-load" src="<?php echo get_template_directory_uri(); ?>/images/vtab-active-icon5.png" alt="" />
                <span>Be Purposeful</span></a>

              <a class="nav-link" id="carousel-section-three">
                  <img class="default career-img-load" src="<?php echo get_template_directory_uri(); ?>/images/vtab-default-icon3.jpg" alt="" />
                  <img class="current career-img-load" src="<?php echo get_template_directory_uri(); ?>/images/vtab-active-icon3.png" alt="" />
                  <span>Be Progressive</span></a>
              <a class="nav-link" id="carousel-section-four">
                    <img class="default career-img-load" src="<?php echo get_template_directory_uri(); ?>/images/vtab-default-icon4.jpg" alt="" />
                    <img class="current career-img-load" src="<?php echo get_template_directory_uri(); ?>/images/vtab-active-icon4.png" alt="" />
                    <span>Be Together</span></a>
            </div>
          </div>
        </div>
      </div>
    </div>

<?php

echo do_shortcode('[service_section id=118 layout="style_three" headingtitle="Fight your untapped potential" subheading="At TC Global, we are waging a war against our untapped potential, not just in our work, but also in our lives. Join us, accelerate growth and leverage our platform to unlock resources to live to your greatest potential"]');

echo do_shortcode('[heading title="TC Global" subtitle="Community Insights"][testimonial id=119 layout="style_two"]');

echo do_shortcode('[heading title="success in numbers" subtitle="Our Impact"][our_impact_section id=83]');

echo do_shortcode('[global_career_slider id="576"]');
echo do_shortcode('[global_section id="574" title="Shan Chopra" sub_title="Chief Storyteller" layout="style_two"]');

?>

<?php get_footer(); ?>
