<?php

/**
 * The template for displaying all post list
 *
 * This is the template that displays all post list by default.
 **/

 get_header();
?>

<?php

global $post, $wpdb;

$i =1;

 $page_for_posts = get_option( 'page_for_posts' );

  $banner_image = wp_get_attachment_image_src( get_post_thumbnail_id($page_for_posts), 'full' );
  $banner_title = get_post_meta( $page_for_posts, 'banner_title', true );

    //$search_key = $_REQUEST['s'];
    /** replace apostrophe (’) with single quote(') in search key **/
    $get_key = $_REQUEST['s'];
    $search_key = str_replace('’', "'", $get_key);
    
    $insight_type_val = $_REQUEST['type'];
    $insight_topic_val = $_REQUEST['insight_topic'];
    $insight_business_val = $_REQUEST['insight_business'];

$act_cls = '';
$type_list = '';
$taglist = get_terms('post_tag');

if($insight_type_val == 'All'){
    $act_cls = 'active';
}

$type_list .='<ul id="selc_insignt_type">';
$type_list .='<li id="All"><a class="'.$act_cls.'" ><img src="'.get_template_directory_uri().'/images/drop-tick.jpg" alt="">All</a></li>';

  foreach ($taglist as $tag)
  {

    if($_REQUEST['type'] == $tag->name ){$act_cls = 'active'; }
    else {$act_cls = ''; }

    $type_list .='<li id="'.$tag->name.'"><a class="'.$act_cls.'"><img src="'.get_template_directory_uri().'/images/drop-tick.jpg" alt="">'.$tag->name.'</a></li>';
  }
$type_list .='</ul>';


// Get the taxonomy's terms
$topic_detail = get_terms(
    array(
        'taxonomy'   => 'category',
        //'hide_empty' => false,
        'orderby' => 'term_id',
        'order' => 'ASC', // or ASC
    )
);

$topic_list = '';

$act_cls = '';

if($insight_topic_val == 'All'){
    $act_cls = 'active';
  }

$topic_list .='<ul id="selc_insight_topic">
  <li id="All"><a class="'.$act_cls.'" ><img src="'.get_template_directory_uri().'/images/drop-tick.jpg" alt="">All</a></li>';
    foreach ($topic_detail as $detail)
    {
        if($_REQUEST['insight_topic'] == $detail->name ){$act_cls = 'active'; }
        else {$act_cls = ''; }

        $topic_list .='<li id="'.$detail->name.'"><a class="'.$act_cls.'"><img src="'.get_template_directory_uri().'/images/drop-tick.jpg" alt="">'.$detail->name.'</a></li>';
    }
$topic_list .='</ul>';


$business_list = ["Global Ed", "Global Learning", "Global Investments", "Global Workspace"];

$act_cls = '';
if($insight_business_val == 'All'){
    $act_cls = 'active';
  }

  $insight_business = '<ul id="selc_insight_business">';
    $insight_business .='<li id="All"><a class="'.$act_cls.'"  ><img src="'.get_template_directory_uri().'/images/drop-tick.jpg" alt="">All</a></li>';
    foreach ( $business_list as $value) {

      if($_REQUEST['insight_business'] == $value ){$act_cls = 'active'; }
      else {$act_cls = ''; }

      $insight_business .='<li id="'.$value.'"><a class="'.$act_cls.'"><img src="'.get_template_directory_uri().'/images/drop-tick.jpg" alt="">'.$value.'</a></li>';
    }
  $insight_business .='</ul>';

  $relation = 'OR';

      if(!empty($_REQUEST['type']) && !empty($_REQUEST['insight_topic']))
      {
        $relation = 'AND';
      }
      if(!empty($_REQUEST['insight_topic']) && !empty($_REQUEST['insight_business']))
      {
        $relation = 'AND';
      }
      if(!empty($_REQUEST['type']) && !empty($_REQUEST['insight_business']) )
      {
        $relation = 'AND';
      }

      elseif(!empty($_REQUEST['type']) && !empty($_REQUEST['insight_topic']) && !empty($_REQUEST['insight_business']))
      {
        $relation = 'AND';
      }

   $insight_tax_query = array('relation' => $relation);
   $insight_meta_query = array('relation' => $relation);    

  if(!empty($_REQUEST['type']) && $_REQUEST['type'] != "All" ) 
    {
      
        $insight_tax_query[] = array(

                'taxonomy' => 'post_tag',
                'field' => 'name',
                'terms' => $insight_type_val,  
                'operator' => 'IN',
          );    
    }

    if(!empty($_REQUEST['insight_topic']) && $_REQUEST['insight_topic'] != "All")
    {

      $insight_tax_query[] = array(
                
                    'taxonomy' => 'category',
                    'field' => 'name',
                    'terms' => $insight_topic_val,
                    'operator' => 'IN',
          );  
    }

    if(!empty($_REQUEST['insight_business']) && $_REQUEST['insight_business'] != "All" )
    {
        $insight_meta_query[] = array(
                
                'key' => 'choose_business',
                'value' => $insight_business_val,
                'compare' => 'LIKE'
          );  
    }       

    
    $args = array( 
          'post_type' => 'post', 
          'posts_per_page' => 5, 
          'order' => 'DESC', 
          's' => $search_key,
          'tax_query' => $insight_tax_query,
          'meta_query' => $insight_meta_query,
          
      );

  // Instantiate custom query
      $custom_query = new WP_Query( $args );

      $insignt_content = '';
      $insignt_content_two = '';

