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
use App\Poll;
use App\Option;



class PollController extends Controller
{
    

    

    public function add(Request $request, $id)
    {
       
      $this->validate($request,[
          'question' => 'required',
          'option1' => 'required',
          'option2' => 'required',
        

      ]);

     //dd($request);

    // create

    $poll= new Poll();
    $poll->question=$request->input('question');
    $poll->event_id= $id;
    $poll->date = date('Y-m-d H:i:s'); 

    $poll->save();



    $option1 = new Option();
    $option1->description=$request->input('option1');
    $option1->poll_id=$poll->id;
    $option2 = new Option();
    $option2->description=$request->input('option2'); 
    $option2->poll_id=$poll->id;
    $option3 = new Option();
    if($request->input('option3')!=null){
        $option3->description=$request->input('option3');
        $option3->poll_id=$poll->id;
        $option3->save();
    }
    if($request->input('option4')!=null){
        $option4 = new Option();
         $option4->description=$request->input('option4');
        $option4->poll_id=$poll->id;
        $option4->save();

    }
    $option1->save();
    $option2->save();



return redirect()->action(
    'EventController@show', ['id' => $poll->event_id]
  );
  }

    public function delete(Request $request,$id)
    {
      
    }


    public function edit()
    {
      

    }
    
    


}
