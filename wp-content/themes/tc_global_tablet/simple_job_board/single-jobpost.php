<?php
/**
 * The Template for displaying job details
 *
 * Override this template by copying it to yourtheme/simple_job_board/single-jobpost.php
 *
 * @author      PressTigers
 * @package     Simple_Job_Board
 * @subpackage  Simple_Job_Board/Templates
 * @version     1.1.0
 * @since       2.2.0
 * @since       2.2.3   Enqueued Front Styles & Revised the HTML structure.
 * @since       2.2.4   Enqueued Front end Scripts.
 * @since       2.3.0   Added "sjb_archive_template" filter.
 */
get_header();

ob_start();
global $post, $wpdb;

 $job_category = get_the_terms( $post->ID, 'jobpost_category' );
 $job_location = get_the_terms( $post->ID, 'jobpost_location' );
 $parent_catid = $job_location[0]->parent;
 $country = get_term_by('id', $parent_catid, 'jobpost_location');
 $experience = get_post_meta( $post->ID, 'work_experience', true );

 $CareerLocName = $job_location[0]->name;

 	$url = get_permalink($post->ID);
 	$title = get_the_title($post->ID);
	$fb = "http://www.facebook.com/share.php?u=".$url."&title=".$title."";
	$linkedin = "http://www.linkedin.com/shareArticle?mini=true&url=".$url."&title=".$title."";
	$twitter = "http://twitter.com/home?status=".$title."+".$url."";

?>

<div class="searchtool-banner careers-banner">
</div>
<div class="bg-color Partner-banner position-relative ">
<div class="bottom-bg"></div>
<div class="container-fluid position-relative p-0">
  <div class="search-form-fields event-detail-fields careers-associate-consultant insights-details-page">
    <div class="bg-color"></div>
    <div class="row">
      <div class="col-sm-12 event-left-banner">
        <div class="col-sm-12 p-0 mb-3"><span class="tags"><?php echo $job_category[0]->name; ?></span></div>
        <h1 class="main-heading text-left"><?php echo get_the_title($post->ID); ?></h1>

        <div class="col-sm-12 carrer-right-box ">
          <div class="row">
            <div class="col-sm-12 pl-0 pt-2 pb-4">
              <span class="event-small-head mb-2">Date added:</span>
              <span class="event-small-head-value"><?php echo get_the_date('d.m.Y', $post->ID); ?></span>
            </div>

            <div class="col-sm-4 ">

            <?php if($CareerLocName){ ?>

              <div class="row list-detail">
                <div class="col-2 pl-0 pr-0">
                  <img src="<?php echo get_template_directory_uri(); ?>/images/map.png" alt="">
                </div>
                <div class="col-10 pl-0">
                  <p class="fs-14"><span><?php echo $job_location[0]->name; ?>, </span> <?php echo $country->name; ?> </p>
                </div>
              </div>
            <?php } ?> 

            </div>

            <div class="col-sm-8 ">
              <?php if($experience) { ?>
              <div class="row list-detail">
                <div class="col-1 pl-0 pr-2">
                  <img src="<?php echo get_template_directory_uri(); ?>/images/workspaceicon.png" alt="">
                </div>
                <div class="col-10 pl-0">
                  <p class="fs-14"><span><?php echo $experience; ?></span>  years of experience </p>
                </div>
              </div>
              <?php } ?>
            </div>
          </div>
        </div>

        <div class="col-sm-12 p-0">
          <div class="row">
            <div class="col-sm-12 mb-4">
              <?php
                  while ( have_posts() ) : the_post();
                    the_content(); // get post content
                  endwhile;
              ?>
             </div>
            </div>
          </div>
          <div class="col-sm-12 p-0">
            <a href="/careers" class="explorelink text-uppercase text-decoration-none" tabindex="0">Back to job offers <span class="pl-3"><img src="<?php echo get_template_directory_uri(); ?>/images/down_2.png" alt=""></span></a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="col-sm-12  bottom-selection">
  <div class="row">
    <div class="col-sm-6 text-center border-right">
      <div class="share-event clearfix p-t-10 mt-1">
        <h4 class="float-left mx-4 mb-0 mt-1">Share the job offer:</h4>
        <ul class="footerul clearfix float-left ml-2">
           <li class="float-left mr-3"><a href="<?php echo $fb; ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/facebook.png" alt=""></a></li>
            <li class="float-left mr-3"><a href="<?php echo $linkedin; ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/linkedin.png" alt=""></a></li>
            <li class="float-left mr-3"><a href="<?php echo $twitter; ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/twitter.png" alt=""></a></li>
        </ul>
      </div>
    </div>
    <div class="col-sm-6 text-center">
      <a href="/apply-job?curjobid=<?php echo $post->ID; ?>"><button type="button" class="btn btn-theme w-250 btn-block">apply now</button></a>
    </div>
  </div>
</div>

 <?php echo do_shortcode('[related_jobs title="Related positions"]'); ?>

<?php
	get_footer();

?>
