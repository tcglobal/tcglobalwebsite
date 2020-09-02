
$(document).ready(function(){

function getUserPlace(id){

    var str = '&locationID=' + id + '&action=fetch_userLocation';

    $.ajax({
        type: "POST",
        dataType: "json",
        url: UserChoice.ajaxurl,
        data: str,
        success: function(data){
            
            var branchName = data.branch;
            var resaddr = data.result;
            var resloc = data.map;

            //console.log(resaddr);
            jQuery('input[name=usermeetingplace]').val(branchName); // assign location branch name
            jQuery('#schedulemeeting_addr').html(resaddr);
            jQuery('#schedulemeeting_map').html(resloc);

        },
        error : function(jqXHR, textStatus, errorThrown) {
            $loader.html(jqXHR + " :: " + textStatus + " :: " + errorThrown);
        }

    });

    return false;
            
}

jQuery(".meetuser_loc_list ul li").click(function() {
    var selplace = $(this).text();
    var placeid = $(this).attr('id');
    
    jQuery(".meetuser_loc").text(selplace);
    jQuery('input[name=usermeetingplace]').val(selplace); // assign value to hidden input
    jQuery('input[name=meetingplace_field]').val(selplace); // assign value to hidden input
    $(".meetuser_loc").removeClass("error");
    jQuery('.meetuser_loc_list').hide();

    getUserPlace(placeid); // ajax function call

    });

});  


