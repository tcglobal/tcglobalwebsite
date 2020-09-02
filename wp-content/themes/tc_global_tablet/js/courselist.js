
$(document).ready(function(){


function load_course(key){
    
    var str = {
        action: 'CourseListFilter',
        whatever: key
    };
    
    //console.log(str);

    $.ajax({
        type: "POST",
        //dataType: "json",
        url: area_posts.ajaxurl,
        data: str,
        success: function(response){
            
            console.log(response);

            $("#specialization").html(response);

        },
        error : function(jqXHR, textStatus, errorThrown) {
            $loader.html(jqXHR + " :: " + textStatus + " :: " + errorThrown);
        }

    });

    return false;
}

$('#areaOfStudy').change(function(){

    var selAreaOfStudy = $("#areaOfStudy").select2("val"); //get selected Area of study value

    /** remove selected specialization, country, study lavel field value on level 1 filter - if onchange the AOS **/
    
    var $multiSelectOptions = $('#specialization option');
    $multiSelectOptions.each(function(index, element) {
        element.remove();
    });
    

    studyVal = selAreaOfStudy.toString();

    load_course(studyVal);
    
    });

});  


