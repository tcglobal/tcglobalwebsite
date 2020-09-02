
 <?php /* Template Name: searchlisttemplate */ 
get_header();  

global $wpdb;

include($_SERVER['DOCUMENT_ROOT'].'/form/filter_api.php');
$seeuniversity = $_REQUEST['university'];

?>

<section class="desktop-mainsection">
<form id="searchForm" action="/search-tool" method="GET" onsubmit="return callapirecords()">
       <div class="searchtool-banner">
         <div class="bg-color"></div>
         <div class="container position-relative">
           <div class="row">
             <div class="col">
               <h2 class="mobile-main-heading ">Search Tool</h2>
             </div>
              </div>
<!-- modal -->
              <div id="myModal" class="modal fade" role="dialog">
              <div class="modal-dialog">

              <div class="modal-content modal-search-filter">
             
              <a href="" class="close-btn" data-dismiss="modal" >
              <img src="<?php bloginfo('template_url')?>/images/popup-close.png;"/>
                
                 </a>
           <div class="search-form-fields search-result ">

           <input type="hidden" name="offset" value="0" id="offset">
           <input type="hidden" name="limit" value="10">
           <input type="hidden" name="recordCount" value="0" id="recordCount">
            <input type="hidden" name="feesrangeselectedMin" id="feesrangeselectedMin" value="<?php echo $feerangemin; ?>">
            <input type="hidden" name="feesrangeselecteMax" id="feesrangeselecteMax" value="<?php echo $feerangemax; ?>">
            <input type="hidden" name="courseuniverse" value="<?php echo $seeuniversity; ?>" id="courseuniverse">
              <div class="row ">
                <div id="protype_loader" style="text-align:center;display:none"><?php
              echo '<img  width="80px" height="40px" src="'. plugins_url()."/searchtool/images/loader.gif".'" alt="Loading..."> '; ?>
                </div>

                <div class="col-12 m-b-20">
                  <label>Where?</label>
                 <select class="form-control mutlidropdown"  data-placeholder="Country" name="country[]"
                  multiple="multiple" onchange="universeChange()" id="country" >
                  <?php echo $countrydata; ?>
                </select>
               </div>

               <div class="col-12 m-b-20">
                 <label>On which study level? </label>
                 <select class="form-control mutlidropdown"  data-placeholder="Study level options"
               name="studyLevel[]" id="studyLevel"  onchange="universeChange()" multiple="multiple" value="" >
                  </select>
               </div>

              <div class="col-12 m-b-20">
               <label>What do you want to study?</label>
               <select class="form-control mutlidropdown" data-placeholder="Area of study"
                name="areaOfStudy[]" onchange="aofChange()" id="areaOfStudy"  multiple="multiple" value="" >
                </select>
              </div>

              <div class="col-12 m-b-20">
                 <label>What specialization?</label>
                <select class="form-control mutlidropdown" data-placeholder="Course options"
                name="specialization[]" id="specialization" onchange="universeChange()" multiple="multiple" value="" >
                </select>
              </div>

              <div class="col-12 text-center" id="filters">
                 <a  class="more-link more-show">more filters +</a>
               </div>
               <div class="col-sm-3 p-0">
                  <div class="search-filter">
               <div  id= "filter" class="search-filter col-sm-12" style="display:none">
                 <h2 id="newfilter"> More filters</h2>
                 <span id="second_level_filter_loader" style="display:none"><?php
                      echo '<img height="50" width="100" src="'. plugins_url()."/searchtool/images/loader.gif".'"
                        alt="Loading..."> ';
                    ?></span>
               <h5 class="p-t-10">Choose university</h5>
               <select class="form-control selectbox m-b-20 mutlidropdown" name="university[]"
              data-placeholder="Choose University"  multiple="multiple" id="university"  value="">
                    <!-- <option value=''>Choose university</option> -->
              </select>

               <label class="mb-0 p-t-20">Choose preffered intake</label>
                    <div class="row">
                     
                      <div class="col">
                      <select class="form-control selectbox m-b-20 mutlidropdown" name="month[]"
                      data-placeholder="months" id="month" multiple="multiple" value="" >
                           <!-- <option value=''></option> -->
                            
                           <?php
                     for($m=1; $m<=12; ++$m){
                      $month=date('M', mktime(0, 0, 0, $m, 1));
                      $label = date('F', mktime(0, 0, 0, $m, 1));
                      $value =date('n', mktime(0, 0, 0, $m, 1));
                      echo "<option value='$month'>$label</option>";
  
                         }
                         ?>
                           </select>
                      </div>
                      <div class="col">
                         <div class="dropdown select-theme filter-dropdown pl-0">
                            <button class="dropdown-toggle exp_center" type="button">Choose Year</button>
                             <input type="hidden" name="intake" value='' id="intake">
                                <div class="dropdown-menu exp_center_show"> 
                                   <ul>
                                    <li><a>Choose Year</a></li>
                                    <?php
                                    $starting_year  =date('Y');
                                    $ending_year = date('Y', strtotime('+3year'));
                                    for($starting_year; $starting_year <= $ending_year; $starting_year++) {?>
                                      <li><a >
                                        <img  src="<?php echo bloginfo('template_url') ?>/images/drop-tick.jpg" alt=>
                                        <?php echo $starting_year?></a></li>
                                    <?php   }
                                      ?>
                                    </ul>
                    
                                </div>
                          </div>
                      </div>
                    </div>
                    <label class="mb-0 p-t-20">Duration of course</label>
                    <div class="tab">
                    <!-- <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Undergraduate</a>
                   </li>
                   <li class="nav-item">
                  <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Postgraduate</a>
                  </li>
                  </ul> -->
                  <div class="tab-content pl-1 pb-3" id="myTabContent">
                  <div >
                    <div class="col pb-2">
                     <div class="custom-control custom-checkbox">
                     <input type="checkbox" class="custom-control-input under durationOfCourse" name="durationOfCourse" id="customCheck6" value="1">
                     <label class="custom-control-label" for="customCheck6">0 - 1 &nbsp year</label>
                     </div>
                   </div>
                   <div class="col">
                     <div class="custom-control custom-checkbox">
                     <input type="checkbox" class="custom-control-input under durationOfCourse" name="durationOfCourse" id="customCheck7" value="2">
                     <label class="custom-control-label" for="customCheck7">1 - 2 &nbsp years</label>
                     </div>
                   </div>
                   <div class="col">
                     <div class="custom-control custom-checkbox">
                     <input type="checkbox" class="custom-control-input under durationOfCourse" name="durationOfCourse" id="customCheck8" value="3">
                     <label class="custom-control-label" for="customCheck8">2 - 3  &nbsp years</label>
                     </div>
                   </div>
                    <div class="col">
                          <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input durationOfCourse" name="durationOfCourse" id="customCheck9" value="4+">
                            <label class="custom-control-label" for="customCheck9">4+ years</label>
                          </div>
                        </div>
                  </div>
                   <!-- <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                     <div class="col pb-2">
                      <div class="custom-control custom-checkbox">
                      <input type="checkbox" class="custom-control-input durationOfCoursePostGraduate" name="durationOfCoursePostGraduate" id="customCheck8" value="5 year">
                      <label class="custom-control-label" for="customCheck8">5 years</label>
                      </div>
                    </div>
                    <div class="col">
                      <div class="custom-control custom-checkbox">
                      <input type="checkbox" class="custom-control-input durationOfCoursePostGraduate" name="durationOfCoursePostGraduate" id="customCheck9" value="6+ year">
                      <label class="custom-control-label" for="customCheck9">6 +years</label>
                      </div>
                    </div>
                  </div> -->
                    </div>
                    </div>
                    <div class="row">
                      <div class="col-sm-12 p-b-20">
                        <label class="mb-0 mt-0 float-left">Language tests not required</label>
                        <div class="custom-control custom-control-inline custom-checkbox mr-0 pt-2 float-right">
                          <input type="checkbox" class="custom-control-input" id="multiselectcheck1">
                          <label class="custom-control-label right-5 m-0 p-0" for="multiselectcheck1"></label>
                        </div>
                      </div>
                    </div>
                    <h5 id="lang">Choose language tests </h5>
                    <select class="form-control selectbox m-b-20 mutlidropdown " name="acceptedlanguage[]" class="testdropdown"
  data-placeholder="Choose languages tests" id="acceptedlanguage"  multiple="multiple" value="" >
                     <!-- <option value=''></option> -->
                     <option value='IELTS'>IELTS</option>
                      <option value='PTE'>PTE</option>
                       <option value='TOEFL'>TOEFL</option>
 
                   </select>

                   <!--<div class="row">
                      <div class="col-sm-12 p-t-30 p-b-20">
                        <label class="mb-0 mt-0 float-left">Additional exams not required</label>
                        <div class="custom-control custom-control-inline custom-checkbox mr-0 pt-2 float-right">
                          <input type="checkbox" class="custom-control-input" id="multiselectcheck2">
                          <label class="custom-control-label right-5 m-0 p-0" for="multiselectcheck2"></label>
                        </div>
                      </div>
                    </div>
                    <h5 id="exam">Choose exams </h5>
                    <select class="form-control selectbox m-b-20 mutlidropdown " name="acceptedexams[]" class="testdropdown1"
                     data-placeholder="Choose exams" id="acceptedexams"  multiple="multiple" value="" >
                     <option value=''></option>
                     <option value='GRE'>GRE</option>
                    <option value='GMAT'>GMAT</option>
                     <option value='SAT'>SAT</option>
 
                   </select>-->


                   <h5 class="p-t-20">Choose mode of study </h5>
              <select class="form-control selectbox m-b-20 mutlidropdown " name="mode_of_study[]"
    data-placeholder="Choose mode of study" id="mode_of_study"  multiple="multiple" value="<" >
                     <!-- <option value=''></option> -->
                     <option value='Full Time'>Full Time</option>
                      <option value='Online'>Online</option>
                      <option value='Part Time'>Part Time</option>
                   </select>

                       

              <label class="mb-0 p-t-20 p-b-10">Choose prefered tuition fee</label>
              
              <div class="col-sm-12 p-0">
                <input type="text" class="js-range-slider" name="feesRange" value=""/>
                <span style="display:none"  id="feesrangeselectedMax" name="feesrangeselectedMax"><?php echo $maxVal?></span>
                  <span style="display:none"  id="feesrangeselectedMin" name="feesrangeselectedMin"><?php echo$minVal?></span>
                  <span style="display:none" name="range-max" id="range-max-value"><?php echo $tutionFees?></span>
              </div>
                <button id="morefilter" type="button" class="btn btn-block mt-1">apply filters</button>
               </div>
               <div class="col-12">

               <a class="btn btn-theme text-white" id="topsearch">Search</a>

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



