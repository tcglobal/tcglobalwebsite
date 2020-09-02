jQuery(document).ready(function () {

  
  setTimeout(function() {
    fetchuniversityList();
    }, 10000);

  $('.expressbtn').click(function () {
      console.log('test');
      $('#express_name').val('');
      $('#express_email').val('');
      $('#express_mobile').val('');
      $('#express_service').val('');
      $('#express_message').val('');
      //$('#express_university').empty();
      $("#express_TermsConditions").prop("checked", false);
      $('#express_service_text').text('Choose Service');
      //fetchuniversityList();
  });

function fetchuniversityList(){

  var country_value='';
  var study_value='';
  var area_value='';
  var course_value='';
  var reqdata = {page_type:'university_filter',country_name:country_value,prog_level:study_value,area_of_study:area_value,prog_name:course_value};

  var settinguniverse = {
        url:'/wp-content/plugins/searchtool/fetch.php', 
        type: "POST",
            data:reqdata
       }

     $.ajax(settinguniverse).done(function (response) {
     $('#express_university').prop('disabled', false);
    var appenddata="";

    if(response){

        var resultData = JSON.parse(response);
        var universeData = resultData.result;
        for (var i = 0; i < universeData.universities.length; i++) {
          var universityList = $.trim(universeData.universities[i].university);
          appenddata += "<option value = '"+universityList+"'>" + universityList + "</option>";
        }
        $("#express_university").empty();
        $("#express_university").append(appenddata);
    }

  });

}     


});