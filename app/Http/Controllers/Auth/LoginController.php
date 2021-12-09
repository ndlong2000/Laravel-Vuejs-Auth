<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;


class LoginController extends Controller
{
    /**
     *
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
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

        $data['password'] = bcrypt($data['password']);
        $user = User::create($data);

        return response()->json(['user' => $user], Response::HTTP_OK);
    }
    public function login(Request $request)
    {

        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        $credentials = request(['email', 'password']);

        if (!Auth::attempt($credentials)) {
            return response()->json(['errors' => 'Wrong account or password'], 401);
        }
        return response()->json(Auth::user(),200);
        $user = $request->user();
        $tokenResult = $user->createToken('Personal Access Token');
        return response()->json([
            'message' => 'Authorization Granted',
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
        ]);
//        $token = Auth::user()->createToken('key')->accessToken;
//        return response()->json(auth('api')->user())->header('Authorization', $token);
    }
    public function logout(Request $request)
    {
        // auth('api')->logout();
         Auth::logout();
        //$request->user()->token()->revoke();
        return response()->json([
            'message' => 'Successfully logged out',
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function user(Request $request)
    {
        return response()->json(auth('api')->user());
    }

    public function login1(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'device_name' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        return $user->createToken($request->device_name)->plainTextToken;
    }

    public function logout1(Request $request)
    {
        //$request->user()->currentAccessToken()->delete();
        return response()->json(['msg' => 'Logout Successfull']);
    }
}
