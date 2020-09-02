<?php
class SearchList
{
    
    /**
     * To get filter checkbox values 
     */
    public function getAcceptedTestValues($selectedValues,$standardTest){
        foreach ($standardTest as $key => $value) {
             $id=$key+1;
            if($selectedValues && count($selectedValues)>Constants::CONST_ZERO ){
               
                if(in_array($value->standardized_test, $selectedValues)){
                    $checkboxOption.='<div class="custom-control custom-checkbox"><input class="custom-control-input" checked id="customCheck'.$id.'"  type="checkbox" name="acceptedTest[]" value="'.($value->standardized_test).'">
                       <label class="custom-control-label" for="customCheck'.$id.'"> ' .$value->standardized_test.' </label> </div>';
                }else{
                    $checkboxOption.='<div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input" id="customCheck'.$id.'"   name="acceptedTest[]" value="'.($value->standardized_test).'">
                   <label class="custom-control-label" for="customCheck'.$id.'">  '.$value->standardized_test.'  </label> </div>';
                }
            }else{
                $checkboxOption.='<div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input" id="customCheck'.$id.'"  name="acceptedTest[]" value="'.($value->standardized_test).'">
                  <label class="custom-control-label" for="customCheck'.$id.'">'.$value->standardized_test.'  </label> </div>';
            }
        }
        $acceptedTest='
           '.$checkboxOption.'
        ';
        return $acceptedTest;
    }
    /**
     * fees range slider
     */
    public function feesRangeSlider($feesRange,$tutionFees){
        if($feesRange && strpos($feesRange, ';') !== false){
            $splitted=explode(';',$feesRange);
        }
        $maxVal=($splitted && $splitted[1])?$splitted[1]:Constants::CONST_ZERO;
        $minVal=($splitted && $splitted[0])?$splitted[0]:Constants::CONST_ZERO;
        $slider='
          <input type="text" class="js-range-slider" name="feesRange" value=""/>
            <span style="display:none"  id="feesrangeselectedMax" name="feesrangeselectedMax">'.$maxVal.'</span>
            <span style="display:none"  id="feesrangeselectedMin" name="feesrangeselectedMin">'.$minVal.'</span>
        ';
        return $slider;
    }
   