<!-- modal -->




       <!--SEARCH-RESULT-->
       <div class="search-result">
         <div class="container">
           <div class="row">
             <div class="col-sm-12">
               <h2 class="mobile-main-heading m-b-50  main-container"><span class="d-block">Your personalized</span>University search results</h2>
               <div class="row">
                 <div class="col-sm-12">
                 

                   <div class="searchlist-topfilter">
                     <div class="row">
                       <div class="col-sm-12">
                       
                    

                               <!-- modal -->
                     <div id="myModalsort" class="modal fade" role="dialog">
                     <div class="modal-dialog">

                     <div class="modal-content">
              
                               <div class="search-sorting-section search-result">
                               <div class="search-filter border-0 position-relative">
                                 <a href="" class="close-btn" data-dismiss="modal" >
                                 <img src="<?php bloginfo('template_url')?>/images/popup-close.png"  alt="close"/>    
                                </a>

                                 <!-- <p>Show</p>
                                 <div class="row">
                                   <div class="col-sm-12">
                                     <div class="custom-control custom-checkbox">
                                      <input type="checkbox" class="custom-control-input showcheck" id="All"
                                       name="showlist"  value="All">
                                       <label class="custom-control-label" for="All">All</label>
                                     </div>
                                   </div>
                                 </div> -->

                                 <!-- <div class="row">
                                   <div class="col-sm-12">
                                     <div class="custom-control custom-checkbox">
                                        <input type="checkbox"  class="custom-control-input showcheck" id="Courses"
                                       name="showlist"  value="Courses">
                                       <label class="custom-control-label" for="Courses">Courses</label>
                                     </div>
                                   </div>
                                 </div> -->
                               
                                 

                                 <p>Sort by</p>
                                 <div class="row">
                                   <div class="col-sm-12">
                                     <div class="custom-control custom-radio">
                                         <input type="radio" checked id="customRadio1" name="sortBy"
                                          class="custom-control-input sortcheck" value="Application deadline">
                                      <label class="custom-control-label" for="customRadio1">Application deadline</label>
                                     </div>
                                   </div>
                                 </div>
                                 <div class="row">
                                   <div class="col-sm-12">
                                     <div class="custom-control custom-radio">
                                         <input type="radio" id="customRadio2" name="sortBy"
                                          class="custom-control-input sortcheck" value="Ranking">
                                      <label class="custom-control-label" for="customRadio2">Ranking</label>
                                     </div>
                                   </div>
                                 </div>
                                   <div class="row">
                                   <div class="col-sm-12">
                                     <div class="custom-control custom-radio">
                                        <input type="radio" id="customRadio3" name="sortBy" 
                                     class="custom-control-input sortcheck" value="Most Popular">
                                       <label class="custom-control-label" for="customRadio3">Most Popular</label>
                                     </div>
                                   </div>
                                 </div>
                                   <div class="row">
                                   <div class="col-sm-12">
                                     <div class="custom-control custom-radio">
                                        <input type="radio" id="customRadio4" name="sortBy" 
                                       class="custom-control-input sortcheck" value="Lowest Price">
                                     <label class="custom-control-label" for="customRadio4">Lowest Price</label>
                                     </div>
                                   </div>
                                 </div>

                                 <div class="row">
                                   <div class="col-sm-12">
                                     <div class="custom-control custom-radio">
                                        <input type="radio" id="customRadio5" name="sortBy" 
                                       class="custom-control-input sortcheck" value="Highest Price">
                                     <label class="custom-control-label" for="customRadio5">Highest Price</label>
                                     </div>
                                   </div>
                                 </div>

                                 <!-- <div class="row">
                                   <div class="col-sm-12">
                                     <div class="custom-control custom-radio">
                                        <input type="radio" id="customRadio6" name="sortBy" 
                                       class="custom-control-input sortcheck" value="Applicant Acceptance Rate">
                                     <label class="custom-control-label" for="customRadio6">Applicant Acceptance Rate</label>
                                     </div>
                                   </div>
                                 </div>  -->

                                 <button type="button" class="btn btn-block m-t-40 " id="sorting-search">search</button>
                               </div>
                             </div>
                           </li>
                         </ul>
                                   </div>
                                   </div>
                                   </div>
                                      <!-- modal -->
                       </div>
                     </div>
                   </div>
                 
                   <span id="page_records_loader" style="display:none"><?php
                      echo '<img height="50" width="100" src="'. plugins_url()."/searchtool/images/loader.gif".'"
                        alt="Loading..."> ';
                    ?></span>
                      <div id="pagination-no-result-div">
                      <div class="no-record-theme">No Results Found</div>
                      </div>
                     <div id="datacollect"> </div>
                   
                     <input type="hidden" id="result_no" value="10"> 
                  

               <button type="button" class="btn loadmore-btn" id="moredata">Load more
               <img src="<?php bloginfo('template_url')?>/images/load-btndown.png"  alt=""/>    
                                
                    
                  
                </button>
             </div>
           </div>
         </div>
       </div>
     </div>
   </div>
   <!--SEARCH-RESULT-->
   <!--POPULAR-COURSE-->
   <div class="popular-course" style="display:none">
     <div class="container-fluid">
       <h2 class="mobile-main-heading m-b-50">Popular Courses</h2>
       </div>
        <div class="col-sm-12"><h4 class="no-record-theme">No Records Found </h4></div>
        </div>
    <!--POPULAR-COURSE-->

    <!-- Get Shortcode content from editor -->
     <?php
      while ( have_posts() ) : the_post();
          the_content(); // get post content
          endwhile;
    ?>

