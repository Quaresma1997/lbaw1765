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
       
//dd($request);
      $this->validate($request,[
          'post' => 'required',
          'file' => 'image|nullable'
      ]);

     // 

      //handle file upload

      if($request->hasFile('file')){
          //get filename with extenstion
          $filenameWithExt = $request->file('file')->getClientOriginalName();

          //get just filename
          $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
          $extension = $request->file('file')->getClientOriginalExtension();

          $filenameToStore = $filename.'_'.time().'.'.$extension;
          $path = $request ->file('file')->storeAs('public/post_images', $filenameToStore);


      }
      else{
        $filenameToStore = null;

      }


    // create
    $post= new Post();
//dd($request);
$post->date = date('Y-m-d H:i:s'); // 2016-10-12 21:09:23
$post->description = $request->input('post');
$post->event_id = $id;
$post->user_id = Auth::user()->id;
$post->image_path = $filenameToStore;
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
    
    public function edit()
    {
      

    }
    
    


}
