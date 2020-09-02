<?php /* Template Name: searchlisttemplate */
get_header();

global $wpdb;

include($_SERVER['DOCUMENT_ROOT'].'/form/filter_api.php');
$seeuniversity = $_REQUEST['university'];

?>
<style>
.search-tool-menu {color: #da1f3d !important;}
</style>

<section class="desktop-mainsection">
  <form id="searchForm" action="/search-tool" method="GET" onsubmit="return callapirecords()">
    <div class="searchtool-banner">
      <div class="bg-color"> </div>
      <div class="container position-relative">
        <div class="row align-items-center">
          <div class="col">
            <h2 class="main-heading">Search Tool</h2>
          </div>
        </div>
        <input type="hidden" name="offset" value="0" id="offset">
        <input type="hidden" name="limit" value="10">
        <input type="hidden" name="cpage" value="1">
        <input type="hidden" name="totalRecords" id="totalRecords" value="0">
        <input type="hidden" name="feesrangeselectedMin" id="feesrangeselectedMin" value="<?php echo $feerangemin; ?>">
        <input type="hidden" name="feesrangeselecteMax" id="feesrangeselecteMax" value="<?php echo $feerangemax; ?>">
        <input type="hidden" id="previousPage" value="1">
        <input type="hidden" name="firstfilter" id="firstfilter" value="0">
        <input type="hidden" name="secondfilter" id="secondfilter" value="0">

        <input type="hidden" name="courseuniverse" value="<?php echo $seeuniversity; ?>" id="courseuniverse">
        <div class="search-form-fields">
          <div class="row">
            <div class="col-sm-11">
              <div id="protype_loader" style="text-align:right;display:none">
                <?php
                    echo '<img  width="80px" height="40px" src="'. plugins_url()."/searchtool/images/loader.gif".'" alt="Loading..."> ';
                ?></div>
              <div class="row">

                <div class="col">
                  <label>Where?</label>
                  <?php $className='form-control'?>
                  <!-- <select class="form-control mutlidropdown"  data-placeholder="Country" name="country[]" onchange="OnSelectionChange()"
                  multiple="multiple" id="country" value="<?php //echo $params['country']?>" > -->

                  <select class="form-control mutlidropdown"  data-placeholder="Country" name="country[]"
                  multiple="multiple" id="country" value="<?php echo $params['country']?>" >
                  <?php echo $countrydata; ?>
                  </select>
                </div>

                <div class="col">
                  <label>On which study level? </label>
                  <?php $className='form-control'?>
                  <select class="form-control mutlidropdown" data-placeholder="Study level options" name="studyLevel[]"
                  multiple="multiple" id="studyLevel" value="<?php echo $params['studyLevel']?>" >
                    <option value=''>Study level options</option>
                  </select>
                </div>

                <div class="col">
                  <label>What do you want to study?</label>
                  <?php $className='form-control'?>
                  <select class="form-control mutlidropdown" data-placeholder="Area of study"
                  name="areaOfStudy[]" onchange="aofChange()" multiple="multiple" id="areaOfStudy"  >
                    <!--<option value=''>Area of study</option>-->
                  </select>
                </div>

                <div class="col">
                  <label>What specialization?</label>
                  <?php $className='form-control'?>
                  <select class="form-control mutlidropdown"  data-placeholder="Course options" name="specialization[]"
                   multiple="multiple" id="specialization" value="<?php echo $params['specialization']?>" >
                    <!-- <option value=''>Course options</option> -->
                  </select>
                </div>

              </div>
            </div>
            <div class="col-sm-1 text-right pt-4"> <a id="topsearch" class="float-right">
              <?php
                      echo '<img src="'. plugins_url()."/searchtool/images/searchbar-icon.png".'"
                        alt="Search"> ';
                    ?>
              </a> </div>
          </div>
        </div>
      </div>
    </div>
    <!--SEARCH-RESULT-->
    <div class="search-result">
      <div class="container">
        <div class="row">
          <div class="col-sm-12">
            <h2 class="main-heading"><span class="d-block">Your personalized</span>University search results</h2>
            <div class="row">
              <div class="col-sm-3 pr-0">
                <div class="search-filter">
                  <h2>More filters</h2>
                  <span id="second_level_filter_loader" style="display:none"><?php
                      echo '<img  src="'. plugins_url()."/searchtool/images/loader.gif".'"
                        alt="Loading..."> ';
                    ?></span>
                  <h6>Choose university</h6>
                  <?php $className='form-control selectbox m-b-20'?>
                  <select class="form-control selectbox m-b-20 mutlidropdown" name="university[]"
              data-placeholder="Choose University"  multiple="multiple" id="university"  value="" >

                  </select>

                  <!--<h6>Choose city</h6>
                  <?php //$className='form-control selectbox m-b-20'?>
                  <select class="form-control selectbox m-b-20 mutlidropdown " name="city[]"
                     data-placeholder="Choose city" id="city"  multiple="multiple" value="" >
                    <option value=''>Choose City</option>
                  </select>-->

                  <label class="mb-0">Choose preffered intake</label>
                  <div class="row">
                    <div class="col-sm-6">
                      <?php $className='form-control selectbox m-b-20'?>
                      <select class="form-control selectbox m-b-20 mutlidropdown" name="month[]"
                     data-placeholder="months" id="month" multiple="multiple" >

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
                    <div class="col-sm-6">
                      <div class="dropdown select-theme filter-dropdown pl-0">
                      <?php $className='form-control selectbox m-b-20'?>
                     <button style="height: 41px;" class="dropdown-toggle exp_center" type="button">Choose Year</button>
                      <input type="hidden" name="intake" value='' id="intake">
                    <div style="min-width: 100%;" class="dropdown-menu exp_center_show">
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
                  <label class="mb-0">Duration of course</label>
                  <div class="tab">
                    <!-- <ul class="nav nav-tabs" id="myTab" role="tablist">
                      <li class="nav-item"> <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Undergraduate</a> </li>
                      <li class="nav-item"> <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Postgraduate</a> </li>
                    </ul> -->
                    <div class="tab-content" id="myTabContent">
                      <div >
                        <div class="col">
                          <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input durationOfCourse" name="durationOfCourse" id="customCheck6" value="1">
                            <label class="custom-control-label" for="customCheck6">0 - 1 &nbsp year</label>
                          </div>
                        </div>
                        <div class="col">
                          <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input durationOfCourse" name="durationOfCourse" id="customCheck7" value="2">
                            <label class="custom-control-label" for="customCheck7">1 - 2 &nbsp years</label>
                          </div>
                        </div>
                        <div class="col">
                          <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input durationOfCourse" name="durationOfCourse" id="customCheck8" value="3">
                            <label class="custom-control-label" for="customCheck8">2 - 3 &nbsp years</label>
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
                        <div class="col">
                          <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input durationOfCoursePostGraduate" name="durationOfCoursePostGraduate" id="customCheck8" value="5 year">
                            <label class="custom-control-label" for="customCheck8">5 years</label>
                          </div>
                        </div>
                        <div class="col">
                          <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input durationOfCoursePostGraduate"  name="durationOfCoursePostGraduate" id="customCheck9" value="6+ year">
                            <label class="custom-control-label" for="customCheck9">6 +years</label>
                          </div>
                        </div>
                      </div> -->
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-sm-12">
                      <label class="mb-0 mt-0">Language tests not required</label>
                      <div class="custom-control custom-control-inline left-15 custom-checkbox mr-0 pt-2 float-right">
                        <input type="checkbox" class="custom-control-input" id="multiselectcheck1">
                        <label class="custom-control-label" for="multiselectcheck1"></label>
                      </div>
                    </div>
                  </div>
                  <h6 id="lang">Choose language tests </h6>
                  <?php $className='form-control selectbox m-b-20'?>
                  <select class="form-control selectbox m-b-20 mutlidropdown testdropdown" name="acceptedlanguage[]"
                     data-placeholder="Choose languages tests" id="acceptedlanguage"  multiple="multiple" value="<?php echo $params['acceptedlanguage']?>" >

                    <option value='IELTS'>IELTS</option>
                    <option value='PTE'>PTE</option>
                    <option value='TOEFL'>TOEFL</option>
                  </select>

                  <h6>Choose mode of study </h6>
                  <?php $className='form-control selectbox m-b-20'?>
                  <select class="form-control selectbox m-b-20 mutlidropdown " name="mode_of_study[]"
                     data-placeholder="Choose mode of study" id="mode_of_study"  multiple="multiple" value="<?php echo $params['mode_of_study']?>" >

                    <option value='Full Time'>Full Time</option>
                    <option value='Online'>Online</option>
                    <option value='Part Time'>Part Time</option>
                  </select>

                <label class="mb-0">Choose prefered tuition fee</label>
                  <div class="col-sm-12 p-0 m-b-40">
                    <input type="text" class="js-range-slider" name="feesRange" value=""/>
                    </span></span> <span style="display:none" name="range-max" id="range-max-value"><?php echo $tutionFees?></span> </div>
                  <button id="morefilter" type="button" class="btn btn-block">Apply filters</button>
                </div>
              </div>
              <div class="col-sm-9 pl-5">
                <div class="searchlist-topfilter">
                  <div class="row" >
                   <div id="pagination-no-result-div" class="no-record-theme">
          <div class="danger">No Results Found</div>
          </div>

          <div class="col-7 pl-0">
            <div class="row">
              <div id="pagination-result-div" class="col"></div>
              <ul class="paging col px-0"></ul>
            </div>
          </div>
          <div class="col-5">
            <div class="row">
                 <!-- <div class="col-3 pl-0 pr-0 additionalfilters">
                    <ul class="filter-dropdown float-right clearfix">
                      <li>
                        <label>Show:</label>
                      </li>
                      <li>
                        <div class="dropdown pl-0">
                          <input type="hidden" name="showlist" id="showlist" value=""/>
                          <button class="btn btn-secondary dropdown-toggle" type="button"
                            id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false"></button>
                          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <ul>
                              <li class="showcourse" data-myvalue="" data-mydata="All" > <a  class="allview"  id="allselect"> <img  id="allselectimg" style="display:none" src="<?php echo bloginfo('template_url') ?>/images/drop-tick.jpg" alt="" /> All </a> </li>

                            </ul>
                          </div>
                        </div>
                      </li>
                    </ul>
                </div> -->

                <div class="col-12 pl-0 additionalfilters">
                      <ul class="filter-dropdown float-right clearfix">
                        <li>
                          <label>Sort by:</label>
                        </li>
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
                          </div>
                        </li>
                      </ul>
                    </div>
              </div>
          </div>
                  </div>
                </div>
                <span id="page_records_loader" style="display:none"><?php
                      echo '<img  src="'. plugins_url()."/searchtool/images/loding.gif".'"
                        style="width:60px !important;" alt="Loading..."> ';
                    ?></span>
                <div id="datacollect"> </div>
                <input type="hidden" id="result_no" value="10">
                <div class="searchlist-topfilter mt-5">
                  <div class="row">
                    <div id="pagination-result-div-bootom" class="col-sm-5"></div>
                    <ul class="paging col-sm-3">
                    </ul>
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
    <div class="popular-course" style="display:none">
      <div class="text-center">
        <div class="boldheading "> Popular Courses </div>
        <div class="path"></div>
      </div>
      <div class="container">
        <div class="row">
         <h4 class="no-record-theme">No Records Found</h4>
        </div>
      </div>
    </div>
    <!--POPULAR-COURSE-->

        <!-- form bottom section -->
    <!-- end form bottom section -->
  </form>
</section>
<script>
$(".showcourse").click(function(event){
     var showed  =   $(this).data('myvalue');
     $('#showlist').val(showed);
     showed=showed?showed:'All';
     $('#dropdownMenuButton').text(showed);
     if(showed==='Courses'){
      $("#courseselect").addClass( "active" );
      $( "#allselectimg" ).attr('style','display:none!important');
      $("#courseselectimg").css( "display",'block' );
     }else{
      $( "#allselect" ).addClass( "active" );
      $("#courseselectimg").attr('style','display:none!important');
      $( "#allselectimg" ).css( "display",'block' );
     }
     callapirecords();
});
</script>

<script>
$(document).ready(function() {
  $('.mutlidropdown').select2();

  var sortingList=["Application deadline","Ranking","Most Popular","Lowest Price", "Highest Price"];
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
      if(showed=='Application deadline'){
        $(this).find('a').addClass( "active" );
        $(this).find('img').css( "display",'block' );
        $('#dropdownMenuButtonsort').text(showed);
      }
  });
  $(".showrank").click(function(event){
     var showed  =   $(this).data('myvalue');
     $('#sortBy').val(showed);
     showed=showed?showed:'Application deadline';
     $('.sorting-ref').removeClass('active');
     $('.sorting-img').attr('style','display:none!important');
     $('#dropdownMenuButtonsort').text(showed);
     if(showed){
      $(this).find('a').addClass( "active" );
      $(this).find('img').css( "display",'block' );
     }

     callapirecords(false,false,false,true);
  });
  $(".showcourse").each(function(event){
    var showed  =   $(this).data('mydata');
    if(showed=='All'){
      $( "#allselect" ).addClass( "active" );
      $("#courseselectimg").attr('style','display:none!important');
      $( "#allselectimg" ).css( "display",'block' );
      $('#dropdownMenuButton').text(showed);
    }
  });
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
 });
