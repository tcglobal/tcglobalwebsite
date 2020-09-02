<?php /* Template Name: searchlisttemplate */
get_header();

?>

<section class="desktop-mainsection">
<form id="searchForm" action="/search-tool" method="GET" onsubmit="return callapirecords()">
    <div class="searchtool-banner">
      <div class="bg-color"></div>
      <div class="container-fluid position-relative">
        <div class="row align-items-center">
          <div class="col">
            <h2 class="main-heading">Search Tool</h2>
          </div>
        </div>
      </div>
    </div>
    <input type="hidden" name="offset" value="0" id="offset">
        <input type="hidden" name="limit" value="10">
        <input type="hidden" name="cpage" value="1">
        <input type="hidden" name="totalRecords" id="totalRecords" value="0">
        <input type="hidden" id="previousPage" value="1">
    <!-- modal -->
    <div id="myModal" class="modal fade" role="dialog">
      <div class="modal-dialog searchfilter-modal">
        <div class="modal-content modal-search-filter search-result p-0">
          <a href="" class="close-btn" data-dismiss="modal" >
            <img src="<?php bloginfo('template_url')?>/images/popup-close.png;"/>
          </a>
          <div class="search-form-fields" id="popuphide">
            <div class="row">
            <div class="col-6 m-b-20">
                <label>I would like to study</label>

                <select class="form-control mutlidropdown" data-placeholder="Area of study"
                name="areaOfStudy[]" id="areaOfStudy"   multiple="multiple" value="" >

            </select>
            </div>
            <div class="col-6 m-b-20">
              <label>Specialising in</label>
              <select class="form-control mutlidropdown" data-placeholder="Course options"
              name="specialization[]" id="specialization" multiple="multiple" value="" >
              <option value=''>Course options</option>
              </select>
          </div>
          <div class="col-6 m-b-20">
            <label>In</label>
            <select class="form-control mutlidropdown"  data-placeholder="Country" name="country[]"
                  multiple="multiple" id="country"  value="" >

            </select>

      </div>
      <div class="col-6 m-b-20">
        <label>As an</label>
        <?php $className='form-control'?>
        <select class="form-control mutlidropdown"  data-placeholder="Study level options"
        name="studyLevel[]" id="studyLevel"  multiple="multiple" value="" >
      </select>
    </div>
    <div class="col-6 mt-3">
      <a class="more-link more-show btn-block mt-3 mb-0"  id="morehide">more filters +</a>
    </div>
    <div class="col-5 mt-3">
      <a class="btn btn-theme text-white btn-block py-3" id="topsearch">Search</a>
    </div>
  </div>
  <div  id= "filter" class="search-filter col-sm-12 px-0" style="display:none">
    <div class="search-filter">
      <div class="row">
        <div class="col-12 mb-2">
          <h2>More filters</h2>

        </div>
        <div class="col-6 m-b-30">
          <h5>Choose university</h5>

                <select class="form-control selectbox m-b-20 mutlidropdown" name="university[]"
              data-placeholder="Choose University"  multiple="multiple" id="university"  value="" >
            <option value=''>Choose university</option>
             </select>
      </div>
      <div class="col-6 m-b-30">
        <h5>Choose City</h5>

        <select class="form-control selectbox m-b-20 mutlidropdown " name="city[]"
                     data-placeholder="Choose city" id="city"  multiple="multiple" value="" >
                     <option value=''>Choose City</option>

       </select>
    </div>
    <div class="col-6">
      <label class="mb-0">Choose preffered intake</label>
      <div class="row">
        <div class="col-sm-6">
        <select class="form-control selectbox m-b-20 mutlidropdown" name="month[]"
          data-placeholder="months" id="month" multiple="multiple" value="" >
          <option value=''></option>
          <?php

                  for($m=1; $m<=12; ++$m){
                  $month=date('F', mktime(0, 0, 0, $m, 1));
                    $label = date('F', mktime(0, 0, 0, $m, 1));
                      $value =date('n', mktime(0, 0, 0, $m, 1));
                      echo "<option value='$value'>$label</option>";

                         }
                         ?>
              </select>
        </div>
        <div class="col-sm-6">

          <select class="form-control selectbox m-b-20" name="intake"
          data-placeholder="year"   id="intake"
          value="" >
          <option value=''>Choose intake year</option>
          <?php
                  $starting_year  =date('Y');
                  $ending_year = date('Y', strtotime('+3year'));

                   for($starting_year; $starting_year <= $ending_year; $starting_year++) {
                  echo '<option value="'.$starting_year.'">'.$starting_year.'</option>';
                   }
                  echo '<option value="'.$starting_year.'">'.$starting_year.'</option>';
                     ?>
        </select>
        </div>
      </div>

  </div>
  <div class="col-6">
    <label class="mb-0">Choose prefered tuition fee</label>

    <div class="col-sm-12 p-0">
      <input type="text" class="js-range-slider" name="feesRange" value=""/>
      <span style="display:none"  id="feesrangeselectedMax" name="feesrangeselectedMax"><?php echo $maxVal?></span>
      <span style="display:none"  id="feesrangeselectedMin" name="feesrangeselectedMin"><?php echo$minVal?></span>
      <span style="display:none" name="range-max" id="range-max-value"><?php echo $tutionFees?></span>
    </div>
  </div>
  <div class="col-6">
    <label class="mb-0">Duration of course</label>
    <div class="tab m-b-20 mt-2">
      <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item">
          <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Undergraduate</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Postgraduate</a>
        </li>
      </ul>
      <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
          <div class="col">
            <div class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input under" name="under[]" id="customCheck6" >
              <label class="custom-control-label" for="customCheck6">3 years</label>
            </div>
          </div>
          <div class="col">
            <div class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input under" name="under[]" id="customCheck7" >
              <label class="custom-control-label" for="customCheck7">4 +years</label>
            </div>
          </div>
        </div>
        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
          <div class="col">
            <div class="custom-control custom-checkbox">
              <input type="checkbox" class="custom-control-input" name="post[]" id="customCheck8">
              <label class="custom-control-label" for="customCheck8">5 years</label>
            </div>
          </div>
          <div class="col">
            <div class="custom-control custom-checkbox">
              <input type="checkbox" class="custom-control-input" name="post[]" id="customCheck9">
              <label class="custom-control-label" for="customCheck9">6 +years</label>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-6 p-t-30">
    <h5>Choose mode of study</h5>
    <select class="form-control selectbox m-b-20 mutlidropdown " name="mode of study[]"
    data-placeholder="Choose mode of study" id="mode of study"  multiple="multiple" value="<?php echo $params['mode of study']?>" >
    <option value=''></option>
    <option value='Fulltime'>Full time</option>
    <option value='Online'>Online</option>
     <option value='Parttime'>Part time</option>

  </select>
  <h5 class="m-t-25">Choose orientation</h5>
  <select class="form-control selectbox m-b-20 mutlidropdown " name="universityorientation[]"
   data-placeholder="Choose university orientation " id="universityorientation"  multiple="multiple" value="<?php echo $params['universityorientation']?>" >
  <option value=''></option>
  <option value='Research'>Research</option>
  <option value='Industry'>Industry</option>


