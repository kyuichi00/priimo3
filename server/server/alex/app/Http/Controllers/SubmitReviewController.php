<?php

namespace App\Http\Controllers;


use Illuminate\Auth\Access\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Item_reviews;
use App\Item_review_likes;
class SubmitReviewController extends Controller
{

    public function index()
    {
    $item_reviewss = DB::table('item_reviews')
        ->join('users','item_reviews.review_user_ID','=','users.user_ID')
        ->join('business','item_reviews.review_biz_ID','=','business.biz_id')
        ->join('items','item_reviews.review_item_ID','=','items.item_id')
        ->orderBy('review_ID','desc')
            ->get()->toArray();

        $item_review_likes = DB::table('item_review_likes')->get()->toArray();
        $reversed = array_reverse($item_reviewss);
        foreach($item_review_likes as $item_review_like){
            //dd($item_review_like->item_review_likes_review_id);
            $ididid = $item_review_like->item_review_likes_review_id-1;
            $reversed[$ididid]->review_like_dislike = $item_review_like->review_like_dislike;
            $reversed[$ididid]->like_user_id = $item_review_like->like_user_id;
            $reversed[$ididid]->item_review_likes_id = $item_review_like->item_review_likes_id;

        }
        $item_reviewss = array_reverse($reversed);


    $num = 1;
        return view('templates.submitReview',compact('item_reviewss','num'));
    }

    public function selectFeedback(request $request)
    {
        $toArray = $request->toArray();

        $key = $toArray['key'];
        $type = $toArray['type'];

        $output = [];

        if($type == 'restaurant'){

            $output = DB::table('business')
                ->where('biz_name', 'like', '%'.$key.'%')
                ->limit(50)
                ->get()
                ->toArray();

        }else if($type == 'dish'){

            $output = DB::table('items')
                ->where('item_name', 'like', '%'.$key.'%')
                ->limit(50)
                ->get()
                ->toArray();

        }

        return response()->json($output);
    }
    public function insertFeedback(request $request)
    {
        $toArray = $request->toArray();

        if(Auth::guest()){

            return view('templates.submitReview')->with('log_error', 'Please Sign In or Sign Up');

        }else if(empty($toArray['review_item_ID']) || empty($toArray['review_biz_ID']) || empty($toArray['item_comment']) || empty($toArray['review_rate']) ){
            return redirect('/submitReview')->with('error', 'Please Fill all fields!');
        }else if(isset($toArray['review_user_ID'])){

            $this->validate($request, [
                'review_rate' => 'required',
            ]);

            Item_reviews::insert([
                'review_user_ID' => $toArray['review_user_ID'],
                'review_biz_ID' => $toArray['review_biz_ID'],
                'review_item_ID' => $toArray['review_item_ID'],
                'item_rate' => $toArray['review_rate'],
                'item_comment' => $toArray['item_comment'],
                'review_rate' => $toArray['review_rate'],


            ]);

            return redirect('/submitReview')->with('success', 'The post Published!');

        }

    }

    public function reviewLikes(request $request)
    {

        $toArray = $request->toArray();
        $user_id = Auth::id();

        if (isset($toArray['finger'])) {
            if ($toArray['finger'] == 'up') {
                if (!isset($toArray['like_id'])) {
                    Item_review_likes::insert([
                        'item_review_likes_review_id' => $toArray['comm_id'],
                        'review_user_id' => $toArray['rev_user_id'],
                        'like_user_id' => $user_id,
                        'review_like_dislike' => 1
                    ]);

                    $get_like_id = DB::getPdo()->lastInsertId();

                    return response()->json([
                        'msg' => 'liked',
                        'like_id' => $get_like_id
                    ]);
                } else if (isset($toArray['like_id'])) {
                    DB::table('Item_review_likes')
                        ->where('item_review_likes_id', '=', $toArray['like_id'])
                        ->update(['review_like_dislike' => 1]);
                }
                return response()->json([
                    'msg' => 'likedAgain',
                ]);
            } else if (isset($toArray['like_id'])) {
                if ($toArray['finger'] == 'already_liked') {
                    DB::table('Item_review_likes')
                        ->where('item_review_likes_id', '=', $toArray['like_id'])
                        ->update(['review_like_dislike' => 0]);
                }
                return response()->json([
                    'msg' => 'disliked',
                ]);
            }
        }
    }

}
