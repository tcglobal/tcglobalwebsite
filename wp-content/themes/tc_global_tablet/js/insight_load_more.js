
$(document).ready(function(){

var ppp = 3; // Post per page
var pageNumber = 0;
var col_val = 'col-sm-4';

function load_posts(id, key, type, topic, business){

    pageNumber++;

    var str = '&col=' + col_val +'&key=' + key +'&type=' + type + '&insight_topic=' + topic + '&insight_business=' + business + '&excludeInsightPost=' + id + '&pageNumber=' + pageNumber + '&ppp=' + ppp + '&action=load_post_ajax';
    
    $.ajax({
        type: "POST",
        dataType: "json",
        url: Myajax.ajaxurl,
        data: str,
        success: function(data){
            var $data = $(data.result);

            if($data.length){

                $("#insight_post").append($data);
                $("#load_post").attr("disabled",false);
                
                if(data.count == pageNumber) {
                    $('#load_post').attr("style", "display: none !important");
                }
            } 
            else{
                
                $('#load_post').attr("style", "display: none !important");
            }
        },
        error : function(jqXHR, textStatus, errorThrown) {
            $loader.html(jqXHR + " :: " + textStatus + " :: " + errorThrown);
        }

    });
    return false;
}

$("#load_post").on("click",function(){ // When btn is pressed.

    var id = $('input[name=exclude_insight_post]').val();
    var key = $('input[name=s]').val();
    var type = $('input[name=type]').val();
    var topic = $('input[name=insight_topic]').val();
    var business = $('input[name=insight_business]').val();
    
    $("#load_post").attr("disabled",true); // Disable the button, temp.
      load_posts(id, key, type, topic, business);
    });

  
});  


