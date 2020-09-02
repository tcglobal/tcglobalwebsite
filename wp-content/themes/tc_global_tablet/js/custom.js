
$(document).ready(function(){

var ppp = 100; // Post per page
var pageNumber = 0;
var col_val = 'col-sm-4';

function load_posts(postid, title, location, date, topic, business){
    
    var eventPostID = postid;

    pageNumber++;
    var str = '&col=' + col_val +'&key=' + title +'&location=' + location + '&event_date=' + date + '&topic=' + topic +'&business=' + business + '&excludePost=' + eventPostID + '&pageNumber=' + pageNumber + '&ppp=' + ppp + '&action=more_post_ajax';
    
    var result="";
    $.ajax({
        type: "POST",
        dataType: "json",
        url: ajax_posts.ajaxurl,
        data: str,
        success: function(data){
            var $data = $(data.result);

            if($data.length){

                $("#ajax-posts").append($data);
                
                if(data.count == pageNumber) {
                    $('#more_posts').attr("style", "display: none !important");
                }
            }
            else{
                $('#more_posts').attr("style", "display: none !important");
            }
        },
        error : function(jqXHR, textStatus, errorThrown) {
            $loader.html(jqXHR + " :: " + textStatus + " :: " + errorThrown);
        }

    });
    return false;
}

$("#more_posts").on("click",function(){ // When btn is pressed.
    var exclude = $('input[name=exclude_post]').val();
    
    var title = $('input[name=event_title]').val();
    var country = $('input[name=event_country]').val();
    var date = $('input[name=event_date]').val();
    
    var topic = $('input[name=topics]').val();
    var business = $('input[name=event_business]').val();
    
    $("#more_posts").attr("disabled",true); // Disable the button, temp.
      load_posts(exclude,title,country,date,topic,business);
  });

  
});  


