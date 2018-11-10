<?php

namespace App\Http\Controllers;

use App\event;
use Illuminate\Http\Request;

class Event_MemberController extends Controller
{
    //查看主页
    public function index(){
        $events = event::all();
        return view('event_member/index',compact('events'));
    }
}
