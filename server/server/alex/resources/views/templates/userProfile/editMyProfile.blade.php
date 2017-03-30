@extends('layouts.app')
@section('content')
    <div class="container">
        <h1>Edit Profile</h1>
        <hr>
        <form class="form-horizontal" role="form" method="POST" action="{{ url('/editMyProfile') }}"  enctype="multipart/form-data">
            {{ csrf_field()}}
            <div class="row">
                <div class="col-md-3">
                    <div class="text-center">
                        <div class="ibox-content no-padding border-left-right col-lg-4">
                            @if($user['user_avatar'] == null)
                                <img src="{{asset('user_profile_pic/user.jpg')}}" class="img-rounded" alt="" width="250">
                            @else
                                <img src="{{asset('user_profile_pic/'.$user['user_avatar'])}}" class="img-rounded" alt="Cinque Terre" width="250">
                            @endif
                        </div>
                        <div class="form-group {{ $errors->has('user_avatar') ? ' has-error' : '' }}">
                            <label for="user_avatar" class="col-md-4 control-label"></label>
                            <div class="col-md-8">
                                <input id="user_avatar" type="file" class="form-control col-md-4 "  name="user_avatar" >
                                @if ($errors->has('user_avatar'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('user_avatar') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-9 personal-info">
                    <div class="form-group{{ $errors->has('user_nickname') ? ' has-error' : '' }}">
                        <input type="hidden" id="user_id" name="user_ID" value="{{Auth::id()}}"/>
                        <label for="user_nickname" class="col-md-4 control-label">Username</label>
                        <div class="col-md-6">
                            <input id="user_nickname" type="text" class="form-control" name="user_nickname" value="{{$user['user_nickname']}}" required >
                            @if ($errors->has('user_nickname'))
                                <span class="help-block">
                            <strong>{{ $errors->first('user_nickname') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <input type="submit" class="btn btn-success edit" value="Update my profile" data="{{Auth::id()}}" style=" float:right;">
                </div>
            </div>
        </form>
    </div>
@endsection