    /**
     * to generate dropdown options
     */
    public function dropDownOptions($name,$list=array(),$id){
        switch($name){
            case 'country':
                foreach ($list as $key => $value) {
                    if((int)$id===(int)$value->country_id){
                        $option.= '<option selected  value="'.$value->country_id.'">'.$value->country_name.'</option>';
                    }else{
                        $option.= '<option  value="'.$value->country_id.'">'.$value->country_name.'</option>';
                    }
                }
                break;
            case 'university':
                foreach ($list as $key => $value) {
                    if((int)$id===(int)$value->university_id){
                        $option.= '<option selected value="'.$value->university_id.'">'.$value->university_name.'</option>';
                    }else{
                        $option.= '<option  value="'.$value->university_id.'">'.$value->university_name.'</option>';
                    }
                }
              break;
            case 'showlist':
            case 'sortBy':
                foreach ($list as $key => $value) {
                    $keyVal=$key+Constants::CONST_ONE;
                    if((int)$id===(int)$keyVal){
                        $option.= '<option selected value="'.$keyVal.'">'.$value.'</option>';
                    }else{
                        $option.= '<option  value="'.$keyVal.'">'.$value.'</option>';
                    }
                }
              break;
            case 'city':
                foreach ($list as $key => $value) {
                    if((string)$id===(string)$value->city){
                        $option.= '<option selected value="'.$value->city.'">'.$value->city.'</option>';
                    }else{
                        $option.= '<option  value="'.$value->city.'">'.$value->city.'</option>';
                    }
                }
              break;
            case 'areaOfStudy':
                foreach ($list as $key => $value) {
                    if((string)$id===(string)$value->prog_aos){
                        $option.= '<option selected value="'.$value->prog_aos.'">'.$value->prog_aos.'</option>';
                    }else{
                        $option.= '<option  value="'.$value->prog_aos.'">'.$value->prog_aos.'</option>';
                    }
                }
              break;
            case 'studyLevel':
                foreach ($list as $key => $value) {
                    if((string)$id===(string)$value->prog_level){
                        $option.= '<option selected value="'.$value->prog_level.'">'.$value->prog_level.'</option>';
                    }else{
                        $option.= '<option  value="'.$value->prog_level.'">'.$value->prog_level.'</option>';
                    }
                }
              break;
            case 'specialization':
                foreach ($list as $key => $value) {
                    if((string)$id===(string)$value->prog_type){
                        $option.= '<option selected value="'.$value->prog_type.'">'.$value->prog_type.'</option>';
                    }else{
                        $option.= '<option  value="'.$value->prog_type.'">'.$value->prog_type.'</option>';
                    }
                }
              break;
            case 'intake':
                foreach ($list as $key => $value) {
                    if($value->intakes){
                        if((int)$id===(int)$value->intakes){
                            $option.= '<option selected value="'.$value->intakes.'">'.$value->intakes.'</option>';
                        }else{
                            $option.= '<option  value="'.$value->intakes.'">'.$value->intakes.'</option>';
                        }
                    }
                }
              break;
            default:
                $option.= '';
        }
        return $option;
    }
    /**
     *To generate dropdown 
     */
    public function generateDropdown($name,$id,$label,$placeHolder,$list=array()){
        
        $option= '<option  value="">'.$placeHolder.'</option>';
        if($list && count($list)>Constants::CONST_ZERO){
            $option.=Self::dropDownOptions($name,$list,$id);
        }
        $className='form-control';
        if($label){
            $selectOpt='<label>'.$label.'</label>';
        }else{
            $className='form-control selectbox';
        }
        $selectOpt.= '
        <select class="'.$className.'" name="'.$name.'" id="'.$name.'" value="'.$id.'" >
        '.$option.'
        </select>';
        $filterHtml=$selectOpt;
        return $filterHtml;
    }
   
    /**
     * This handles form submit 
     * 
     */
    public  function generateForm($filterParms){
        $countryList =Service::getCountryList();
        $courseList=Service::getCourseList();
        $studyLevels=Service::getStudyLevel();
        $specialization=Service::getSpecialization();
        $areaOfStudy=Self::generateDropdown('areaOfStudy',$filterParms['areaOfStudy'],'Where do you want to study?','Area of study',$courseList);
        $countryDropdown=Self::generateDropdown('country',$filterParms['country'],'Where?','Country',$countryList);
        $specialization=Self::generateDropdown('specialization',$filterParms['specialization'],'What specialization?','Course options',$specialization);
        $studyLevelFilter=Self::generateDropdown('studyLevel',$filterParms['studyLevel'],'Study Level?','Study level options',$studyLevels);
     
        $content='<div class="searchtool-banner" id="banner_image_full_width">
                    <div class="bg-color">  </div>
                    <div class="container position-relative">
                        <div class="row align-items-center">
                            <div class="col">
                                <h2 class="main-heading">Search Tool</h2>
                            </div>
                        </div>
                        <div class="search-form-fields">
                            <div class="row">
                                <div class="col-sm-11">
                                <div class="row">
                                    <input type="hidden" name="offset" value="0">
                                    <input type="hidden" name="limit" value="'.Constants::SEARCHLIMIT.'">
                                    <input type="hidden" name="cpage" value="1">
                                    <div class="col">'.$areaOfStudy.'</div>
                                    <div class="col">'.$countryDropdown.'</div>
                                    <div class="col">'.$specialization.'</div>
                                    <div class="col">'.$studyLevelFilter.'</div>
                                </div>
                                </div>
                                <div class="col-sm-1 text-right pt-4 cursor-pointer">
                                    <a id="topsearch" >
                                    <img src="'.plugins_url('searchtool/images/searchbar-icon.png').'" alt="Search" />
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                  
                   
                </div>';
        return $content;
    }

