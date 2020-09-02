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


<div class="searchpartner-banner-bg insights-details-banner">
      <div class="bg-color"></div>
      <div class="container position-relative event-head">
        <div class="row align-items-center">
          <div class="col">
            <h2 class="main-heading">TC Global Insights</h2>
          </div>
        </div></div>
      </div>

      <div class="event-content insights-details-page">
        <div class="bg-color Partner-banner position-relative">
          <div class="bottom-bg"></div>
          <div class="container position-relative">
            <div class="top-bg"></div>
            <div class="partner-form-fields events-page-detail">
              <div class="row">
              	<div class="col-sm-8 pr-5">
              		<div class="col-sm-12 p-0 mb-3"><span class="tags"><?php echo $tag_name[0]->name; ?></span></div>
                  <h1 class="main-heading text-left"><?php echo $title; ?></h1>
          			<?php
      						while ( have_posts() ) : the_post();

                  setPostViews(get_the_ID());

      							the_content(); // get post content

      						endwhile;
      					?>
          		</div>

				<div class="col-sm-4 m-t-50">
                      <div class="right-section-pad pl-0">
                        <div class="col-sm-12 p-0 m-b-20">
                          <div class="row">
                            <div class="col-sm-8">
                              <div class="check-eligible">
                                <button type="button" class="btn btn-block btn-danger form-reset" data-toggle="modal" data-target="#subscribeModal" data-keyboard="false" data-backdrop="static">subscribe</button>
                              </div>
                            </div>
                            <!--<div class="col-sm-4 text-center p-t-10"><img src="<?php echo get_template_directory_uri(); ?>/images/search-fav-unfill.png" alt="fav"></div>-->
                          </div>
                        </div>
                        <h6 class="event-small-head mb-2">Date added</h6>
                        <h6 class="event-small-head-value"><?php echo get_the_date('d.m.Y', $post->ID); ?></h6>
                        <div class="theme-bor-btm"></div>

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

                              <?php if($isPeople == 1 && $k==1) { ?>
                                <div class="quick-fact col-sm-12 px-0 p-b-20">
                              <?php } ?>

                               <h4 class="m-t-30 m-b-30" <?php if($k==1){ }else { echo 'style="display:none"'; }?>>Authors</h4>
                                <div class="col-sm-12 px-0 mb-2"><div class="row">
                                      <div class="col-sm-3 text-center">
                                        <img src="<?php echo $invite_imgurl[0]; ?>" alt="life" class="img-fluid m-b-20">
                                      </div>
                                      <div class="col-sm-9 pl-0">
                                        <div class="event-people">
                                          <p><span><?php echo $invitename; ?></span></p>
                                          <p><?php echo $inviterole; ?></p>
                                        </div></div>
                                      </div>
                                    </div>
                              <?php } } ?>


                          <?php if($isPeople == 1) { ?>
                              </div><div class="theme-bor-btm m-t-20"></div>
                          <?php } ?>

                     <div class="quick-fact">
                        <h4 class="m-t-30 m-b-20">Filed under:</h4>
                        <div class="col-sm-12 p-0">
                          <?php echo $assign_cat; ?>
                        </div>
                      </div>
                      <div class="theme-bor-btm"></div>
                      <div class="share-event col-sm-12 px-0 p-b-20 ">
                        <h4 class="m-t-30 m-b-20">Share the Insight</h4>
                        <ul class="footerul">
                          	<li><a href="<?php echo $fb; ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/facebook.png" alt=""></a></li>
                  			<li><a href="<?php echo $linkedin; ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/linkedin.png" alt=""></a></li>
                  			<li><a href="<?php echo $twitter; ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/twitter.png" alt=""></a></li>
                        </ul>
                      </div>
                      <div class="theme-bor-btm"></div>

                      <div class="share-event col-sm-12 px-0 p-b-20">
                        <?php echo do_shortcode( '[popular_insights title="Popular this week" layout="style_three"]' ); ?>
                      </div>

                    </div>
                  </div>

                  <div class="col-sm-12 m-t-50">
                    <a href="/insights" class="explorelink text-uppercase text-decoration-none" tabindex="0">
                      Back to insights<span class="pl-3"><img src="<?php echo get_template_directory_uri(); ?>/images/down_2.png" alt=""></span></a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>



<?php echo do_shortcode( '[popular_insights title="Related Insights" layout="style_one"]' ); ?>
<?php echo do_shortcode( '[global_section id="525" title="Subscribe!" sub_title="No spam, just your favourite topics." layout="style_one" popup="enabled"]' ); ?>
<?php echo do_shortcode( '[content_block id=21 slug=common-section]' ); ?>


<?php get_footer(); ?>
