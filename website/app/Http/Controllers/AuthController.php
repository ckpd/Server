<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\User;
use App\Model\Profile;
use App\Notifications\SignupActivate;


class AuthController extends Controller{

    public $successStatus = 200;


    public function signup(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email|unique:users',
            'password' => 'required|string|confirmed'
        ]);
        $user = new User([
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'activation_token' => str_random(60)

        ]);

        $user->save();
        
        $user->notify(new SignupActivate($user));

        return response()->json([
            'message' => 'Successfully created user!'
        ], 201);
    }
  




    public function login(Request $request){
        
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);
        $credentials = request(['email', 'password']);
        $credentials['active'] = 1;
        $credentials['deleted_at'] = null;
    

        if(!Auth::attempt($credentials))
            return response()->json([
                'message' => 'Unauthorized'
            ], 401);
        $user = $request->user();
        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;
        if ($request->remember_me)
            $token->expires_at = Carbon::now()->addWeeks(1);
        $token->save();
        return response()->json([
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse(
                $tokenResult->token->expires_at
            )->toDateTimeString()
        ]);
    }
  
    /**
     * Logout user (Revoke the token)
     *
     * @return [string] message
     */
    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json([
            'message' => 'Successfully logged out'
        ]);
    }
  
    /**
     * Get the authenticated User
     *
     * @return [json] user object
     */
    public function user(Request $request){
        // dd($request->user());
        return response()->json($request->user());
    }


    public function signupActivate($token, Request $request){
        $user = User::where('activation_token', $token)->first();
        if (!$user) {
            return response()->json([
                'message' => 'This activation token is invalid.'
            ], 404);
        }
        
        $user->active = true;        
        //after activation token is set to null create profile with blank data
        $user->activation_token = '';

        Profile::create([
            'user_id'       =>      $user->id,
            'firstname'     =>      $request['firstname'],
            'lastname'      =>      $request['lastname'],
            'street'        =>      $request['street'],
            'parish'        =>      $request['parish'],
            'mobile'        =>      $request['mobile'],
            'landline'      =>      $request['landline'],
            'farm_name'     =>      $request['farm_name'],
            'farm_address_steet'    =>      $request['farm_address_steet'],
            'farm_address_parish'   =>      $request['farm_address_parish'],
            'flock_capacity'        =>      $request['flock_capacity'],
            'principal_occupation'  =>      $request['principal_occupation'],
            'qualifications'        =>      $request['qualifications'],
            'training'              =>      $request['training'],
            ]);
        

        $user->save();
        // return $user;
        return view('home');
    }
    public function successful(){
        return redirect('http://localhost:8888');
        // return view('auth/success');
    }
}