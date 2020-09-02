<?php /* Template Name: searchlisttemplate */
get_header();
  ?>
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
        <input type="hidden" id="previousPage" value="1">
        <div class="search-form-fields">
          <div class="row">
            <div class="col-sm-11">
              <div class="row">
                <div class="col">
                  <label>What do you want to study?</label>
                  <?php $className='form-control'?>
                  <select class="form-control mutlidropdown" data-placeholder="Area of study"
                  name="areaOfStudy[]"  multiple="multiple" id="areaOfStudy"  >
                    <option value=''>Area of study</option>
                  </select>
                </div>
                <div class="col">
                  <label>Where?</label>
                  <?php $className='form-control'?>
                  <select class="form-control mutlidropdown"  data-placeholder="Country" name="country[]" onchange="OnSelectionChange()"
                  multiple="multiple" id="country" value="<?php echo $params['country']?>" >
                  <option value=''>Country</option>

                  </select>
                </div>
                <div class="col">
                  <label>What specialization?</label>
                  <?php $className='form-control'?>
                  <select class="form-control mutlidropdown"  data-placeholder="Course options" name="specialization[]"
                   multiple="multiple" id="specialization" value="<?php echo $params['specialization']?>" >
                    <option value=''>Course options</option>
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
              </div>
            </div>
            <div class="col-sm-1 text-right pt-4"> <a id="topsearch" >
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
                      echo '<img src="'. plugins_url()."/searchtool/images/loader.gif".'"
                        alt="Loading..."> ';
                    ?></span>
                  <h6>Choose university</h6>
                  <?php $className='form-control selectbox m-b-20'?>
                  <select class="form-control selectbox m-b-20 mutlidropdown" name="university[]"
              data-placeholder="Choose University"  multiple="multiple" id="university"  value="<?php echo $params['university']?>" >
                    <option value=''>Choose university</option>
                  </select>
                  <h6>Choose city</h6>
                  <?php $className='form-control selectbox m-b-20'?>
                  <select class="form-control selectbox m-b-20 mutlidropdown " name="city[]"
                     data-placeholder="Choose city" id="city"  multiple="multiple" value="<?php echo $params['city']?>" >
                    <option value=''>Choose City</option>
                  </select>
                  <label class="mb-0">Choose preffered intake</label>
                  <div class="row">
                    <div class="col-sm-6">
                      <?php $className='form-control selectbox m-b-20'?>
                      <select class="form-control selectbox m-b-20 mutlidropdown" name="month[]"
                     data-placeholder="months" id="month" multiple="multiple" value="<?php echo $params['month']?>" >
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
                      <?php $className='form-control selectbox m-b-20'?>
                      <select class="form-control selectbox m-b-20 mutlidropdown" name="intake[]"
                     data-placeholder="year" id="intake" multiple="multiple" value="<?php echo $params['intake']?>" >
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
                  <label class="mb-0">Duration of course</label>
                  <div class="tab">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                      <li class="nav-item"> <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Undergraduate</a> </li>
                      <li class="nav-item"> <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Postgraduate</a> </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                      <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <div class="col">
                          <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" name="customCheck6[]" id="customCheck6" value="1">
                            <label class="custom-control-label" for="customCheck6">3 years</label>
                          </div>
                        </div>
                        <div class="col">
                          <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" name="customCheck6[]" id="customCheck7" value="2">
                            <label class="custom-control-label" for="customCheck7">4 +years</label>
                          </div>
                        </div>
                      </div>
                      <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                        <div class="col">
                          <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="customCheck8" value="3">
                            <label class="custom-control-label" for="customCheck8">5 years</label>
                          </div>
                        </div>
                        <div class="col">
                          <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="customCheck9" value="4">
                            <label class="custom-control-label" for="customCheck9">6 +years</label>
                          </div>
                        </div>
                      </div>
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
                  <option value=''></option>
                  <option value='IELTS'>IELTS</option>
                  <option value='PTE'>PTE</option>
                  <option value='TOEFL'>TOEFL</option>
                  </select>
                  <div class="row">
                    <div class="col-sm-12 p-t-30">
                      <label class="mb-0 mt-0">Additional exams not required</label>
                      <div class="custom-control custom-control-inline left-15 custom-checkbox mr-0 pt-2 float-right">
                        <input type="checkbox" class="custom-control-input" id="multiselectcheck2">
                        <label class="custom-control-label" for="multiselectcheck2"></label>
                      </div>
                    </div>
                  </div>
                  <h6 class="m-t-15" id="exam">Choose exams </h6>
                  <?php $className='form-control selectbox m-b-20'?>
                  <select class="form-control selectbox m-b-20 mutlidropdown testdropdown1" name="acceptedexams[]"
                     data-placeholder="Choose exams" id="acceptedexams"  multiple="multiple" value="<?php echo $params['acceptedexams']?>" >
                  <option value=''></option>
                  <option value='GRE'>GRE</option>
                  <option value='GMAT'>GMAT</option>
                  <option value='SAT'>SAT</option>
                  </select>
                  <h6>Choose mode of study </h6>
                  <?php $className='form-control selectbox m-b-20'?>
                  <select class="form-control selectbox m-b-20 mutlidropdown " name="mode_of_study[]"
                     data-placeholder="Choose mode of study" id="mode_of_study"  multiple="multiple" value="<?php echo $params['mode_of_study']?>" >
                    <option value=''></option>
                    <option value='Fulltime'>Full time</option>
                    <option value='Online'>Online</option>
                    <option value='Parttime'>Part time</option>
                  </select>
                  <h6>Choose university orientation </h6>
                  <?php $className='form-control selectbox m-b-20'?>
                  <select class="form-control selectbox m-b-20 mutlidropdown " name="universityorientation[]"
                     data-placeholder="Choose university orientation " id="universityorientation"  multiple="multiple" value="<?php echo $params['universityorientation']?>" >
                    <option value=''></option>
                    <option value='Research'>Research</option>
                    <option value='Industry'>Industry</option>
                  </select>
                  <label class="mb-0">Choose prefered tuition fee</label>
                  <div class="col-sm-12 p-0 m-b-40">
                    <input type="text" class="js-range-slider" name="feesRange" value=""/>
                    <span style="display:none"  id="feesrangeselectedMax" name="feesrangeselectedMax"><?php echo $maxVal?></span> <span style="display:none"  id="feesrangeselectedMin" name="feesrangeselectedMin"><?php echo$minVal?></span> <span style="display:none" name="range-max" id="range-max-value"><?php echo $tutionFees?></span> </div>
                  <button id="morefilter" type="button" class="btn btn-block">Apply filters</button>
                </div>
              </div>
              <div class="col-sm-9 pl-5">
                <div class="searchlist-topfilter">
                  <div class="row" >
                    <div id="pagination-no-result-div" class="no-record-theme">
          					  <div class="danger">No Results Found</div>
          					</div>
                    <div id="pagination-result-div" class="col-sm-4 pr-0"></div>
                    <ul class="paging col-sm-2 px-0">
                    </ul>
                    <div class="col pl-0 additionalfilters">
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
                                <li class="showcourse" data-myvalue="Courses" data-mydata="Courses" id="courseselect" > <a  class=""  > <img id="courseselectimg" style="display:none" src="<?php echo bloginfo('template_url') ?>/images/drop-tick.jpg" alt="" /> Courses </a> </li>
                              </ul>
                            </div>
                          </div>
                        </li>
                      </ul>
                    </div>
                    <div class="col pl-0 additionalfilters">
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
                <span id="page_records_loader" style="display:none"><?php
                      echo '<img src="'. plugins_url()."/searchtool/images/loader.gif".'"
                        alt="Loading..."> ';
                    ?></span>
                <div id="datacollect"> </div>
                <input type="hidden" id="result_no" value="10">
                <div class="searchlist-topfilter mt-5">
                  <div class="row">
                    <div id="pagination-result-div-bootom" class="col-sm-4 "></div>
                    <ul class="paging col-sm-2 px-0">
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
    <div class="popular-course">
      <div class="text-center">
        <div class="boldheading "> Popular Courses </div>
        <div class="path"></div>
      </div>
      <div class="container">
        <div class="row">
         <h4 class="text-center col-sm-12">No Records Found</h4>
        </div>
      </div>
    </div>
    <!--POPULAR-COURSE-->
    <!--SET-COURSE-->
    <div class="aboutblock position-relative">
      <div class="rightbanner position-absolute"></div>
      <div class="container ">
        <div class="row ">
          <div class="col-md-6">
            <div class="aboutblock__container">
              <div class="smallheading text-uppercase "> get, set, global! </div>
              <div class="boldheading"> <span class="d-block">Set the right</span> course </div>
              <div class="brownpath"></div>
              <div class="content m-t-30"> <span class="d-block">Would you like your journey of searching the right university</span> <span class="d-block">to be even more precise and tailored right to your needs? </span> <span class="d-block">Register to our Student’s Portal to get wider access</span> <span class="d-block">to all of our tools. Let’s start this journey together!</span> </div>
              <div class="morebtn m-t-40"> <a href="" class="text-uppercase text-decoration-none">sign in to portal <span><img src="images/forward.png" alt="" width="13"></span></a> </div>
            </div>
          </div>
          <div class="col-md-6 "> </div>
        </div>
      </div>
    </div>
    <!--SET-COURSE-->
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
      $( "#allselectimg" ).css( "display",'none' );
      $("#courseselectimg").css( "display",'block' );
     }else{
      $( "#allselect" ).addClass( "active" );
      $("#courseselectimg").css( "display",'none' );
      $( "#allselectimg" ).css( "display",'block' );
     }
     callapirecords();
});

