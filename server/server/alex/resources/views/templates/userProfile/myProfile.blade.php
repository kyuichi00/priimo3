@extends('layouts.app')


@section('content')
    <div class="wrapper wrapper-content">
        <div class="row animated fadeInRight">
            <div class="col-md-4">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Profile Detail</h5>
                    </div>
                    <div>
                        <div class="ibox-content no-padding border-left-right col-lg-4">
                            @if($user['user_avatar'] == null)
                                    <img src="{{asset('user_profile_pic//user.jpg')}}" class="img-responsive" alt="Cinque Terre">
                            @else
                                    <img src="{{asset('user_profile_pic/'.$user['user_avatar'])}}" class="img-responsive" alt="Cinque Terre">
                            @endif
                        </div>
                        <div class="ibox-content profile-content">
                            <h4><strong>{{$user['user_nickname']}}</strong></h4>
                            <div class="user-button">
                                <div class="row">
                                    <div class="col-md-6">
                                        <a href="/editMyProfile" class="btn btn-primary btn-sm btn-block" data="{{Auth::id()}}" style="color: #fff;">
                                            <i class="fa fa-edit"></i>
                                            Edit My Profile
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
        </div>
            <div class="row">
                <div class="col-lg-8">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>My Reviews</h5>
                        </div>
                        <div class="ibox-content">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>biz_name</th>
                                    <th>item_name</th>
                                    <th>item_comment</th>
                                    <th>item_rate</th>
                                    <th>Review Date</th>
                                </tr>
                                </thead>
                                @foreach($call  as $cal)
                                    <tbody>
                                    <tr>
                                        <td>{{$cal->biz_name}}</td>
                                        <td>{{$cal->item_name}}</td>
                                        <td>{{$cal->item_comment}}</td>
                                        <td>{{$cal->item_rate}}</td>
                                        <td>{{$cal->review_createdate}}</td>
                                    </tr>
                                    </tbody>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>My Friends </h5>
                        </div>
                        <div class="ibox-content">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>Firstname</th>
                                    <th>Lastname</th>
                                    <th>NickName</th>
                                    <th>Relation</th>
                                </tr>
                                </thead>
                                @foreach($allFriends as $allFriend)
                                    <tbody>
                                    <tr>
                                        <td>{{$allFriend->user_firstname}}</td>
                                        <td>{{$allFriend->user_lastname}}</td>
                                        <td>{{$allFriend->user_nickname}}</td>
                                        @if($allFriend->relations == 'Friend')
                                            <td><input type="button" class="btn btn-success"  value="{{$allFriend->relations}}"></td>
                                        @elseif($allFriend->relations == 'Confirm')
                                            <td><input type="button" class="btn btn-info profile_confirm" data-id="{{$allFriend->user_ID}}" value="{{$allFriend->relations}}"></td>
                                        @endif
                                    </tr>
                                    </tbody>
                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
