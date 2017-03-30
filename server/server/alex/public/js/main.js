$(document).ready(function(){
//--------Data Table ------////
    $('#example').DataTable();


//-----Submit Review-----//
$(document).on('keyup','.restaurant_name',function(){
    $(".rest_result").html('');

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var rest = $.trim($(".submit_review_info input[name='restaurant']").val());

    var url = '/submitReview/selectFeedback';

    searchAjax('restaurant', rest, url, function(result){
        $.each(result,function(index,value){
            var rest_result ="<tr>" +
                                  "<td class='restaurant_name' data-id="+value.biz_id+">"+value.biz_name+"</td>" +
                                  "<td class='restaurant_addr' style='border-left:3px solid red'>"+value.biz_addr+"</td>" +
                             "</tr>";
            $(".rest_result").append(rest_result);
        })
    });
});

$(document).on('keyup','.dish_name',function(){
    $(".rest_result").html('');

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    var dish = $.trim($(".submit_review_info input[name='dish']").val());

    var url = '/submitReview/selectFeedback';

    searchAjax('dish', dish, url, function(result){
        $.each(result,function(index,value){
            var rest_result ="<tr>" +
                                "<td class='dish_name' data-id="+value.item_id+">"+value.item_name+"</td>" +
                             "</tr>";
            $(".rest_result").append(rest_result);
        })

    });

});



//----- Fill input Value Comment part-----//
$(document).on('click','.rest_result .restaurant_name',function(){
    var rest_name = $(this).text();
    var rest_id = $(this).data('id');

    var rest_last_val = $.trim($(".submit_review_info input[name='restaurant']").val(rest_name));
    var rest_last_id = $.trim($(".submit_review_info input[name='review_biz_ID']").val(rest_id));

    $(".rest_result").html('');
});

$(document).on('click','.rest_result .dish_name',function(){
    var dish_name = $(this).text();
    var dish_id = $(this).data('id');

    var dish_last_val = $.trim($(".submit_review_info input[name='dish']").val(dish_name));
    var dish_last_id = $.trim($(".submit_review_info input[name='review_item_ID']").val(dish_id));

    $(".rest_result").html('');
});

$(document).on('click','.acidjs-rating-stars input[type="radio"]',function(){
   var star_val = $(this).prop('checked');
});


//----- Home page Search -----//
$(document).on('click','.tab',function(){

    $(".search input[name='home_city_search']").val('');
    $(".search input[name='home_dish_search']").val('');
    $(".search input[name='home_dish_search_tab2']").val('');
    $(".city_alert").addClass("hidden");
    $(".dish_alert").addClass("hidden");
    $(".home_danger_alert").addClass("hidden");
    $(".home_danger_submit").addClass("hidden");
    $(".search select[name='home_distance_search']").val(0.5);
})


$(document).on('keyup','.home_search_city',function(){
    $(".home_seatch_result").html('');

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var home_city = $.trim($(".home_search_city ").val());
    var url = '/home/searchInfo';

    searchAjax('cityHomePage', home_city, url, function(result) {
        if (result == '') {
           $(".city_alert").removeClass("hidden");
        }else {
            $(".city_alert").addClass("hidden");
        $.each(result, function (index, value) {
            var rest_result = "<tr>" +
                "<td class='city_name' data-id=" + value.city_ID + " data-lat=" + value.city_lat + " data-lng=" + value.city_lng + ">" + value.city_name + "</td>" +
                "<td style='border-left:3px solid red'>" + value.city_state + "</td>" +
                "</tr>";
            $(".home_seatch_result").append(rest_result);
        })
        }
    });
});
//-----Tab 1 Dish Keyup ----///

$(document).on('click','.tab',function() {
    $(".home_seatch_result").html('');
    $(".search .home_search_city").val('');
    $(".search .home_search_dish").val('');
});
    $(document).on('keyup','.home_search_dish',function(){
$(".home_seatch_result").html('');

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

    var home_dish = $.trim($(".home_search_dish ").val());
    var url = '/home/searchInfo';

    searchAjax('dishHomePage', home_dish, url, function(result){
        if (result == '') {
            $(".dish_alert").removeClass("hidden");
        }else {
            $(".dish_alert").addClass("hidden");
            $.each(result, function (index, value) {
                var rest_result = "<tr>" +
                    "<td class='home_dish_name' data-id='" + value.item_id + "' data-cat1='" + value.item_cat1ID + "'" +
                    "data-cat2='" + value.item_cat2ID + "'" +
                    "data-cat3='" + value.item_cat3ID + "'" +
                    "data-cat4='" + value.item_cat4ID + "'" +
                    "data-cat5='" + value.item_cat5ID + "'" +
                    ">" + value.item_name + "</td>" +
                    "</tr>";
                $(".home_seatch_result").append(rest_result);
            })
        }
    });
});
//-----Tab 2 Dish Keyup ----///
$(document).on('keyup','.home_search_dish_tab2',function(){
    $(".home_seatch_result").html('');

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var home_dish = $.trim($(".home_search_dish_tab2 ").val());
    var url = '/home/searchInfo';

    searchAjax('dishHomePage', home_dish, url, function(result){
        if (result == '') {
            $(".dish_alert").removeClass("hidden");
        }else {
            $(".dish_alert").addClass("hidden");
            $.each(result, function (index, value) {
                var rest_result = "<tr>" +
                    "<td class='home_dish_name' data-id='" + value.item_id + "' data-cat1='" + value.item_cat1ID + "'" +
                    "data-cat2='" + value.item_cat2ID + "'" +
                    "data-cat3='" + value.item_cat3ID + "'" +
                    "data-cat4='" + value.item_cat4ID + "'" +
                    "data-cat5='" + value.item_cat5ID + "'" +
                    ">" + value.item_name + "</td>" +
                    "</tr>";
                $(".home_seatch_result").append(rest_result);
            })
        }
    });
});
    var city ='';
    var dish = '';
$(document).on('click',' .city_name',function(){
     city_name = $(this).text();
     city_id = $(this).data('id');
     city_lat = $(this).data('lat');
     city_lng = $(this).data('lng');

        city = [{city_name:city_name,city_id:city_id,city_lat:city_lat,city_lng:city_lng}];
    var city_last_val = $.trim($(".search input[name='home_city_search']").val(city_name));

    $(".home_seatch_result").html('');
});

$(document).on('click',' .home_dish_name',function(){
     dish_home_name = $(this).text();
     dish_home_name_tab2 = $(this).text();
     // dish_home_name_tab2 = $(this).text();
     dish_id = $(this).data('id');
     dish_cat1ID = $(this).data('cat1');
     dish_cat2ID = $(this).data('cat2');
     dish_cat3ID = $(this).data('cat3');
     dish_cat4ID = $(this).data('cat4');
     dish_cat5ID = $(this).data('cat5');

         dish  = [{dish_id:dish_id,dish_home_name:dish_home_name,dish_cat1ID:dish_cat1ID,dish_cat2ID:dish_cat2ID,dish_cat3ID:dish_cat3ID,dish_cat4ID:dish_cat4ID,dish_cat5ID:dish_cat5ID}]
    var home_dish_last_val = $.trim($(".search input[name='home_dish_search']").val(dish_home_name));
    var home_dish_last_val = $.trim($(".search input[name='home_dish_search_tab2']").val(dish_home_name_tab2));

    $(".home_seatch_result").html('');
});



$(document).on('click','.home_page_sumbit',function(){
    $(".home_seatch_result").html('');

     var distance = $.trim($(".search select[name='home_distance_search']").val());
     var chain_rest =  $(".checkbox input[type='checkbox']:checked").val();
     var dist = [{distance:distance}];
     var chains = [{chain_rest:chain_rest}];
     var genInfo = [{city:city,dish:dish,dist:dist,chains:chains}]
    $(".sk-spinner-three-bounce").removeClass('hidden');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    var dish_name = $(".search input[name='home_dish_search']").val();
    $.ajax({
        url:'/homePageGeneralSearch',
        dataType: 'json',
        data:{genInfo:genInfo},
        type: 'post',
        success: function(result){

            $(".sk-spinner-three-bounce").addClass('hidden');
            if(result == 'no_result'){
                $(".home_danger_alert").removeClass('hidden');
            }else if(result == 'Empty_Row'){
                 $(".home_danger_submit").removeClass('hidden');
            }else{
                $(".home_danger_alert").addClass('hidden');
                $(".home_danger_submit").addClass('hidden');

                $.each(result.data,function(index,value){

                    if(value.review_rate == 1){
                        var item_rate = '<i class="fa fa-star first_star" aria-hidden="true"></i><i class="fa fa-star first_star" aria-hidden="true" style="background-color: #c1c1c1;"></i><i class="fa fa-star first_star" aria-hidden="true" style="background-color: #c1c1c1;"></i><i class="fa fa-star first_star" aria-hidden="true" style="background-color: #c1c1c1;"></i><i class="fa fa-star first_star" aria-hidden="true" style="background-color: #c1c1c1;"></i>'
                    }else if(value.review_rate == 2){
                        var item_rate ='<i class="fa fa-star first_star" aria-hidden="true"></i><i class="fa fa-star first_star" aria-hidden="true"></i><i class="fa fa-star first_star" aria-hidden="true" style="background-color: #c1c1c1;"></i><i class="fa fa-star first_star" aria-hidden="true" style="background-color: #c1c1c1;"></i><i class="fa fa-star first_star" aria-hidden="true" style="background-color: #c1c1c1;"></i>'
                    }else if(value.review_rate == 3){
                        var item_rate ='<i class="fa fa-star first_star" aria-hidden="true"></i><i class="fa fa-star first_star" aria-hidden="true"></i><i class="fa fa-star first_star" aria-hidden="true" ></i><i class="fa fa-star first_star" aria-hidden="true" style="background-color: #c1c1c1;"></i><i class="fa fa-star first_star" aria-hidden="true" style="background-color: #c1c1c1;"></i>'
                    }else if(value.review_rate == 4){
                        var item_rate ='<i class="fa fa-star first_star" aria-hidden="true"></i><i class="fa fa-star first_star" aria-hidden="true"></i><i class="fa fa-star first_star" aria-hidden="true" ></i><i class="fa fa-star first_star" aria-hidden="true" ></i><i class="fa fa-star first_star" aria-hidden="true" style="background-color: #c1c1c1;"></i>'
                    }else if(value.review_rate == 5){
                        var item_rate ='<i class="fa fa-star first_star" aria-hidden="true"></i><i class="fa fa-star first_star" aria-hidden="true"></i><i class="fa fa-star first_star" aria-hidden="true" ></i><i class="fa fa-star first_star" aria-hidden="true" ></i><i class="fa fa-star first_star" aria-hidden="true" ></i>'
                    }
                    if(result.info == 'cat1'){
                        var id = value.biz_id;
                        finaly_dist = Math.round(value.distance);
                        console.log(finaly_dist);
                    var home_page_result ='<div class="container col-lg-12" style="padding:0px;">'
                                                +'<div class="panel panel-default">'
                                                    +'<div class="panel-body" style="padding:10px;" >'
                                                        +'<div class="well col-xs-2" style="padding:0px;" >'
                                                            +'<img class="img-responsive" src="/panel/rest_img/20170208.PNG" alt="">'
                                                        +'</div>'
                                                        +'<div class="panel-body col-xs-10" style="padding:0px;border: transparent;">'
                                                            +'<div class="col-sm-6" style="line-height: 32px;">'
                                                                +'<div>'+value.BIZ+'</div>'
                                                                +'<div>'
                                                                    +'<span>'+item_rate+'</span>'
                                                                    +'<br>'
                                                                    +'<span>'+finaly_dist+' miles from you</span>'
                                                                +'</div>'
                                                                +'<div>'+dish_name+'</div>'
                                                            +'</div>'
                                                                +'<div class="pull-right col-sm-6" style="line-height: 32px;">'+value.biz_addr+'<br>'+value.biz_cityname+'</div>'
                                                        +'</div>'
                                                        +'<div class="panel-body col-xs-12 pull-left" style="padding-top:5px;border: transparent;border-radius:0px;border-top: 1px solid #d9d9d9;">'
                                                            +'<div class="col-xs-1 pull-left" style="padding:0px;">'
                                                                +'<img class="img-responsive" src="/panel/rest_img/201702080.83191100 1486547973.jpg" alt="">'
                                                            +'</div>'
                                                            +'<div class="text_dote col-xs-10">'+value.item_comment+'</div>'
                                                            +'<a href="restaurantPage/'+id+'" class="pull-right">More info...</a>'
                                                        +'</div>'
                                                    +'</div>'
                                                +'</div>'
                                            +'</div>';
                    }


                    $(".home_seatch_result").append(home_page_result);
                })
            }
        }
    });
});

//------ User Geolocation -----//
var latitude = '';
var longitude = '';
function geoFindMe() {
    var output = document.getElementById("out");

    if (!navigator.geolocation){
        return;
    }

    function success(position) {
        latitude  = position.coords.latitude;
        longitude = position.coords.longitude;
    };

    function error() {
        // output.innerHTML = "Unable to retrieve your location";
    };
    navigator.geolocation.getCurrentPosition(success, error);

}

$(document).on('click','.geo_location',function(){
    geoFindMe();
    var int = setInterval(function(){
        if(latitude!='' && longitude!=''){
            clearInterval(int);
        }
    },100);
});
$(document).on('click','.home_page_sumbit_tab2',function() {

    var distance = $.trim($(".search select[name='home_distance_search']").val());
    var chain_rest = $(".checkbox input[type='checkbox']:checked").val();
    var lat = latitude;

    var long = longitude;
    var dish_tab2 = dish;

    var dist = [{distance: distance}];
    var chains = [{chain_rest: chain_rest}];
    var user_lat =[{lat:lat}]
    var user_lng =[{long:long}]
    var genInfo_tab2 = [{dish: dish, dist: dist, chains: chains,user_lat:user_lat,user_lng:user_lng}]

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    var dish_name = $(".search input[name='home_dish_search']").val();
    $.ajax({
        url: '/homePageGeneralSearch_tab2',
        dataType: 'json',
        data: {genInfo_tab2:genInfo_tab2},
        type: 'post',

        success: function(result){
            $(".sk-spinner-three-bounce").addClass('hidden');
            // console.log(result);
            if(result == 'no_result'){
                $(".home_danger_alert").removeClass('hidden');
            }else if(result == 'Empty_Row'){
                $(".home_danger_submit").removeClass('hidden');
            }else{
                $(".home_danger_alert").addClass('hidden');
                $(".home_danger_submit").addClass('hidden');

                $.each(result.data,function(index,value){
                    if(value.review_rate == 1){
                        var item_rate = '<i class="fa fa-star first_star" aria-hidden="true"></i><i class="fa fa-star first_star" aria-hidden="true" style="background-color: #c1c1c1;"></i><i class="fa fa-star first_star" aria-hidden="true" style="background-color: #c1c1c1;"></i><i class="fa fa-star first_star" aria-hidden="true" style="background-color: #c1c1c1;"></i><i class="fa fa-star first_star" aria-hidden="true" style="background-color: #c1c1c1;"></i>'
                    }else if(value.review_rate == 2){
                        var item_rate ='<i class="fa fa-star first_star" aria-hidden="true"></i><i class="fa fa-star first_star" aria-hidden="true"></i><i class="fa fa-star first_star" aria-hidden="true" style="background-color: #c1c1c1;"></i><i class="fa fa-star first_star" aria-hidden="true" style="background-color: #c1c1c1;"></i><i class="fa fa-star first_star" aria-hidden="true" style="background-color: #c1c1c1;"></i>'
                    }else if(value.review_rate == 3){
                        var item_rate ='<i class="fa fa-star first_star" aria-hidden="true"></i><i class="fa fa-star first_star" aria-hidden="true"></i><i class="fa fa-star first_star" aria-hidden="true" ></i><i class="fa fa-star first_star" aria-hidden="true" style="background-color: #c1c1c1;"></i><i class="fa fa-star first_star" aria-hidden="true" style="background-color: #c1c1c1;"></i>'
                    }else if(value.review_rate == 4){
                        var item_rate ='<i class="fa fa-star first_star" aria-hidden="true"></i><i class="fa fa-star first_star" aria-hidden="true"></i><i class="fa fa-star first_star" aria-hidden="true" ></i><i class="fa fa-star first_star" aria-hidden="true" ></i><i class="fa fa-star first_star" aria-hidden="true" style="background-color: #c1c1c1;"></i>'
                    }else if(value.review_rate == 5){
                        var item_rate ='<i class="fa fa-star first_star" aria-hidden="true"></i><i class="fa fa-star first_star" aria-hidden="true"></i><i class="fa fa-star first_star" aria-hidden="true" ></i><i class="fa fa-star first_star" aria-hidden="true" ></i><i class="fa fa-star first_star" aria-hidden="true" ></i>'
                    }
                    if(result.info == 'cat1'){
                        var id = value.biz_id;
                        var home_page_result ='<div class="container col-lg-12" style="padding:0px;">'
                            +'<div class="panel panel-default">'
                            +'<div class="panel-body" style="padding:10px;" >'
                            +'<div class="well col-xs-2" style="padding:0px;" >'
                            +'<img class="img-responsive" src="/panel/rest_img/20170208.PNG" alt="">'
                            +'</div>'
                            +'<div class="panel-body col-xs-10" style="padding:0px;border: transparent;">'
                            +'<div class="col-sm-6" style="line-height: 32px;">'
                            +'<div>'+value.BIZ+'</div>'
                            +'<div>'
                            +'<span>'+item_rate+'</span>'
                            +'<span></span>'
                            +'</div>'
                            +'<div>'+dish_name+'</div>'
                            +'</div>'
                            +'<div class="pull-right col-sm-6" style="line-height: 32px;">'+value.biz_addr+'<br>'+value.biz_cityname+'</div>'
                            +'</div>'
                            +'<div class="panel-body col-xs-12 pull-left" style="padding-top:5px;border: transparent;border-radius:0px;border-top: 1px solid #d9d9d9;">'
                            +'<div class="col-xs-1 pull-left" style="padding:0px;">'
                            +'<img class="img-responsive" src="/panel/rest_img/201702080.83191100 1486547973.jpg" alt="">'
                            +'</div>'
                            +'<div class="text_dote col-xs-10">'+value.item_comment+'</div>'
                            +'<a href="restaurantPage/'+id+'" class="pull-right">More info...</a>'
                            +'</div>'
                            +'</div>'
                            +'</div>'
                            +'</div>';
                    }

                    $(".home_seatch_result").append(home_page_result);
                })
            }
        }

    });

});



//----Find Friends ----//
$(document).on('keyup','.find_friends',function() {
    $('.findfirends_result').html('');
    var friends = $.trim($(".friends input[name='find_friends']").val());
    if (friends == '')
        return false;

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        if (typeof(xhr) != "undefined") {
            xhr.abort();
        } else {
            window.xhr = undefined;
        }
        xhr = $.ajax({
            url: '/findFriends',
            dataType: 'json',
            data: {friends: friends},
            type: 'post',
            success: function (result) {
                if(result == ''){
                    $(".no_friends").removeClass('hidden')
                }else{
                    $(".no_friends").addClass('hidden');
                    $.each(result, function (index, value) {
                        var rest_result = "<tr>" +
                            "<td class='find_frineds_name'>" + value.user_nickname + "</td>" +
                            "<td class='find_frineds_name'>" + value.user_firstname + "</td>" +
                            "<td class='find_frineds_name'>" + value.user_lastname + "</td>";
                        if (value.rel == 'Friend') {
                            rest_result += "<td class='find_frineds_name'><input type='button' value='Friends' class='btn btn-success friend_request' data-id=" + value.user_ID + "></td>"
                        } else if (value.rel == 'Sent') {
                            rest_result += "<td class='find_frineds_name'><input type='button' value='Request Sent' class='btn btn-warning friend_request' data-id=" + value.user_ID + "></td>"
                        } else if (value.rel == 'Confirm') {
                            rest_result += "<td class='find_frineds_name'><input type='button' value='Confirm' class='btn btn-info friend_request' data-id=" + value.user_ID + "></td>"
                        } else if (value.rel == undefined) {
                            rest_result += "<td class='find_frineds_name'><input type='button' value='Add Friend' class='btn btn-danger friend_request' data-id=" + value.user_ID + "></td>"
                        }
                        "</tr>";
                        $(".findfirends_result").append(rest_result);
                    })
                }
            }
        });
});
$(document).on('click','.friend_request',function(){
    var this_button = $(this);
   var friend_id = $(this).data('id');
   var friend_request_val = $(this).val();
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url:'/sendFriendRequest',
        dataType: 'json',
        data:{friend_id :friend_id,friend_request_val:friend_request_val},
        type: 'post',
        success: function(result){
            if(result == 'no_user'){
                $(".friends_page_alert").removeClass('hidden')
            }else if(result == 'Friend'){
                $(".friends_page_alert").removeClass('hidden')
                $(".friends_page_alert").text("You are already Friends !!!")
            }else if(result == 'Waiting'){
                $(".friends_page_alert").removeClass('hidden')
                $(".friends_page_alert").text("Your Request are already sent !!!")
            }else if(result == 'Confirm'){
                $(".friends_page_alert").removeClass('hidden')
                $(".friends_page_alert").text("Now You are Friends !!!")
                this_button.val('Friend');
                this_button.removeClass('btn-info');
                this_button.addClass('btn-success');
            }else if(result == 'Add_Friend'){
                $(".friends_page_alert").removeClass('hidden')
                $(".friends_page_alert").text("Request sent !!!")
                    this_button.val('Request Send');
                    this_button.removeClass('btn-danger');
                    this_button.addClass('btn-warning');
            }
        }
    });
});
    $(document).on('click','.profile_confirm',function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var this_button = $(this);

        var friend_id = $(this).data('id');
        var friend_request_val = $(this).val();
            console.log(friend_request_val);
        $.ajax({
            url:'/myProfileRequestAccept',
            dataType: 'json',
            data:{friend_id :friend_id,friend_request_val:friend_request_val},
            type: 'post',
            success: function(result){
                if(result == 'no_user'){
                    $(".friends_page_alert").removeClass('hidden')
                }else if(result == 'Friend'){
                    $(".friends_page_alert").removeClass('hidden')
                    $(".friends_page_alert").text("You are already Friends !!!")
                }else if(result == 'Waiting'){
                    $(".friends_page_alert").removeClass('hidden')
                    $(".friends_page_alert").text("Your Request are already sent !!!")
                }else if(result == 'Confirm'){
                    $(".friends_page_alert").removeClass('hidden')
                    $(".friends_page_alert").text("Now You are Friends !!!")
                    this_button.val('Friend');
                    this_button.removeClass('btn-info');
                    this_button.addClass('btn-success');
                }else if(result == 'Add_Friend'){
                    $(".friends_page_alert").removeClass('hidden')
                    $(".friends_page_alert").text("Request sent !!!")
                    this_button.val('Request Send');
                    this_button.removeClass('btn-danger');
                    this_button.addClass('btn-warning');
                }
            }
        });
    });
