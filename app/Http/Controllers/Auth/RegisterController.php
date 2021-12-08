<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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

//    use RegistersUsers;
//
//    /**
//     * Where to redirect users after registration.
//     *
//     * @var string
//     */
//    protected $redirectTo = RouteServiceProvider::LOGIN;


    public function register(Request $request ){
        $data = $request->all();
        $this->validate($request,[
            'id' => ['required', 'string', 'max:20'],
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'address' => ['required', 'string', 'max:255'],
            'phone_number' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'password' => ['required', 'string', 'min:6'],
            're_pass' => 'required|min:6|same:password',
        ]);
        $data['password'] = Hash::make($data['password']);
        $user = User::create($data);
        return response([
            'user' => $user
        ], 200);
    }
}
