<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Event;
use App\Done;
use App\NotDone;

class UpdateNotDoneEventsToDone extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'UpdateNotDoneEventsToDone:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update not done events to done';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
    
        $events = Event::all();
        foreach($events as $e){
            if($this->compareDate($e)){
                if($e->done == null){
                    $not_done = $e->not_done;
                    $not_done->delete();
                }

            }
        }

    }

    private function compareDate($event){
         $date_today = date('Y-m-d') ;
        $time_now = date('H:i:s') ;
        
        if(strcmp($date_today, $event->date) > 0){
            return true;
        }elseif(strcmp($date_today, $event->date) == 0){
            return (strcmp($time_now, $event->time) > 0); 
        }else
            return false;
    }
}
