<?php /* Template Name: searchlisttemplateapi */ ?>
    <?php get_header();  ?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <script>
 function callapirecords()
  {
    var countryval = "United Kingdom";
    console.log('countryresponse', countryval);  
                 $.ajax({  
                     url: 'http://13.235.4.44/client_api/program_data/v1.0/',  
                     type: 'POST',  
                     headers: {
                      "Authorization": "Token 08e128cafdeef5d79ef0bd2ae30ccebfea888564",
                      "Content-Type" :"application/json"
                         },
                     data: {
                      country_name: countryval,
                     
                      }, 
                      success: function (data) {  
                         console.log('countryresponse', data);  
                    },  
    });
  }
  callapirecords();
 </script>




<?php get_footer(); ?>