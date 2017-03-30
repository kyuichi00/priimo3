@extends('layouts.app')
    @section('css')
    {!! Html::style(asset('css/home_page_tabs/home_page_tab.css')) !!}
    @stop

@section('content')
    <div class="container">
        <div class="page-header">
        </div>
        <div class="row">
            <div class="col-md-10">
                <div class="panel with-nav-tabs panel-primary">

                    @foreach($business as $busines)
                    <div class="panel-heading">
                        <h3>{{$busines->biz_name}}</h3>
                    </div>
                    <div class="panel-body">
                        <h4>{{$busines->biz_addr}}</h4>
                        <h4>{{$busines->biz_cityname}}</h4>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@stop