</form>
   </section>

<script>
$(document).ready(function(){
  $('.page-template').addClass('footer-bottom-padding');
  $("#newfilter").hide();
  $(".more-show").click(function(){
    $("#filter").css("display", "block");
    $("#topsearch").hide();
    $("#filters").hide();
    $("#newfilter").show();

   });
  
  $("#finalsorting").click(function(){
  $("input:checkbox").on('click', function() {
  var $box = $(this);
  if ($box.is(":checked")) {
      var group = "input:checkbox[name='" + $box.attr("name") + "']";
      $(group).prop("checked", false);
    $box.prop("checked", true);
  } else {
    $box.prop("checked", false);
  }
});
});

});
</script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script type="text/javascript">
var originalCountryList=[];
$(document).ready(function(){

  originalCountryList = <?php echo $countryListflag; ?>;

  // $('html, body').animate({
  //           scrollTop: $(".main-container").offset().top
  // }, 1000);
 $("#moredata").click(function(){
  var offset=document.getElementById("offset").value;
  var offsetVal=parseInt(offset)+10;
  loadmore(offsetVal);
 });
  $('#morefilter').click(function(){
    $('.modal-backdrop').hide();
    $('#myModal').hide();
    $("#datacollect").empty();
    $("#offset").val(0);
    $('#recordCount').val(0);
    $(".page-template.page-template-searchlisttemplate").removeClass("modal-open");

    jQuery('input[name=courseuniverse]').val('');
    callapirecords(false,true,false);
    
    $('html, body').animate({
       scrollTop: $(".main-container").offset().top
    }, 50);
  })
   //Preffered intake
    jQuery(".exp_center").click(function () {
        jQuery('.exp_center_show').toggle();
    });
    jQuery(".exp_center_show ul li").click(function () {
        var expCenter = $(this).text();
        jQuery(".exp_center").text(expCenter);

        if(expCenter != "Choose Year"){
          jQuery('.exp_center').addClass('value-selected');
          jQuery('input[name=intake]').val($.trim(expCenter)); // assign value to hidden input
        }
        else{
          jQuery('.exp_center').removeClass('value-selected');
          jQuery('input[name=intake]').val('');
        }

        jQuery('.exp_center_show').hide();
        $('.exp_center_show ul li').find('img').attr('style', 'display:none');
        $(this).find('img').attr('style', 'display:inline-block');
    });
     jQuery(document).on("click", function (e) {
        if ($(e.target).is(".exp_center_show, .exp_center") === false) {
            jQuery(".exp_center_show").hide();
        }
    });
  $('#topsearch').click(function(){
    $('.modal-backdrop').hide();
    $('#myModal').hide();
    $("#datacollect").empty();
    $("#offset").val(0);
    $('#recordCount').val(0);
    $(".page-template.page-template-searchlisttemplate").removeClass("modal-open");
    callapirecords(true,false,false);
    $('html, body').animate({
       scrollTop: $(".main-container").offset().top
    }, 50);
  });
  $('#sorting-search').click(function(){
    $('#myModalsort').hide();
    $('.modal-backdrop').hide();
    $(".page-template.page-template-searchlisttemplate").removeClass("modal-open");
    $("#datacollect").empty();
    $("#offset").val(0);
    $('#recordCount').val(0);
    callapirecords(false,false,true);
    $('html, body').animate({
       scrollTop: $(".main-container").offset().top
    }, 50);
  });
 $('.mutlidropdown').select2();
  $(".more-show").click(function(){
    $("#filter").css("display", "block");
    $("#topsearch").hide();
    $("#filters").hide();
 });
 
   $(".durationOfCourse").on('click', function() {
    $(".durationOfCoursePostGraduate").each(function (params) {
          var $box = $(this);
          $box.prop("checked", false);
    })
  });
  $(".durationOfCoursePostGraduate").on('click', function() {
    $(".durationOfCourse").each(function (params) {
          var $box = $(this);
          $box.prop("checked", false);
    })
  });

  $('#page_records_loader').css('display','block');
  $('#pagination-no-result-div').css('display','none');  
  var settings = {
    url: '<?php echo plugins_url('searchtool');?>/fetch.php',  //"/wp-content/themes/tcglobal/includes/search_filter_api.php",
    type: "POST",
    data:{page_type:'first_level_filter'}
  }
  $.ajax(settings).done(function (response) {
    $('#page_records_loader').css('display','none');
    if(response){
      var appendarea="";
      var appendtype="";
      var appendlevel=""; 
      
      var responseData = JSON.parse(response);
      var response = responseData.result;
      var arealeveltype=(response);
      if(arealeveltype){
        for (var i = 0; i < arealeveltype.prog_level.length; i++) {
          appendlevel += "<option value = '" + arealeveltype.prog_level[i] + "'>" + arealeveltype.prog_level[i] + "</option>";
        }
        for (var i = 0; i < arealeveltype.area_of_study.length; i++) {
          appendarea += "<option value = '" + arealeveltype.area_of_study[i] + "'>" + arealeveltype.area_of_study[i] + "</option>";
        }
        for (var i = 0; i < arealeveltype.prog_type.length; i++) {
          appendtype += "<option value = '" + arealeveltype.prog_type[i] + "'>" + arealeveltype.prog_type[i] + "</option>";
        }
        
      }
      
      $("#studyLevel").append(appendlevel);
      $("#areaOfStudy").append( appendarea);
      $("#specialization").append(appendtype);
      
    }

    

  });  

  var fetuniverseVal= document.getElementById("courseuniverse").value;
    if(fetuniverseVal){
      callapirecords(false,true,false);
    }
    else{
      callapirecords(false,false,false);
    }

    setTimeout(function() {
      calluniversityrecords();
    }, 2500);
  
  $('.page-item ').hide();
});

