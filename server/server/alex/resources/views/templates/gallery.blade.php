@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="panel panel-primary">
            <div class="panel-heading">Choose Restaurant & Upload Impressions</div>
            <div class="panel-body">
                <div class="col-md-4">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            {{ Form::open(['url' => '/gallery/uploadImg', 'method' => 'post', 'files' => true]) }}
                            <div class=" form-group col-lg-12">
                                @if (session('success'))
                                    <div class="alert alert-success">
                                        <strong>{{ session('success') }}</strong>
                                    </div>
                                @elseif(session('error'))
                                    <div class="alert alert-danger">
                                        <strong>{{ session('error') }}</strong>
                                    </div>
                                @endif
                                <div class="col-lg-12">
                                    <div class="input-group gallery gallery_restaurant_name">
                                        {{ Form::text('rest',null,array('placeholder'=>'Restaurant','class'=>'form-control ')) }}
                                        {{ Form::hidden('biz_ID',null,array('class'=>'form-control ')) }}
                                    </div>
                                </div>
                            </div>
                            <div class="form-group {{ $errors->has('files') ? ' has-error' : '' }}">
                                <div class=" form-group     col-lg-12">
                                    <input id="" type="file" class="form-control col-md-4 "  name="files[]" multiple/>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-info col-xs-4">Push</button>
                            {{ Form::close() }}
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="panel panel-default">
                        <div class="panel-heading">result</div>
                        <div class="panel-body" style="height: 300px; overflow-x: hidden; ">
                            <table class="gall_result">

                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel panel-success">
            <div class="panel-heading">Gallery</div>
            <div class="panel-body"style="overflow-x: hidden;height: 400px;">
                    <div class="wrapper wrapper-content">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="ibox float-e-margins">

                                    <div class="ibox-content">
                                        <div class="lightBoxGallery">

                                            @foreach($images as $image)
                                            <div class="col-md-2" >
                                                 <img src="{{$image->rest_img}}" width="100%" height="150px" style=" border:1px solid black;"></a>
                                                 <span><a href="restaurantPage/{{$image->biz_id}}">{{$image->business_name}}</a></span>
                                            </div>
                                                @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
@endsection

