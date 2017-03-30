<?php

Auth::routes();


Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index');
Route::post('/home/searchInfo', 'HomeController@searchInfo');
Route::post('/homePageGeneralSearch','HomeController@GeneralSearchByCityAndDish');
Route::post('/homePageGeneralSearch_tab2','HomeController@GeneralSearchByCityAndDish_tab2');

//Restaurant
Route::get('/restaurantPage/{biz_id}','RestaurantController@index');

Route::group(['middleware' => 'auth'], function () {
//Profile
    Route::get('/myProfile', 'MyProfileController@index');
    Route::post('/myProfile', 'MyProfileController@index');
    Route::post('/myProfileRequestAccept',   'MyProfileController@acceptFriendRequest');
    Route::get('/editMyProfile', 'MyProfileController@selectUser');
    Route::post('/editMyProfile', 'MyProfileController@editUser');
//Review
    Route::get('/submitReview', 'SubmitReviewController@index');
    Route::post('/submitReview/selectFeedback', 'SubmitReviewController@selectFeedback');
    Route::post('/submitReview/insertFeedback', 'SubmitReviewController@insertFeedback');
    Route::post('/submitReview/reviewLikes', 'SubmitReviewController@reviewLikes');


//Find Friends
    Route::get('/findFriends','FindFriendsController@index');
    Route::post('/findFriends','FindFriendsController@findFriends');
    Route::post('/sendFriendRequest','FindFriendsController@acceptFriendRequest');

//Find Friends
    Route::get('/gallery','GalleryController@index');
    Route::post('/gallery/selectRestaurant','GalleryController@selectRestaurantForGallery');
    Route::post('/gallery/uploadImg','GalleryController@uploadGalleryImg');
});