function getCountryFlag(countryName){
    var countryFlag= originalCountryList.filter(x => x.country == countryName).map(x => x.flag);
    if(countryFlag){
      return countryFlag[0];
    }else{
      return null;
    }
}


function getfirstlevelrecords(){

  var originalCountryList=[];

  var settings = {
    url: '<?php echo plugins_url('searchtool');?>/fetch.php',  //"/wp-content/themes/tcglobal/includes/search_filter_api.php",
    type: "POST",
    data:{page_type:'first_level_filter'}
  }

  $.ajax(settings).done(function (response) {
     $('#page_records_loader').css('display','none');
    if(response){
      var appendarea="";
      var appendtype="";
      var appendlevel="";
      var appendCountry="";
      var responseData = JSON.parse(response);
      var response = responseData.result;
      var arealeveltype=(response);
      if(arealeveltype){
        for (var i = 0; i <  arealeveltype.prog_level.length; i++) {
          appendlevel += "<option value = '" +   arealeveltype.prog_level[i] + " '>" +   arealeveltype.prog_level[i] + " </option>";
        }
      }
      
      $("#studyLevel").append(appendlevel);
      originalCountryList=(responseData.countryList);
      for (var i = 0; i <  responseData.countryList.length; i++) {
        appendCountry += "<option value = '" +    responseData.countryList[i].country + " '>" +    responseData.countryList[i].country + " </option>";
      }
      $("#country").append(appendCountry);
    }
    callapirecords();
  });

}

