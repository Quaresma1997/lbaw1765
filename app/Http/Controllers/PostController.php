<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Event;
use App\Post;


class PostController extends Controller
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

    public function index(){

        
    }


    public function add(Request $request, $id)
    {
       

      $this->validate($request,[
          'post' => 'required',
          'file' => 'image|nullable'
      ]);

     // 

      //handle file upload

      if($request->hasFile('file')){
          if($request->file('file')->isValid()){
            $file = $request->file("file");
          $filename = $file->getClientOriginalName();
          $file->move(public_path('/post_images'), $filename);
          }
      }
      else{
        $filename = null;

      }


    // create
    $post= new Post();

$post->date = date('Y-m-d H:i:s'); // 2016-10-12 21:09:23
$post->description = $request->input('post');
$post->event_id = $id;
$post->user_id = Auth::user()->id;
$post->image_path = $filename;
$post->save();

return redirect()->action(
    'EventController@show', ['id' => $post->event_id]
  );
  }

    public function delete(Request $request,$id)
    {
        $post = Post::find($id);

        $event_id = $post->event_id;

       // dd($request);
          $post->delete();
          return redirect()->action(
            'EventController@show', ['id' => $event_id]
          );           

    }
    
    public function update(Request $request,$id)
    {

         $this->validate($request,[
          'post' => 'required',
          'file' => 'image|nullable'
      ]);

      $post = Post::find($id);

        if($request->hasFile('file')){
          if($request->file('file')->isValid()){
            $file = $request->file("file");
          $filename = $file->getClientOriginalName();
          $file->move(public_path('/post_images'), $filename);
          $post->image_path = $filename;
          }
      }
      else{
        $filename = null;

      }


      

      $event_id = $post->event_id;

      $post->date = date('Y-m-d H:i:s'); // 2016-10-12 21:09:23
$post->description = $request->input('post');


       // dd($request);
          $post->save();
          return redirect()->action(
            'EventController@show', ['id' => $event_id]
          );    

    }
    
    


}
