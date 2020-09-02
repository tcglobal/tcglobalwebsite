<!DOCTYPE html>
<html <?php language_attributes(); ?> style="overflow-x: hidden;">
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, maximum-scale=1.0" />
<link rel="profile" href="https://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-MR4HFP5');</script>
<!-- End Google Tag Manager -->
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> -->
<script src="https://maps.googleapis.com/maps/api/js?key=<?php echo get_option('wpsl_google_api_key'); ?>" async ></script>
<?php
//wp_enqueue_script('google-map','https://maps.googleapis.com/maps/api/js?key='. get_option('wpsl_google_api_key').'&sensor=false');
wp_head()
?>

<!-- Facebook Pixel Code -->
<script>
!function(f,b,e,v,n,t,s)
{if(f.fbq)return;n=f.fbq=function(){n.callMethod?
n.callMethod.apply(n,arguments):n.queue.push(arguments)};
if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
n.queue=[];t=b.createElement(e);t.async=!0;
t.src=v;s=b.getElementsByTagName(e)[0];
s.parentNode.insertBefore(t,s)}(window, document,'script',
'https://connect.facebook.net/en_US/fbevents.js');
fbq('init', '1720237644879351');
fbq('track', 'PageView');
</script>
<noscript><img height="1" width="1" style="display:none"
src="https://www.facebook.com/tr?id=1720237644879351&ev=PageView&noscript=1"
/></noscript>
<!-- End Facebook Pixel Code -->

<!-- Start amplitude code -->
<script type="text/javascript">

  (function(e,t){var n=e.amplitude||{_q:[],_iq:{}};var r=t.createElement("script")

  ;r.type="text/javascript"

  ;r.integrity="sha384-35+p+zAMRt40eCQKk1/Xowd25miK7ZUBRbn6ikyGdVMfY6iKSyDDJwxFc9z4+HhF"

  ;r.crossOrigin="anonymous";r.async=true

  ;r.src="https://cdn.amplitude.com/libs/amplitude-6.0.1-min.gz.js"

  ;r.onload=function(){if(!e.amplitude.runQueuedFunctions){

  console.log("[Amplitude] Error: could not load SDK")}}

  ;var i=t.getElementsByTagName("script")[0];i.parentNode.insertBefore(r,i)

  ;function s(e,t){e.prototype[t]=function(){

  this._q.push([t].concat(Array.prototype.slice.call(arguments,0)));return this}}

  var o=function(){this._q=[];return this}

  ;var a=["add","append","clearAll","prepend","set","setOnce","unset"]

  ;for(var u=0;u<a.length;u++){s(o,a[u])}n.Identify=o;var c=function(){this._q=[]

  ;return this}

  ;var l=["setProductId","setQuantity","setPrice","setRevenueType","setEventProperties"]

  ;for(var p=0;p<l.length;p++){s(c,l[p])}n.Revenue=c

  ;var d=["init","logEvent","logRevenue","setUserId","setUserProperties","setOptOut","setVersionName","setDomain","setDeviceId", "enableTracking", "setGlobalUserProperties","identify","clearUserProperties","setGroup","logRevenueV2","regenerateDeviceId","groupIdentify","onInit","logEventWithTimestamp","logEventWithGroups","setSessionId","resetSessionId"]

  ;function v(e){function t(t){e[t]=function(){

  e._q.push([t].concat(Array.prototype.slice.call(arguments,0)))}}

  for(var n=0;n<d.length;n++){t(d[n])}}v(n);n.getInstance=function(e){

  e=(!e||e.length===0?"$default_instance":e).toLowerCase()

  ;if(!n._iq.hasOwnProperty(e)){n._iq[e]={_q:[]};v(n._iq[e])}return n._iq[e]}

  ;e.amplitude=n})(window,document);

  amplitude.getInstance().init("313c25455c006b796dfde429f778c0ee");

</script>
	<!-- End amplitude code -->

</head>
<body <?php body_class(); ?> style="overflow-x: hidden;"  >
<!-- <div class="loaderIcon"></div> -->

<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-MR4HFP5"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
<!-- get current page url -->
<?php
  global $post;
  global $current_pageName, $current_page_url, $currentPageID;
  $current_pageName = $post->post_title;
  $currentPageID = get_queried_object_id();
  $current_page_url = get_permalink( $currentPageID );

  $hidemenu = array(2287,2291,2292,2293,2425);
?>
<!--HEADER-MENU-->
<header id="goto-top">
  <div class="mobile-menu"><span></span></div>
  <a href="https://tcglobal.com" class="mobile-menu-close clicked" style="display:none;"><span></span></a> 

<?php if (!in_array($currentPageID, $hidemenu)) { ?>
  <nav id="mobile-nav">
    <ul class="top-sub-menu">
      
	  <!--<li><a data-toggle="modal" data-target="#checkeligible" data-keyboard="false" data-backdrop="static" class="text-decoration-none portal-form-reset allformtrigger">Portals</a></li> -->

      <li><a href=<?php echo get_option('help_center'); ?> target="_blank"><img alt="" src="/wp-content/uploads/2019/08/helpcenter.png" width="16" />Help Centre</a></li>
      <li><a href=<?php echo get_option('search_tool'); ?>><img alt="" src="/wp-content/uploads/2019/08/search.png" width="16" />Course Search</a></li>
    </ul>
    <?php
    $args = array(
            'theme_location'=> 'mobile',
            'menu_id'=>'',
            'menu_class'=>'main'
            );
      wp_nav_menu($args);
    ?>

	<div style="padding:10px 22px;margin-top: -30px;">
		<a data-toggle="modal" data-target="#Covid-19" data-keyboard="false" data-backdrop="static" class="navbutton text-uppercase text-center text-decoration-none allformtrigger" style="width: 100%;font-size: 14px;font-weight: 800;line-height:1.86;font-family: 'Zona Pro';height: 47px;">Covid-19 Notification</a>
    </div>
	</nav>

<?php } ?>  
  <div class="container-fluid p-0">
    <div class="row">
      <div class="col-4 pr-1">        
        <?php if ( function_exists( 'the_custom_logo' ) ) { the_custom_logo(); } ?>
      </div>
      <div class="col-1 pl-2 px-0 text-center">
        <div class="mobile-user-icon bg-icons ml-0"></div>
      </div> 
      <div class="col-4 pr-0">
        <a href="https://tcglobal.com/login-user-type/"><button type="button" class="btn btn-theme btn-signin w-100 p-b-0 p-t-0">Sign In</button></a>
      </div>   
    </div>
  </div>

</header>
