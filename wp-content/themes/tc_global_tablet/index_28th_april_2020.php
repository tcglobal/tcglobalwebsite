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

    $type_list .='<li id="'.$tag->name.'"><a class="'.$act_cls.'" ><img src="'.get_template_directory_uri().'/images/drop-tick.jpg" alt="">'.$tag->name.'</a></li>';
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

        $topic_list .='<li id="'.$detail->name.'"><a class="'.$act_cls.'" ><img src="'.get_template_directory_uri().'/images/drop-tick.jpg" alt="">'.$detail->name.'</a></li>';
    }
$topic_list .='</ul>';


$business_list = ["Global Ed", "Global Learning", "Global Investments", "Global Workspace"];

$act_cls = '';
if($insight_business_val == 'All'){
    $act_cls = 'active';
  }

  $insight_business = '<ul id="selc_insight_business">';
    $insight_business .='<li id="All"><a class="'.$act_cls.'" ><img src="'.get_template_directory_uri().'/images/drop-tick.jpg" alt="">All</a></li>';
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

$ex_insignt_id = '';

if($custom_query->have_posts()) :
  while ($custom_query->have_posts()) : $custom_query->the_post();

      $img = '';
      $insignt_id = get_the_ID();
      $ex_insignt_id .=$insignt_id.',';
      //$img = wp_get_attachment_image_src( get_post_thumbnail_id($insignt_id), 'medium' );
      $tag = get_the_tags($insignt_id);

      if ($i == 1) { 
        $cls = 'col-sm-8'; 
        $img = wp_get_attachment_image_src( get_post_thumbnail_id($insignt_id), 'full' );
      }
      else { 
        $cls = 'col-sm-4 three_column'; 
        $img = wp_get_attachment_image_src( get_post_thumbnail_id($insignt_id), 'medium' ); 
      }


        $insignt_content .='<div class="'.$cls.' m-b-30">
                      <div class="position-relative">
                        <a href="'.get_permalink( $insignt_id ).'"><img src="'.$img[0].'" alt="" class="img-fluid"></a>
                        
                      </div>
                      <div class="contentslider">
                        <span class="taglabel">'.$tag[0]->name.'</span>
                        <div class="datetime float-right">'.get_the_date('d.m.Y').'</div>
                        <div class="formheading pb-2"><a href="'.get_permalink( $insignt_id ).'">'.get_the_title($insignt_id).'</a></div>
                        <a href="'.get_permalink( $insignt_id ).'"><p>'.get_kc_excerpt().'</p></a>
                      </div>
                    </div>';

$i++;
endwhile;

else:
      $insignt_content ='<p class="no_result">Sorry, no results found.</p>';

endif;
wp_reset_postdata();

$max_pagenum = $custom_query->max_num_pages;

if ( $max_pagenum > 1 )
{
	$loadbtn ='<a id="load_post" class="eventbtn text-uppercase text-decoration-none d-block mx-auto">load more insights<span><img src="'.get_template_directory_uri().'/images/down-white.png" alt=""></span></a>';
}

?>

<?php
   $exclude_insightPost = rtrim($ex_insignt_id, ',');
    $selected_filter_val='';

if( !empty($insight_type_val) || !empty($insight_topic_val) || !empty($insight_business_val) )
{

$selected_filter_val .='<div class="event-topfilter m-b-40 p-t-10">
  <div class="event-topfilter-value d-block">
    <div class="row">
      <div class="col-sm-12">
        <span class="subheadingitem fs-12" style="font-size:12px !important;">Selected:</span>
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

        $selected_filter_val .='</span>
        <a id="clear_field" class="clear-btn ml-3"><span >CLEAR ALL</span></a>
      </div>
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
        $sel_intopic_val = "Choose topic";
      }

      if(!empty($_REQUEST['insight_business'])) {
        $sel_inbusiness_val = $_REQUEST['insight_business'];
      }
      else{
        $sel_inbusiness_val = "Choose business";
      }
  ?>

