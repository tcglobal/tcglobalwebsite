<?php
/**
* Plugin Name:  Search Tool
* Plugin URI: https://www.yourwebsiteurl.com/
* Description: This is the very first plugin I ever created.
* Version: 1.0
* Author: Gomathi
* Author URI: http://yourwebsiteurl.com/
**/
include_once('Constants.php');
include_once('SearchComponent/Service.php');
include_once('SearchComponent/SearchList.php');
include_once('SearchComponent/CourseDetail.php');
include_once('SearchComponent/UniversityDetail.php');
include_once('SearchComponent/PopularCourses.php');
include_once('SearchComponent/CoursesMayLike.php');
//include_once('SearchComponent/Insert.php');
global $wpdb;
/**
 * Add js script files
 */

/*function customScripts(){
     wp_enqueue_script( 'rangeslider-js', plugins_url( 'js/rangeSlider.min.js', __FILE__ ));
    wp_enqueue_script( 'rangeslider-custom-js', plugins_url( 'js/Script.js', __FILE__ ));    //  wp_enqueue_script('google-map','https://maps.googleapis.com/maps/api/js?key='.Constants::GOOGLE_MAP_API_KEY,array(),null,true);
}*/

/**
 * Add css for range slider 
 */

/*function rangeSliderCss(){
    wp_enqueue_style( 'jquery-ui-css', plugins_url('searchtool/js/jquery-ui.css'),false,'1.1','all');
    wp_enqueue_style( 'range-slider-min-css', plugins_url('searchtool/css/rangeSlider.min.css'),false,'1.1','all');
   //wp_enqueue_style( 'style-css', plugins_url('searchtool/css/style.css'),false,'1.1','all');
    if('Tc Global for Mobile'==get_current_theme()){
    wp_enqueue_style( 'style-mobile-css', plugins_url('searchtool/css/stylemobile.css'),false,'1.1','all');
    }
    else if('Tc Global for Tablet'==get_current_theme()){
        wp_enqueue_style( 'style-css', plugins_url('searchtool/css/styletab.css'),false,'1.1','all');
    }
    else{
        wp_enqueue_style( 'style-css', plugins_url('searchtool/css/style.css'),false,'1.1','all');
    }
}

add_action('wp_footer', 'customScripts');
add_action('wp_footer', 'rangeSliderCss');*/



/**
 * short code for search tool 
 */
function searchToolContent(){
    if($_SERVER['REQUEST_METHOD'] == 'GET'){
        $params = $_GET;
    }else{
        $params = $_POST;	
    }
    $content=SearchList::searchCourseList($params);
    return $content;
}
add_shortcode('searchTool','searchToolContent');


/**
 * short code for course details
 */
function courseDetailView(){
    $params = $_GET;
    $content=CourseDetail::courseDetailContent($params);
    return $content;
}
add_shortcode('courseDetail','courseDetailView');


/**
 * short code for university details
 */
function  universityDetailView(){
    $params = $_GET;
    $content=UniversityDetail::universityDetailContent($params);
    return $content;
}
add_shortcode('universitydetail','universityDetailView');
/**
 * short code for popular course list
 */
function  popularCourseList(){
    $content=PopularCourses::popularCourseList();
    return $content;
}
add_shortcode('popularCourse','popularCourseList');

/**
 * short code for  course you may like 
 */
function  coursesLikeList(){
    $content=CoursesMayLike::CoursesMayLikeList();
    return $content;
}
add_shortcode('coursesMayLike','coursesLikeList');
?>