    /**
     * generate more filter form
     */
    public function moreFilterForm($filterParms){
        $university=$filterParms['university'];
        $feesRange=$filterParms['feesRange'];
        $acceptedTestSelected=$filterParms['acceptedTestSelected'];
        $universityList =Service::getUniversityList($filterParms);
        $cityList =Service::getCities('universities',$filterParms);
        $standardTest =Service::getStandardTests($filterParms);
        $intakes =Service::getIntakeYear($filterParms);
        $university=Self::generateDropdown('university',$university,'','Choose university',$universityList);
        $cities=Self::generateDropdown('city',$filterParms['city'],'','Choose city',$cityList);
        $intake=Self::generateDropdown('intake',$filterParms['intake'],'','Choose intake year',$intakes);
        $tutionFees=Service::getTutionFees($filterParms);
        $feesRangeSlider=Self::feesRangeSlider($feesRange,$tutionFees);
        $acceptedTestValues=Self::getAcceptedTestValues($acceptedTestSelected,$standardTest);
        $content='<div class="col-sm-3 pr-0">
                <div class="search-filter">
                 <h2>More filters</h2>
                '.$university.'
               '.$cities.'
               '.$intake.'
                <label class="mb-0">Choose prefered tuition fee</label>
                <div class="col-sm-12 p-0">'.$feesRangeSlider.'</div>
                <span style="display:none" name="range-max" id="range-max-value">'.$tutionFees.'</span>
                <label>Choose accepted tests</label>
               '.$acceptedTestValues.'
                 <button id="morefilter" type="button" class="btn btn-block">Apply filters</button>
                </div>
            </div>';
        return $content;
    }
    /**
     * sorting options form 
     */
    public function sortingOption($filterParms){
        $showlist=$filterParms['showlist'];
        $sortById=$filterParms['sortBy'];
        $showList=Self::generateDropdown('showlist',$showlist,'','All',Constants::SHOWLIST);
        $sortBy=Self::generateDropdown('sortBy',$sortById,'','All',Constants::SORTBY);
        $content=' <div class="col-sm-3">
                        <div class="row">
                          <label class="col-sm-4 pr-0">Show:</label>
                          <div class="col-sm-8 pr-0">
                         '.$showList.'
                         </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="row">
                          <label class="col-sm-5 pr-0">Sort by:</label>
                          <div class="col-sm-7 pl-0">
                          '.$sortBy.'
                          </div>
                        </div>
                      </div>';
        return $content;
    }
    /**
     * To get course list 
     */
    public function searchCourseList($params){
        //search default options
        $off = $params['offset']? $params['offset']:Constants::CONST_ZERO;
        $limit = $params['limit']?$params['limit']:Constants::SEARCHLIMIT;
        $page = $params['cpage']?$params['cpage']:Constants::CONST_ONE;
        $showlist = $params['showlist']?$params['showlist']:'';
        $sortBy = $params['sortBy']?$params['sortBy']:'';
        //search top filter options
        $areaOfStudy=$params['areaOfStudy']?$params['areaOfStudy']:'';
        $country=$params['country']?$params['country']:'';
        $specialization=$params['specialization']?$params['specialization']:'';
        $studyLevel=$params['studyLevel']?$params['studyLevel']:'';
        //search left filter options
        $university = $params['university']?$params['university']:'';
        $city = $params['city']?$params['city']:'';
        $intake = $params['intake']?$params['intake']:'';
        $feesRange = $params['feesRange']?$params['feesRange']:Constants::CONST_ZERO;
        $acceptedTestSelected = $params['acceptedTest']?$params['acceptedTest']:[];
        //params
        $filterParms=array('off'=>$off,'limit'=>$limit,'showlist'=>$showlist,
        'sortBy'=>$sortBy,'areaOfStudy'=>$areaOfStudy,'country'=>$country,'page'=>$page,
        'specialization'=>$specialization,'studyLevel'=>$studyLevel,'university'=>$university,
        'city'=>$city,'intake'=>$intake,'feesRange'=>$feesRange,'acceptedTestSelected'=>$acceptedTestSelected
         );
        $content=Self::fetchData($filterParms);
        return $content;
    }
    /**
     * fetch data based on filters or without filters
     */
    public function fetchData($filterParms){
        $responseData=Service::getSearchResult($filterParms);
        $searchList=$responseData['searchResult'];
        $totalPages=ceil($responseData['totalRecord']/Constants::SEARCHLIMIT);
        $totalRecord=$responseData['totalRecord'];
        $rows=count($searchList)?count($searchList):Constants::CONST_ZERO;
        $list='';
        if($searchList && count($searchList)>Constants::CONST_ZERO){

            foreach ($searchList as $key => $value) {
                    $startDateText=$value->prog_start_date? "Start Date : " :$value->intake;
                    $startDate=$value->prog_start_date?  date("m-d-Y", strtotime($value->prog_start_date)) :'';
                    $applicationFees=$value->tution_fees? floatval($value->tution_fees) :'';
                    $currency=$value->tution_fees? Constants::CURRENCY_USD :'';
                    $url=$value->showType=='univeristy' ? '/universitydetail?id=' .$value->id.'&university_name='.$value->name.'&country_name='.$value->country_name:'/coursedetail?id='
                   .$value->id.'&university_name='.$value->univName.'&country_name='.$value->country_name;
                    $address=$value->showType=='univeristy' ? '<span>'.$value->city.',</span> <span class="name">'.$value->country_name.'</span>' :$value->univName;
                    $universityName=$value->showType=='univeristy' ? '' :$value->univName;
                    $intake=$value->intake ? 'Intake : '.$value->intake:'';
                    $list.=' 
                    <div  class="searchlist-box" >
                    <span id="detaillink" style="display:none">"'.$url.'"</span>
                    <div class="row">
                    <div class="col-sm-4 thumbnail pr-0">
                        <a href="'.$url.'">
                      
                        <img height="1000" width="1000" src="'.plugins_url('searchtool/images/img-world-citizenship.png').'" alt="search-list-img" class="img-fluid" />
                          </a>
                        <span class="name type1">'.$value->showType.'</span>
                        <span class="amount"><span class="value">'.$applicationFees.' </span><span class="type">'.$currency.'</span></span>
                      </div>
                      <div class="col-sm-8 pl-0">
                        <div class="col-sm-12">
                          <div class="col-sm-12">
                            <div class="row">
                              <div class="col-sm-9">
                                <p class="date">'.$startDateText.' <span>'.$startDate.'</span></p>
                              </div>
                              <div class="col-sm-2 pr-0 text-center pt-2 mt-1">
                                <div class="tag-count">
                                  <img src="'.plugins_url('searchtool/images/rank-tag.png').'"  alt="tag"  />
                                  <span class="value">'.$value->ranking.'</span>
                                </div>
                                <div class="popover fade show bs-popover-left"><div class="arrow" style="top: 16px;"></div>
                                <div class="popover-body">
                                  World University Rank
                                </div>
                              </div>
                            </div>
                            <div class="col-sm-1 text-right p-0 pt-2 mt-1">
                              <a href=""><img src="'.plugins_url('searchtool/images/search-favfill.png').'"  alt="fav"  /></a>
                            </div>
                          </div>
                          <h3><img src="'.plugins_url('searchtool/images/flag-img.png').'"  alt="flag"  />'.$address.'</h3>
                          <h3><img src="'.plugins_url('searchtool/images/user-icon-search.png').'"  alt="user"  /><span>Public</span> <span class="name">University</span></h3>
                         <a href="'.$url.'"> <h2>'.$value->name.'</h2></a>
                          <div class="row">
                            <div class="col-sm-6">
                              <button type="button" class="btn btn-block btn-danger">check eligibility</button>
                            </div>
                            <div class="col-sm-6">
                              <button type="button" class="btn btn-block btn-outline-danger">express your interest</button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div> ';
            }
        }else{
            $list.= '<div class="text-center">No Results Found</div>';
        }
        $content.=Self::searchHtmlContent($filterParms,$totalPages,$totalRecord,$rows,$list);
        return $content;
    }
    /**
     * search html content
     */
    public function searchHtmlContent($filterParms,$totalPages,$totalRecord,$rows,$list){
        $topSearch=Self::generateForm($filterParms);
        $moreForm=Self::moreFilterForm($filterParms);
        $sortingContent.= Self::sortingOption($filterParms);  
        $pageLink.= Self::getPaginationContent($totalPages,$totalRecord,$rows,$filterParms);
        $popularCourses= PopularCourses::popularCourseList();
        $content='<section class="desktop-mainsection"> ';
        $content.=' <form id="searchForm" action="/search-tool" method="GET">'.$topSearch.'<div class="search-result">
        <div class="container">
          <div class="row">
            <div class="col-sm-12">
              <h2 class="main-heading"><span class="d-block">Your personalized</span>University search results</h2>
              <div class="row">
                '.$moreForm.'
                <div class="col-sm-9 pl-5">
                  <div class="searchlist-topfilter">
                    <div class="row">
                        '.$pageLink.'
                      '.$sortingContent.'
                    </div>
                  </div>
                '.$list.'
             <div class="searchlist-topfilter mt-5"> 
                        <div class="row">'.$pageLink.'</div></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>  </form>'.$popularCourses.'
  <div class="aboutblock position-relative">
   <div class="rightbanner position-absolute"></div>
   <div class="container ">
      <div class="row ">
         <div class="col-md-6">
            <div class="aboutblock__container">
               <div class="smallheading text-uppercase ">
                get, set, global!
               </div>
               <div class="boldheading">
                 <span class="d-block">Set the right</span> course
               </div>
               <div class="brownpath"></div>
               <div class="content m-t-30">
                 <span class="d-block">Would you like your journey of searching the right university</span>
                 <span class="d-block">to be even more precise and tailored right to your needs? </span>
                 <span class="d-block">Register to our Student’s Portal to get wider access</span>
                 <span class="d-block">to all of our tools. Let’s start this journey together!</span>
               </div>
               <div class="morebtn m-t-40">
                  <a href="" class="text-uppercase text-decoration-none">sign in to portal <span><img src="http://tcglobal.wpengine.com/wp-content/uploads/2019/08/forward.png" alt="" width="13"></span></a>
               </div>
            </div>
         </div>
         <div class="col-md-6 ">
         </div>
      </div>
   </div>
</div>

<!--SET-COURSE-->

<!--ABOUT-SIGNUP-->

<div class="about-signup">
  <div class="text-center">
    <div class="boldheading">
      Why Sign Up with TC Global
    </div>
    <div class="path"></div>
  </div>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-sm-12">
        <div class="row">
          <div class="col-sm-4">
            <img src="'.plugins_url('searchtool/images/profile-editing.png').'"  class="img-fluid" />
            <p><span class="d-block">Build and Manage</span> your Profile</p>
          </div>
          <div class="col-sm-4">
            <img src="'.plugins_url('searchtool/images/services-ecosystem.png').'"  class="img-fluid" />
            <p><span class="d-block">Rich Matching</span> and Recommendation Engine</p>
          </div>
          <div class="col-sm-4">
            <img src="'.plugins_url('searchtool/images/global-partnership.png').'"  class="img-fluid" />
            <p><span class="d-block">Community</span> and Global Partnerships</p>
          </div>
          <div class="col-sm-4">
            <img src="'.plugins_url('searchtool/images/dashboard.png').'"  class="img-fluid" />
            <p><span class="d-block">Journey</span> Dashboard</p>
          </div>
          <div class="col-sm-4">
            <img  src="'.plugins_url('searchtool/images/events.png').'"  class="img-fluid" />
            <p><span class="d-block">Recommended</span> Insights and Events</p>
          </div>
          <div class="col-sm-4">
            <img  src="'.plugins_url('searchtool/images/help-centre.png').'"  class="img-fluid" />
            <p><span class="d-block">HelpCentre</span> and Knowledge Base</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!--ABOUT-SIGNUP-->

      <!-- insight section -->
      <div class="insightblock p-t-80 p-b-80">
        <div class="text-center">
          <div class="smallheading text-uppercase ">
            Explore our resources
          </div>
          <div class="boldheading">
            Related insights
          </div>
          <div class="path"></div>
        </div>
        <div class="container">
          <div class="insightslider">
            <div class="multiple-items">
              <div>
                <div class="singleslideitem">
                  <div class="contentslider">
                    <div class="row align-items-center m-b-40">
                      <div class="col-md-6 ">
                        <span class="taglabel">Future of ed</span>
                      </div>
                      <div class="col-md-6">
                        <div class="text-right">
                          <div class="datetime pt-1 ">12.03.2019</div>
                        </div>
                      </div>
                    </div>
                    <div class="text-left">
                      <div class="formheading pb-2 text-left">Jobs adapting to technological advances</div>
                      <div class="sightdesc">What is your attitude as a small town businessman when it comes to advertising</div>
                      <a href="" class="d-block m-t-20 explorelink text-uppercase text-decoration-none d-flex align-items-center">Read more<span class="pl-3"><img src="http://tcglobal.wpengine.com/wp-content/uploads/2019/08/down_2.png" alt=""></span></a>
                    </div>
                  </div>
                </div>
              </div>
              <div>
                <div class="singleslideitem">
                  <div class="contentslider">
                    <div class="row align-items-center m-b-40">
                      <div class="col-md-6 ">
                        <span class="taglabel">Future of ed</span>
                      </div>
                      <div class="col-md-6">
                        <div class="text-right">
                          <div class="datetime pt-1 ">12.03.2019</div>
                        </div>
                      </div>
                    </div>
                    <div class="text-left">
                      <div class="formheading pb-2 text-left">Jobs adapting to technological advances</div>
                      <div class="sightdesc">What is your attitude as a small town businessman when it comes to advertising</div>
                      <a href="" class="d-block m-t-20 explorelink text-uppercase text-decoration-none d-flex align-items-center">Read more<span class="pl-3"><img src="http://tcglobal.wpengine.com/wp-content/uploads/2019/08/down_2.png" alt=""></span></a>
                    </div>
                  </div>
                </div>
              </div>
              <div>
                <div class="singleslideitem">
                  <div class="contentslider">
                    <div class="row align-items-center m-b-40">
                      <div class="col-md-6 ">
                        <span class="taglabel">Future of ed</span>
                      </div>
                      <div class="col-md-6">
                        <div class="text-right">
                          <div class="datetime pt-1 ">12.03.2019</div>
                        </div>
                      </div>
                    </div>
                    <div class="text-left">
                      <div class="formheading pb-2 text-left">Jobs adapting to technological advances</div>
                      <div class="sightdesc">What is your attitude as a small town businessman when it comes to advertising</div>
                      <a href="" class="d-block m-t-20 explorelink text-uppercase text-decoration-none d-flex align-items-center">Read more<span class="pl-3"><img src="http://tcglobal.wpengine.com/wp-content/uploads/2019/08/down_2.png" alt=""></span></a>
                    </div>
                  </div>
                </div>
              </div>
              <div>
                <div class="singleslideitem">
                  <div class="contentslider">
                    <div class="row align-items-center m-b-40">
                      <div class="col-md-6 ">
                        <span class="taglabel">Future of ed</span>
                      </div>
                      <div class="col-md-6">
                        <div class="text-right">
                          <div class="datetime pt-1 ">12.03.2019</div>
                        </div>
                      </div>
                    </div>
                    <div class="text-left">
                      <div class="formheading pb-2 text-left">Jobs adapting to technological advances</div>
                      <div class="sightdesc">What is your attitude as a small town businessman when it comes to advertising</div>
                      <a href="" class="d-block m-t-20 explorelink text-uppercase text-decoration-none d-flex align-items-center">Read more<span class="pl-3"><img src="http://tcglobal.wpengine.com/wp-content/uploads/2019/08/down_2.png" alt=""></span></a>
                    </div>
                  </div>
                </div>
              </div>
              <div>
                <div class="singleslideitem">
                  <div class="contentslider">
                    <div class="row align-items-center m-b-40">
                      <div class="col-md-6 ">
                        <span class="taglabel">Future of ed</span>
                      </div>
                      <div class="col-md-6">
                        <div class="text-right">
                          <div class="datetime pt-1 ">12.03.2019</div>
                        </div>
                      </div>
                    </div>
                    <div class="text-left">
                      <div class="formheading pb-2 text-left">Jobs adapting to technological advances</div>
                      <div class="sightdesc">What is your attitude as a small town businessman when it comes to advertising</div>
                      <a href="" class="d-block m-t-20 explorelink text-uppercase text-decoration-none d-flex align-items-center">Read more<span class="pl-3"><img src="http://tcglobal.wpengine.com/wp-content/uploads/2019/08/down_2.png" alt=""></span></a>
                    </div>
                  </div>
                </div>
              </div>
              <div>
                <div class="singleslideitem">
                  <div class="contentslider">
                    <div class="row align-items-center m-b-40">
                      <div class="col-md-6 ">
                        <span class="taglabel">Future of ed</span>
                      </div>
                      <div class="col-md-6">
                        <div class="text-right">
                          <div class="datetime pt-1 ">12.03.2019</div>
                        </div>
                      </div>
                    </div>
                    <div class="text-left">
                      <div class="formheading pb-2 text-left">Jobs adapting to technological advances</div>
                      <div class="sightdesc">What is your attitude as a small town businessman when it comes to advertising</div>
                      <a href="" class="d-block m-t-20 explorelink text-uppercase text-decoration-none d-flex align-items-center">Read more<span class="pl-3"><img src="http://tcglobal.wpengine.com/wp-content/uploads/2019/08/down_2.png" alt=""></span></a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="text-center m-t-60 ">
            <a href="" class="eventbtn text-uppercase text-decoration-none d-block mx-auto">Go to Insights <span><img src="http://tcglobal.wpengine.com/wp-content/uploads/2019/08/whiteforward.png" alt="" width="15"></span></a>
          </div>
        </div>
      </div></section>';
        return $content;
    }

