<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';


    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
//            'user_firstname' => 'required|max:100',
        'user_nickname' => 'required|max:100|unique:users',
        'user_email' => 'required|email|max:200|unique:users',
        'user_zip' => 'required|max:10',
        'password' => 'required|min:6|confirmed',
    ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
//            'user_firstname' => $data['user_firstname'],
//            'user_lastname' => $data['user_lastname'],
            'user_nickname' => $data['user_nickname'],
            'user_zip' => $data['user_zip'],
            'user_email' => $data['user_email'],
            'password' => bcrypt($data['password']),
        ]);
    }
}
