<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class RestaurantController extends Controller
{

    public function index($id)
    {

        $business = DB::table('business')
            ->where('biz_id', $id)
            ->get()
            ->toArray();
        

        return view('templates.restaurantPage',compact('business'));
    }

}