</script>
<script>
 var originalCountryList=[];
$(document).ready(function() {

  originalCountryList = <?php echo $countryListflag; ?>;

  $('#page_records_loader').css('display','block');
  $('.additionalfilters').css('display','none');
  $('#pagination-no-result-div').css('display','none');
  // $('html, body').animate({
  //           scrollTop: $(".search-form-fields").offset().top
  // }, 50);

  //$('#second_level_filter_loader').css('display','block');
  $('#university').prop('disabled', true);

  callfilterrecords();

  $('.page-item ').hide();

  $('#topsearch').click(function(){

    jQuery('input[name=firstfilter]').val(1);
    jQuery('input[name=secondfilter]').val(0);

    calluniversityrecords();
    callapirecords(false,true,false,false);
  });
  $('#morefilter').click(function(){

    jQuery('input[name=courseuniverse]').val('');
    jQuery('input[name=secondfilter]').val(1);
    var valOne = jQuery('input[name=firstfilter]').val();
    var valTwo = jQuery('input[name=secondfilter]').val();

    $('html, body').animate({
       scrollTop: $(".search-form-fields").offset().top
    }, 50);
    callapirecords(false,false,true,false);
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



 });

/** reset country and study list onchage of AOS - start **/
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
          appendlevel += "<option value = '" + arealeveltype.prog_level[i] + "'>" + arealeveltype.prog_level[i] + "</option>";
        }
      }

      $("#studyLevel").append(appendlevel);
      originalCountryList=(responseData.countryList);
      for (var i = 0; i <  responseData.countryList.length; i++) {
        appendCountry += "<option value = '" + responseData.countryList[i].country + "'>" + responseData.countryList[i].country + "</option>";
      }
      $("#country").append(appendCountry);
    }
    callapirecords();
  });

}