$(".showrank").click(function(event){
     var showed  =   $(this).data('myvalue');
     $('#sortBy').val(showed);
});


</script>
<script>


$(document).ready(function(){

//   function GetQueryStringParams(sParam,type)
// {
//   var sPageURL = window.location.search.substring(1);
//   var sURLVariables = sPageURL.split('&');
//   var studyvalues=type===1?[]:'';
//     for (var i = 0; i < sURLVariables.length; i++)
//       {
//           var sParameterName = sURLVariables[i].split('=');
//           var sParameterNameChanged = sParameterName[0].split('%');
//           if (sParameterNameChanged[0] ==sParam )
//           {
//             if(type===1){
//               var formatedName= sParameterName[1].replace(/[+\s]/g, ' ')
//               studyvalues.push(formatedName)
//             }else{
//               studyvalues=sParameterName[1];
//             }
//           }
//       }
//     return studyvalues;
//  }



//   var areaofstudyvalue = GetQueryStringParams('areaOfStudy',1);
//   var countryvalue = GetQueryStringParams('country',1);
//   var courseoptionvalue = GetQueryStringParams('specialization',1);
//   var studylevelvalue = GetQueryStringParams('studyLevel',1);
//   var universityvalue = GetQueryStringParams('university',1);
//   var cityvalue = GetQueryStringParams('city',1);
//   var monthvalue = GetQueryStringParams('month',1);
//   var yearvalue = GetQueryStringParams('intake',1);
//   var languagetestvalue = GetQueryStringParams('acceptedlanguage',1);
//   var  examvalue = GetQueryStringParams('acceptedexams',1);
//   var modeofstudyvalue = GetQueryStringParams('mode_of_study',1);
//   var universityorientationvalue = GetQueryStringParams('universityorientation',1);
//   $("#areaOfStudy").val(areaofstudyvalue).trigger('change');
//   $("#country").val(countryvalue).trigger('change');
//   $("#specialization").val(courseoptionvalue).trigger('change');
//   $("#studyLevel").val( studylevelvalue).trigger('change');
//   $("#university").val( universityvalue).trigger('change');
//   $("#city").val( cityvalue).trigger('change');
//   $("#intake").val( yearvalue).trigger('change');
//   $("#month").val( monthvalue).trigger('change');
//   $("#acceptedlanguage").val( languagetestvalue).trigger('change');
//   $("#acceptedexams").val(  examvalue ).trigger('change');
//   $("#mode_of_study").val( modeofstudyvalue).trigger('change');
//   $("#universityorientation").val( universityorientationvalue).trigger('change');

   $(".more-show").click(function(){
    $("#filter").css("display", "block");
    $("#topsearch").hide();
    $("#filters").hide();

   });



});
</script>
<script>
$(document).ready(function() {
  $('.mutlidropdown').select2();

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
    console.log('showed',showed)
    if(showed=='All'){
      $( "#allselect" ).addClass( "active" );
      $("#courseselectimg").css( "display",'none' );
      $( "#allselectimg" ).css( "display",'block' );
      $('#dropdownMenuButton').text(showed);
    }
  });

 });