$(document).on('click','.finger',function(){
    var this_button = $(this);
        var finger = $(this).attr('data');
        $(this).attr('data','');
        var comm_id = $(this).attr('data-comm');
        var like_id = $(this).attr('data-like-id');
        var rev_user_id = $(this).attr('data-rev-user');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url:'/submitReview/reviewLikes',
        dataType: 'json',
        data:{finger:finger,comm_id:comm_id,rev_user_id:rev_user_id,like_id:like_id},
        type: 'post',
        success: function(result) {
            console.log(result);
            if(result['msg']=='liked') {
                this_button.css("color", "#06b506");
                this_button.attr('data','already_liked');
                this_button.attr('data-like-id',result['like_id']);
            }else if (result['msg']=='disliked') {
                this_button.css("color", "#333");
                this_button.attr('data','up');
            }else if(result['msg']=='likedAgain') {
                this_button.css("color", "#06b506");
                this_button.attr('data','already_liked');
            }
        }
    });

});
$(document).on('keyup','.gallery_restaurant_name',function(){
    $(".rest_result").html('');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var gallery_rest_name = $.trim($(".gallery input[name='rest']").val());
    if(gallery_rest_name == ''){
        return false;
    }
    $.ajax({
        url: '/gallery/selectRestaurant',
        dataType: 'json',
        data: {gallery_rest_name: gallery_rest_name},
        type: 'post',
        success: function(result) {
            $.each(result,function(index,value){
                var rest_result ="<tr>" +
                    "<td class='gal_restaurant_name' data-id="+value.biz_id+">"+value.biz_name+"</td>" +
                    "<td class='restaurant_addr' style='border-left:3px solid red'>"+value.biz_addr+"</td>" +
                    "</tr>";
                $(".gall_result").append(rest_result);
            })
        }
    });
});
$(document).on('click','.gall_result .gal_restaurant_name',function(){
    var rest_name = $(this).text();
    var rest_id = $(this).data('id');

    var rest_last_val = $.trim($(".gallery input[name='rest']").val(rest_name));
    var rest_last_id = $.trim($(".gallery input[name='biz_ID']").val(rest_id));

    $(".gall_result").html('');
});














});
//---- Ajax Search fucntion for Submit review ----//

function searchAjax(type, key, url, callback){

    if(key == '' || type == ''){
        return false;
    }

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    if(typeof(xhr) != "undefined"){
        xhr.abort();
    }else{
        window.xhr = undefined;
    }

    xhr = $.ajax({
        url:url,
        dataType: 'json',
        data:{key : key, type: type},
        type: 'post',
        success: function(result){
            if(typeof(callback) == "function"){
                callback(result);
            }
        }
    });
}