</select>
</div>
<div class="col-6">
  <label class="m-b-20 mt-0">Language tests not required</label>
  <div class="custom-control custom-control-inline custom-checkbox mr-0 pt-2 float-right">
    <input type="checkbox" class="custom-control-input" id="multiselectcheck1">
    <label class="custom-control-label pl-0 right-5" for="multiselectcheck1"></label>
  </div>
  <h5 id="lang">Choose language tests </h5>
 <select class="form-control selectbox m-b-20 mutlidropdown " name="acceptedlanguage[]" class="testdropdown"
  data-placeholder="Choose languages tests" id="acceptedlanguage"  multiple="multiple" value="<?php echo $params['acceptedTest']?>" >
  <option value=''></option>
  <option value='IELTS'>IELTS</option>
  <option value='PTE'>PTE</option>
  <option value='TOEFL'>TOEFL</option>

</select>
</div>
<div class="col-6">
  <label class="m-b-20 mt-0">Additional exams not required</label>
  <div class="custom-control custom-control-inline custom-checkbox mr-0 pt-2 float-right">
    <input type="checkbox" class="custom-control-input" id="multiselectcheck2">
    <label class="custom-control-label pl-0 right-5" for="multiselectcheck2"></label>
  </div>
  <h5 id="exam">Choose exams </h5>
  <select class="form-control selectbox m-b-20 mutlidropdown " name="acceptedexams[]" class="testdropdown"
  data-placeholder="Choose exams" id="acceptedexams"  multiple="multiple" value="<?php echo $params['acceptedexam']?>" >
  <option value=''></option>
  <option value='GRE'>GRE</option>
  <option value='GMAT'>GMAT</option>
  <option value='SAT'>SAT</option>

