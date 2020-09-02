<?php 
	$id = get_the_ID();
	$image = wp_get_attachment_image_src( get_post_thumbnail_id($id),  'medium');
	 
	$banner_title = get_post_meta( get_the_ID(), 'banner_title', true );
	$banner_content = get_post_meta( get_the_ID(), 'banner_content', true );
	$button = get_post_meta( get_the_ID(), 'button_text', true ); 
	$link = get_post_meta( get_the_ID(), 'button_link', true );

?>

<div class="mobile-home-banner">
  <div class="bgcolor">
    <div class="content">
      <h2 class="main-heading"><?php echo $banner_title; ?></h2>
      <p><?php echo $banner_content; ?></p>
      <a style="padding-right: 20px;" href=<?php echo $link; ?> ><button type="button" class="btn btn-theme tab1-btn"> <?php echo $button; ?><img alt="" src="/wp-content/uploads/2019/08/whiteforward.png" class="img-fluid" /></button></a>
      <img alt="" src=<?php echo $image[0]; ?> class="img-fluid" style="width:100%" />
    </div>
  </div>
</div>