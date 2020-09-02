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

<div class="searchpartner-banner-bg careers-banner" >
  <div class="container position-relative event-head" >
    <div class="row align-items-center">
    </div></div>
</div>

 <div class="event-content">
        <div class="bg-color Partner-banner position-relative">
          <div class="bottom-bg"></div>
          <div class="container position-relative">
            <div class="top-bg"></div>
            <div class="partner-form-fields careers-associate-consultant events-page-detail p-b-60">
              <div class="row">
                <div class="col-sm-8 ">
                  <div class="col-sm-12 p-0 mb-3"><span class="tags"><?php echo $job_category[0]->name; ?></span></div>
                  <h1 class="main-heading text-left"> <?php echo get_the_title($post->ID); ?></h1>
                    <div class="col-sm-10 ">
                      <div class="row">
                        <div class="col-sm-6 pl-0 pt-2 pb-4">
                          <span class="event-small-head mb-2">Date added:</span>
                          <span class="event-small-head-value"><?php echo get_the_date('d.m.Y', $post->ID); ?></span>
                        </div>

                      </div>
                    </div>
                    <div class="col-sm-12">
                      <div class="row">
						<div class="col-sm-12 pl-0 mb-4">

							<?php
							while ( have_posts() ) : the_post();
								the_content(); // get post content
							endwhile;
							?>

						</div>
          </div>
				</div>
                </div>
                <div class="col-sm-4 ">
                  <div class="right-section-pad pl-4">
                    <div class="carrer-right-box">

                    <?php if($CareerLocName){ ?>
                      
                      <div class="row list-detail">
                        <div class="col-2 pr-0">
                          <img src="<?php echo get_template_directory_uri(); ?>/images/map.png" alt="">
                        </div>
                        <div class="col-10 pl-2">
                          <p class="fs-14"><span><?php echo $job_location[0]->name; ?>, </span> <?php echo $country->name; ?></p>
                        </div>
                      </div>
                    <?php } ?>  

                       <div class="row list-detail">
                       	<?php if($experience) { ?>
                        <div class="col-2 pr-0">
                          <img src="<?php echo get_template_directory_uri(); ?>/images/workspaceicon.png" alt="">
                        </div>
                        <div class="col-10 pl-2">
                          <p class="fs-14"><span><?php echo $experience; ?></span>  years of experience </p>
                        </div>
                        <?php } ?>
                      </div>


                    <div class="col-sm-12 p-0 m-t-20"><div class="row"><div class="col-sm-12"><div class="check-eligible">
                      <a href="/apply-job?curjobid=<?php echo $post->ID; ?>"><button type="button" class="btn btn-block btn-danger">apply now</button></a>
                    </div>
                  </div>
                  </div></div>
                  <div class="theme-bor-btm m-b-30 m-t-10"></div>
                    <div class="share-event col-sm-12 pl-0 p-b-20 ">
                      <h4 class="m-t-30 m-b-20">Share the job offer</h4>
                      <ul class="footerul">
                        <li><a href="<?php echo $fb; ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/facebook.png" alt=""></a></li>
                  			<li><a href="<?php echo $linkedin; ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/linkedin.png" alt=""></a></li>
                  			<li><a href="<?php echo $twitter; ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/twitter.png" alt=""></a></li>
                      </ul>
                    </div>
                  </div>
                  </div>
                </div>
                <div class="col-sm-12 m-t-20">
                  <a href="/careers" class="explorelink text-uppercase text-decoration-none" tabindex="0">Back to job offers<span class="pl-3"><img src="<?php echo get_template_directory_uri(); ?>/images/down_2.png" alt=""></span></a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <?php echo do_shortcode('[related_jobs title="Related positions"]'); ?>

<?php
	get_footer();

?>
