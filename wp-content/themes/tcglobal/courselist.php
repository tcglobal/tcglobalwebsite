<?php /* Template Name: Course Result page */
get_header();

global $wpdb;

include($_SERVER['DOCUMENT_ROOT'].'/form/university_api.php');

global $post;
?>

<section class="desktop-mainsection">
  <form id="searchForm" action="/search-tool" method="GET">
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
        <input type="hidden" name="feesrangeselectedMin" id="feesrangeselectedMin" value="0">
        <input type="hidden" name="feesrangeselecteMax" id="feesrangeselecteMax" value="50000">
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
                    <!--<option value=''>Area of study</option>-->
                    <?php echo $areaofstudyname; ?>
                  </select>
                </div>
                <div class="col">
                  <label>Where?</label>
                  <?php $className='form-control'?>
                  <select class="form-control mutlidropdown"  data-placeholder="Country" name="country_name[]" onchange="OnSelectionChange()"
                  multiple="multiple" id="country_name" value="<?php echo $params['country_name']?>" >
                  <option value=''>Country</option>
                  <option value='Australia'>Australia</option>
                  <option value='Canada'>Canada</option>
                  <option value='United Kingdom '>United Kingdom</option>


                  </select>
                </div>
                <div class="col">
                  <label>What specialization?</label>
                  <?php $className='form-control'?>
                  <select class="form-control mutlidropdown"  data-placeholder="Course options" name="specialization[]"
                   multiple="multiple" id="specialization" value="<?php echo $params['specialization']?>" >
                    <!-- <option value=''>Course options</option> -->
                    <?php // echo $course_list; ?>
                  </select>
                </div>
                
              </div>
            </div>
            <div class="col-sm-1 text-right pt-4"> <a id="course_search" >
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
            <h2 class="main-heading"><span class="d-block">Search results</h2>

            <div class="selectquery"></div>

            <div class="row">

              <div class="count"></div>
              <div class="course-result col-sm-12"></div>
            </div>

          </div>
        </div>
      </div>
    </div>
    <!--SEARCH-RESULT-->
    

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
     $('.sorting-img').attr('style','display:none!important');
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
        jQuery('.exp_center').addClass('value-selected');
        jQuery('input[name=intake]').val(expCenter); // assign value to hidden input
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
  $('#page_records_loader').css('display','block');
  $('.additionalfilters').css('display','none');
  $('#pagination-no-result-div').css('display','none');
  // $('html, body').animate({
  //           scrollTop: $(".search-form-fields").offset().top
  // }, 50);
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
        /*for (var i = 0; i <  arealeveltype.area_of_study.length; i++) {
          appendarea += "<option value = '" +  arealeveltype.area_of_study[i] + " '>" +   arealeveltype.area_of_study[i] + " </option>";
        }*/
        /*for (var i = 0; i <  arealeveltype.prog_type.length; i++) {
          appendtype += "<option value = '" +   arealeveltype.prog_type[i] + " '>" +   arealeveltype.prog_type[i] + " </option>";
        }*/
        for (var i = 0; i <  arealeveltype.prog_level.length; i++) {
          appendlevel += "<option value = '" +   arealeveltype.prog_level[i] + " '>" +   arealeveltype.prog_level[i] + " </option>";
        }
      }
      //$("#specialization").append(appendtype);
      //$("#areaOfStudy").append( appendarea);
      $("#studyLevel").append(appendlevel);
      originalCountryList=(responseData.countryList);

      /*for (var i = 0; i <  responseData.countryList.length; i++) {
        appendCountry += "<option value = '" +    responseData.countryList[i].country + " '>" +    responseData.countryList[i].country + " </option>";
      }
      $("#country").append(appendCountry);*/
    }
    callapirecords();
  });
  OnSelectionChange();
 
  $('.page-item ').hide();

  /*$('#topsearch').click(function(){
    callapirecords();
    
  });*/
  $('#morefilter').click(function(){
    $('html, body').animate({
       scrollTop: $(".search-form-fields").offset().top
    }, 50);
    callapirecords();
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
    $('#country').attr('disabled',true);
    $('#specialization').attr('disabled',true);
    $('#studyLevel').attr('disabled',true);
  $("#areaOfStudy").change(function(){
     var areaVal=$("#areaOfStudy").select2("val");
    if(areaVal && areaVal.length ){
        $('#country').attr('disabled',false);
        $('#specialization').attr('disabled',false);
        $('#studyLevel').attr('disabled',false);
    }else{
      $('#country').attr('disabled',true);
      $('#specialization').attr('disabled',true);
      $('#studyLevel').attr('disabled',true);
    }
  })

 
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
function getCountryFlag(countryName){
    var countryFlag= originalCountryList.filter(x => x.country == countryName).map(x => x.flag);
    if(countryFlag){
      return countryFlag[0];
    }else{
      return null;
    }
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
  var feesRangemax =  $("#feesrangeselecteMax").val();
  var feesRangemin =  $("#feesrangeselectedMin").val();
  var showlistVal= $("#showlist").val();
  var sortbyVal =  $("#sortBy").val();

 if ($("#multiselectcheck1").is(":checked")){
  var acceptedlangtestVal="";
 }
 if ($("#multiselectcheck2").is(":checked")){
  var acceptedexamVal="";
 }

 $('.page-item ').hide();
 var ourdata = {page_type:'searchresult',sortBy:sortbyVal,offset:parseInt(offsetVal),limit:parseInt(val),country_name:countryVal,university_name:univVal,showlist:showlistVal,area_Of_Study:areaVal,specialization:specializval,studyLevel:studyVal,prog_campus:cityVal,month:monthVal,intake:yearVal,acceptedlanguage:acceptedlangtestVal,acceptedexams:acceptedexamVal,mode_of_study:modeofstudyVal,universityorientation:universityorientVal,feesRange:feesRangemax,feesRangemin:feesRangemin,durationOfCourse:durationOfCourse,durationOfCoursePostGraduate:durationOfCoursePostGraduate};


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
    var totalRecords=content && parseInt(content.total_count)>0?parseInt(content.total_count):0;
    var totalPages=Math.ceil(totalRecords/10);
		if(totalRecords > 0 &&  content){
		$('#totalRecords').val(content.total_count);
			for (var i=0; i<content.records.length; i++) {
        var res= content.records[i];

        var countryFlag=getCountryFlag(res.country_name);
        var flagHtml=countryFlag?'<img src="<?php echo plugins_url('searchtool') ?>/flags/'+countryFlag+'" alt="flag" >':null;
        var currencyAmount=	res.prog_fees_value?'<span class="amount"><span class="value">'+(res.prog_fees_value).toFixed()+'</span>'+
				'<span class="type">'+res.prog_fees_currency+'</span>':'';
        var url='/coursedetail?prog_id='+res.prog_id+'&prog_name='+res.prog_name+'&university_name='+res.university_name+'&country_name='+
        res.country_name;
        var url= encodeURI(url);
        box+= '<div class="searchlist-box">'+
				'<div class="row">'+
				'<div class="col-sm-4 thumbnail pr-0">'+
				'<a href="'+url+'">'+
				'<img src="<?php echo bloginfo('template_url') ?>/images/img-world-citizenship.png" alt="search-list-img"class="img-fluid" width="1000" height="1000" > '+
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
						'<img src="<?php echo bloginfo('template_url') ?>/images/rank-tag.png" alt="tag" style="display:none"> '+
					   '<span class="value"></span>'+
						'</div>'+
						'<div class="popover fade show bs-popover-left">'+
						'<div class="arrow" style="top: 16px;">'+
						 '</div>'+
						'<div class="popover-body">'+
					  '</div>'+
					  '</div>'+
					  '</div>'+
					'<div class="col-sm-1 text-right p-0 pt-2 mt-1">'+
					  '<a >'+
          '<img src="<?php echo bloginfo('template_url') ?>/images/search-favfill.png" alt="fav" style="display:none"> '+
                  '</a>'+
                  '</div>'+
                  '</div>'+
         
          '<h3>'+flagHtml+res.university_name+'</h3>'+
            '<h3><img src="<?php echo bloginfo('template_url') ?>/images/user-icon-search.png" alt="user"><span>Public</span> <span class="name">University</span></h3>'+

				 '<a href="'+url+'">'+
				 '<h2>' +res.prog_name+ '</h2>'+
				 '</a>'+

				  '<div class="row">'+
				   '<div class="col-sm-6">'+
					'<a href="'+url+'" title="' +res.prog_name+'"><button type="button" class="btn btn-block btn-danger">Learn more</button></a>'+
					'</div>'+
					'<div class="col-sm-6">'+
					  '<button type="button" class="btn btn-block btn-outline-danger expressbtn" data-toggle="modal" data-target="#expressModal">express your interest</button>'+
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

	console.log('totalRecords',totalRecords)
	console.log('totalPages',totalPages)
	if(totalPages>1){
	  recordsget(totalPages);
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
