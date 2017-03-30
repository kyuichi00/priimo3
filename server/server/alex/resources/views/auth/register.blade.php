@extends('layouts.app')

@section('content')
    <div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Register</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
                        {{ csrf_field()}}

                        {{--<div class="form-group{{ $errors->has('user_firstname') ? ' has-error' : '' }}">--}}
                            {{--<label for="user_firstname" class="col-md-4 control-label">Name</label>--}}

                            {{--<div class="col-md-6">--}}
                                {{--<input id="user_firstname" type="text" class="form-control" name="user_firstname" value="{{ old('user_firstname') }}" required autofocus>--}}

                                {{--@if ($errors->has('user_firstname'))--}}
                                    {{--<span class="help-block">--}}
                                        {{--<strong>{{ $errors->first('user_firstname') }}</strong>--}}
                                    {{--</span>--}}
                                {{--@endif--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="form-group{{ $errors->has('user_lastname') ? ' has-error' : '' }}">--}}
                            {{--<label for="user_lastname" class="col-md-4 control-label">Surname</label>--}}

                            {{--<div class="col-md-6">--}}
                                {{--<input id="user_lastname" type="text" class="form-control" name="user_lastname" value="{{ old('user_lastname') }}" required>--}}

                                {{--@if ($errors->has('user_lastname'))--}}
                                    {{--<span class="help-block">--}}
                                        {{--<strong>{{ $errors->first('user_lastname') }}</strong>--}}
                                    {{--</span>--}}
                                {{--@endif--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        <div class="form-group{{ $errors->has('user_nickname') ? ' has-error' : '' }}">
                            <label for="user_nickname" class="col-md-4 control-label">Username</label>

                            <div class="col-md-6">
                                <input id="user_nickname" type="text" class="form-control" name="user_nickname" value="{{ old('user_nickname') }}" required>

                                @if ($errors->has('user_nickname'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('user_nickname') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('user_email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="user_email" type="email" class="form-control" name="user_email" value="{{ old('user_email') }}" required>

                                @if ($errors->has('user_email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('user_email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>   <div class="form-group{{ $errors->has('user_zip') ? ' has-error' : '' }}">
                            <label for="user_zip" class="col-md-4 control-label">Zip Code</label>

                            <div class="col-md-6">
                                <input id="user_zip" type="number" class="form-control" name="user_zip" value="{{ old('user_zip') }}" required>

                                @if ($errors->has('user_zip'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('user_zip') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>

                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Register
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
