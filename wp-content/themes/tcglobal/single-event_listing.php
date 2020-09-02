<?php get_header(); ?>

<style>
#menu-item-113 a {color: #da1f3d;}
</style>

<?php

global $tc_head, $tc_subhead, $post, $wpdb;

    $cur_postid = $post->ID;
    $img = wp_get_attachment_image_src( get_post_thumbnail_id($cur_postid), 'full' );
    $event_addr = get_post_meta( $cur_postid, '_event_address', true );
    $event_category = get_the_terms( $cur_postid, 'event_categories' );

    $event_date = get_post_meta( $cur_postid, '_event_start_date', true );

    $eventurl = get_permalink($cur_postid);
    $event_title = get_the_title($cur_postid);
    $fb = "http://www.facebook.com/share.php?u=".$eventurl."&title=".$event_title."";
    $linkedin = "http://www.linkedin.com/shareArticle?mini=true&url=".$eventurl."&title=".$event_title."";
    $twitter = "http://twitter.com/home?status=".$event_title."+".$eventurl."";

    $post_object = get_post( $cur_postid );

?>

	<div class="searchpartner-banner-bg Events-banner">
      <div class="bg-color"></div>
      <div class="container position-relative event-head">
        <div class="row align-items-center">
          <div class="col">
            <h2 class="main-heading">TC Global Events</h2>
          </div>
        </div></div>
      </div>

      <div class="event-content">
        <div class="bg-color Partner-banner position-relative">
          <div class="bottom-bg"></div>
          <div class="container position-relative">
            <div class="top-bg"></div>
            <div class="partner-form-fields events-page-detail">
              <div class="row">

              	<div class="col-sm-7 ">
                  <div class="col-sm-12 p-0 mb-3"><span class="tags"><?php echo $event_category[0]->name; ?></span></div>
                  <h1 class="main-heading text-left">
                    <span class=""><?php echo get_the_title($cur_postid); ?></span>
                  </h1>
                    <div class="col-sm-12 ">
                      <div class="row">
                        <div class="col-sm-6 pl-0 py-4">
                          <h6 class="event-small-head mb-2">Date</h6>
                          <h6 class="event-small-head-value"><?php echo $event_date; ?></h6>
                        </div>
                        <div class="col-sm-6 py-4">
                          <h6 class="event-small-head mb-2">Location</h6>
                          <h6 class="event-small-head-value"><?php echo $event_addr; ?></h6>
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-12">
                      <div class="row">
                      	<div class="col-sm-12 pl-0">

                          <?php
                            while ( have_posts() ) : the_post();

                            setEventViews($post->ID);
                            the_content(); // get post content

                            endwhile;
                          ?>

                      		</div>
                        </div>
                      </div>
                    </div>

          <div class="col-sm-5">
            <div class="right-section-pad">
              <div class="univ_logo">
                <img src="<?php echo $img[0]; ?>" alt="life" class="m-b-20 img-fluid">
              </div>
              <div class="col-sm-12 border-bottom"><div class="row"><div class="col-sm-8 p-0"><div class="check-eligible">
                <!--<a href="/event-register?eventid=<?php echo $cur_postid; ?>"><button type="button" class="btn btn-block btn-danger">Register to the event</button></a>-->
				<a href="/event-register?eventid=<?php echo $cur_postid; ?>"><button type="button" class="btn btn-block btn-danger">Register</button></a>
              </div>
            </div>
            <!--<div class="col-sm-4 text-right mt-3"><img src="<?php echo get_template_directory_uri(); ?>/images/search-fav-unfill.png" alt="fav"></div></div></div>-->
            <div class="quick-fact col-sm-12 pl-0 p-b-20 border-bottom">

              <?php
			  $k==1;
			  for($i=1; $i<=5; $i++)
			  {
			  		$invitename =  get_post_meta( $cur_postid, 'invite_name_'.$i, true );
					$inviterole =  get_post_meta( $cur_postid, 'role_'.$i, true );
					$inviteimag =  get_post_meta( $cur_postid, 'image_'.$i, true );
					if($inviteimag){
						$invite_imgurl = wp_get_attachment_image_src($inviteimag);
					}
					if(!empty($invitename) && !empty($inviterole) && !empty($inviteimag)){
					$k++;
			  ?>
			  <h4 class="m-t-30 m-b-30" <?php if($k==1){ }else { echo 'style="display:none"'; }?>>People at the Event</h4>
			  <div class="col-sm-12 pr-0 mb-2"><div class="row">
                <div class="col-sm-2 p-0 text-center">
                  <img src="<?php echo $invite_imgurl[0]; ?>" alt="life" class="img-fluid m-b-20">
                </div>
                <div class="col-sm-10">
                  <div class="event-people">
                    <p><span><?php echo $invitename; ?></span></p>
                    <p><?php echo $inviterole; ?> </p>
                  </div></div>
                </div>
              </div>
			  <?php } } ?>


              </div>
              <div class="share-event col-sm-12 pl-0 p-b-20 ">
                <h4 class="m-t-30 m-b-20">Share the Event</h4>
                <ul class="footerul">
                  <li><a href="<?php echo $fb; ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/facebook.png" alt=""></a></li>
                  <li><a href="<?php echo $linkedin; ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/linkedin.png" alt=""></a></li>
                  <li><a href="<?php echo $twitter; ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/twitter.png" alt=""></a></li>
                </ul>
              </div>
            </div>
          </div>

          <div class="col-sm-12 m-t-50 m-b-50">
            <a href="/events" class="explorelink text-uppercase text-decoration-none" tabindex="0">Back to Events<span class="pl-3"><img src="<?php echo get_template_directory_uri(); ?>/images/down_2.png" alt=""></span></a>
          </div>


        </div>
      </div>
    </div>
  </div>
</div>

<?php echo do_shortcode( '[popular_events title="Events You May Like" layout="style_one"]' ); ?>

<?php echo do_shortcode( '[content_block id=21 slug=common-section]' ); ?>


<?php get_footer(); ?>