function universeChange(){
  calluniversityrecords();
}

function calluniversityrecords(){

  $('#second_level_filter_loader').css('display','block');
  $('#university').prop('disabled', true);

  var  country_value=$("#country").select2("val");
  country_value=country_value ?country_value.toString():'';
  var  study_value=$("#studyLevel").select2("val");
  study_value=study_value?study_value.toString():'';
  var area_value=$("#areaOfStudy").select2("val");
  area_value=area_value?area_value.toString():'';
  var  course_value=$("#specialization").select2("val");
  course_value=course_value ?course_value.toString():'';

  var reqdata = {page_type:'university_filter',country_name:country_value,prog_level:study_value,area_of_study:area_value,prog_name:course_value};

  var settinguniverse = {
      url:'<?php echo plugins_url('searchtool');?>/fetch.php', 
      type: "POST",
          data:reqdata
     }

  $.ajax(settinguniverse).done(function (response) {
     
    var appenddata="";

    if(response){

        var resultData = JSON.parse(response);
        var universeData = resultData.result;
        $("#university").empty();

        for (var i = 0; i < universeData.universities.length; i++) {
          var universityList = $.trim(universeData.universities[i].university);
          appenddata += "<option value = '"+universityList+"'>" + universityList + "</option>";
        }

        $("#university").append(appenddata);

        var getuniverseVal= document.getElementById("courseuniverse").value;
        if(getuniverseVal){
          var  univdata = getuniverseVal;
        }
        else{
          var  univdata=$("#university").select2("val");
          univdata=univdata?univdata.toString():'';
        }
        
        $("#university option[value='"+ getuniverseVal +"']").attr("selected","selected");
        $("#university").val(univdata).trigger('change');

        $('#second_level_filter_loader').css('display','none');
        $('#university').prop('disabled', false);
    }
  });
}

