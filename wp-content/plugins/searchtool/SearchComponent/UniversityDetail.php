<?php
class UniversityDetail
{
    /**
     * Course detail 
     */
    public function universityDetailContent($params){
        $response=Service::getUniversityDetails($params);
        $universityDetail=$response['details'];
        $coordinates=$response['coordinates'];
        $content='<div><p>'.$universityDetail->university_name.'</p>
        <p>'.$universityDetail->city.'</p>
        <p>'.$universityDetail->country_name.'</p>
        <p>'.$universityDetail->ranking.'</p>
        <p>'.$universityDetail->overview.'</p>
        <p>'.floatval($universityDetail->tution_fees).'</p>
        <input type="hidden" name="lat" id="lat" value="'.$coordinates['lat'].'">
        <input type="hidden" name="lng" id="lng"  value="'.$coordinates['lng'].'">
        </div>
        <div id="map" style="height: 400px; width: 50%;"></div>
        <video width="400" controls controlsList="nodownload" disablePictureInPicture >
            <source src="https://www.w3schools.com/html/mov_bbb.mp4" type="video/mp4">
            Your browser does not support  video.
        </video>';
        return $content;
    }
 
}

?>