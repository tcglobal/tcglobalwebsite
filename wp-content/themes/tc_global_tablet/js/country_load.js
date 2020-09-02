
$(document).ready(function(){

var ppp = 100; // Post per page
var pageNumber = 0;
var col_val = 'col-sm-6';
var type = 'tab';

function loadMoreCountry(id){
    
    pageNumber++;

    var poststr = '&col=' + col_val + '&type=' + type + '&excludeCountryPage=' + id + '&pageNumber=' + pageNumber + '&ppp=' + ppp + '&action=country_post_ajax';

    $.ajax({
        type: "POST",
        dataType: "json",
        url: CountryData.ajaxurl,
        data: poststr,
        success: function(data){
            
            var $data = $(data.result);
            
            if($data.length){

                $("#country_post").append($data);
                
                if(data.count == pageNumber) {
                    $('#loadCountryPage').attr("style", "display: none !important");
                }
            } 
            else{
                
                $('#loadCountryPage').attr("style", "display: none !important");
            }
        },
        error : function(jqXHR, textStatus, errorThrown) {
            $loader.html(jqXHR + " :: " + textStatus + " :: " + errorThrown);
        }

    });
    return false;
}

$("#loadCountryPage").on("click",function(){ // When btn is pressed.

    var id = $('input[name=exclude_page]').val();
    
    $("#loadCountryPage").attr("disabled",true); // Disable the button, temp.
      loadMoreCountry(id);
    });

});  