</select>
</div>
</div>
<div class="row justify-content-center">
  <div class="col-5 m-b-20 m-t-20 px-2">
    <button type="button" class="btn btn-block" id="morefilter">search</button>
  </div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>

<!--SEARCH-RESULT-->
      <div class="search-result p-t-50">
        <div class="container">
          <div class="row">
            <div class="col-sm-12">
              <h2 class="main-heading">Catalysing the Global Citizens of tomorrow, today</h2>
              <div class="row">
                <div class="col-sm-12">

                  <div class="searchlist-topfilter">
                      <div class="row">
                      <div id="pagination-no-result-div" class="col-sm-12">
                      <div class="no-record-theme">No Results Found</div>
                      </div>
                      <div id="pagination-result-div" class="col"></div>
                      <ul class="paging p-0"></ul>
                        <div class="col pl-0 additionalfilters">
                          <ul class="filter-dropdown clearfix float-right">
                            <li><label>Show:</label></li>
                            <li>
                            <div class="dropdown pl-0">
                            <input type="hidden" name="showlist" id="showlist" value=""/>
                            <button class="btn btn-secondary dropdown-toggle" type="button"
                              id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                              aria-expanded="false"></button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                              <ul>
                                <li class="showcourse" data-myvalue="" data-mydata="All" > <a  class="allview"  id="allselect"> <img  id="allselectimg" style="display:none" src="<?php echo bloginfo('template_url') ?>/images/drop-tick.jpg" alt="" /> All </a> </li>
                                <li class="showcourse" data-myvalue="Courses" data-mydata="Courses" id="courseselect" > <a  class=""  > <img id="courseselectimg" style="display:none" src="<?php echo bloginfo('template_url') ?>/images/drop-tick.jpg" alt="" /> Courses </a> </li>

                                </ul>
                              </div>
                            </div></li>
                          </ul>
                        </div>
                        <div class="col pl-0 additionalfilters">
                          <ul class="filter-dropdown clearfix float-right">
                            <li><label>Sort by:</label></li>
                            <li>
                            <div class="dropdown pl-0">
                            <input type="hidden" name="sortBy" id="sortBy" value=""/>
                            <button class="btn btn-secondary dropdown-toggle" type="button"
                              id="dropdownMenuButtonsort" data-toggle="dropdown" aria-haspopup="true"
                              aria-expanded="false"></button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                              <ul id="search-tool-sorting">
                             </ul>
                              </div>
                            </div></li>
                          </ul>
                        </div>
                      </div>
                    </div>



                    <span id="page_records_loader" style="display:none"><?php
                      echo '<img height="50" width="100" src="'. plugins_url()."/searchtool/images/loader.gif".'"
                        alt="Loading..."> ';
                    ?></span>
                          <div id="datacollect"> </div>
                       <input type="hidden" id="result_no" value="10">

                <div class="searchlist-topfilter mt-4">
                <div class="row">
                <div id="pagination-result-div-bootom" class="col-sm-5"></div>
                <ul class="paging col-sm-3 px-0"></ul>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<!--SEARCH-RESULT-->

<!--POPULAR-COURSE-->
<div class="popular-course">
  <h2 class="main-heading">Popular Courses</h2>
  <div class="col-sm-12"><h4 class="no-record-theme">No Records Found </h4></div>
    </div>

<!--POPULAR-COURSE-->

