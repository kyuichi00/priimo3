<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
class User_friends extends Model
{
    use Notifiable;
    protected $table = 'user_friends';

    protected $fillable = [
        'user_1','user_2', 'approved',
    ];

    public function getAllUsers($userNickName){

        $this->userNickName=$userNickName;
        $users = DB::table('users')
            ->select('user_ID','user_lastname','user_firstname','user_nickname','user_email','user_avatar')
            ->where('user_nickname', 'like',$userNickName . '%')
            ->where('user_ID','!=', Auth::id())
            ->limit(50)
            ->get()
            ->toArray();



            return $users;
    }

    public function friendsList(){

         $user_relations = [];
        $login_user = Auth::id();


        $users_friends = DB::table('user_friends')
            ->join('users', function ($join) {
                $join->on(['user_friends.user_1'=> 'users.user_ID',])
                    ->orOn(['user_friends.user_2'=> 'users.user_ID']);
            })
            ->where('user_1', '=', $login_user)
               ->orWhere('user_2', '=',$login_user)
            ->where('users.user_ID', '!=', $login_user)
            ->get()->toArray();

        foreach($users_friends as $user_friends){
            if($user_friends->user_1==Auth::id() && $user_friends->approved==0){
                $user_relations[$user_friends->user_2] = 'Sent';
            }else if($user_friends->user_1==Auth::id() && $user_friends->approved==1){
               $user_relations[$user_friends->user_2] = 'Friend';
            }else if($user_friends->user_2==Auth::id() && $user_friends->approved==0){
               $user_relations[$user_friends->user_1] = 'Confirm';
            }
        }

        return $user_relations;
    }
}
