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
         <input type="hidden" name="feesrangeselectedMin" id="feesrangeselectedMin" value="<?php echo $feerangemin; ?>">
        <input type="hidden" name="feesrangeselecteMax" id="feesrangeselecteMax" value="<?php echo $feerangemax; ?>">
        <input type="hidden" name="courseuniverse" value="<?php echo $seeuniversity; ?>" id="courseuniverse">
    <!-- modal -->
    <div id="myModal" class="modal fade" role="dialog">
      <div class="modal-dialog searchfilter-modal">
        <div class="modal-content modal-search-filter search-result p-0">
          <a href="" class="close-btn" data-dismiss="modal" >
            <img src="<?php bloginfo('template_url')?>/images/popup-close.png;"/>
          </a>
          <div class="search-form-fields" id="popuphide">
            <div id="protype_loader" style="text-align:center;display:none"><?php
              echo '<img  width="80px" height="40px" src="'. plugins_url()."/searchtool/images/loader.gif".'" alt="Loading..."> ';
            ?></div>
            <div class="row">
              <div class="col-6 m-b-20">
                <label>In</label>
                <select class="form-control mutlidropdown"  data-placeholder="Country" name="country[]"
                  multiple="multiple" onchange="universeChange()" id="country"  value="" >
                  <?php echo $countrydata; ?>
                </select>
              </div>

              <div class="col-6 m-b-20">
                <label>As an</label>
                <?php $className='form-control'?>
                <select class="form-control mutlidropdown"  data-placeholder="Study level options"
                name="studyLevel[]" id="studyLevel" onchange="universeChange()" multiple="multiple" value="" >
                </select>
              </div>

              <div class="col-6 m-b-20">
                  <label>I would like to study</label>
                  <select class="form-control mutlidropdown" data-placeholder="Area of study"
                  name="areaOfStudy[]" onchange="aofChange()" id="areaOfStudy"   multiple="multiple" value="" >
                  </select>
              </div>

              <div class="col-6 m-b-20">
                <label>Specialising in</label>
                <select class="form-control mutlidropdown" data-placeholder="Course options"
                name="specialization[]" id="specialization" onchange="universeChange()" multiple="multiple" value=""  >
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
          <span id="second_level_filter_loader" style="display:none"><?php
                      echo '<img height="50" width="100" src="'. plugins_url()."/searchtool/images/loader.gif".'"
                        alt="Loading..."> ';
                    ?></span>
        </div>
        <div class="col-6 m-b-30">
          <h5>Choose university</h5>
            <select class="form-control selectbox m-b-20 mutlidropdown" name="university[]"
              data-placeholder="Choose University"  multiple="multiple" id="university"  value="" >
            </select>
      </div>
      <div class="col-6 m-b-30">
        <!--<h5>Choose City</h5>
        <select class="form-control selectbox m-b-20 mutlidropdown " name="city[]"
                     data-placeholder="Choose city" id="city"  multiple="multiple" value="" >
                     <option value=''>Choose City</option>
          </select>-->
    </div>
    <div class="col-6">
      <label class="mb-0">Choose preffered intake</label>
      <div class="row">
        <div class="col-sm-6">
        <select class="form-control selectbox m-b-20 mutlidropdown" name="month[]"
          data-placeholder="months" id="month" multiple="multiple" value="" >
          
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
      
      <div class="tab-content" id="myTabContent">
        <div >
          <div class="col">
            <div class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input under durationOfCourse" name="durationOfCourse" id="customCheck6" value="1" >
              <label class="custom-control-label" for="customCheck6">0 - 1 &nbsp year</label>
            </div>
          </div>
          <div class="col">
            <div class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input under durationOfCourse" name="durationOfCourse" id="customCheck7"  value="2">
              <label class="custom-control-label" for="customCheck7">1 - 2 &nbsp years</label>
            </div>
          </div>
          <div class="col">
            <div class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input under durationOfCourse" name="durationOfCourse" id="customCheck8"  value="3">
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
        
      </div>
    </div>
  </div>
  <div class="col-6 p-t-30">
    <h5>Choose mode of study</h5>
    <select class="form-control selectbox m-b-20 mutlidropdown " name="mode_of_study[]"
    data-placeholder="Choose mode of study" id="mode_of_study"  multiple="multiple" value="<?php echo $params['mode of study']?>" >
    
    <option value='Full Time'>Full Time</option>
    <option value='Online'>Online</option>
     <option value='Part Time'>Part Time</option>
   </select>

  <!-- <h5 class="m-t-25">Choose orientation</h5>
  <select class="form-control selectbox m-b-20 mutlidropdown " name="universityorientation[]"
   data-placeholder="Choose university orientation " id="universityorientation"  multiple="multiple" value="<?php echo $params['universityorientation']?>" >  
    <?php echo $university_orientation; ?>
  </select> -->

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
  
  <option value='IELTS'>IELTS</option>
  <option value='PTE'>PTE</option>
  <option value='TOEFL'>TOEFL</option>
 
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
              <h2 class="main-heading main-container">Catalysing the Global Citizens of tomorrow, today</h2>
              <div class="row">
                <div class="col-sm-12">
             
                  <div class="searchlist-topfilter">
                      <div class="row">
                      <div id="pagination-no-result-div" class="col-sm-12">
                      <div class="no-record-theme">No Results Found</div>
                      </div>
                      <div id="pagination-result-div" class="col pr-0"></div>
                      <div class="col"><ul class="paging p-0"></ul></div>

                        <!-- <div class="col pl-0 additionalfilters filter-show">
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
                              </ul>
                              </div>
                            </div></li>
                          </ul>
                        </div> -->

                        <div class="col pl-0 additionalfilters sort-show">
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
<div class="popular-course" style="display:none">
  <h2 class="main-heading">Popular Courses</h2>
  <div class="col-sm-12"><h4 class="no-record-theme">No Records Found </h4></div>
    </div>

