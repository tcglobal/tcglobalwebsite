
$(document).ready(function(){

function getLocationDetail(id){

    var str = '&locationID=' + id + '&action=fetch_userLocation';

    $.ajax({
        type: "POST",
        dataType: "json",
        url: schedule_map.ajaxurl,
        data: str,
        success: function(data){
            
            var branchName = data.branch;
            var resaddr = data.result;
            var resloc = data.map;

            //console.log(resaddr);
            jQuery('input[name=schjourney_loc]').val(branchName); // assign location branch name
            jQuery('#meeting_addr').html(resaddr);
            jQuery('.user-location-detail').html(resaddr);
            jQuery('#current_meeting_map').html(resloc);

        },
        error : function(jqXHR, textStatus, errorThrown) {
            $loader.html(jqXHR + " :: " + textStatus + " :: " + errorThrown);
        }

    });

    return false;
            
}

jQuery(".schuser_loc_show ul li").click(function() {
    var selplace = $(this).text();
    var placeid = $(this).attr('id');
    
    jQuery(".schuser_loc").text(selplace);
    jQuery('input[name=schjourney_loc]').val(selplace); // assign value to hidden input
    jQuery('input[name=selectloc_field]').val(selplace); // assign value to hidden input
    $(".schuser_loc").removeClass("error");
    jQuery('.schuser_loc_show').hide();

    getLocationDetail(placeid); // ajax function call

    });

});  