/** reset specialization values onchage of AOS - start **/
function aofChange(){

  $('#protype_loader').css('display','block');
  $('#specialization').prop('disabled', true);
  var  aofVal=$("#areaOfStudy").select2("val");
  aofVal=aofVal?aofVal.toString():'';
  
  $.ajax({
  type: 'post',
  url:  '<?php echo plugins_url('searchtool');?>/fetch.php',
    data: {
      area_of_study:aofVal,
      page_type:'specialization_filter'
  },
  success: function (result) {

    var appendtype="";
    $("#specialization").empty();
    var responseData = JSON.parse(result);
    var response = responseData.result;
    var arealeveltype=(response);

      if(arealeveltype){
          for (var i = 0; i <  arealeveltype.prog_type.length; i++) {
            appendtype += "<option value = '" + arealeveltype.prog_type[i] + "'>" + arealeveltype.prog_type[i] + "</option>";
          }
      }

      $("#specialization").append(appendtype);

      $('#protype_loader').css('display','none');
      $('#specialization').prop('disabled', false);

      calluniversityrecords();
    }
  })
}
/** end **/


function OnSelectionChange(){
  var  countryVal=$("#country").select2("val");
   countryVal=countryVal;
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

/*var postdata = {page_type:'searchresult',sortBy:'',offset:0,limit:10,country_name:'',university_name:'',showlist:'',area_Of_Study:'',specialization:'',studyLevel:'',prog_campus:'',month:'',intake:'',acceptedlanguage:'',acceptedexams:'',mode_of_study:'',universityorientation:'',feesRange:50000,feesRangemin:0,durationOfCourse:''}  */

var postdata = {page_type:'searchresult',sortBy:'',offset:0,limit:10,country_name:'',university_name:'',showlist:'',area_Of_Study:'',specialization:'',studyLevel:'',prog_campus:'',month:'',intake:'',acceptedlanguage:'',acceptedexams:'',mode_of_study:'',universityorientation:'',feesRange:'',feesRangemin:'',durationOfCourse:''}  

function  callapirecords(filterOne,filterTwo,sort){

  var offsetVal= document.getElementById("offset").value;
  var val = document.getElementById("result_no").value;

if(filterOne || filterTwo){

  var  countryVal=$("#country").select2("val");
  countryVal=countryVal ?countryVal.toString():'';
  var areaVal=$("#areaOfStudy").select2("val");
  areaVal=areaVal?areaVal.toString():'';
  var  specializval=$("#specialization").select2("val");
  specializval=specializval ?specializval.toString():'';
  var  studyVal=$("#studyLevel").select2("val");
  studyVal=studyVal?studyVal.toString():'';

  postdata.country_name =countryVal;
  postdata.area_Of_Study =areaVal;
  postdata.specialization =specializval;
  postdata.studyLevel =studyVal;

 } 

if(filterTwo){

    var getuniverseVal= document.getElementById("courseuniverse").value;
    if(getuniverseVal){
      univVal = getuniverseVal;
    }
    else{
      var univVal =$("#university").select2("val");
      //univVal=univVal?univVal.toString():'';
      univVal=univVal?univVal:'';
    }

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
    var modeofstudyVal =$("#mode_of_study").select2("val");
    modeofstudyVal= modeofstudyVal? modeofstudyVal.toString():'';
    var universityorientVal =$("#universityorientation").select2("val");
    universityorientVal= universityorientVal? universityorientVal.toString():'';
    var postval =$("input[name='customCheck6[]']").value;
    var feesRangemax =  $("#feesrangeselecteMax").val();
    var feesRangemin =  $("#feesrangeselectedMin").val();
    var showlistVal = ''
    $(".showcheck:checked").each(function() {
      showlistVal=$(this).val();
    });

    if ($("#multiselectcheck1").is(":checked")){
    var acceptedlangtestVal="";
   }
   if ($("#multiselectcheck2").is(":checked")){
    var acceptedexamVal="";
   }
 
    var durationOfCourse ='';
    $(".durationOfCourse:checked").each(function() {
      durationOfCourse+=($(this).val())+',';
    });
    durationOfCourse=durationOfCourse.replace(/,\s*$/, "");

    var durationOfCoursePostGraduate ='';
    $(".durationOfCoursePostGraduate:checked").each(function() {
      durationOfCoursePostGraduate+=($(this).val())+',';
    });
    durationOfCoursePostGraduate=durationOfCoursePostGraduate.replace(/,\s*$/, "");

    postdata.university_name =univVal;
    postdata.showlist =showlistVal;
    postdata.prog_campus =cityVal;
    postdata.month =monthVal;
    postdata.intake =yearVal;
    postdata.acceptedlanguage =acceptedlangtestVal;
    postdata.acceptedexams =acceptedexamVal;
    postdata.mode_of_study =modeofstudyVal;
    postdata.universityorientation =universityorientVal;
    postdata.feesRange =feesRangemax;
    postdata.feesRangemin =feesRangemin;
    postdata.durationOfCourse =durationOfCourse;
    postdata.durationOfCoursePostGraduate =durationOfCoursePostGraduate;

 } 

  if(sort){

      var sortbyVal  = '';
      $(".sortcheck:checked").each(function() {
        sortbyVal=$(this).val();
      });
      postdata.sortBy =sortbyVal;
  }

  var offsetData = {offset: parseInt(offsetVal)}; // update offset value
  $.extend( postdata, offsetData );
  ourdata = postdata;

  $('.modal-backdrop').hide();
  $('#myModal').hide();
  $(".page-template.page-template-searchlisttemplate").removeClass("modal-open");
  //var ourdata = {page_type:'searchresult',sortBy:sortbyVal,offset:parseInt(offsetVal),limit:parseInt(val),country_name:countryVal,university_name:univVal,showlist:showlistVal,area_Of_Study:areaVal,specialization:specializval,studyLevel:studyVal,prog_campus:cityVal,month:monthVal,intake:yearVal,acceptedlanguage:acceptedlangtestVal,acceptedexams:acceptedexamVal,mode_of_study:modeofstudyVal,universityorientation:universityorientVal,feesRange:feesRangemax,feesRangemin:feesRangemin,durationOfCourse:durationOfCourse,durationOfCoursePostGraduate:durationOfCoursePostGraduate};
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
    var box=''; 

    var totalRecords=content && parseInt(content.totalRecords)>0?parseInt(content.totalRecords):0; 
    if(totalRecords > 0 && content){
    for (var i=0; i<content.searchList.length; i++) {
      $('#totalRecords').val(content.totalRecords);
          var res= content.searchList[i];
          var countryFlag=getCountryFlag(res.country);
          var flagHtml=countryFlag?'<img src="<?php echo plugins_url('searchtool') ?>/flags/'+countryFlag+'" alt="flag" >':'';
       
         /*var currencyAmount=  res.prog_fees_value?'<span class="amount"><span class="value">'+(res.prog_fees_value).toFixed()+'</span>'+'<span class="type">'+res.prog_fees_currency+'</span>':'';*/
         var currencyAmount = '';
         if(res.prog_fees_value_usd){
         var currencyAmount=  res.prog_fees_value_usd?'<span class="amount"><span class="value">'+(res.prog_fees_value_usd)+'</span>'+'<span class="type">USD</span>':'';
         }
         else if(res.prog_fees_value_bv && (!res.prog_fees_value_usd)){
           var currencyAmount=  res.prog_fees_value_bv?'<span class="amount"><span class="value">'+(res.prog_fees_value_bv)+'</span>'+'<span class="type">'+res.prog_fees_currency_bv+'</span>':'';
         }

         var universeRanking = '';
        if(res.qs_world_ranking && res.qs_world_ranking != "0" && res.qs_world_ranking != "-"){

          var rankVal = '';
          var rankData = res.qs_world_ranking;
          var rankarr = rankData.split("-");

          if(rankarr[0] && rankarr[1]){
              rankVal = rankarr[0]+"+";
          }
          else{
            rankVal = res.qs_world_ranking;
          }

         universeRanking ='<div class="tag-count"><span class="value">'+rankVal+'</span></div><div class="popover fade show bs-popover-left"><div class="arrow" style="top: 16px;"></div><div class="popover-body"> World University Rank </div></div>';
        }    

         var url='/coursedetail?prog_id='+res.prog_id+'&prog_name='+res.prog_name_bv+'&university_name='+res.university+'&country_name='+res.country;
          var url= encodeURI(url);
        
            box+= '<div class="searchlist-box"><div class="row"><div class="col-sm-12 thumbnail"><a target="_blank" href="'+url+'"><img src="<?php echo bloginfo('template_url') ?>/images/img-world-citizenship.jpg" alt="search-list-img"class="img-fluid"> </a><span class="name type1">course</span><div class="searchlist-fav"><a >'+'<img src="<?php echo bloginfo('template_url') ?>/images/searchlist-fav.png" alt="fav.png" style="display:none"></a></div></div><div class="col-sm-12 px-20"><div class="col-sm-12"><div class="row"><div class="col-9">'+currencyAmount+'</div><div class="col-3 p-0">'+universeRanking+'</div><div class="col-sm-12"><p class="date">Start Date: <span>'+res.prog_start_date_bv+'</span></p></div></div><h3>'+flagHtml+'<span>'+res.university+'</span></h3><h2>' +res.prog_name_bv+'</h2><div class="row"><div class="col-sm-12"><a href="'+url+'" target="_blank" title="' +res.prog_name_bv+'"><button type="button" class="btn btn-block btn-danger">Learn more</button></a></div><div class="col-sm-12"><button type="button" class="btn btn-block btn-outline-danger expressbtn allformtrigger" data-toggle="modal" data-target="#expressModal" >express your interest</button></div></div></div></div></div></div>'
                //  popular courses
  }
  $("#datacollect").append(box);
  $('#pagination-no-result-div').css('display','none');  
}else{
  $("#datacollect").empty();
  $('#pagination-no-result-div').css('display','block');  
}
 
  var recordCount=$('#recordCount').val();
  
  recordCount=content && content.searchList? parseInt(recordCount)+parseInt(content.searchList.length):0;
  $('#recordCount').val(recordCount);
  if(!content){
    $("#moredata").css('display','none');
  }
  if (content && (recordCount>= content.totalRecords) ){
    $("#moredata").css('display','none');
  }
  
 
  });
  // We increase the value by 2 because we limit the results by 2
}
function loadmore(offsetVal)
{
  $('#offset').val(offsetVal);
  callapirecords(false,false,false);
}


jQuery(document).ready(function() {

    jQuery(".expressbtn").click(function() {
        jQuery('.helpchat').hide();
    });
    
  jQuery(".close").click(function() {
        jQuery('.helpchat').show();
    });

  });
  
</script>
<script>
   $(function () {
        $("#multiselectcheck1").click(function () {
        if ($("#multiselectcheck1").is(":checked")) {
               $("#lang").hide();
                $("#acceptedTest").next('span').hide();
            } else {
               $("#lang").show();
                $("#acceptedTest").next('span').show();
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

  <script src="/form/express_form.js"></script>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.3/jquery.min.js"></script>
  
<?php get_footer(); ?>


<div class="search-filter-buttons global-space">
    
    <div class="row">
      <div class="col-6 text-center pt-2">
        <a href="" class="more-link allformtrigger" id="finalsorting" data-toggle="modal"
          data-target="#myModalsort">sorting</a>
      </div>
      <div class="col-6 pl-0">
         <button type="button" id ="finalfilter" class="btn btn-theme allformtrigger" data-toggle="modal"
          data-target="#myModal">show filters</button>
      </div>
    </div>
    
  </div>

  
 