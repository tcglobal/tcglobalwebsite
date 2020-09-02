<?php 
class PopularCourses
{
    /**
     * Course detail 
     */
 
public function popularCourseList(){
     $popularList=Service::getPopularCourses();
     foreach ($popularList as $key => $value) {
    $currency=$value->prog_fees_value?$value->prog_fees_currency:'';
    $startDateText=$value->prog_start_date? "Start Date : " :$value->intake;
    $startDate=$value->prog_start_date?  date("m-d-Y", strtotime($value->prog_start_date)) :'';
    $applicationFees=$value->prog_fees_value? floatval($value->prog_fees_value) :'';
    $address= '<span>'.$value->city.',</span> <span class="name">'.$value->country_name.'</span>';

$list.=' <div class="col-sm-3">
 <div class="course-list">
 <div class="img-sec">
 <img src="'.plugins_url('searchtool/images/img-world-citizenship.png').'" alt="course-img" class="img-fluid">
 <a class="addfav" href=""><img src="'.plugins_url('searchtool/images/added-fav.png').'" alt="course-img" class="img-fluid"></a>
 <span class="amount"><span class="value">'.$applicationFees.'</span><span class="type">'.$currency.'</span></span>
 </div>
 <div class="row">
 <div class="col-sm-9">
 <p class="date">'.$startDateText.' <span>'.$startDate.'</span></p>
 </div>
 <div class="col-sm-3 pt-2 mt-1">
 <div class="tag-count">
 <img src="'.plugins_url('searchtool/images/rank-tag.png').'" alt="tag" />
 <span class="value">'.$value->ranking.'</span>
 </div>
 </div>
 </div>
 <h3><img src="'.plugins_url('searchtool/images/flag-img.png').'" alt="flag" /><span>'.$address.'</span>
  <span class="name">'.$address.'</span></h3>
 <h2>'.$value->course_name.'</h2>
 </div>
 </div>';
 }

$content='<div class="popular-course">
 <div class="text-center">
 <div class="boldheading">
 Popular Courses
 </div>
 <div class="path"></div>
 </div>
 <div class="container">
 <div class="row">
 '.$list.'
 </div>
 </div>
 </div>';
return$content;
 }

}

?>