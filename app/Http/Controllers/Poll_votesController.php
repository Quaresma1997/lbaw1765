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
use App\Poll_votes;




class Poll_votesController extends Controller
{
    

    

    public function add(Request $request, $id)
    {


        
        
        $inc = $request->input('option');  //option_id
        $user= Auth::user()->id;

        $old = Poll_votes::where('poll_id',$id )-> where('user_id',$user)->get();

       // dump($old[0]);


        if($old->isEmpty()){


            // criar novo voto
            $poll_vote= new Poll_votes();
            $poll_vote->poll_id =$id;
            $poll_vote->user_id = Auth::user()->id;
            $poll_vote->option_id = $request->input('option');
            //dd( $poll_vote->option_id);

            $poll_vote->save();
       
            $poll = Poll::find($id);
            return redirect()->action(
                'EventController@show', ['id' => $poll->event_id]
              );

        }else if($old[0]->option_id != $inc ){
            //dump($old[0]->option_id);
            //update vote
            $vote_id=$old[0]->id;
            //dump($vote_id);
            $new_vote = Poll_votes::find($vote_id);
            if($new_vote == null)
                return redirect('404');
            $new_vote->option_id = $request->input('option');
            $poll = Poll::find($id);
           
            $new_vote->save();
            return redirect()->action(
                'EventController@show', ['id' => $poll->event_id]
              );
            

        }
        else{
            $poll = Poll::find($id);

            return redirect()->action(
                'EventController@show', ['id' => $poll->event_id]
              );

        }


    

       
  

  }


}