<!--SET-COURSE-->
<div class="aboutblock position-relative tablet-citizenship-banner-section">
  <div class="rightbanner position-absolute"></div>
  <div class="container ">
    <div class="row ">
      <div class="col-md-6">
        <div class="aboutblock__container list-detail pl-2">
          <h3 class="sub-heading">get, set, global!</h3>
          <h2 class="main-heading">Set the right course</h2>
          <p>Would you like your journey of searching the right university to be even more precise and tailored right to your needs?
            Register to our Student’s Portal to get wider access to all of our tools. Let’s start this journey together!</p>
            <button type="button" class="btn btn-primary">sign in to portal<img alt="" src="images/right-arrow.png" class="img-fluid"></button>
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
    <h2 class="main-heading">Why Sign Up with TC Global</h2>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-sm-12">
        <div class="row">
          <div class="col-sm-4">
          <img src="<?php bloginfo('template_url')?>/images/profile-editing.png" class="img-fluid" />

            <p><span class="d-block">Build and Manage</span> your Profile</p>
          </div>
          <div class="col-sm-4">
          <img src="<?php bloginfo('template_url')?>/images/services-ecosystem.png" class="img-fluid" />

            <p><span class="d-block">Rich Matching</span> and Recommendation Engine</p>
          </div>
          <div class="col-sm-4">
          <img src="<?php bloginfo('template_url')?>/images/global-partnership.png" class="img-fluid" />

            <p><span class="d-block">Community</span> and Global Partnerships</p>
          </div>
          <div class="col-sm-4">
          <img src="<?php bloginfo('template_url')?>/images/dashboard.png" class="img-fluid" />

            <p><span class="d-block">Journey</span> Dashboard</p>
          </div>
          <div class="col-sm-4">
          <img src="<?php bloginfo('template_url')?>/images/events.png" class="img-fluid" />

            <p><span class="d-block">Recommended</span> Insights and Events</p>
          </div>
          <div class="col-sm-4">
          <img src="<?php bloginfo('template_url')?>/images/help-centre.png" class="img-fluid" />

            <p><span class="d-block">HelpCentre</span> and Knowledge Base</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!--ABOUT-SIGNUP-->

    </section>
    <!---POPULAR-INSIGHTS--->
    <div class="tablet-popular-insights py-0">
        <div class="tablet-popular-insights pb-0">
          <h3 class="sub-heading">Explore our resources</h3>
          <h2 class="main-heading">Popular Insights</h2>
        </div>
        <section class="carousel slider tablet-popular-insights py-0">
          <div>
            <div class="list">
              <span class="taglabel">Future of Ed</span>
              <h2>Jobs adapting<br> to technological<br> advances</h2>
              <p>What is your attitude as a<br> small town businessman<br> when it comes to advertising</p>
              <a href="" class=""><span>Read more</span>
              <img src="<?php bloginfo('template_url')?>/images/down_2.png" alt="" />

            </a>
            </div>
          </div>
          <div>
            <div class="list">
              <span class="taglabel">Future of Ed</span>
              <h2>Jobs adapting<br> to technological<br> advances</h2>
              <p>What is your attitude as a<br> small town businessman<br> when it comes to advertising</p>
              <a href="" class=""><span>Read more</span>
              <img src="<?php bloginfo('template_url')?>/images/down_2.png" alt="" />


            </a>
            </div>
          </div>
          <div>
            <div class="list">
              <span class="taglabel">Future of Ed</span>
              <h2>Jobs adapting<br> to technological<br> advances</h2>
              <p>What is your attitude as a<br> small town businessman<br> when it comes to advertising</p>
              <a href="" class=""><span>Read more</span>
              <img src="<?php bloginfo('template_url')?>/images/down_2.png" alt="" />

              </a>
            </div>
          </div>
          <div>
            <div class="list">
              <span class="taglabel">Future of Ed</span>
              <h2>Jobs adapting<br> to technological<br> advances</h2>
              <p>What is your attitude as a<br> small town businessman<br> when it comes to advertising</p>
              <a href="" class=""><span>Read more</span>
              <img src="<?php bloginfo('template_url')?>/images/down_2.png" alt="" />

              </a>
            </div>
          </div>
          <div>
            <div class="list">
              <span class="taglabel">Future of Ed</span>
              <h2>Jobs adapting<br> to technological<br> advances</h2>
              <p>What is your attitude as a<br> small town businessman<br> when it comes to advertising</p>
              <a href="" class=""><span>Read more</span>
              <img src="<?php bloginfo('template_url')?>/images/down_2.png" alt="" />

              </a>
            </div>
          </div>
          <div>
            <div class="list">
              <span class="taglabel">Future of Ed</span>
              <h2>Jobs adapting<br> to technological<br> advances</h2>
              <p>What is your attitude as a<br> small town businessman<br> when it comes to advertising</p>
              <a href="" class=""><span>Read more</span>
              <img src="<?php bloginfo('template_url')?>/images/down_2.png" alt="" />

              </a>
            </div>
          </div>
          <div>
            <div class="list">
              <span class="taglabel">Future of Ed</span>
              <h2>Jobs adapting<br> to technological<br> advances</h2>
              <p>What is your attitude as a<br> small town businessman<br> when it comes to advertising</p>
              <a href="" class=""><span>Read more</span>
              <img src="<?php bloginfo('template_url')?>/images/down_2.png" alt="" />

              </a>
            </div>
          </div>
          <div>
            <div class="list">
              <span class="taglabel">Future of Ed</span>
              <h2>Jobs adapting<br> to technological<br> advances</h2>
              <p>What is your attitude as a<br> small town businessman<br> when it comes to advertising</p>
              <a href="" class=""><span>Read more</span>
              <img src="<?php bloginfo('template_url')?>/images/down_2.png" alt="" />

              </a>
            </div>
          </div>
          <div>
            <div class="list">
              <span class="taglabel">Future of Ed</span>
              <h2>Jobs adapting<br> to technological<br> advances</h2>
              <p>What is your attitude as a<br> small town businessman<br> when it comes to advertising</p>
              <a href="" class=""><span>Read more</span>
              <img src="<?php bloginfo('template_url')?>/images/down_2.png" alt="" />


              </a>
            </div>
          </div>
          <div>
            <div class="list">
              <span class="taglabel">Future of Ed</span>
              <h2>Jobs adapting<br> to technological<br> advances</h2>
              <p>What is your attitude as a<br> small town businessman<br> when it comes to advertising</p>
              <a href="" class=""><span>Read more</span>
              <img src="<?php bloginfo('template_url')?>/images/down_2.png" alt="" />


              </a>
            </div>
          </div>
          <div>
            <div class="list">
              <span class="taglabel">Future of Ed</span>
              <h2>Jobs adapting<br> to technological<br> advances</h2>
              <p>What is your attitude as a<br> small town businessman<br> when it comes to advertising</p>
              <a href="" class=""><span>Read more</span>
              <img src="<?php bloginfo('template_url')?>/images/down_2.png" alt="" />


              </a>
            </div>
          </div>
          <div>
            <div class="list">
              <span class="taglabel">Future of Ed</span>
              <h2>Jobs adapting<br> to technological<br> advances</h2>
              <p>What is your attitude as a<br> small town businessman<br> when it comes to advertising</p>
              <a href="" class=""><span>Read more</span>
              <img src="<?php bloginfo('template_url')?>/images/down_2.png" alt="" />


              </a>
            </div>
          </div>
          </form>
        </section>
        <div class="tablet-popular-insights text-center pt-0">
          <a href="" class="eventbtn d-block text-decoration-none mx-auto text-uppercase">Go To Insights<span><img src="images/whiteforward.png" alt="" width="13"></span></a>
        </div>
        </div>
    <!---POPULAR-INSIGHTS--->