/** end **/

/** filter data - start **/
function callfilterrecords(){

  var settings = {
    url: '<?php echo plugins_url('searchtool');?>/fetch.php',
    type: "POST",
    data:{page_type:'first_level_filter'}
  }
  $.ajax(settings).done(function (response) {
     $('#page_records_loader').css('display','none');

     $('#second_level_filter_loader').css('display','none');
     $('#university').prop('disabled', false);

     //console.log(response);

    if(response){
      var appendarea="";
      var appendtype="";
      var appendlevel="";

      var responseData = JSON.parse(response);
      var response = responseData.result;
      var arealeveltype=(response);

      if(arealeveltype){

          for (var i = 0; i <  arealeveltype.prog_level.length; i++) {
            appendlevel += "<option value = '" + arealeveltype.prog_level[i] +"'>"+arealeveltype.prog_level[i] + "</option>";
          }

          for (var i = 0; i <  arealeveltype.area_of_study.length; i++) {
            appendarea += "<option value = '"+arealeveltype.area_of_study[i]+"'>"+arealeveltype.area_of_study[i]+"</option>";
          }

          for (var i = 0; i <  arealeveltype.prog_type.length; i++) {
            appendtype += "<option value = '" + arealeveltype.prog_type[i] + " '>"+arealeveltype.prog_type[i]+"</option>";
          }
      }

      $("#studyLevel").append(appendlevel);
      $("#areaOfStudy").append( appendarea);
      $("#specialization").append(appendtype);


    }


  });



    var fetuniverseVal= document.getElementById("courseuniverse").value;
    if(fetuniverseVal){
        callapirecords(false,false,true,false);
    }
    else{
        callapirecords(false,false,false,false);
    }

    // load university api after list render
    
    setTimeout(function() {
      calluniversityrecords();
    }, 2500);


}
/** end **/

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
function getCountryFlag(countryName){
    var countryFlag= originalCountryList.filter(x => x.country == countryName).map(x => x.flag);
    if(countryFlag){
      return countryFlag[0];
    }else{
      return null;
    }
}


