<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
class AuthContoller extends Controller
{
    function hello(){
           return response()->json([
            'status'=>true,
            'message'=>'hello file called'
           ]);
    }

   function signup(Request $req){
        $validateUser=Validator::make($req->all(),[
          'name'=>'required',
          'email'=>'required|email|unique:users,email',
          'password'=>'required'  
        ]);
        
        if($validateUser->fails()){
             return response()->json([
                'status'=>false,
                'message'=>"Validate Error",
                'errors'=>$validateUser->errors()->all(),
                
             ],401);
        }
       $user= User::create([
            'name'=>$req->name,
            "email"=>$req->email,
            "password"=>$req->password
        ]);

        return response()->json([
            'status'=>true,
            'message'=>"User Created Succesfully",
            'user'=>$user
         ],200);
   }

   function login(Request $req){
        $validateUser=Validator::make($req->all(),[
          'email'=>'required|email',
          'password'=>'required'  
        ]);
        
        if($validateUser->fails()){
            return response()->json([
                'status'=>false,
                'message'=>'Authentication Fails',
                'error'=>$validateUser->errors()->all()
            ],404);
        }
        if(Auth::attempt(['email'=>$req->email,'password'=>$req->password])){
            $authUser=Auth::user();
            return response()->json([
                'status'=>true,
                'message'=>"User Login Successfully",
                'token'=>$authUser->createToken('Api Tokens')->plainTextToken,
                'token_type'=>'bearer'
             ],200);
        }
        else{
            return response()->json([
                'status'=>false,
                'message'=>'Email and Password does not match',
            ],401);
        }
   }

   function logout(Request $req){
        $user=$req->user();
        $user->tokens()->delete();
        
        return response()->json([
            'status'=>true,
            'message'=>'Successfull logout',
             "user"=>$user
        ],200);

   }
}