$ex_insignt_id = '';

if($custom_query->have_posts()) :
  while ($custom_query->have_posts()) : $custom_query->the_post();

        $insignt_id = get_the_ID();
        $ex_insignt_id .=$insignt_id.',';
        $img = wp_get_attachment_image_src( get_post_thumbnail_id($insignt_id), 'medium' );
        $tag = get_the_tags($insignt_id);

      if ($i == 1)
        {

	        $insignt_content .='
          		<div class="col-sm-12 three_column m-b-30">
	              <div class="position-relative">
	                <a href="'.get_permalink( $insignt_id ).'"><img src="'.$img[0].'" alt="" class="img-fluid w-100"></a>
	                
	                </div>
	              <div class="contentslider">
	                <span class="taglabel">'.$tag[0]->name.'</span>
	                <div class="datetime float-right">'.get_the_date('d.m.Y').'</div>
	                <div class="formheading pb-2 mt-3"><a href="'.get_permalink( $insignt_id ).'">'.get_the_title($insignt_id).'</a></div>
	                <a href="'.get_permalink( $insignt_id ).'"><p>'.get_kc_excerpt().'</p></a>
	              </div>
	            </div>';

		}
		else{

			$insignt_content_two .='<div class="col-sm-12 three_column pb-3 mb-4">
              <div class="row">
                <div class="col-5 position-relative pl-0">
                  <a href="'.get_permalink( $insignt_id ).'"><img src="'.$img[0].'" alt="" class="img-fluid w-100"></a>
                </div>
                <div class="col-5 p-0">
                  <span class="taglabel">'.$tag[0]->name.'</span>
                  <div class="formheading pb-2 mt-2"><a href="'.get_permalink( $insignt_id ).'">'.get_the_title($insignt_id).'</a></div>
                  <div class="datetime float-left">'.get_the_date('d.m.Y').'</div>
                </div>
                <div class="col-2 pr-0">
                  
                </div>
              </div>
            </div>';

		}

$i++;
endwhile;

else:
  $insignt_content ='<p class="no_result">Sorry, no results found.</p>';

endif;
wp_reset_postdata();

$max_pagenum = $custom_query->max_num_pages;

if ( $max_pagenum > 1 )
{
	$loadbtn ='<a id="load_post" class="mobile-filter-btn text-center text-uppercase text-decoration-none d-block mx-auto m-t-40">load more insights<span><img src="'.get_template_directory_uri().'/images/down-white.png" alt=""></span></a>';

}

?>

<?php
   $exclude_insightPost = rtrim($ex_insignt_id, ',');
    $selected_filter_val='';

if( !empty($insight_type_val) || !empty($insight_topic_val) || !empty($insight_business_val) )
{

    $selected_filter_val .='<div class="col-12 event-topfilter-value d-block">
      <div class="row">
        <div class="col-sm-12">
            <span class="subheadingitem fs-12">Selected:</span>
            </div>
              <div class="col-sm-12">
              <span class="selected_items">';

              if(!empty($insight_type_val)){
                $selected_filter_val .='<span class="tags ml-3">'.$insight_type_val.'<a id="clear_ins_type"><img class="ml-1" src="'.get_template_directory_uri().'/images/close-tag.png" /></a></span>';
              }

              if(!empty($insight_topic_val)){
                $selected_filter_val .='<span class="tags ml-3">'.$insight_topic_val.'<a id="clear_ins_topic"><img class="ml-1" src="'.get_template_directory_uri().'/images/close-tag.png" /></a></span>';
              }

              if(!empty($insight_business_val)){
                $selected_filter_val .='<span class="tags ml-3">'.$insight_business_val.'<a id="clear_ins_business" ><img class="ml-1" src="'.get_template_directory_uri().'/images/close-tag.png" /></a></span>';
              }

              $selected_filter_val .='</span></div>';
              $selected_filter_val .='<div class="col-sm-12">
            <a id="clear_field" class="clear-btn"><span>CLEAR ALL</span></a>
          </div>
        </div>
    </div>'; 
}

?>

<?php

    if(!empty($_REQUEST['type'])) {
      $sel_type_val = $_REQUEST['type'];
    }
    else{
      $sel_type_val = "Choose type";
    }

    if(!empty($_REQUEST['insight_topic'])) {
      $sel_intopic_val = $_REQUEST['insight_topic'];
    }
    else{
    //  $sel_intopic_val = "Choose topic";
		$sel_intopic_val = "Choose Category";
    }

    if(!empty($_REQUEST['insight_business'])) {
      $sel_inbusiness_val = $_REQUEST['insight_business'];
    }
    else{
      $sel_inbusiness_val = "Choose business";
    }

