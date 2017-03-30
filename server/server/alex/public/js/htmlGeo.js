function geoFindMe() {
    var output = document.getElementById("out");

    if (!navigator.geolocation){
        output.innerHTML = "<p>Geolocation is not supported by your browser</p>";
        return;
    }

    function success(position) {
        var latitude  = position.coords.latitude;
        var longitude = position.coords.longitude;

               output.innerHTML = '<p>Latitude is ' + latitude + ' <br>Longitude is ' + longitude + '</p>';

               var img = new Image();
               img.src = "http://maps.googleapis.com/maps/api/staticmap?center=" + latitude + "," + longitude + "&zoom=13&size=300x300&sensor=false";

               output.appendChild(img);
    };

    function error() {
        output.innerHTML = "Unable to retrieve your location";
    };

    output.innerHTML = "<p>Locating…</p>";

    navigator.geolocation.getCurrentPosition(success, error);
}
$(document).ready(function(){})

//-----Submit Review-----//
    $(document).on('keyup','.restaurant_name',function(){})



//------------------------------------------------------------------------------------------------------------------------//





var latitude = '';
var longitude = '';
function geoFindMe() {
    var output = document.getElementById("out");
    navigator.geolocation.getCurrentPosition(success, error);

    if (!navigator.geolocation){
        // output.innerHTML = "<p>Geolocation is not supported by your browser</p>";
        return;
    }
    function success(position) {
        latitude  = position.coords.latitude;
        longitude = position.coords.longitude;
        // output.innerHTML = '<p>Latitude is ' + latitude + ' <br>Longitude is ' + longitude + '</p>';

        // var img = new Image();
        // img.src = "http://maps.googleapis.com/maps/api/staticmap?center=" + latitude + "," + longitude + "&zoom=13&size=300x300&sensor=false";

        // output.appendChild(img);
    };
    // console.log(latitude);
    function error() {
        // output.innerHTML = "Unable to retrieve your location";
    };

    // output.innerHTML = "<p>Locating…</p>";

}

$(document).on('click','.geo_location',function(){
    geoFindMe();
    var int = setInterval(function(){
        if(latitude!='' && longitude!=''){
            clearInterval(int);
        }
    },100);
})
// $(document).on('click','.home_page_sumbit',function() {
//
//     var distance = $.trim($(".search select[name='home_distance_search']").val());
//     var chain_rest = $(".checkbox input[type='checkbox']:checked").val()
//     console.log(distance);
//     console.log(distance);
//     var dist = [{distance: distance}];
//     var chains = [{chain_rest: chain_rest}];
//     var genInfo = [{city: city, dish: dish, dist: dist, chains: chains}]
//     $.ajaxSetup({
//         headers: {
//             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//         }
//     });
//
//     $.ajax({
//         url: '/homePageGeneralSearch',
//         dataType: 'json',
//         data: {genInfo: genInfo},
//         type: 'post',
//         success: function (result) {
//         }
//
//     });

// });



