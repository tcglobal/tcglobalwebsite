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

        $fb = get_post_meta( $cur_postid, '_organizer_facebook', true );
        $linkedin = get_post_meta( $cur_postid, '_linkedin', true );
        $twitter = get_post_meta( $cur_postid, '_organizer_twitter', true );

        $post_object = get_post( $cur_postid );

?>

  <div class="searchtool-banner Events-banner">
      <div class="bg-color"></div>
      <div class="container-fluid position-relative">
        <div class="row align-items-center">
          <div class="col">
            <h2 class="main-heading">TC Global <br/>Events</h2>
          </div>
        </div>
      </div>
    </div>

    <div class="bg-color Partner-banner position-relative">
      <div class="bottom-bg"></div>
      <div class="container-fluid position-relative p-0">
        <div class="search-form-fields event-detail-fields">
          <div class="bg-color"></div>
          <div class="row">
            <div class="col-sm-12 event-left-banner">
              <div class="col-sm-12 p-0 mb-3"><span class="tags"><?php echo $event_category[0]->name; ?></span></div>
              <h1 class="main-heading text-left">
                <span class=""><?php echo get_the_title($cur_postid); ?></span>
              </h1>
              <div class="col-sm-12 p-t-30 p-b-30 px-0">
                <div class="row">
                  <div class="col-sm-4">
                    <p class="event-small-head mb-2">Date</p>
                    <p class="event-small-head-value mb-2"><?php echo $event_date; ?></p>
                  </div>
                  <div class="col-sm-8">
                    <p class="event-small-head mb-2">Location</p>
                    <p class="event-small-head-value mb-2"><?php echo $event_addr; ?></p>
                  </div>
                </div>
              </div>
              <div class="quick-fact col-sm-12 pl-0 pb-4 border-top border-bottom">
              <h4 class="m-t-30 m-b-30">People at the Event</h4>
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

                  <div class="col-sm-6 mb-4">
                    <div class="row">
                    <div class="col-sm-3 pr-0">
                      <img src="<?php echo $invite_imgurl[0]; ?>" alt="life" class="img-fluid" />
                    </div>
                    <div class="col-sm-9 pr-0">
                      <div class="event-people">
                        <h4><?php echo $invitename; ?></h4>
                        <p><?php echo $inviterole; ?></p>
                      </div>
                    </div>
                  </div>
                </div>
				    <?php } } ?>

              </div>
            </div>
            <div class="share-event col-sm-12 pl-0 pb-5 tablet-footer-section">
              <h4 class="m-t-30 mb-4">Share the Event</h4>
              <ul class="footerul">
                <li><a href="<?php echo $fb; ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/facebook.png" alt=""></a></li>
                <li><a href="<?php echo $linkedin; ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/linkedin.png" alt=""></a></li>
                <li><a href="<?php echo $twitter; ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/twitter.png" alt=""></a></li>
              </ul>
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
                <div class="col-sm-12 m-t-50 px-0">
                  <a href="/events" class="explorelink text-uppercase text-decoration-none" tabindex="0">Back to Events<span class="pl-3"><img src="<?php echo get_template_directory_uri(); ?>/images/down_2.png" alt=""></span></a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

<div class="col-sm-12 bottom-selection">
    <div class="row justify-content-center">
      <div class="col-sm-6 text-center">
        <a href="/event-register?eventid=<?php echo $cur_postid; ?>"><button type="button" class="btn btn-theme w-250 btn-block">Register</button></a>
      </div>
    </div>
  </div>

<?php echo do_shortcode( '[popular_events title="Events You May Like"]' ); ?>

<?php echo do_shortcode( '[content_block id=21 slug=common-section]' ); ?>


<?php get_footer(); ?>
