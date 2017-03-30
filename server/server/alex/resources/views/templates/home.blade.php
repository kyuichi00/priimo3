@extends('layouts.app')
    @section('css')
        {!! Html::style(asset('css/home_page_tabs/home_page_tab.css')) !!}
    @stop
@section('content')
    <div class="wrapper wrapper-content animated fadeIn">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Find the restaurant you need</h5>
                    </div>
                    <div class="ibox-content">
                        <div class="col-lg-6">
                            <div class="tabs-container">
                                <ul class="nav nav-tabs">
                                    <li class="active tab"><a data-toggle="tab" href="#tab-3" aria-expanded="true">Search By City</a></li>
                                    <li class="tab geo_location"><a data-toggle="tab" href="#tab-4" aria-expanded="false">Search by Current place</a></li>
                                </ul>
                                <div class="tab-content">
                                    <div id="tab-3" class="tab-pane active">
                                        <div class="panel-body">
                                            <div class="alert alert-danger city_alert hidden">
                                                <strong>Sorry</strong> but there aren't any cities with this letter(s).
                                            </div>
                                            <div class="alert alert-danger dish_alert hidden">
                                                <strong>Sorry</strong> but there aren't any dish with this letter(s).
                                            </div>
                                            <div class="search">
                                                <input type="text" name="home_city_search" class="form-control home_search_city" placeholder="Search Location" >
                                            </div>
                                            <div class="search">
                                                <input type="text" name="home_dish_search" class="form-control home_search_dish" placeholder="Search Dish" >
                                            </div>
                                            <div class="search">
                                                <select name="home_distance_search" id="" class="form-control" style="margin-bottom: 1%;" >
                                                    <option value="0.5">Nearby (1/2 mile)</option>
                                                    <option value="1">Walkable (1 mile)</option>
                                                    <option value="5">Drivable (5 mile)</option>
                                                    <option value="20">City-wide (20 mile)</option>
                                                </select>
                                            </div>
                                            <div class="checkbox">
                                                <label><input type="checkbox" value="non_chain">Exclude Chain Restaurants<span></span></label>
                                            </div>
                                            <input type="submit" class="btn btn-success home_page_sumbit">
                                        </div>
                                        <div class="ibox float-e-margins" style="height: 800px; overflow-x: hidden;" >

                                            <div class="alert alert-danger home_danger_alert hidden">
                                                <strong>Sorry</strong> but there aren't any results for your search.
                                            </div>
                                            <div class="alert alert-danger home_danger_submit hidden">
                                                <strong>Please</strong> fill all fields.
                                            </div>
                                            <div class="ibox-content" style="width: 100%;overflow-y: hidden;padding: 15px 0px;">
                                                <div class="sk-spinner sk-spinner-three-bounce hidden">
                                                    <div class="sk-bounce1"></div>
                                                    <div class="sk-bounce2"></div>
                                                    <div class="sk-bounce3"></div>
                                                </div>
                                                <table class="table home_seatch_result" >

                                                </table>
                                            </div>
                                        </div>
                                </div>
                                <div id="tab-4" class="tab-pane ">
                                    <div class="panel-body">
                                        <div class="alert alert-danger dish_alert hidden">
                                            <strong>Sorry</strong> but there aren't any dish with this letter(s).
                                        </div>
                                        <div class="search">
                                            <input type="text" name="home_dish_search_tab2" class="form-control home_search_dish_tab2" placeholder="Search Dish" >
                                        </div>
                                        <div class="search">
                                            <select name="home_distance_search" id="" class="form-control">
                                                <option value="0.5">Nearby  (1/2 mile)</option>
                                                <option value="1"> Walkable (1 mile)  </option>
                                                <option value="5">Drivable  (5 mile)</option>
                                                <option value="20">City-wide (20 mile)</option>
                                            </select>
                                        </div>
                                        <div class="checkbox">
                                            <label><input type="checkbox" value="non_chain">Exclude Chain Restaurants<span></span></label>
                                        </div>
                                        <input type="submit" class="btn btn-success home_page_sumbit_tab2">
                                    </div>
                                    <div class="ibox float-e-margins" style="height: 470px; overflow-x: hidden;">
                                        <div class="ibox-content" style="width: 100%;overflow-y: hidden;">
                                            <div class="alert alert-danger home_danger_alert hidden">
                                                <strong>Sorry</strong> but there aren't any results for your search.
                                            </div>
                                            <div class="alert alert-danger home_danger_submit hidden">
                                                <strong>Please</strong> fill all fields.
                                            </div>
                                            <div class="sk-spinner sk-spinner-three-bounce hidden">
                                                <div class="sk-bounce1"></div>
                                                <div class="sk-bounce2"></div>
                                                <div class="sk-bounce3"></div>
                                            </div>
                                            <table class="table home_seatch_result">
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@stop