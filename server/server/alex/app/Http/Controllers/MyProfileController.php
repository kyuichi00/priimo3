<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\User_friends;
class MyProfileController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $user_id = Auth::id();
        $user = User::where('user_id','=',$user_id)->first()->toArray();

        $call = DB::select('call getuserdetailsnonchain('."$user_id".')');


  //-------Get Friends and Requests---//
        $user_friends = new User_friends();
        $friendsAndRequests = $user_friends->friendsList();
        $allFriends=[];
          foreach ($friendsAndRequests as $key => $value){
                   $hallo = DB::table('users')->where('user_ID','=',$key)->get()->toArray();
              foreach ($hallo as $hall){
                  if($value == 'Friend'){
                      $allFriends[$key] = $hall;
                      $allFriends[$key]->relations = $value;
                  }elseif($value == 'Confirm'){
                      $allFriends[$key] = $hall;
                      $allFriends[$key]->relations = $value;
                  }
              }

          }
        return view('templates.userProfile.myProfile',compact('user','allFriends','call'));
    }

    public function selectUser()
    {
         $user_id = Auth::id();
        $user = User::where('user_id','=',$user_id)->first()->toArray();

        return view('templates.userProfile.editMyProfile',compact('user'));//
    }
    public function editUser(request $edit)
    {
        if($edit->hasFile('user_avatar')){
            $file = $edit->file('user_avatar');
            $img_fileName = $file->getClientOriginalName();
            $upload =  $edit->user_avatar->move(public_path('user_profile_pic/'), $img_fileName);

        }

        if(empty($edit->user_avatar)){
            User::where('user_id','=',$edit->user_ID)->update([
                'user_nickname' => $edit->user_nickname,
            ]);
        }

        if(!empty($edit->user_avatar)){
            User::where('user_id','=',$edit->user_ID)->update([
                'user_nickname' => $edit->user_nickname,
                'user_avatar' => $img_fileName,
            ]);
        }

        return redirect('/myProfile');
    }


    public function acceptFriendRequest(request $request)
    {
        $user_id = Auth::id();
        $friends_info = $request->toArray();
        if($friends_info['friend_request_val'] == 'Friends'){

            return response()->json('Friends');
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