<script>
$(".showcourse").click(function(event){
     var showed  =   $(this).data('myvalue');
     $('#showlist').val(showed);
     showed=showed?showed:'All';
     $('#dropdownMenuButton').text(showed);
     if(showed==='Courses'){
      $("#courseselect").addClass( "active" );
      $( "#allselectimg" ).css( "display",'none' );
      $("#courseselectimg").css( "display",'block' );
     }else{
      $( "#allselect" ).addClass( "active" );
      $("#courseselectimg").css( "display",'none' );
      $( "#allselectimg" ).css( "display",'block' );
     }
     callapirecords();
});




</script>



<script>
$(document).ready(function() {
  $('.mutlidropdown').select2();
  $('.page-item ').hide();
  var sortingList=["All",'Country','Area of study','University'];
  sortingOptions='';
  for (var i = 0; i <  sortingList.length; i++) {
    sortingOptions +='<li class="showrank" data-myvalue="'+sortingList[i]+'" data-mydata="'+sortingList[i]+'">'+
      '<a class="sorting-ref">'+
      '<img class="sorting-img" style="display:none" src="<?php echo bloginfo('template_url') ?>/images/drop-tick.jpg" alt="" />'+sortingList[i]+'</a>'+
      '</li>';
  }
  $('#search-tool-sorting').append(sortingOptions);
  $(".showrank").each(function(event){
      var showed  =   $(this).data('myvalue');
      if(showed=='All'){
        $(this).find('a').addClass( "active" );
        $(this).find('img').css( "display",'block' );
        $('#dropdownMenuButtonsort').text(showed);
      }
  });
  $(".showrank").click(function(event){
     var showed  =   $(this).data('myvalue');
     $('#sortBy').val(showed);
     showed=showed?showed:'All';
     $('.sorting-ref').removeClass('active');
     $('.sorting-img').css('display','none');
     $('#dropdownMenuButtonsort').text(showed);
     if(showed){
      $(this).find('a').addClass( "active" );
      $(this).find('img').css( "display",'block' );
     }
     callapirecords();
  });
  $(".showcourse").each(function(event){
    var showed  =   $(this).data('mydata');
    if(showed=='All'){
      $( "#allselect" ).addClass( "active" );
      $("#courseselectimg").css( "display",'none' );
      $( "#allselectimg" ).css( "display",'block' );
      $('#dropdownMenuButton').text(showed);
    }
  });
$(".more-show").click(function(){
    $("#filter").css("display", "block");
    $("#topsearch").hide();
    $("#filters").hide();
    $("#morehide").hide();

   });

 });