?>


<div class="mobile-global-education-banner insights-banner" style="background: url(<?php echo $banner_image[0]; ?>) !important;background-position: 69% 0 !important;">
      <div class="bg-color"></div>
      <div class="container-fluid position-relative">
        <div class="row">
          <div class="col pr-5">
            <h2 class="mobile-main-heading pr-5"><?php echo $banner_title; ?></h2>
          </div>
        </div>
      </div>
    </div>

<form name="insight_search_form" method="get" id="insight_search_form" action="" role="search">
    <div class="mobile-global-journey global-space p-t-40 ">
      <div class="container-fluid">
        <div class="p-b-20">
          <h2 class="mobile-main-heading">Ideas to help catalyse the Global Citizens of tomorrow</h2>
        </div>

		<div class="search-form-fields search-result filter-events-form top-0">
          <div class="row">

            <div class="col-12 event-search">
              <div class="input-group">
                  <input type="text" name="s" class="form-control" placeholder="What are you looking for?" value="<?php echo $_REQUEST['s']; ?>">
                  <div class="input-group-append">
                    <span class="input-group-text pr-2" id="basic-addon2">
                      <a href="javascript:void(0);" onclick="document.getElementById('insight_search_form').submit();"><img class="search-icon" src="<?php echo get_template_directory_uri(); ?>/images/search-icon_mb.png" alt="Search" /></a>
                    </span>
                  </div>
                </div>
            </div>

            <div class="col-12 event-topfilter m-b-30 d-none">
              <ul class="filter-dropdown events-dropdown clearfix">
                <li class="float-none"><div class="dropdown pl-0">
                  <button id="insight_btn1" class="btn btn-secondary black-txt dropdown-toggle insight-type" type="button"><span><?php  echo $sel_type_val; ?></span></button>
                  <div class="dropdown-menu insight-type-show">
                    <?php  echo $type_list; ?>
                  </div>
                  </div></li>
              </ul>
              <input type="hidden" name="type" value="<?php  echo $_GET['type']; ?>" />
            </div>
 <div class="col-12 event-topfilter m-b-30 d-none">
              <ul class="filter-dropdown events-dropdown clearfix">
                <li class="float-none"><div class="dropdown pl-0">
                  <button id="insight_btn3" class="btn btn-secondary black-txt dropdown-toggle insight-business" type="button"><span><?php  echo $sel_inbusiness_val; ?></span></button>
                  <div class="dropdown-menu insight-business-show">
                    <?php  echo $insight_business; ?>
                  </div>
                  </div></li>
              </ul>
              <input type="hidden" name="insight_business" value="<?php  echo $_GET['insight_business']; ?>" />
            </div>

            <div class="col-12 event-topfilter m-b-30">
              <ul class="filter-dropdown events-dropdown clearfix">
                <li class="float-none"><div class="dropdown pl-0">
                  <button id="insight_btn2" class="btn btn-secondary black-txt dropdown-toggle insight-topic" type="button"><span><?php echo $sel_intopic_val; ?></span></button>
                  <div class="dropdown-menu insight-topic-show">
                    <?php echo $topic_list; ?>
                  </div>
                  </div></li>
              </ul>
              <input type="hidden" name="insight_topic" value="<?php echo $_GET['insight_topic']; ?>" />
            </div>
           

            <?php echo $selected_filter_val; ?>

            <div class="col-12">
              <a class="btn btn-theme" href="javascript:void(0);" onclick="document.getElementById('insight_search_form').submit();">apply filters</a>
            </div>
          </div>
        </div>

        <div class="col-sm-12 eventers-section inlights-morelist p-0 m-b-10">
          <div class="row">
      			<?php echo $insignt_content; ?>
      		</div>
  		</div>

      <input type="hidden" name="exclude_insight_post" value="<?php echo $exclude_insightPost; ?>">
      
      <div class="col-sm-12 eventers-section insight-list inlights-morelist p-0 m-t-10 p-b-30">
          <div class="" id="insight_post">
          		<?php echo $insignt_content_two; ?>
          </div>
          <?php echo $loadbtn; ?>
        </div>



		</div>
      </div>

</form>

<?php echo do_shortcode( '[global_section id="525" title="Subscribe!" sub_title="No spam, just your favourite topics." layout="style_one" popup="enabled"]' ); ?>

<?php echo do_shortcode( '[popular_insights title="Popular Insights" layout="style_one"]' ); ?>

<?php echo do_shortcode( '[content_block id=21 slug=common-section]' ); ?>

<div class="col-sm-12 bottom-selection">
  <div class="row">
    <div class="col-12 text-center">
      <button type="button" data-toggle="modal" data-target="#schedule_form" id="schedule_trigger" data-keyboard="false" data-backdrop="static" class="btn btn-theme btn-block allformtrigger">schedule an e-Meet</button>
  </div>
  </div>
</div>

<?php get_footer(); ?>
