$(document).ready(function(){

  //alert('test');

  initialize();

var geocoder;

if (navigator.geolocation) {
    //navigator.geolocation.getCurrentPosition(successFunction, errorFunction);
} 
//Get the latitude and the longitude;
function successFunction(position) {
    var lat = position.coords.latitude;
    var lng = position.coords.longitude;
    codeLatLng(lat, lng)
}

function errorFunction(){
    //alert("Geocoder failed");

    console.log("Geocoder failed");
}

function initialize() {
    geocoder = new google.maps.Geocoder();

  }
  var html =""
  
  
  function codeLatLng(lat, lng) {

    var latlng = new google.maps.LatLng(lat, lng);
    geocoder.geocode({'latLng': latlng}, function(results, status) {
      if (status == google.maps.GeocoderStatus.OK) {
      //console.log(results)
        if (results[1]) {
         //formatted address
         //alert(results[0].formatted_address)
          this.html = results[0].formatted_address;
         var curaddr = results[0].formatted_address;

        //find country name
             for (var i=0; i<results[0].address_components.length; i++) {
            for (var b=0;b<results[0].address_components[i].types.length;b++) {

            //there are different types that might hold a city admin_area_lvl_1 usually does in come cases looking for sublocality type will be more appropriate
                /*if (results[0].address_components[i].types[b] == "administrative_area_level_1") {
                    //this is the object you are looking for
                    city= results[0].address_components[i];
                    break;
                }*/

                if (results[0].address_components[i].types[b] == "locality") {
                    //this is the object you are looking for
                    city= results[0].address_components[i];
                    break;
                }
            }
        }
        //city data
        //alert(city.short_name + " - " + city.long_name)

        var cityname = city.long_name;
        
        getCurrentAddress(cityname); // ajax function call


       } else {
          //alert("No results found");
          console.log("No results found");
        }
      
      } 

      else {
        //alert("Geocoder failed due to: " + status);
        console.log(status);
      }
    });

  }


  function getCurrentAddress(name){

    var str = '&locality=' + name + '&action=userLocationAddress';

    $.ajax({
        type: "POST",
        dataType: "json",
        url: ajax_addr.ajaxurl,
        data: str,
        success: function(data){

          var resplace = data.result;
            
          jQuery(".select_loc").text(name);

          jQuery('input[name=journey_loc]').val(name);

            if(resplace == ''){ // if current location not in DB
                $('#current_addr').html('<p>Result Not found.</p>');
            }

            else{
              $('#current_addr').html(data.result);
            }

          $('#current_loc_map').html(data.map);

        }

    });

    return false;

  }


});