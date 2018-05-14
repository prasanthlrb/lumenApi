<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Container\make;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class userController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function index()
    {
      return User::all();
    }
    public function store(Request $request)
    {
    $user = User::create([

      'name' => $request->name,
      'username' => $request->username,
      'email'=> $request->email,
      'api_token'=> str_random(50),
      'password'=> app('hash')->make($request->password),
    ]);
    return response()->json(['message'=>'success','user'=> $user],200);
    }

    public function login(Request $request)
    {
      $user = User::where('email',$request->email)->first();
      if(!$user){
         return response()->json(['message'=>'User Not Found','status'=> 'error'],404);
         
      }
      if(Hash::check($request->password,$user->password)){
        $user->update(['api_token' =>str_random(50)]);

       return response()->json(['message'=>'success','user'=> $user],200);
      }else{
        return response()->json(['message'=>'Invalid Cretendials','status'=> 'error'],401);
      }
    }

    public function logout(Request $request)
    {
     $user = User::where('api_token',$request->api_token)->first();
     if(!$user){
      return response()->json(['message'=>'Not Logged in','status'=> 'error'],401);
     }
     $user->api_token = null;
     $user->save();
     return response()->json(['status'=>'success','message'=> 'successfully logged out'],200);
    }
}
