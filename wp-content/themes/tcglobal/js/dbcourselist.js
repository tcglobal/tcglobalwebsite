
$(document).ready(function(){


function callcourseapi(){

    var areaVal=$("#areaOfStudy").select2("val");
  studytype = areaVal?areaVal.toString():'';

  var  countryVal=$("#country_name").select2("val");
  countrytype = countryVal ?countryVal.toString():'';

  var  specializval=$("#specialization").select2("val");
  coursetype = specializval ?specializval.toString():'';

  var myvalue = {
        action: 'CourseTableData',
        userarea:studytype,
        usercountry:countrytype,
        usercoursetype:coursetype

    };
    
    //console.log(myvalue);
    
    $.ajax({
        type: "POST",
        url: coursedata.ajaxurl,
        data: myvalue,
        success: function(data){
            
            //console.log(data);

            var sqlquery = data.query;
            var count = data.count;
            var result = data.res;
            //console.log(sqlquery);
            
            $(".selectquery").html(sqlquery);

            $('.count').html("<h2> Total Records:" + count + "</h2>");

            $(".course-result").html(result);
        },
        error : function(jqXHR, textStatus, errorThrown) {
            $loader.html(jqXHR + " :: " + textStatus + " :: " + errorThrown);
        }

    });

    return false;
}

$('#course_search').click(function(){
    callcourseapi();
  });

});  


