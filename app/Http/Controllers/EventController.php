<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Event;

class EventController extends Controller
{
    //public function index() {}

    public function store() {
        //request('event_title');
        //request('event_price');
        //request('event_date');
        //request('event_description');

        

        $event_title =request('event_title');
        $event_type =request('event_type');
        $event_price =request('event_price');
        $event_date =request('event_date');
        $event_city =request('event_city');
        $event_description =request('event_description');

        $data=array('event_title'=>$event_title,'event_type'=>$event_type,"event_price"=>$event_price,"event_date"=>$event_date,"event_description"=>$event_description, "event_city"=>$event_city);
        
        DB::table('event')->insert($data);



    }
}