</script>

<script>

$(document).ready(function() {
var settings = {
    url: '<?php echo plugins_url('searchtool');?>/fetch.php',  //"/wp-content/themes/tcglobal/includes/search_filter_api.php",
    type: "POST",
    data:{page_type:'first_level_filter'}
  }
  $.ajax(settings).done(function (response) {
    if(response){
      var appendarea="";
      var appendtype="";
      var appendlevel="";
      var appendCountry="";
      var responseData = JSON.parse(response);
      var response = responseData.result;
      var arealeveltype=(response);
      for (var i = 0; i <  arealeveltype.area_of_study.length; i++) {
        appendarea += "<option value = '" +  arealeveltype.area_of_study[i] + " '>" +   arealeveltype.area_of_study[i] + " </option>";
      }
      $("#areaOfStudy").append( appendarea);
      for (var i = 0; i <  arealeveltype.prog_type.length; i++) {
        appendtype += "<option value = '" +   arealeveltype.prog_type[i] + " '>" +   arealeveltype.prog_type[i] + " </option>";
      }
      $("#specialization").append(appendtype);
      for (var i = 0; i <  arealeveltype.prog_level.length; i++) {
        appendlevel += "<option value = '" +   arealeveltype.prog_level[i] + " '>" +   arealeveltype.prog_level[i] + " </option>";
      }
      $("#studyLevel").append(appendlevel);
      for (var i = 0; i <  responseData.countryList.length; i++) {
        appendCountry += "<option value = '" +    responseData.countryList[i].country + " '>" +    responseData.countryList[i].country + " </option>";
      }
      $("#country").append(appendCountry);
    }
  });
  OnSelectionChange();
  callapirecords();
  $('.page-item ').hide();
});


function OnSelectionChange(){
  var  countryVal=$("#country").select2("val");
  countryVal=countryVal.toString();
  $('#second_level_filter_loader').css('display','block');
  $('#university').prop('disabled', true);
  $('#city').prop('disabled', true);
  $.ajax({
  type: 'post',
  url:  '<?php echo plugins_url('searchtool');?>/fetch.php',
    data: {
      country:countryVal,
      page_type:'second_level_filter'
  },
  success: function (result) {
    $('#second_level_filter_loader').css('display','none');
    $('#university').prop('disabled', false);
    $('#city').prop('disabled', false);
    if(result){
      var appenddata="";
      var appendcity="";
      var countryList=JSON.parse(result);
      for (var i = 0; i < countryList.list.length; i++) {
          appenddata += "<option value = '" + countryList.list[i].university + " '>" + countryList.list[i].university + " </option>";
      }
      var  univdata=$("#university").select2("val");
      $("#university").empty();
      $("#university").append(appenddata);
      $("#university").val( univdata).trigger('change');
      for (var i = 0; i < countryList.citylist.length; i++) {
          appendcity += "<option value = '" + countryList.citylist[i].city + " '>" + countryList.citylist[i].city + " </option>";
      }
      var  citydata=$("#city").select2("val");
      $("#city").empty();
      $("#city").append(appendcity);
      $("#city").val( citydata).trigger('change');
    }
  }})
}

