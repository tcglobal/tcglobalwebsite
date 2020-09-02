
 <?php /* Template Name: searchlisttemplate */ 
get_header();  
?>

<section class="desktop-mainsection">
<form id="searchForm" action="/search-tool" method="GET" onsubmit="return callapirecords()">
       <div class="searchtool-banner">
         <div class="bg-color"></div>
         <div class="container position-relative">
           <div class="row">
             <div class="col">
               <h2 class="mobile-main-heading">Search Tool</h2>
             </div>
              </div>
<!-- modal -->
              <div id="myModal" class="modal fade" role="dialog">
              <div class="modal-dialog">

              <div class="modal-content modal-search-filter">
             
              <a href="" class="close-btn" data-dismiss="modal" >
              <img src="<?php bloginfo('template_url')?>/images/popup-close.png;"/>
                
                 </a>
           <div class="search-form-fields search-result">

           <input type="hidden" name="offset" value="0" id="offset">
           <input type="hidden" name="limit" value="10">
           <input type="hidden" name="recordCount" value="0" id="recordCount">

              <div class="row">
              <div class="col-12 m-b-20">
               <label>What do you want to study?</label>
               <select class="form-control mutlidropdown" data-placeholder="Area of study"
                name="areaOfStudy[]" id="areaOfStudy"   multiple="multiple" value="" >
                 <!-- <select class="form-control"> -->
                  <option value=''>Area of study</option>
               </select>
               </div>
               <div class="col-12 m-b-20">
               <label>Where?</label>
                 
                  <select class="form-control mutlidropdown"  data-placeholder="Country" name="country[]"
                  multiple="multiple" id="country" onchange="OnSelectionChange()">
                    <option value=''>Country</option>
                
                </select>
               

               </div>
               <div class="col-12 m-b-20">
               <label>What specialization?</label>
              <select class="form-control mutlidropdown" data-placeholder="Course options"
              name="specialization[]" id="specialization" multiple="multiple" value="" >
                    <option value=''>Course options</option>
                   
               </select>
               </div>
               <div class="col-12 m-b-20">
               <label>On which study level? </label>
               <select class="form-control mutlidropdown"  data-placeholder="Study level options"
             name="studyLevel[]" id="studyLevel"  multiple="multiple" value="" >
                    <option value=''>Study level options</option>
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
                    <option value=''>Choose university</option>
              </select>
               <h5 class="p-t-20">Choose City</h5>
               <select class="form-control selectbox m-b-20 mutlidropdown " name="city[]"
                data-placeholder="Choose city" id="city"  multiple="multiple" value="" >
                <option value=''>Choose City</option>
                   
                </select>
                    <label class="mb-0 p-t-20">Choose preffered intake</label>
                    <div class="row">
                     
                      <div class="col">
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
                      <div class="col">
                     <select class="form-control selectbox m-b-20 " name="intake[]"
                         data-placeholder="year" id="intake">
                          
                          <option value=''>Choose year</option>
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
                    <label class="mb-0 p-t-20">Duration of course</label>
                    <div class="tab">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item">
                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Undergraduate</a>
                   </li>
                   <li class="nav-item">
                  <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Postgraduate</a>
                  </li>
                  </ul>
                  <div class="tab-content pl-1 pb-3" id="myTabContent">
                  <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                    <div class="col pb-2">
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
                     <div class="col pb-2">
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
                     <option value=''></option>
                     <option value='IELTS'>IELTS</option>
                      <option value='PTE'>PTE</option>
                       <option value='TOEFL'>TOEFL</option>
 
                   </select>

                   <div class="row">
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
 
                   </select>
                   <h5 class="p-t-20">Choose mode of study </h5>
              <select class="form-control selectbox m-b-20 mutlidropdown " name="mode of study[]"
    data-placeholder="Choose mode of study" id="mode of study"  multiple="multiple" value="<" >
                     <option value=''></option>
                     <option value='Fulltime'>Full time</option>
                      <option value='Online'>Online</option>
                      <option value='Parttime'>Part time</option>
                   </select>
                       <h5 class="p-t-20">Choose university orientation </h5>
                   
                       <select class="form-control selectbox m-b-20 mutlidropdown " name="universityorientation[]"
                     data-placeholder="Choose university orientation " id="universityorientation"  multiple="multiple" value="" >          
                       <option value=''></option>
                     <option value='Research'>Research</option>
                     <option value='Industry'>Industry</option>
 
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
               <h2 class="mobile-main-heading m-b-50"><span class="d-block">Your personalized</span>University search results</h2>
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
                                 <p>Show</p>
                                 <div class="row">
                                   <div class="col-sm-12">
                                     <div class="custom-control custom-checkbox">
                                      <input type="checkbox" class="custom-control-input showcheck" id="All"
                                       name="showlist"  value="All">
                                       <label class="custom-control-label" for="All">All</label>
                                     </div>
                                   </div>
                                 </div>
                                 <div class="row">
                                   <div class="col-sm-12">
                                     <div class="custom-control custom-checkbox">
                                        <input type="checkbox"  class="custom-control-input showcheck" id="Courses"
                                       name="showlist"  value="Courses">
                                       <label class="custom-control-label" for="Courses">Courses</label>
                                     </div>
                                   </div>
                                 </div>
                               
                                 

                                 <p>Sort by</p>
                                 <div class="row">
                                   <div class="col-sm-12">
                                     <div class="custom-control custom-radio">
                                         <input type="radio" id="customRadio1" name="sortBy"
                                          class="custom-control-input sortcheck" value="All">
                                      <label class="custom-control-label" for="customRadio1">All</label>
                                     </div>
                                   </div>
                                 </div>
                                 <div class="row">
                                   <div class="col-sm-12">
                                     <div class="custom-control custom-radio">
                                         <input type="radio" id="customRadio2" name="sortBy"
                                          class="custom-control-input sortcheck" value="Country">
                                      <label class="custom-control-label" for="customRadio2">Country</label>
                                     </div>
                                   </div>
                                 </div>
                                   <div class="row">
                                   <div class="col-sm-12">
                                     <div class="custom-control custom-radio">
                                        <input type="radio" id="customRadio3" name="sortBy" 
                                     class="custom-control-input sortcheck" value="Area of study">
                                       <label class="custom-control-label" for="customRadio3">Area of study</label>
                                     </div>
                                   </div>
                                 </div>
                                   <div class="row">
                                   <div class="col-sm-12">
                                     <div class="custom-control custom-radio">
                                        <input type="radio" id="customRadio4" name="sortBy" 
                                       class="custom-control-input sortcheck" value="University">
                                     <label class="custom-control-label" for="customRadio4">University</label>
                                     </div>
                                   </div>
                                 </div>
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
   <div class="popular-course">
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


   
<script type="text/javascript">
  $('.mobile-menu, .overlay').click(function () {
  	$('.mobile-menu').toggleClass('clicked');

  	$('#mobile-nav').toggleClass('show');

  });
  var rangeMax = $('#range-max-value').text();
    var rangeMaxSelected = $('#feesrangeselectedMax').text();
    var rangeMinSelected = $('#feesrangeselectedMin').text();

    $(".js-range-slider").ionRangeSlider({
        skin: "round",
        type: "double",
        grid: true,
        min: 0,
        max: rangeMax,
        from: rangeMinSelected,
        to: parseFloat(rangeMaxSelected) === 0 ? rangeMax : rangeMaxSelected,
        prefix: "$"
    });
    $('.carousel').slick({
    dots: true,
    infinite: true,
    speed: 300,
    centerPadding: '33px',
    slidesToShow: 1,
    slidesToScroll: 1,
    focusOnSelect: true,
    centerMode: true,

  });
