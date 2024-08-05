<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BaseController extends Controller
{
   function successRespons($result,$message){
         $response=[
            'status'=>true,
            'message'=>$message,
            'data'=>$result
         ];
         return response()->json($response,200);
   }

   function errorRespons($message,$errMessage=[],$code=404){
    $response=[
       'status'=>true,
       'message'=>$message,
    ];
    if(!empty($errMessage)){
        $data['data']=$errMessage;
    }
    return response()->json($response,$code);
}
}