    /**
     * to display pagination
     */
    public function getPaginationContent($totalPages,$totalRecord,$rows,$filterParms){
        $page=$filterParms['page'];
        if((int)$filterParms['showlist']===Constants::CONST_TWO)
        {
            $showListType='Universities';
        }
        else if((int)$filterParms['showlist']===Constants::CONST_ONE){
           $showListType= 'Courses';
        }else{
            $showListType=' Records ';
        }
        $pagination='<div class="col-sm-4">
                                <p>Showing <span>'.$rows.' of '.$totalRecord.'</span> '.$showListType.' found</p>
                            </div>
                            <div class="col-sm-2 px-0">
                                <nav aria-label="Page navigation example">
                                <ul class="pagination">';
        //previous page 
        if($page && (int)$page!==Constants::CONST_ONE && $totalRecord>Constants::SEARCHLIMIT ){
            $pageUrl=Self::paginationLink($filterParms,'Prev','');
            $pagination.= "<li class='page-item'>".$pageUrl."</li>"; 
        }
        //pagination links 
        for($i = max(Constants::CONST_ONE, $page - Constants::CONST_ONE); $i <= min($page + Constants::CONST_ONE, $totalPages); $i++){
            $pageUrl=Self::paginationLink($filterParms,$i,'');
            $pagination.= "".$pageUrl.""; 
        }; 
        //next page  
        if($page && (int)$page!==(int)$totalPages && $totalRecord>Constants::SEARCHLIMIT){
            $pageUrl=Self::paginationLink($filterParms,'Next',$totalPages);
            $pagination.= "<li class='page-item'>".$pageUrl."</li>"; 
        }
        $pagination.= " </ul> </nav> </div>";  
        
        return $pagination;   
    }