<!--POPULAR-COURSE-->
  <?php
  /**  Get Shortcode content from editor  **/
    while ( have_posts() ) : the_post();
      the_content(); // get post content
    endwhile;
  ?>

</section>
    

<script>
$(".showcourse").click(function(event){
     var showed  =   $(this).data('myvalue');
     $('#showlist').val(showed);
     showed=showed?showed:'All';
     $('#dropdownMenuButton').text(showed);
     if(showed==='Courses'){
      $("#courseselect").addClass( "active" );
      $("#allselectimg").attr('style','display:none!important');
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
  $('.page-item ').hide();

    /*$('#country').attr('disabled',true);
    $('#specialization').attr('disabled',true);
    $('#studyLevel').attr('disabled',true);
   $("#areaOfStudy").change(function(){
     var areaVal=$("#areaOfStudy").select2("val");

     $("#studyLevel").empty();
     $("#country").empty();
    getfirstlevelrecords();

    if(areaVal && areaVal.length ){
        $('#country').attr('disabled',false);
        $('#specialization').attr('disabled',false);
        $('#studyLevel').attr('disabled',false);
    }else{
      $('#country').attr('disabled',true);
      $('#specialization').attr('disabled',true);
      $('#studyLevel').attr('disabled',true);
    }
  })*/
  // $('html, body').animate({
  //           scrollTop: $(".main-container").offset().top
  // }, 50);
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
     $('.sorting-img').css('display','none');
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
   $('#topsearch').click(function(){
    callapirecords(false,true,false,false);
    $('html, body').animate({
       scrollTop: $(".main-container").offset().top
    }, 50);
  });
  $('#morefilter').click(function(){
    jQuery('input[name=courseuniverse]').val('');
    callapirecords(false,false,true,false);
    $('html, body').animate({
       scrollTop: $(".main-container").offset().top
    }, 50);
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
var settings = {
    url: '<?php echo plugins_url('searchtool');?>/fetch.php',  
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
        callapirecords(false,false,true,false);
    }
    else{
        callapirecords(false,false,false,false);
    }

    setTimeout(function() {
      calluniversityrecords();
    }, 2500);


 $('.page-item ').hide();
});


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

function  callapirecords(isPaginationCliked=false,filterOne,filterTwo,sort){

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

        }

        if(filterTwo)
        {

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

            /*var showlistVal = ''
            $(".showcheck:checked").each(function() {
              showlistVal=$(this).val();
            });*/

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
            /*postdata.showlist =showlistVal;*/
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

    var offsetData = {offset: parseInt(offsetVal)};
    $.extend( postdata, offsetData );
    ourdata = postdata;
  
  $('.page-item ').hide();
  $('.modal-backdrop').remove();
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
    if(totalRecords > 0){
      $('#totalRecords').val(content.totalRecords);
      for (var i=0; i<content.searchList.length; i++) {
        var res= content.searchList[i];
        var countryFlag=getCountryFlag(res.country);
        var flagHtml=countryFlag?'<img src="<?php echo plugins_url('searchtool') ?>/flags/'+countryFlag+'" alt="flag" >':'';

        /*var currencyAmount= res.prog_fees_value?'<span class="amount"><span class="value">'+(res.prog_fees_value).toFixed()+'</span>'+'<span class="type">'+res.prog_fees_currency+'</span>':'';*/
        var currencyAmount = '';
        if(res.prog_fees_value_usd){
          var currencyAmount= res.prog_fees_value_usd?'<span class="amount"><span class="value">'+(res.prog_fees_value_usd)+'</span><span class="type">USD</span>':'';
        }
        else if(res.prog_fees_value_bv && (!res.prog_fees_value_usd)){        
          var currencyAmount= res.prog_fees_value_bv?'<span class="amount"><span class="value">'+(res.prog_fees_value_bv)+'</span><span class="type">'+res.prog_fees_currency_bv+'</span>':'';
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
            box+= '<div class="searchlist-box"><div class="row"><div class="col-sm-4 thumbnail pr-0"><a target="_blank" href="'+url+'"><img src="<?php echo bloginfo('template_url') ?>/images/img-world-citizenship.png" alt="search-list-img" class="img-fluid"></a><span class="name type1">course</span>'+currencyAmount+'</div><div class="col-sm-8 pl-0"><div class="col-sm-12"><div class="col-sm-12"><div class="row"><div class="col-sm-9"><p class="date">Start Date: <span>'+res.prog_start_date_bv+'</span></p></div><div class="col-sm-2 pr-0 text-center pt-2 mt-1">'+universeRanking+'</div><div class="col-sm-1 text-right p-0 pt-2 mt-1"><a ><img src="<?php echo bloginfo('template_url') ?>/images/search-favfill.png" alt="fav" style="display:none"> </a></div></div><h3>'+flagHtml+'<span>'+res.university+'</span></h3><h2>'+res.prog_name_bv+'</h2><div class="row"><div class="col-sm-6"><a href="'+url+'" target="_blank" title="' +res.prog_name_bv+'"><button type="button" class="btn btn-block btn-danger">Learn more</button></a></div><div class="col-sm-6"><button type="button" class="btn btn-block btn-outline-danger px-0 allformtrigger" data-toggle="modal" data-target="#expressModal">express your interest</button></div></div></div></div></div></div></div>'
                //  popular courses
                 
      }

  }
  var totalRecords=content && parseInt(content.totalRecords)>0?parseInt(content.totalRecords):0; 
  var totalPages=Math.ceil(totalRecords/10);
  if(totalPages>1){
    recordsget(totalPages);
  }else{
    $('.paging').twbsPagination('destroy');
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
  $("#datacollect").empty().append(box);
   $('.page-item ').hide();
  
  });
 return false;
 
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
  callapirecords(true,false,false,false);
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

  <script src="/form/express_form.js"></script>

<?php get_footer(); ?>

    <div class="show-filter-btnbottom">
      <button type="button"  id ="finalfilter" data-toggle="modal"  data-target="#myModal" 
      class="btn btn-theme btn-block allformtrigger">show filters</button>
      
    </div>
