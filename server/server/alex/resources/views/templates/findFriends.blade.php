@extends('layouts.app')
@section('content')

    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading">Find Your Friends</div>
            <div class="panel-body">
                <div class="friends">
                    <input type="text" name="find_friends" class="form-control find_friends" placeholder="Find Friends" >
                </div>
                <div class="panel-heading col-md-12" >
                    <div class="alert alert-danger friends_page_alert hidden">
                        Sorry! You must register to send Friend request!!!
                    </div>
                    <div class="alert alert-danger no_friends hidden">
                        Sorry!<strong> There is no user with that name!!!</strong>
                    </div>
                </div>
                <div class="panel-body" style="height: 300px; overflow-x: hidden; ">
                    <table class="findfirends_result">
                    </table>
                </div>
            </div>
        </div>
    </div>


@stop
