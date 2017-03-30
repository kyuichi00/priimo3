<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\User_friends;
class FindFriendsController extends Controller
{


    public function index()
    {
        return view('templates.findFriends');
    }
    public function findFriends(request $request)
    {

        $usersToArray = $request->toArray();
        $userNickName = $usersToArray['friends'];

            $user_friends = new User_friends();

        $info_friends = $user_friends->getAllUsers($userNickName);

        $request_info = $user_friends ->friendsList();
       foreach($info_friends as $info_friend){
           foreach($request_info as $key=>$value){
               if($info_friend->user_ID === $key){
                    $info_friend->rel = $value;
               }
           }
       }
        return response()->json($info_friends);
    }

    public function acceptFriendRequest(request $request)
    {
        $user_id = Auth::id();
        $friends_info = $request->toArray();

        if($friends_info['friend_request_val'] == 'Friend'){

                return response()->json('Friend');
        }else if($friends_info['friend_request_val'] == 'Request Send'){

            return response()->json('Waiting');
        }else if($friends_info['friend_request_val'] == 'Confirm'){

            DB::table('user_friends')
                ->where('user_1','=', $friends_info['friend_id'])
                    ->where('user_2','=', Auth::id())
                        ->update(['approved' => 1]);

            return response()->json('Confirm');
        }else if($friends_info['friend_request_val'] == 'Add Friend') {
            if ($user_id != null) {
                User_friends::create([
                    'user_1' => $user_id,
                    'user_2' => $friends_info['friend_id']
                ]);

                return response()->json('Add_Friend');
            }else{
                return response()->json('no_user');
            }
        }

    }


}