</script>
<script>

$(document).ready(function() {
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
  var yearVal =$("#intake").select2("val");
  yearVal=yearVal ?yearVal:'';
  var monthVal =$("#month").select2("val");
  monthVal= monthVal ? monthVal:'';
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
 var ourdata = {page_type:'searchresult',sortBy:sortbyVal,offset:parseInt(offsetVal),limit:parseInt(val),country_name:countryVal,university_name:univVal,showlist:showlistVal,area_Of_Study:areaVal,specialization:specializval,studyLevel:studyVal,prog_campus:cityVal,month:monthVal,intake:yearVal,acceptedlanguage:acceptedlangtestVal,acceptedexams:acceptedexamVal,mode_of_study:modeofstudyVal,universityorientation:universityorientVal,feesRange:feesRangemax,feesRangemin:feesRangemin,cityVal:cityVal};
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
		$('#totalRecords').val(content.total_count);
		var box='';
		var totalRecords=parseInt(content.total_count)>0?parseInt(content.total_count):0;
		var totalPages=Math.ceil(totalRecords/10);
		if(totalRecords > 0){
			for (var i=0; i<content.records.length; i++) {
	var res= content.records[i];
	var url='/coursedetail?prog_id='+res.prog_id+'&prog_name='+res.prog_name+'&university_name='+res.university_name+'&country_name='+
	res.country_name;
	var url= encodeURI(url);
	box+= '<div class="searchlist-box">'+
				'<div class="row">'+
				'<div class="col-sm-4 thumbnail pr-0">'+
				'<a href="'+url+'">'+
				'<img src="<?php echo bloginfo('template_url') ?>/images/img-world-citizenship.png" alt="search-list-img"class="img-fluid" width="1000" height="1000" > '+
			   '</a>'+
			   '<span class="name type1">course</span>'+
				'<span class="amount"><span class="value">'+res.prog_fees_value+'</span>'+
				'<span class="type">'+res.prog_fees_currency+'</span>'+
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
					   '<span class="value">'+res.score_1+'</span>'+
						'</div>'+
						'<div class="popover fade show bs-popover-left">'+
						'<div class="arrow" style="top: 16px;">'+
						 '</div>'+
						'<div class="popover-body">'+
					  '</div>'+
					  '</div>'+
					  '</div>'+
					'<div class="col-sm-1 text-right p-0 pt-2 mt-1">'+
					  '<a href="">'+
	'<img src="<?php echo bloginfo('template_url') ?>/images/search-favfill.png" alt="fav"> '+
					'</a>'+
					'</div>'+
				   '</div>'+

	'<h3><img src="<?php echo bloginfo('template_url') ?>/images/flag-img.png" alt="flag">'+res.university_name+'</h3>'+
		'<h3><img src="<?php echo bloginfo('template_url') ?>/images/user-icon-search.png" alt="user"><span>Public</span> <span class="name">University</span></h3>'+

				 '<a href="'+url+'">'+
				 '<h2>' +res.prog_name+ '</h2>'+
				 '</a>'+

				  '<div class="row">'+
				   '<div class="col-sm-6">'+
					'<button type="button" class="btn btn-block btn-danger">check eligibility</button>'+
					'</div>'+
					'<div class="col-sm-6">'+
					  '<button type="button" class="btn btn-block btn-outline-danger">express your interest</button>'+
					'</div>'+
				  '</div>'+

				'</div>'+
			  '</div>'+
			'</div>'+
			'</a>'+
		  '</div>'+
		 '</div>'+
		 '</div>'
		//  popular courses
	}
	    }


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
  // We increase the value by 2 because we limit the results by 2
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
//var totalRecords=$('#totalRecords').val();



function recordsget(totalPages){
//console.log('totalRecords', parseInt(totalRecords)>0?2:0);
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
  callapirecords(true);
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

<?php
/**  Get Shortcode content from editor  **/

    while ( have_posts() ) : the_post();
    the_content(); // get post content
    endwhile;
?>

<?php get_footer(); ?>
