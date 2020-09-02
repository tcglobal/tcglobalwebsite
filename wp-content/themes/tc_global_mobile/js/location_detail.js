
$(document).ready(function(){

function getLocationDetail(id){

    var str = '&locationID=' + id + '&action=fetch_userLocation';

    $.ajax({
        type: "POST",
        dataType: "json",
        url: ajax_loc.ajaxurl,
        data: str,
        success: function(data){
            //var $data = $(data.result);
            var uaddr = data.result;
            var locaddr = data.map;

            $('#current_addr').html(uaddr);
            //$('#map-location').html(locaddr); 

        },
        error : function(jqXHR, textStatus, errorThrown) {
            $loader.html(jqXHR + " :: " + textStatus + " :: " + errorThrown);
        }

    });

    return false;
            
}

jQuery(".select_loc_show ul li").click(function() {
    var location = $(this).text();
    var locid = $(this).attr('id');
    
    jQuery(".select_loc").text(location);
    jQuery('input[name=journey_loc]').val(location); // assign value to hidden input
    jQuery('input[name=journeyloc_field]').val(location);
    $(".select_loc").removeClass("error");
    jQuery('.select_loc_show').hide();

    getLocationDetail(locid); // ajax function call

    });

});  


