<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */

get_header(); ?>

<style>
#menu-item-61 a {color: #da1f3d;}
</style>

<?php
global $post, $wpdb;

  $assign_cat ='';

  $author_id=$post->post_author;

 	$url = get_permalink($post->ID);
 	$title = get_the_title($post->ID);
	$fb = "https://www.facebook.com/share.php?u=".$url."&title=".$title."";
	$linkedin = "https://www.linkedin.com/shareArticle?mini=true&url=".$url."&title=".$title."";
	$twitter = "https://twitter.com/home?status=".$title."+".$url."";

	$tag_name = get_the_terms( $post->ID, 'post_tag' );
	$category = get_the_terms( $post->ID, 'category' );

	foreach ($category as $key => $value)
	{
		$topic_cls = get_term_meta( $value->term_id, 'topics_class_name', true );
		$assign_cat .='<span class="'.$topic_cls.' tags mr-4">'.$value->name.'</span>';
	}

?>


    <div class="searchtool-banner insights-banner">
          <div class="bg-color"></div>
          <div class="container-fluid position-relative">
            <div class="row align-items-center">
              <div class="col">
                <h2 class="main-heading">TC Global <br>Insights</h2>
              </div>
            </div>
          </div>
        </div>

      <div class="bg-color Partner-banner position-relative block-tab-bottom-space">
      <div class="bottom-bg"></div>
      <div class="container-fluid position-relative p-0">
        <div class="search-form-fields event-detail-fields  insights-details-page">
          <div class="bg-color"></div>
          <div class="row">

            <div class="col-sm-12 event-left-banner">
              <div class="col-sm-12 p-0 mb-3"><span class="tags"><?php echo $tag_name[0]->name; ?></span></div>
              <h1 class="main-heading text-left">
                <span class=""><?php echo $title; ?></span>
              </h1>
              <div class="col-sm-12 p-t-40">
                <div class="row">
                  <div class="col-sm-12 pl-0">
                    <p class="event-small-head mb-2">Date added</p>
                    <p class="event-small-head-value mb-0"><?php echo get_the_date('d.m.Y', $post->ID); ?></p>
                  </div>
                </div>
              </div>
              <div class="theme-bor-btm"></div>

              <div class="quick-fact col-sm-12 px-0">


                  <?php
                    $k==1;
                    for($i=1; $i<=5; $i++)
                    {
                      $invitename =  get_post_meta( $post->ID, 'invite_name_'.$i, true );
                      $inviterole =  get_post_meta( $post->ID, 'role_'.$i, true );
                      $inviteimag =  get_post_meta( $post->ID, 'image_'.$i, true );
                      if($inviteimag){
                        $invite_imgurl = wp_get_attachment_image_src($inviteimag);
                      }
                      if(!empty($invitename) && !empty($inviterole) && !empty($inviteimag)){
                      $k++;

                      global $isPeople;
                      $isPeople = 1;
                    ?>
                    <h4 class="m-t-30 m-b-30" <?php if($k==1){ }else { echo 'style="display:none"'; }?>>Authors</h4>
                    <div class="col-sm-12 p-0">
                    <div class="row">

                    <div class="col-sm-6"><div class="row">
                      <div class="col-sm-3 pr-0">
                        <img src="<?php echo $invite_imgurl[0]; ?>" alt="life" class="img-fluid m-b-20">
                      </div>
                      <div class="col-sm-9">
                        <div class="event-people">
                          <h5><?php echo $invitename; ?></h5>
                          <p><?php echo $inviterole; ?></p>
                        </div>
                      </div>
                    </div>
                  </div>

                <?php } } ?>

                </div>
              </div>
            </div>

            <?php if($isPeople == 1) { ?>
                <div class="theme-bor-btm"></div>
            <?php } ?>

          <div class="share-event col-sm-12 px-0 pb-4 tablet-footer-section">
            <h4 class="m-t-30 mb-4">Share the Event</h4>
            <ul class="footerul">
            <li><a href="<?php echo $fb; ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/facebook.png" alt=""></a></li>
            <li><a href="<?php echo $linkedin; ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/linkedin.png" alt=""></a></li>
            <li><a href="<?php echo $twitter; ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/twitter.png" alt=""></a></li>
            </ul>
          </div>


          <div class="col-sm-12">
            <div class="row">

                <?php
                   while ( have_posts() ) : the_post();
                      setPostViews(get_the_ID()); // function call

                      the_content(); // get post content
                  endwhile;
                ?>

                <div class="quick-fact">
                    <h4 class="m-t-10 m-b-20">Filed under:</h4>
                    <div class="col-sm-12 p-0">
                      <?php echo $assign_cat; ?>
                    </div>
                  </div>

                  <div class="share-event col-sm-12 px-0 p-b-20">
                    <?php echo do_shortcode( '[popular_insights title="Popular this week" layout="style_three"]' ); ?>
                  </div>
                </div>
              </div>
              <div class="col-sm-12 p-0">
                <a href="/insights" class="explorelink text-uppercase text-decoration-none" tabindex="0">Back to Insights<span class="pl-3"><img src="<?php echo get_template_directory_uri(); ?>/images/down_2.png" alt=""></span></a>
              </div>
            </div>



          </div>
        </div>
      </div>
    </div>
  </div>

<?php echo do_shortcode( '[popular_insights title="Related Insights" layout="style_one"]' ); ?>
<?php echo do_shortcode( '[global_section id="525" title="Subscribe!" sub_title="No spam, just your favourite topics." layout="style_one" popup="enabled"]' ); ?>
<?php echo do_shortcode( '[content_block id=21 slug=common-section]' ); ?>

<!--FOOTER-SECTION-->
    <div class="col-sm-12  bottom-selection">
      <div class="row justify-content-center">
        <div class="col-sm-6 text-center">
          <button type="button" class="btn btn-theme w-250 btn-block allformtrigger" data-toggle="modal" data-target="#subscribeModal">subscribe</button>
        </div>
      </div>
    </div>

<?php get_footer(); ?>