function  callapirecords(isPaginationCliked=false){
  if(!isPaginationCliked ){
    $('#offset').val(0);
    $('.paging').twbsPagination('destroy');
  }
  var  countryVal=$("#country").select2("val");
  countryVal=countryVal ?countryVal.toString():'';
  var offsetVal= document.getElementById("offset").value;
  var val = document.getElementById("result_no").value;
  var areaVal=$("#areaOfStudy").select2("val");
  areaVal=areaVal?areaVal.toString():'';
  var  specializval=$("#specialization").select2("val");
  specializval=specializval ?specializval.toString():'';
  var  studyVal=$("#studyLevel").select2("val");
  studyVal=studyVal?studyVal.toString():'';
  var univVal =$("#university").select2("val");
  univVal =univVal ? univVal:'';
  var cityVal=$("#city").select2("val");
  cityVal=cityVal?cityVal:'';
  var yearVal =$("#intake").val();
  yearVal=yearVal ?yearVal:'';
  var monthVal =$("#month").select2("val");
  monthVal= monthVal ? monthVal.toString():'';
  var acceptedlangtestVal=$("#acceptedlanguage").select2("val");
  acceptedlangtestVal=acceptedlangtestVal?acceptedlangtestVal.toString():'';
  var acceptedexamVal =$("#acceptedexams").select2("val");
  acceptedexamVal=acceptedexamVal?acceptedexamVal.toString():'';
  var modeofstudyVal =$("#modeofstudy").select2("val");
  modeofstudyVal= modeofstudyVal? modeofstudyVal.toString():'';
  var universityorientVal =$("#universityorientation").select2("val");
  universityorientVal= universityorientVal? universityorientVal.toString():'';
  var postval =$("input[name='customCheck6[]']").value;
  var feesRangemax =  $("#feesrangeselectedMax").text();
  var feesRangemin =  $("#feesrangeselectedMin").text();
  var showlistVal= $("#showlist").val();
  var sortbyVal =  $("#sortBy").val();

 if ($("#multiselectcheck1").is(":checked")){
  var acceptedlangtestVal="";
 }
 if ($("#multiselectcheck2").is(":checked")){
  var acceptedexamVal="";
 }
 $('.page-item ').hide();
 $('.modal-backdrop').remove();
  $('#myModal').hide();
  $(".page-template.page-template-searchlisttemplate").removeClass("modal-open");
  var ourdata = {page_type:'searchresult',sortBy:sortbyVal,offset:parseInt(offsetVal),limit:parseInt(val),country_name:countryVal,university_name:univVal,showlist:showlistVal,area_Of_Study:areaVal,specialization:specializval,studyLevel:studyVal,prog_campus:cityVal,month:monthVal,intake:yearVal,acceptedlanguage:acceptedlangtestVal,acceptedexams:acceptedexamVal,mode_of_study:modeofstudyVal,universityorientation:universityorientVal,feesRange:feesRangemax,feesRangemin:feesRangemin,cityVal:cityVal};
  var settingsProg = {
		  url:'<?php echo plugins_url('searchtool');?>/fetch.php', //"/wp-content/themes/tcglobal/includes/search_api.php",
		  type: "POST",
          data:ourdata
     }
  $('#page_records_loader').css('display','block');
 $.ajax(settingsProg).done(function (response) {
  $('#page_records_loader').css('display','none')
  var response = JSON.parse(response);
  var content = response.result;
		$('#totalRecords').val(content.total_count);
		var box='';
		var totalRecords=parseInt(content.total_count)>0?parseInt(content.total_count):0;
		var totalPages=Math.ceil(totalRecords/10);
		if(totalRecords > 0){
			for (var i=0; i<content.records.length; i++) {
        var res= content.records[i];
        var currencyAmount=	res.prog_fees_value?'<span class="amount"><span class="value">'+res.prog_fees_value+'</span>'+
				'<span class="type">'+res.prog_fees_currency+'</span>':'';
        var url='/coursedetail?prog_id='+res.prog_id+'&prog_name='+res.prog_name+'&university_name='+res.university_name+'&country_name='+
        res.country_name;
        var url= encodeURI(url);
            box+=  '<div class="searchlist-box">'+
                    '<div class="row">'+
                     '<div class="col-sm-4 thumbnail pr-0">'+
                      '<a href="'+url+'">'+
                      '<img src="<?php echo bloginfo('template_url') ?>/images/img-world-citizenship.png" alt="search-list-img"class="img-fluid"  > '+


                        '</a>'+
                        '<span class="name type1">course</span>'+currencyAmount+

                      '</div>'+
                      '<div class="col-sm-8 pl-0">'+
                        '<div class="col-sm-12">'+
                          '<div class="col-sm-12">'+
                            '<div class="row">'+
                              '<div class="col-sm-9">'+
                              '<p class="date">Start Date: <span>'+res.prog_start_date+'</span></p>'+

                              '</div>'+
                              '<div class="col-sm-2 pr-0 text-center pt-2 mt-1">'+
                                '<div class="tag-count">'+
                                '<img src="<?php echo bloginfo('template_url') ?>/images/rank-tag.png" alt="tag"> '+
                                '<span class="value"></span>'+
                                 '</div>'+
                                '<div class="popover fade show bs-popover-left"><div class="arrow" style="top: 16px;"></div>'+
                                '<div class="popover-body">  World University Rank  </div>'+


                            '</div>'+
                            '</div>'+
                            '<div class="col-sm-1 text-right p-0 pt-2 mt-1">'+
                              '<a href="">'+
                              '<img src="<?php echo bloginfo('template_url') ?>/images/search-favfill.png" alt="fav"> '+

                             '</a>'+
                            '</div>'+
                            '</div>'+
                          '<h3>'+
                          '<img src="<?php echo bloginfo('template_url') ?>/images/flag-img.png" alt="flag">'+
                           '<span>'+res.university_name+',</span>'+
                            '</h3>'+
                          '<h2>'+res.prog_name+'</h2>'+
                          '<div class="row">'+
                            '<div class="col-sm-6">'+
                              '<button type="button" class="btn btn-block btn-danger">check eligibility</button>'+
                            '</div>'+
                            '<div class="col-sm-6">'+
                              '<button type="button" class="btn btn-block btn-outline-danger px-0">express your interest</button>'+
                            '</div>'+
                          '</div>'+
                        '</div>'+
                      '</div>'+
                    '</div>'+
                  '</div>'+
                '</div>'
                //  popular courses

      }

  }
  var totalRecords=parseInt(content.total_count)>0?parseInt(content.total_count):0;
  var totalPages=Math.ceil(totalRecords/10);
  if(totalPages>1){
    recordsget(totalPages);
  }else{
    $('.paging').twbsPagination('destroy');
  }
  if(totalRecords>0){
      $('#pagination-no-result-div').css('display','none');
      $('.additionalfilters').css('display','block');
      paginationResult(content.records.length);
    }else{
      $('#pagination-no-result-div').css('display','block');
      $('.additionalfilters').css('display','none');
      $('#pagination-result-div').html('');
      $('#pagination-result-div-bootom').html('');
    }
  $("#datacollect").empty().append(box);
   $('.page-item ').hide();

	});
 return false;

}
function paginationResult(countOfRecord){
  var totalRecords=$('#totalRecords').val();
  var pageUrl='';
  var pagination='<p>Showing <span>'+countOfRecord+' of  '+totalRecords +' </span>records found</p>';
  var paginationLinkDiv='<nav aria-label="Page navigation example">'+
              '<ul class="pagination">'+
      pageUrl+"</ul> </nav>";
      $('#pagination-result-div').html(pagination);
      $('#pagination-result-div-bootom').html(pagination);
  }
