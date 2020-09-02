<?php 
	$id = get_the_ID();
	$image = wp_get_attachment_image_src( get_post_thumbnail_id($id), 'single-post-thumbnail' );
	 
	$banner_title = get_post_meta( get_the_ID(), 'banner_title', true );
	$banner_content = get_post_meta( get_the_ID(), 'banner_content', true );
	$button = get_post_meta( get_the_ID(), 'button_text', true ); 
	$link = get_post_meta( get_the_ID(), 'button_link', true );

?>
<div class="desktop-mainsection">
<!-- banner section -->
<div class="bannerblock">
    <div class="bannerformsection position-absolute m-t-40">
      <div class="boldheading">
        <?php echo $banner_title; ?>
    </div>
      <div class="redpath"></div>
      <div class="bannerdesc m-t-25">
        <?php echo $banner_content; ?>

      </div>

      <a href=<?php echo $link; ?> class="d-block m-t-20 explorelink text-uppercase text-decoration-none"><button type="button" class="btn btn-theme tab1-btn" style="font-size:12px !important;width:260px !important;height:39px !important;"><?php echo $button; ?><span><img src="/wp-content/uploads/2019/08/whiteforward.png" alt=""></span></button></a>
    </div>

    <div class="rightimg position-absolute">
    	<?php echo "<img alt='' class='img-fluid' width='".$image[1]."' height='".$image[2]."' src='".$image[0]."'>"; ?>
    </div>
</div>
<!-- end banner section -->