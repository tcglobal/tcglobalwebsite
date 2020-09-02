<?php
class CourseDetail
{
    /**
     * Course detail 
     */
    public function courseDetailContent($params){
        $courseDetail=Service::getCourseDetails($params);
        $courseDetail=$courseDetail[0];
        $content='<div>
        <p>'.$courseDetail->course_name.'</p>
        <p>'.$courseDetail->university_name.'</p>
        <p>'.$courseDetail->city.','.$courseDetail->country_name.'</p>
        <p>Global University Ranking: '.$courseDetail->ranking.'</p>
        <a href="/universitydetail?id='.$courseDetail->university_id.'">About University</a>
        <p>About '.$courseDetail->university_name.'</p>
        <p> '.$courseDetail->overview.'</p>
        <a href="/universitydetail?id='.$courseDetail->university_id.'">More about the university</a>
        <a href="/search-tool">See all Courses</a>
        </div>';
        return $content;
    }
 
}

?>