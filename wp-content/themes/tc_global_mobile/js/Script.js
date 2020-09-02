$(document).ready(function(){
    /**
     * range slider initialize
     */
    function initSlider() {
        $("#range-control").rangeslider({
            polyfill: false,
            rangeClass: 'rangeslider',
            disabledClass: 'rangeslider--disabled',
            horizontalClass: 'rangeslider--horizontal',
            verticalClass: 'rangeslider--vertical',
            fillClass: 'rangeslider__fill',
            handleClass: 'rangeslider__handle',
            onInit: function () { },
            onSlide: function (position, value) { },
            onSlideEnd: function (position, value) {
                $('#feesRange').val(value);
                $('.range-value').html(value);
            }
        }); 
    }
    // initSlider();
    
  
    /**
     * stydy level on change ajax call for tution fee
     */
    $('#studyLevel').change(function () {
        //Selected value
        var inputValue = $(this).val();
        $('#range-control').attr('min', 20).change();
        $('#range-control').rangeslider('destroy');
        initSlider();
        var url ='api/statesList';
        //Ajax for calling php function
        $.ajax({
            type: 'GET',
            url: url,
            success: function (data) {
               console.log('data',data)
            }
        });
    });

    /**
     * to initialize map in university page 
     */
    function initMap() {
        var lat = $('#lat').val();
        var lng=$('#lng').val();
        var uluru = { lat: parseFloat(lat), lng: parseFloat(lng) };
        var map = new google.maps.Map(
            document.getElementById('map'), { zoom: 7, center: uluru, zoomControl: false,
            mapTypeControl: false,
            scaleControl: false,
            streetViewControl: false,
            rotateControl: false,
            fullscreenControl: false });
        var marker = new google.maps.Marker({ position: uluru, map: map });
    }
    var pathName = window.location.pathname;
    if (pathName === '/universitydetail/' || pathName === '/universitydetail'){
        initMap();
    }

    $('#showlist').change(function () {
        $('#searchForm').submit();
    });
    $('#sortBy').change(function () {
        $('#searchForm').submit();
    });
    $('#topsearch').on('click',function () {
        $('#searchForm').submit();
    });
    $('#morefilter').on('click', function () {
        $('#searchForm').submit();
    });
    
    var rangeMax = $('#range-max-value').text();
    var rangeMaxSelected = $('#feesrangeselectedMax').text();
    var rangeMinSelected = $('#feesrangeselectedMin').text();

    $(".js-range-slider").ionRangeSlider({
        skin: "round",
        type: "double",
        grid: true,
        min: 0,
        max: rangeMax,
        from: rangeMinSelected,
        to: parseFloat(rangeMaxSelected) === 0 ? rangeMax : rangeMaxSelected,
        prefix: "$"
    });
    if (pathName === '/search-tool/' || pathName === '/search-tool') {
        $('html, body').animate({
            scrollTop: $(".search-form-fields").offset().top
        }, 2000);
    }

   
}); 