/*var postdata = {page_type:'searchresult',sortBy:'',offset:0,limit:10,country_name:'',university_name:'',showlist:'',area_Of_Study:'',specialization:'',studyLevel:'',prog_campus:'',month:'',intake:'',acceptedlanguage:'',acceptedexams:'',mode_of_study:'',universityorientation:'',feesRange:50000,feesRangemin:0,durationOfCourse:''}*/

var postdata = {page_type:'searchresult',sortBy:'',offset:0,limit:10,country_name:'',university_name:'',showlist:'',area_Of_Study:'',specialization:'',studyLevel:'',prog_campus:'',month:'',intake:'',acceptedlanguage:'',acceptedexams:'',mode_of_study:'',universityorientation:'',feesRange:'',feesRangemin:'',durationOfCourse:''}

function  callapirecords(isPaginationCliked=false, filterOne, filterTwo,sort){

  if(!isPaginationCliked ){
    $('#offset').val(0);
    $('.paging').twbsPagination('destroy');
    $('#previousPage').val(1);
  }


  var offsetVal= document.getElementById("offset").value;
  var val = document.getElementById("result_no").value;

if(!isPaginationCliked)
{

  if(filterOne){
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

    jQuery('#dropdownMenuButtonsort').text('Application deadline');
    jQuery('input[name=sortBy]').val('');
    jQuery('.sorting-ref').removeClass('active');
    jQuery('.sorting-img').attr('style','display:none!important');

    jQuery(".showrank a").first().addClass("active");
    jQuery('.sorting-img').first().attr('style','display:inline-block!important');

    $('#university').val(null).trigger('change');
    $('#month').val(null).trigger('change');
    $('#acceptedlanguage').val(null).trigger('change');
    $('#mode_of_study').val(null).trigger('change');

    jQuery('.exp_center').removeClass('value-selected');
    jQuery(".exp_center").text('Choose Year');
    jQuery('input[name=intake]').val('');

    jQuery('.exp_center_show ul li a img').attr('style','display:none!important');
    jQuery('#customCheck6').prop('checked', false);
    jQuery('#customCheck7').prop('checked', false);
    jQuery('#customCheck8').prop('checked', false);
    jQuery('#customCheck9').prop('checked', false);

    var $minVal = "<?php echo $feerangemin; ?>";
    var $maxVal = "<?php echo $feerangemax; ?>";

    $('input[name=feesrangeselectedMin]').val($minVal);
    $('input[name=feesrangeselecteMax]').val($maxVal);

    var  my_range = $(".js-range-slider").data("ionRangeSlider");
    my_range.reset();

    postdata.sortBy ='';
    postdata.university_name = '';
    postdata.showlist ='';
    postdata.prog_campus ='';
    postdata.month ='';
    postdata.intake ='';
    postdata.acceptedlanguage ='';
    postdata.acceptedexams ='';
    postdata.mode_of_study ='';
    postdata.universityorientation ='';
    /*postdata.feesRange = maxfee;
    postdata.feesRangemin = minfee;*/

    postdata.feesRange = '';
    postdata.feesRangemin = '';

    postdata.durationOfCourse ='';
    postdata.durationOfCoursePostGraduate ='';

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

        if ($("#multiselectcheck1").is(":checked")){
          var acceptedlangtestVal="";
         }
         if ($("#multiselectcheck2").is(":checked")){
          var acceptedexamVal="";
         }

        var feesRangemax =  $("#feesrangeselecteMax").val();
        var feesRangemin =  $("#feesrangeselectedMin").val();
        var showlistVal= $("#showlist").val();

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
        var sortbyVal =  $("#sortBy").val();
        postdata.sortBy =sortbyVal;
    }

}

$('.page-item ').hide();

  var offsetData = {offset: parseInt(offsetVal)};
  $.extend( postdata, offsetData );
  ourdata = postdata;
  var settingsProg = {
  url:'<?php echo plugins_url('searchtool');?>/fetch.php', //"/wp-content/themes/tcglobal/includes/search_api.php",
  type: "POST",
      data:ourdata
  }     
  $('#page_records_loader').css('display','block');
  $.ajax(settingsProg).done(function (response) {
  $('#page_records_loader').css('display','none');

    var response = JSON.parse(response);
    var content = response.result;

    var box='';
    var totalRecords=content && parseInt(content.totalRecords)>0?parseInt(content.totalRecords):0;
    var totalPages=Math.ceil(totalRecords/10);
    if(totalRecords > 0 &&  content){
    $('#totalRecords').val(content.totalRecords);
      for (var i=0; i<content.searchList.length; i++) {
        var res= content.searchList[i];

        var countryFlag=getCountryFlag(res.country);
        var flagHtml=countryFlag?'<img src="<?php echo plugins_url('searchtool') ?>/flags/'+countryFlag+'" alt="flag" >':'';
        var currencyAmount = '';

        if(res.prog_fees_value_usd) {
           currencyAmount= res.prog_fees_value_usd?'<span class="amount"><span class="value">'+(res.prog_fees_value_usd)+'</span><span class="type">USD</span>':'';
        }
        else if(res.prog_fees_value_bv && (!res.prog_fees_value_usd))
        {
           currencyAmount= res.prog_fees_value_bv?'<span class="amount"><span class="value">'+(res.prog_fees_value_bv)+'</span><span class="type">'+res.prog_fees_currency_bv+'</span>':'';
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

            universeRanking ='<div class="tag-count"><span class="value">'+rankVal+'</span></div><div class="popover fade show bs-popover-left"><div class="arrow" style="top: 16px;"></div><div class="popover-body">World University Rank</div></div>';
        }

        var url='/coursedetail?prog_id='+res.prog_id+'&prog_name='+res.prog_name_bv+'&university_name='+res.university+'&country_name='+res.country;
        var url= encodeURI(url);
        box+= '<div class="searchlist-box"><div class="row"><div class="col-sm-4 thumbnail pr-0"><a target="_blank" href="'+url+'"><img src="<?php echo bloginfo('template_url') ?>/images/img-world-citizenship.jpg" alt="search-list-img"class="img-fluid" width="1000" height="1000" > </a><span class="name type1">course</span>'+currencyAmount+'</div><div class="col-sm-8 pl-0"><div class="col-sm-12"><div class="col-sm-12"><div class="row"><div class="col-sm-9"><p class="date">Start Date: <span>'+res.prog_start_date_bv+'</span></p></div><div class="col-sm-2 pr-0 text-center pt-2 mt-1">'+universeRanking+'</div><div class="col-sm-1 text-right p-0 pt-2 mt-1"><a ><img src="<?php echo bloginfo('template_url') ?>/images/search-favfill.png" alt="fav" style="display:none"> </a></div></div><h3>'+flagHtml+res.university+'</h3><h3><div class="bg-icons bg-16 bg-user_icon_search ml-0 mr-3"></div><span>Public</span><span class="name">University</span></h3><a href="'+url+'"><h2>' +res.prog_name_bv+ '</h2></a><div class="row"><div class="col-sm-6"><a href="'+url+'" target="_blank" title="' +res.prog_name_bv+'"><button type="button" class="btn btn-block btn-danger">Learn more</button></a></div><div class="col-sm-6"><button type="button" class="btn btn-block btn-outline-danger expressbtn" data-toggle="modal" data-target="#expressModal">express your interest</button></div></div></div></div></div></a></div></div></div>'
    //  popular courses
    }
  }
 $("#datacollect").empty().append(box);
  //console.log('totalRecords',totalRecords)
  //console.log('totalPages',totalPages)
  if(totalPages>1){
    recordsget(totalPages);
  }

  if(totalRecords>0){
      $('#pagination-no-result-div').css('display','none');
      $('.additionalfilters').css('display','block');
      paginationResult(content.searchList.length);
    }else{
      $('#pagination-no-result-div').css('display','block');
      $('.additionalfilters').css('display','none');
      $('#pagination-result-div').html('');
      $('#pagination-result-div-bootom').html('');
    }

  
   $('.page-item ').hide();
  });

   return false;
  // We increase the value by 2 because we limit the results by 2
}


 function paginationResult(countOfRecord){

  var prevVal=$('#previousPage').val();
  var recordCount=prevVal>1? (((prevVal-1)*10)+countOfRecord) :countOfRecord;
  var totalRecords=$('#totalRecords').val();
  var pageUrl='';
  var pagination='<p>Showing <span>'+recordCount+' of  '+totalRecords +' </span>records found</p>';
  var paginationLinkDiv='<nav aria-label="Page navigation example">'+
              '<ul class="pagination">'+
      pageUrl+"</ul> </nav>";
      $('#pagination-result-div').html(pagination);
      $('#pagination-result-div-bootom').html(pagination);
  }
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
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
// Text labels

prev: '<img src="<?php echo bloginfo('template_url') ?>/images/pagination-left.png" alt="flag"></a>',
next: '<img src="<?php echo bloginfo('template_url') ?>/images/pagination-right.png" alt="flag"></a>',

// carousel-style pagination
loop: false,
// callback function
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


  callapirecords(true,false,false,false);

  $('.page-active').removeClass('active');
  $('#page'+page).addClass('active');

},
// pagination Classes
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
<script src="/form/express_form.js"></script>

<?php
/**  Get Shortcode content from editor  **/

    while ( have_posts() ) : the_post();
    the_content(); // get post content
    endwhile;
?>
<?php get_footer(); ?>