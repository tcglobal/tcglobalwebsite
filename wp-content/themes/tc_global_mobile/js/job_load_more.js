
$(document).ready(function(){

var ppp = 4; // Post per page
var pageNumber = 0;
var type = 'mobile';

function load_jobPost(id,key,country,city,team,sort,subcountry, subteam){

    pageNumber++;

    var str = '&device=' + type + '&excludeJobPost=' + id +'&key=' + key +'&country=' + country + '&city=' + city + '&team=' + team + '&sort=' + sort + '&career_country=' + subcountry + '&career_team=' + subteam + '&pageNumber=' + pageNumber + '&ppp=' + ppp + '&action=load_job_post';
    
    //alert(str);


    $.ajax({
        type: "POST",
        dataType: "json",
        url: Jobajax.ajaxurl,
        data: str,
        success: function(data){
            var $data = $(data.result);

        if($data.length){

                $("#job_post_ajax").append($data);
                $("#load_job").attr("disabled",false);
                
                if(data.count == pageNumber) {
                    $('#load_job').attr("style", "display: none !important");
                }
            } 
            else{
                
                $('#load_job').attr("style", "display: none !important");
            }
        },
        error : function(jqXHR, textStatus, errorThrown) {
            $loader.html(jqXHR + " :: " + textStatus + " :: " + errorThrown);
        }

    });
    return false;
}

$("#load_job").on("click",function(){ // When btn is pressed.

    var id = $('input[name=exclude_job_post]').val();
    var key = $('input[name=job_key]').val();
    var country = $('input[name=job_country]').val();
    var city = $('input[name=job_city]').val();
    var team = $('input[name=job_team]').val();
    var sort = $('input[name=sort_val]').val();
    var subcountry = $('input[name=subcareer_country]').val();
    var subteam = $('input[name=subcareer_team]').val();
    
    $("#load_job").attr("disabled",true); // Disable the button, temp.
      load_jobPost(id,key,country,city,team,sort, subcountry, subteam );
    });

  
});  


