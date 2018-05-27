<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Event;
use App\Category;

class IndexController extends Controller
{
    /**
     * Shows the index
     *
     * @param  int  $id
     * @return Response
     */
    public function show()
    {
      if(Auth::check())
        return redirect('homepage');
      else
      //  return response()->json(['most' => $this->getMostParticipativeEvents()]);
         return view('pages.index', ['most' => $this->getMostParticipativeEvents()]);
    }

    private function getMostParticipativeEvents(){
      $categories_events = array();

      $firsts = array();

      $business_id = Category::where('name', 'Business')->first()->id;
      $business_events = array();
      foreach(Event::where('category_id', $business_id)->get() as $event){
        array_push($business_events, $event);
      }
      if(sizeof($business_events) > 0){
        if(sizeof($business_events) > 1)
          usort($business_events, array($this, "cmp_events_part"));
        array_push($firsts,reset($business_events));
      }

      $educational_id = Category::where('name', 'Educational')->first()->id;
      $educational_events = array();
      foreach(Event::where('category_id', $educational_id)->get() as $event){
        array_push($educational_events, $event);
      }
      if(sizeof($educational_events) > 0){
        if(sizeof($educational_events) > 1)
          usort($educational_events, array($this, "cmp_events_part"));
        array_push($firsts,reset($educational_events));
      }

      $entertainment_id = Category::where('name', 'Entertainment')->first()->id;
      $entertainment_events = array();
      foreach(Event::where('category_id', $entertainment_id)->get() as $event){
        array_push($entertainment_events, $event);
      }
      if(sizeof($entertainment_events) > 0){
        if(sizeof($entertainment_events) > 1)
          usort($entertainment_events, array($this, "cmp_events_part"));
        array_push($firsts,reset($entertainment_events));
      }

      $music_id = Category::where('name', 'Music')->first()->id;
      $music_events = array();
      foreach(Event::where('category_id', $music_id)->get() as $event){
        array_push($music_events, $event);
      }
      if(sizeof($music_events) > 0){
        if(sizeof($music_events) > 1)
          usort($music_events, array($this, "cmp_events_part"));
        array_push($firsts,reset($music_events));
      }

      $sports_id = Category::where('name', 'Sports')->first()->id;
      $sports_events = array();
      foreach(Event::where('category_id', $sports_id)->get() as $event){
        array_push($sports_events, $event);
      }
      if(sizeof($sports_events) > 0){
        if(sizeof($sports_events) > 1)
          usort($sports_events, array($this, "cmp_events_part"));
        array_push($firsts,reset($sports_events));
      }

      $other_id = Category::where('name', 'Other')->first()->id;
      $other_events = array();
      foreach(Event::where('category_id', $other_id)->get() as $event){
        array_push($other_events, $event);
      }
      if(sizeof($other_events) > 0){
        if(sizeof($other_events) > 1)
          usort($other_events, array($this, "cmp_events_part"));
        array_push($firsts,reset($other_events));
      }
      
      if(sizeof($firsts) >= 4){
        usort($firsts, array($this, "cmp_events_part"));
        return array_slice($firsts, 0, 4);
      }else{
        switch(sizeof($firsts)){
          case 3:
            usort($firsts, array($this, "cmp_events_part"));  
          array_push($firsts, reset($firsts));
            
            return $firsts;
          case 2:
            usort($firsts, array($this, "cmp_events_part"));  
          array_push($firsts, reset($firsts));
            array_push($firsts, reset($firsts));
            
            return $firsts;
          case 1:
          usort($firsts, array($this, "cmp_events_part"));
            array_push($firsts, reset($firsts));
            array_push($firsts, reset($firsts));
            array_push($firsts, reset($firsts));
            return $firsts;
          default:
            return $firsts;
        }
      }
      

    }

    function cmp_events_part($a, $b)
    {
      return strcmp(count($b->participants), count($a->participants));
    }

    public function show404error(){
      if(Auth::check()){
        $categories = Category::all();
        return view('pages.404', ['categories' => $categories]);
      }else
        return view('pages.404');
      
    }

    public function show500error(){
       if(Auth::check()){
        $categories = Category::all();
        return view('pages.500', ['categories' => $categories]);
      }else
        return view('pages.500');
    }

    public function show400error(){
       if(Auth::check()){
        $categories = Category::all();
        return view('pages.400', ['categories' => $categories]);
      }else
        return view('pages.400');
    }


        public function show401error(){
       if(Auth::check()){
        $categories = Category::all();
        return view('pages.401', ['categories' => $categories]);
      }else
        return view('pages.401');
    }


        public function show403error(){
       if(Auth::check()){
        $categories = Category::all();
        return view('pages.403', ['categories' => $categories]);
      }else
        return view('pages.403');
    }


}