    /**
     * generate pagination link
     */
    public function paginationLink($filterParms,$curentPage,$totalPages){
        $page=$filterParms['page'];
        $limit=$filterParms['limit'];
        $university=$filterParms['university'];
        $showlist = $filterParms['showlist'];
        $sortBy = $filterParms['sortBy'];
        $areaOfStudy=$filterParms['areaOfStudy']?$filterParms['areaOfStudy']:"";
        $country=$filterParms['country']?$filterParms['country']:"";
        $specialization=$filterParms['specialization'];
        $studyLevel=$filterParms['studyLevel'];
        $city = $filterParms['city'];
        $intake = $filterParms['intake'];
        $feesRange = $filterParms['feesRange'];
        $acceptedTestSelected = $filterParms['acceptedTestSelected'];
        if($acceptedTestSelected && count($acceptedTestSelected)>Constants::CONST_ZERO){
            foreach ($acceptedTestSelected as $key => $value) {
                if($key!==Constants::CONST_ZERO){
                    $acceptTest.='&acceptedTest[]='.$value;
                }else{
                    $acceptTest.='acceptedTest[]='.$value;
                }
            }
        }
        if($curentPage==='Prev'){
            $preOff=($page-Constants::CONST_TWO)* Constants::SEARCHLIMIT;
            $prePage=$page===Constants::CONST_ONE?$page:$page-Constants::CONST_ONE;
            $pageLink="<a  class='page-link' href='/search-tool?offset=".$preOff."&limit=".$limit."&cpage=".$prePage."&areaOfStudy=".$areaOfStudy."&showlist=".$showlist."&sortBy=".$sortBy."&country=".$country."&specialization=".$specialization."&studyLevel=".$studyLevel."&university=".$university."&city=".$city."&intake=".$intake."&feesRange=".$feesRange."&".$acceptTest."'><img src='".plugins_url('searchtool/images/pagination-left.png')."'  alt='Prev' /></a>";
        }else if($curentPage==='Next'){
            $nextPage=$page===$totalPages?$page:$page+Constants::CONST_ONE;
            $nextOff=($nextPage-Constants::CONST_ONE)* Constants::SEARCHLIMIT;
            $pageLink= "<a class='page-link' href='/search-tool?offset=".$nextOff."&limit=".$limit."&cpage=".$nextPage."&areaOfStudy=".$areaOfStudy."&showlist=".$showlist."&sortBy=".$sortBy."&country=".$country."&specialization=".$specialization."&studyLevel=".$studyLevel."&university=".$university."&city=".$city."&intake=".$intake."&feesRange=".$feesRange."&".$acceptTest."'><img src='".plugins_url('searchtool/images/pagination-right.png')."'  alt='Next' /></a>";
        }else{
            $off=($curentPage-Constants::CONST_ONE)* Constants::SEARCHLIMIT;
            $activeClass=((string)$curentPage===$page) || (!$page)? 'page-item active':' page-item ';
            $pageLink="<li class='".$activeClass."'><a class='page-link'
             href='/search-tool?offset=".$off."&limit=".$limit."&cpage=".$curentPage."&areaOfStudy=".$areaOfStudy."&showlist=".$showlist."&sortBy=".$sortBy."&country=".$country."&specialization=".$specialization."&studyLevel=".$studyLevel."&university=".$university."&city=".$city."&intake=".$intake."&feesRange=".$feesRange."&".$acceptTest."'>".$curentPage."</a></li>";
        }
      
        return $pageLink;
    }
  

    

    
 
}

?>