<div class="searchtool-banner insights-banner" style="background: url(<?php echo $banner_image[0]; ?>) !important;background-position: center !important;">
      <div class="bg-color"></div>
      <div class="container-fluid position-relative">
        <div class="row align-items-center">
          <div class="col">
            <h2 class="main-heading"><?php echo $banner_title; ?></h2>
          </div>
        </div>
      </div>
    </div>

<form name="insight_search_form" method="get" id="insight_search_form" action="" role="search">
<div class="search-result p-t-50 pb-0">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-12">
            <h2 class="main-heading col-sm-9 p-0">Ideas  to help catalyse the Global Citizens of tomorrow</h2>
            <div class="row">
              <div class="col-sm-12">
                <div class="insights-topsearch-select">
                  <div class="row justify-content-between">
                    <div class="col-sm-4">
                      <div class="seach-textbox">
                        <input type="text" name="s" placeholder="What you're looking for?" class="form-control" value="<?php echo $_REQUEST['s']; ?>" />
                         <a href="javascript:void(0);" onclick="document.getElementById('insight_search_form').submit();"><img class="search-icon" src="<?php echo get_template_directory_uri(); ?>/images/searchbar-icon.png" alt="Search" /></a>
                      </div>
                    </div>

                    <div class="col-sm-8">
                      <div class="row event-topfilter m-t-25 mb-0">
                        <div class="col">
                          <ul class="filter-dropdown clearfix">
                            <li class="float-none"><div class="dropdown dropdown-theme pl-0">
                              <button class="btn btn-secondary black-txt dropdown-toggle insight-type" type="button"><?php echo $sel_type_val; ?></button>
                              <div class="dropdown-menu insight-type-show">
                                <?php echo $type_list; ?>
                              </div>
                            </div></li>
                          </ul>
                          <input type="hidden" name="type" value="<?php echo $_GET['type']; ?>" />
                        </div>
                        <div class="col">
                          <ul class="filter-dropdown clearfix">
                            <li class="float-none"><div class="dropdown dropdown-theme pl-0">
                              <button class="btn btn-secondary black-txt dropdown-toggle insight-topic" type="button"><?php echo $sel_intopic_val; ?></button>
                              <div class="dropdown-menu insight-topic-show">
                                <?php echo $topic_list; ?>
                              </div>
                            </div></li>
                          </ul>
                          <input type="hidden" name="insight_topic" value="<?php echo $_GET['insight_topic']; ?>" />
                        </div>
                        <div class="col">
                          <ul class="filter-dropdown clearfix">
                            <li class="float-none"><div class="dropdown dropdown-theme pl-0">
                              <button class="btn btn-secondary black-txt dropdown-toggle insight-business" type="button"><?php echo $sel_inbusiness_val; ?></button>
                              <div class="dropdown-menu insight-business-show">
                                <?php echo $insight_business; ?>
                              </div>
                            </div></li>
                          </ul>
                          <input type="hidden" name="insight_business" value="<?php echo $_GET['insight_business']; ?>" />
                        </div>
                      </div>
                    </div>
					       </div>
                </div>

                <?php echo $selected_filter_val; ?>

                <div class="col-sm-12 eventers-section inlights-morelist p-0 m-b-30">
                  <div class="row" id="insight_post">
      						  <?php echo $insignt_content; ?>
      					</div>
                </div>

                <input type="hidden" name="exclude_insight_post" value="<?php echo $exclude_insightPost; ?>">
                <div class="text-center w-100 m-t-10 m-b-60 loadmore">
                	<?php echo $loadbtn; ?>
                </div>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</form>

<?php echo do_shortcode( '[global_section id="525" title="Subscribe!" sub_title="No spam, just your favourite topics." layout="style_one" popup="enabled"]' ); ?>
<?php echo do_shortcode( '[popular_insights title="Popular Insights" layout="style_one"]' ); ?>

<?php echo do_shortcode( '[content_block id=21 slug=common-section]' ); ?>





<?php get_footer(); ?>