</script>
 <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twbs-pagination/1.4.1/jquery.twbsPagination.min.js"></script>
<script>

function recordsget(totalPages){
$('.paging').twbsPagination({
totalPages:totalPages>1?totalPages:0,
startPage:1,
visiblePages: 3,
initiateStartPageClick: false,
href: false,
hrefVariable: '{{number}}',
prev: '<img src="<?php echo bloginfo('template_url') ?>/images/pagination-left.png" alt="flag"></a>',
next: '<img src="<?php echo bloginfo('template_url') ?>/images/pagination-right.png" alt="flag"></a>',
loop: false,
onPageClick: function (event, page,offset,limit) {
  var prevVal=$('#previousPage').val();
  prevVal=parseInt(prevVal);
  var offset= $('#offset').val();
  offset=parseInt(offset);
  if(page===1){
    $('#offset').val(0);
  }
else{
    offset=(page-1)*10;
    $('#offset').val(offset);
   }
  $('#previousPage').val(page);
  callapirecords(true);
	$('.page-active').removeClass('active');
  $('#page'+page).addClass('active');
},
paginationClass: 'pagination',
nextClass: 'next',
prevClass: 'prev',
pageClass: 'page',
activeClass: 'active',
disabledClass: 'disabled'

});
}

</script>



 <script>
   $(function () {
        $("#multiselectcheck1").click(function () {
         if ($("#multiselectcheck1").is(":checked")) {
               $("#lang").hide();
                $("#acceptedlanguage").next('span').hide();
            } else {
               $("#lang").show();
                $("#acceptedlanguage").next('span').show();
            }
        });
        $("#multiselectcheck2").click(function () {
          if ($("#multiselectcheck2").is(":checked")) {
               $("#exam").hide();
                $("#acceptedexams").next('span').hide();
            } else {
               $("#exam").show();
                $("#acceptedexams").next('span').show();
            }
        });
    });



  </script>


    <?php get_footer(); ?>


      <div class="show-filter-btnbottom">
      <button type="button"  id ="finalfilter" data-toggle="modal"  data-target="#myModal"
      class="btn btn-theme btn-block">show filters</button>

      </div>
