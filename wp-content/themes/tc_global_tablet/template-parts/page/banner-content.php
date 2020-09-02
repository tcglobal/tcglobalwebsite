<?php 
	$id = get_the_ID();
	$image = wp_get_attachment_image_src( get_post_thumbnail_id($id), 'single-post-thumbnail' );
	 
	$banner_title = get_post_meta( get_the_ID(), 'banner_title', true );
	$banner_content = get_post_meta( get_the_ID(), 'banner_content', true );
	$button = get_post_meta( get_the_ID(), 'button_text', true ); 
	$link = get_post_meta( get_the_ID(), 'button_link', true );
	
	

?>
<div class="tablet-home-banner">
  <div class="bgcolor" style="background: url(<?php echo $image[0]; ?>) no-repeat;" >
    <div class="content">
      <h2 class="main-heading"><?php echo $banner_title; ?></h2>
      <p><?php echo $banner_content; ?></p>
      <a href=<?php echo $link; ?> ><button type="button" class="btn btn-theme tab1-btn" style="font-size:12px !important;height:40px !important;"><?php echo $button; ?><img alt="" src="/wp-content/uploads/2019/08/whiteforward.png" class="img-fluid" /></button></a>
    </div>
  </div>
</div>