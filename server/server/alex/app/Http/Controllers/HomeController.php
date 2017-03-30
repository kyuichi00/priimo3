<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class HomeController extends Controller
{



    public function index()
    {

        return view('templates.home');
    }

    public function searchInfo(request $request)
    {
        $toArray = $request->toArray();

        $key = $toArray['key'];
        $type = $toArray['type'];

        if ($type == 'cityHomePage') {
            $output = DB::table('cities')
                ->where('city_name', 'like', '%' . $key . '%')
                ->limit(20)
                ->get()
                ->toArray();
        }else if ($type == 'dishHomePage') {
            $output = DB::table('items')
                ->where('item_name', 'like', '%' . $key . '%')
                ->limit(20)
                ->get()
                ->toArray();

        }
        return response()->json($output);

    }

    public function GeneralSearchByCityAndDish(request $request)
    {
        $GeneralInfos = $request->toArray();
        $infoToArrayCity = array_get($GeneralInfos, 'genInfo.0.city.0');
        $infoToArrayDish = array_get($GeneralInfos, 'genInfo.0.dish.0');
        $infoToArrayDistance = array_get($GeneralInfos, 'genInfo.0.dist.0');
        $infoToArrayChains = array_get($GeneralInfos, 'genInfo.0.chains.0');
        if (!empty($infoToArrayCity) && !empty($infoToArrayDish)) {

//-----------Actions with DISH CAT 1 -------------------//
            $dishCate1NameById = DB::table('dishcat1')
                ->select('dishcat1_name')
                ->where('dishcat1_ID', '=', $infoToArrayDish['dish_cat1ID'])
                ->get()
                ->toArray();
            foreach ($dishCate1NameById as $dishCat1NameById) {
                foreach ($dishCat1NameById as $dishCa1NamById) {
                    $dishCat1Name = $dishCa1NamById;
                }
            }

            $dishCate1ByName = DB::table('dishcat1')
                ->select('dishcat1_name')
                ->get()
                ->toArray();

            $dishCat1NameArray = [];
            foreach ($dishCate1ByName as $dishCat1ByName) {
                foreach ($dishCat1ByName as $dishCa1ByName) {
                    array_push($dishCat1NameArray, $dishCa1ByName);
                }
            }
//----------- END Action With DISH CAT1------------------//

//-----------Actions with DISH CAT 2 -------------------//

            $dishCate2NameById = DB::table('dishcat2')
                ->select('dishcat2_name')
                ->where('dishcat2_ID', '=', $infoToArrayDish['dish_cat2ID'])
                ->get()
                ->toArray();
            foreach ($dishCate2NameById as $dishCat2NameById) {
                foreach ($dishCat2NameById as $dishCa2NameById) {
                    $dishCat2Name = $dishCa2NameById;
                }
            }

            $dishCate2ByName = DB::table('dishcat2')
                ->select('dishcat2_name')
                ->get()
                ->toArray();

            $dishCat2NameArray = [];
            foreach ($dishCate2ByName as $dishCat2ByName) {
                foreach ($dishCat2ByName as $dishCa2ByName) {
                    array_push($dishCat2NameArray, $dishCa2ByName);
                }
            }
            if (!isset($infoToArrayChains)) {
                if (in_array($dishCat1Name, $dishCat1NameArray)) {
                    $procForCat1 = DB::select("call getbizallcat1distancesearch('$dishCat1Name',{$infoToArrayCity['city_lat']},{$infoToArrayCity['city_lng']},{$infoToArrayDistance['distance']})");
                    if(empty($procForCat1) || !isset($procForCat1)) {
                        if (in_array($dishCat2Name, $dishCat2NameArray)) {
                            $procForCat2 = DB::select("call getbizallcat2distancesearch('$dishCat2Name',{$infoToArrayCity['city_lat']},{$infoToArrayCity['city_lng']},{$infoToArrayDistance['distance']})");
                            if(!empty($procForCat2)){
                                $item_comment=[];
                                foreach($procForCat2 as $procForCa2){
                                    array_push($item_comment,$procForCa2->biz_id);
                                }
                                $comments = DB::table('item_reviews')
                                    ->whereIn('review_biz_ID',$item_comment)
                                    ->where('review_item_ID',$infoToArrayDish['dish_id'])
                                    ->get()
                                    ->toArray();

                                $new=[];
                                for($i=0;$i<count($procForCat2);$i++){
                                    $a =  $procForCat2[$i]->biz_id;
                                    for($j=0;$j<count($comments);$j++){
                                        if($comments[$j]->review_biz_ID == $a){
                                            array_push($new,array_merge((array)$procForCat2[$i],(array)$comments[$j]));
                                        }

                                    }
                                }
                                if(empty($new)){
                                    return response()->json('no_result');
                                }else{
                                    return response()->json(array('data' => $new, 'info' => 'cat2'));
                                }
                            }
                        }
                    }
                    $item_comment=[];
                    foreach($procForCat1 as $procForCa1){
                        array_push($item_comment,$procForCa1->biz_id);
                    }

                    $comments = DB::table('item_reviews')
                        ->whereIn('review_biz_ID',$item_comment)
                        ->where('review_item_ID',$infoToArrayDish['dish_id'])
                        ->get()
                        ->toArray();

                    $new=[];
                    for($i=0;$i<count($procForCat1);$i++){
                        $a =  $procForCat1[$i]->biz_id;
                        for($j=0;$j<count($comments);$j++){
                            if($comments[$j]->review_biz_ID == $a){
                                array_push($new,array_merge((array)$procForCat1[$i],(array)$comments[$j]));
                            }
                        }

                    }
                    if(empty($new)){
                        return response()->json('no_result');
                    }else{
                        return response()->json(array('data' => $new, 'info' => 'cat1'));
                    }
                }
            } else if (isset($infoToArrayChains)) {
                if (in_array($dishCat1Name, $dishCat1NameArray)) {
                    $procForCat1 = DB::select("call getbiznonchaincat1distancesearch('$dishCat1Name',{$infoToArrayCity['city_lat']},{$infoToArrayCity['city_lng']},{$infoToArrayDistance['distance']})");
                    if (empty($procForCat1)) {
                        if (in_array($dishCat2Name, $dishCat2NameArray)) {
                                $procForCat2 = DB::select("call getbiznonchaindistancecat2search('$dishCat2Name',{$infoToArrayCity['city_lat']},{$infoToArrayCity['city_lng']},{$infoToArrayDistance['distance']})");
                            if(!empty($procForCat2)){
                                $item_comment=[];
                                foreach($procForCat2 as $procForCa2){
                                    array_push($item_comment,$procForCa2->biz_id);
                                }
                                $comments = DB::table('item_reviews')
                                    ->whereIn('review_biz_ID',$item_comment)
                                    ->where('review_item_ID',$infoToArrayDish['dish_id'])
                                    ->get()
                                    ->toArray();

                                $new=[];
                                for($i=0;$i<count($procForCat2);$i++){
                                    $a =  $procForCat2[$i]->biz_id;
                                    for($j=0;$j<count($comments);$j++){
                                        if($comments[$j]->review_biz_ID == $a){
                                            array_push($new,array_merge((array)$procForCat2[$i],(array)$comments[$j]));
                                        }

                                    }
                                }
                                return response()->json(array('data' => $new, 'info' => 'cat2'));
                            }else{
                                return response()->json('no_result');
                            }
                        }
                    }
                    $item_comment=[];
                    foreach($procForCat1 as $procForCa1){
                        array_push($item_comment,$procForCa1->biz_id);
                    }
                    $comments = DB::table('item_reviews')
                        ->whereIn('review_biz_ID',$item_comment)
                        ->where('review_item_ID',$infoToArrayDish['dish_id'])
                        ->get()
                        ->toArray();

                    $new=[];
                    for($i=0;$i<count($procForCat1);$i++){
                        $a =  $procForCat1[$i]->biz_id;
                        for($j=0;$j<count($comments);$j++){
                            if($comments[$j]->review_biz_ID == $a){
                                array_push($new,array_merge((array)$procForCat1[$i],(array)$comments[$j]));
                            }

                        }
                    }
                    return response()->json(array('data' => $new, 'info' => 'cat1'));
                }
            }
        } else {
            return response()->json('Empty_Row');
        }

    }
    public function GeneralSearchByCityAndDish_tab2(request $request)
    {


        $GeneralInfos = $request->toArray();
        $infoToArrayDish = array_get($GeneralInfos, 'genInfo_tab2.0.dish.0');
        $infoToArrayDistance = array_get($GeneralInfos, 'genInfo_tab2.0.dist.0');
        $infoToArrayChains = array_get($GeneralInfos, 'genInfo_tab2.0.chains.0');
        $infoToArraylat = array_get($GeneralInfos, 'genInfo_tab2.0.user_lat.0');
        $infoToArraylong = array_get($GeneralInfos, 'genInfo_tab2.0.user_lng.0');


         if (!empty($infoToArraylat['lat']) && !empty($infoToArraylong['long'])) {

        //-----------Actions with DISH CAT 1 -------------------//
            $dishCate1NameById = DB::table('dishcat1')
                ->select('dishcat1_name')
                ->where('dishcat1_ID', '=', $infoToArrayDish['dish_cat1ID'])
                ->get()
                ->toArray();
            foreach ($dishCate1NameById as $dishCat1NameById) {
                foreach ($dishCat1NameById as $dishCa1NamById) {
                    $dishCat1Name = $dishCa1NamById;
                }
            }

            $dishCate1ByName = DB::table('dishcat1')
                ->select('dishcat1_name')
                ->get()
                ->toArray();

            $dishCat1NameArray = [];
            foreach ($dishCate1ByName as $dishCat1ByName) {
                foreach ($dishCat1ByName as $dishCa1ByName) {
                    array_push($dishCat1NameArray, $dishCa1ByName);
                }
            }
        //----------- END Action With DISH CAT2------------------//
        //-----------Actions with DISH CAT 2 -------------------//

            $dishCate2NameById = DB::table('dishcat2')
                ->select('dishcat2_name')
                ->where('dishcat2_ID', '=', $infoToArrayDish['dish_cat2ID'])
                ->get()
                ->toArray();
            foreach ($dishCate2NameById as $dishCat2NameById) {
                foreach ($dishCat2NameById as $dishCa2NameById) {
                    $dishCat2Name = $dishCa2NameById;
                }
            }

            $dishCate2ByName = DB::table('dishcat2')
                ->select('dishcat2_name')
                ->get()
                ->toArray();

            $dishCat2NameArray = [];
            foreach ($dishCate2ByName as $dishCat2ByName) {
                foreach ($dishCat2ByName as $dishCa2ByName) {
                    array_push($dishCat2NameArray, $dishCa2ByName);
                }
            }

                if (!isset($infoToArrayChains)) {
                    if (in_array($dishCat1Name, $dishCat1NameArray)) {
                        $procForCat1 = DB::select("call getbizallcat1distancesearch('$dishCat1Name',{$infoToArraylat['lat']},{$infoToArraylong['long']},{$infoToArrayDistance['distance']})");//{$infoToArraylat['lat']},{$infoToArraylong['long']}
                        if (empty($procForCat1)) {
                            if (in_array($dishCat2Name, $dishCat2NameArray)) {
                                $procForCat2 = DB::select("call getbizallcat2distancesearch('$dishCat2Name',{$infoToArraylat['lat']},{$infoToArraylong['long']},{$infoToArrayDistance['distance']})");//{$infoToArraylat['lat']},{$infoToArraylong['long']}
                                if(!empty($procForCat2)){
                                    $item_comment=[];
                                    foreach($procForCat2 as $procForCa2){
                                        array_push($item_comment,$procForCa2->biz_id);
                                    }
                                    $comments = DB::table('item_reviews')
                                        ->whereIn('review_biz_ID',$item_comment)
                                        ->where('review_item_ID',$infoToArrayDish['dish_id'])
                                        ->get()
                                        ->toArray();
                                        $new=[];
                                    for($i=0;$i<count($procForCat2);$i++){
                                        $a =  $procForCat2[$i]->biz_id;
                                        for($j=0;$j<count($comments);$j++){
                                            if($comments[$j]->review_biz_ID == $a){
                                                 array_push($new,array_merge((array)$procForCat2[$i],(array)$comments[$j]));
                                            }

                                        }
                                    }

                                    return response()->json(array('data' => $new, 'info' => 'cat2'));
                                }else{

                                    return response()->json('no_result');

                                }
                            }
                        }
                        $item_comment=[];
                        foreach($procForCat1 as $procForCa1){
                            array_push($item_comment,$procForCa1->biz_id);
                        }
                        $comments = DB::table('item_reviews')
                            ->whereIn('review_biz_ID',$item_comment)
                            ->where('review_item_ID',$infoToArrayDish['dish_id'])
                            ->get()
                            ->toArray();
                                $new=[];
                        for($i=0;$i<count($procForCat1);$i++){
                            $a =  $procForCat1[$i]->biz_id;
                            for($j=0;$j<count($comments);$j++){
                                if($comments[$j]->review_biz_ID == $a){
                                    array_push($procForCat1,array_merge((array)$procForCat1[$i],(array)$comments[$j]));
                                }

                            }
                        }
                        return response()->json(array('data' => $new, 'info' => 'cat1'));
                    }
                }else if (isset($infoToArrayChains)) {
                    if (in_array($dishCat1Name, $dishCat1NameArray)) {
                        $procForCat1 = DB::select("call getbiznonchaincat1distancesearch('$dishCat1Name',{$infoToArraylat['lat']},{$infoToArraylong['long']},{$infoToArrayDistance['distance']})");
                        if (empty($procForCat1)) {
                            if (in_array($dishCat2Name, $dishCat2NameArray)) {
                                $procForCat2 = DB::select("call getbiznonchaindistancecat2search('$dishCat2Name',{$infoToArraylat['lat']},{$infoToArraylong['long']},{$infoToArrayDistance['distance']})");
                                if(!empty($procForCat2)){
                                    $item_comment=[];
                                    foreach($procForCat2 as $procForCa2){
                                        array_push($item_comment,$procForCa2->biz_id);
                                    }
                                    $comments = DB::table('item_reviews')
                                        ->whereIn('review_biz_ID',$item_comment)
                                        ->where('review_item_ID',$infoToArrayDish['dish_id'])
                                        ->get()
                                        ->toArray();
                                        $new=[];
                                    for($i=0;$i<count($procForCat2);$i++){
                                        $a =  $procForCat2[$i]->biz_id;
                                        for($j=0;$j<count($comments);$j++){
                                            if($comments[$j]->review_biz_ID == $a){
                                                array_push($new,array_merge((array)$procForCat2[$i],(array)$comments[$j]));
                                            }

                                        }
                                    }
                                    return response()->json(array('data' => $new, 'info' => 'cat2'));
                                }else{
                                    return response()->json('no_result');
                                }
                            }
                        }
                        $item_comment=[];
                        foreach($procForCat1 as $procForCa1){
                            array_push($item_comment,$procForCa1->biz_id);
                        }
                        $comments = DB::table('item_reviews')
                            ->whereIn('review_biz_ID',$item_comment)
                            ->where('review_item_ID',$infoToArrayDish['dish_id'])
                            ->get()
                            ->toArray();

                        $new=[];
                        for($i=0;$i<count($procForCat1);$i++){
                            $a =  $procForCat1[$i]->biz_id;
                            for($j=0;$j<count($comments);$j++){
                                if($comments[$j]->review_biz_ID == $a){
                                    array_push($procForCat1,array_merge((array)$procForCat1[$i],(array)$comments[$j]));
                                }

                            }
                        }
                        return response()->json(array('data' => $new, 'info' => 'cat1'));
                    }
                }
         }else{
            return response()->json('Empty_Row');
         }

    }



}
