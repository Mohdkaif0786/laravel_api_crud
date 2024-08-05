<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\auth\BaseController;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas['posts']=Post::all();
        return response()->json([
            'status'=>true,
            'message'=>"All Post Data",
            'data'=>$datas
         ],200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $req)
    {
        $validatePost=Validator::make($req->all(),[
            'title'=>"required",
            'description'=>"required",
            'image'=>"required"
        ]);
        // return $req->all();
        if($validatePost->fails()){
             return response()->json([
                'status'=>false,
                'message'=>"Validation Failed",
                'error'=>$validatePost->errors()->all(),
             ],401);
        }
        $image=$req->image;
        $ext=$image->getClientOriginalExtension();
        $image_name=time().".".$ext;
       $image->move(public_path('uplods'),$image_name);
        $post=Post::create([
            'title'=>$req->title,
            'description'=>$req->description,
            'image'=>$image_name

        ]);
        return response()->json([
            'status'=>true,
            'message'=>"Post Created Succesfully",
            'user'=>$post],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $data['posts']=Post::select('title','description','image')->where('id',$id)->get();
        return response()->json([
            'status'=>true,
            'message'=>"Get Single Post Data",
            'data'=>$data],200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $req, $id)
    {
        $validatePost=Validator::make($req->all(),[
            'title'=>"required",
            'description'=>"required",
        ]);
    

        if($validatePost->fails()){
             return response()->json([
                'status'=>false,
                'message'=>"Validation Failed",
                'error'=>$validatePost->errors()->all(),
             ],401);
        }
        $post=Post::find($id);

        
        if($req->image!='' ||  boolval($req->image)){
            $path=public_path()."/uplods/";
            if($post->image!='' && $post->image!==null){
            
                unlink($path.$post->image);
            }

            $image=$req->image;
            $ext=$image->getClientOriginalExtension();
            $image_name=time().".".$ext;
            $image->move(public_path('uplods'),$image_name);
        }
        else{
            $image_name=$post->image;
        }

        $post->update([
            'title'=>$req->title,
            'description'=>$req->description,
            'image'=>$image_name
        ]);
        return response()->json([
            'status'=>true,
            'message'=>"Post update Succesfully",
            'user'=>$post],200);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Responses
     */
    public function destroy($id)
    {
         $post=Post::find($id);
         $post->delete();
         if(file_exists($post->image)){
             unlink(public_path().'/uploads/'.$post->image);
         }
         return response()->json([
            'status'=>true,
            'message'=>"Post Successfull Delete",
            'user'=>$post],200);
    }
}