</script>


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
$(document).ready(function(){
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
    callapirecords();
  })
  $('#topsearch').click(function(){
    $('.modal-backdrop').hide();
    $('#myModal').hide();
    $("#datacollect").empty();
    $("#offset").val(0);
    $('#recordCount').val(0);
    $(".page-template.page-template-searchlisttemplate").removeClass("modal-open");
    callapirecords();
  });
  $('#sorting-search').click(function(){
    $('#myModalsort').hide();
    $('.modal-backdrop').hide();
    $(".page-template.page-template-searchlisttemplate").removeClass("modal-open");
    $("#datacollect").empty();
    $("#offset").val(0);
    $('#recordCount').val(0);
    callapirecords();
  });
 $('.mutlidropdown').select2();
  $(".more-show").click(function(){
    $("#filter").css("display", "block");
    $("#topsearch").hide();
    $("#filters").hide();
 });
 $('#pagination-no-result-div').css('display','none');  
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
      if(arealeveltype){
        for (var i = 0; i <  arealeveltype.area_of_study.length; i++) {
          appendarea += "<option value = '" +  arealeveltype.area_of_study[i] + " '>" +   arealeveltype.area_of_study[i] + " </option>";
        }
        for (var i = 0; i <  arealeveltype.prog_type.length; i++) {
          appendtype += "<option value = '" +   arealeveltype.prog_type[i] + " '>" +   arealeveltype.prog_type[i] + " </option>";
        }
        for (var i = 0; i <  arealeveltype.prog_level.length; i++) {
          appendlevel += "<option value = '" +   arealeveltype.prog_level[i] + " '>" +   arealeveltype.prog_level[i] + " </option>";
        }
      }
      $("#specialization").append(appendtype);
      $("#areaOfStudy").append( appendarea);
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
  

