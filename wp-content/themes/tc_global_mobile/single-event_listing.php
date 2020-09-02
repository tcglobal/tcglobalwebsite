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

        $newDate = date("d.m.Y", strtotime($event_date));

         $event_stime = get_post_meta(  $cur_postid, '_event_start_time', true );

        $fb = get_post_meta( $cur_postid, '_organizer_facebook', true );
        $linkedin = get_post_meta( $cur_postid, '_linkedin', true );
        $twitter = get_post_meta( $cur_postid, '_organizer_twitter', true );

        $post_object = get_post( $cur_postid );

?>

  <div class="Events-banner event-detail-sec">
      <div class="bg-color"></div>
      <div class="container position-relative">
        <div class="row">
          <div class="col">
            <h2 class="mobile-main-heading">TC Global <br/> Events</h2>
          </div>
        </div>

        <div class="search-form-fields search-result">
          <div class="row">
            <div class="col-sm-12 event-left-banner">
              <div class="col-sm-12 p-0 mb-3 clearfix"><span class="tags"><?php echo $event_category[0]->name; ?></span></div>
              <h1 class="main-heading text-left overflow-hide">
                <span class=""><?php echo get_the_title($cur_postid); ?></span>
              </h1>
              <div class="col-sm-12 p-t-10 p-b-30 px-0">
                <div class="row">
                  <div class="col-sm-12">
                    <p class="event-small-head mb-2">Date and time</p>
                    <p class="event-small-head-value m-b-20"><?php echo $newDate; ?> at <?php echo $event_stime; ?> </p>
                  </div>
                  <div class="col-sm-12">
                    <p class="event-small-head mb-2">Location</p>
                    <p class="event-small-head-value mb-2"><?php echo $event_addr; ?></p>
                  </div>
                </div>
              </div>
              <div class="quick-fact col-sm-12 px-0 pb-4">
                <h4 class="m-t-30 m-b-20">People at the Event</h4>
                <div class="row">
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
                  <div class="col-sm-12 m-b-20">
                    <div class="row">
                      <div class="col-3 pr-0">
                        <img src="<?php echo $invite_imgurl[0]; ?>" alt="life" class="img-fluid">
                      </div>
                      <div class="col-9">
                        <div class="event-people">
                          <h4><?php echo $invitename; ?></h4>
                          <p><?php echo $inviterole; ?> </p>
                        </div>
                      </div>
                    </div>
                  </div>
				          <?php } } ?>

                      </div>
                    </div>

                    <div class="share-event col-sm-12 pl-0 pb-5 mobile-footer-section">
                      <h4 class="m-t-30 mb-4">Share</h4>
                      <ul class="footerul">
                        <li><a href="<?php echo $fb; ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/facebook.png" alt=""></a></li>
                        <li><a href="<?php echo $linkedin; ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/linkedin.png" alt=""></a></li>
                        <li><a href="<?php echo $twitter; ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/twitter.png" alt=""></a></li>
                      </ul>
                    </div>
                    <div class="col-sm-12 px-0">
                      <div class="row">
                        <div class="col-sm-12">
                            <?php
                            while ( have_posts() ) : the_post();

                            setEventViews($post->ID);
                            the_content(); // get post content

                            endwhile;
                          ?>
                        </div>
                      </div>
                    </div>
                    <div class="col-sm-12 m-t-30 m-b-20 px-0">
                      <a href="/events" class="explorelink text-uppercase text-decoration-none px-0" tabindex="0">Back to Events<span class="pl-3"><img src="<?php echo get_template_directory_uri(); ?>/images/down_2.png" alt=""></span></a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

<div class="col-sm-12 bottom-selection">
  <div class="row">
    <div class="col-12 text-center">
      <!--<a href="/event-register?eventid=<?php echo $cur_postid; ?>"><button type="button" class="btn btn-theme btn-block">register to the event</button></a>-->
	  <a href="/event-register?eventid=<?php echo $cur_postid; ?>"><button type="button" class="btn btn-theme btn-block">Register</button></a>	  
    </div>
  </div>
</div>

<?php echo do_shortcode( '[popular_events title="Events You May Like"]' ); ?>

<?php echo do_shortcode( '[content_block id=21 slug=common-section]' ); ?>


<?php get_footer(); ?>