function  callapirecords(){
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
 var showlistVal = ''
	$(".showcheck:checked").each(function() {
    showlistVal=$(this).val();
	});
  var sortbyVal  = '';
	$(".sortcheck:checked").each(function() {
    sortbyVal=$(this).val();
	});
 if ($("#multiselectcheck1").is(":checked")){
  var acceptedlangtestVal="";
 }
 if ($("#multiselectcheck2").is(":checked")){
  var acceptedexamVal="";
 }
  $('.modal-backdrop').hide();
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
		var box='';	
		var totalRecords=content && parseInt(content.total_count)>0?parseInt(content.total_count):0; 
    if(totalRecords > 0 && content){
    for (var i=0; i<content.records.length; i++) {
      $('#totalRecords').val(content.total_count);
         var res= content.records[i];
         var currencyAmount=	res.prog_fees_value?'<span class="amount"><span class="value">'+res.prog_fees_value+'</span>'+
				'<span class="type">'+res.prog_fees_currency+'</span>':'';
         var url='/coursedetail?prog_id='+res.prog_id+'&prog_name='+res.prog_name+'&university_name='+res.university_name+'&country_name='+
        res.country_name;
          var url= encodeURI(url);
        
            box+= '<div class="searchlist-box">'+
              
              '<div class="row">'+
                '<div class="col-sm-12 thumbnail">'+
                
                '<a href="'+url+'">'+
                              
'<img src="<?php echo bloginfo('template_url') ?>/images/img-world-citizenship.png" alt="search-list-img"class="img-fluid"> '+
                  '</a>'+
                  '<span class="name type1">course</span>'+
                  '<div class="searchlist-fav">'+
                   '<a >'+
'<img src="<?php echo bloginfo('template_url') ?>/images/searchlist-fav.png" alt="fav.png"> '+

                '</a>'+
                '</div>'+
                '</div>'+
                '<div class="col-sm-12 px-20">'+
                  '<div class="col-sm-12">'+
                    '<div class="row">'+
                      '<div class="col-10">'+currencyAmount+
                      '</div>'+
                      '<div class="col-2 p-0">'+
                        '<div class="tag-count">'+
'<img src="<?php echo bloginfo('template_url') ?>/images/rank-tag.png" alt="tag"> '+
                        
                       '<span class="value">'+res.score_1+'</span>'+
                        '</div>'+
                       '<div class="popover fade show bs-popover-left"><div class="arrow" style="top: 16px;"></div>'+
                       '<div class="popover-body"> World University Rank </div>'+
                     '</div>'+
                    '</div>'+
                    '<div class="col-sm-12">'+
                     '<p class="date">Start Date: <span>'+res.prog_start_date+'</span></p>'+
                  '</div>'+
                  '</div>'+
                  '<h3><img src="<?php echo plugins_url('searchtool') ?>/flags/'+res.flag+'" alt="flag"><span>'+res.university_name+'</span></h3>'+
                 
                  '<h2>' +res.prog_name+'</h2>'+
                  '<div class="row">'+
                   '<div class="col-sm-12">'+
                    '<button type="button" class="btn btn-block btn-danger">check eligibility</button>'+
                    '</div>'+
                    '<div class="col-sm-12">'+
                   '<button type="button" class="btn btn-block btn-outline-danger">express your interest</button>'+
                    '</div>'+
                  '</div>'+
                '</div>'+
              '</div>'+
            '</div>'+
          '</div>'
                //  popular courses
  }
  $("#datacollect").append(box);
  $('#pagination-no-result-div').css('display','none');  
}else{
  $("#datacollect").empty();
  $('#pagination-no-result-div').css('display','block');  
}
 
  var recordCount=$('#recordCount').val();
  
  recordCount=content && content.records? parseInt(recordCount)+parseInt(content.records.length):0;
  $('#recordCount').val(recordCount);
  console.log('content',content)
  if(!content){
    $("#moredata").css('display','none');
  }
  if (content && (recordCount>= content.total_count) ){
    $("#moredata").css('display','none');
  }
  
 
	});
  // We increase the value by 2 because we limit the results by 2
}
function loadmore(offsetVal)
{
  $('#offset').val(offsetVal);
  callapirecords();
}
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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.3/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css" rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.min.css" rel="stylesheet" /> 
<?php get_footer(); ?>


<div class="search-filter-buttons global-space">
    
    <div class="row">
      <div class="col-6 text-center pt-2">
        <a href="" class="more-link" id="finalsorting" data-toggle="modal"
          data-target="#myModalsort">sorting</a>
      </div>
      <div class="col-6 pl-0">
         <button type="button" id ="finalfilter" class="btn btn-theme" data-toggle="modal"
          data-target="#myModal">show filters</button>
      </div>
    </div>
    
  </div>

  
 