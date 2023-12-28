<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        set_page_meta('Dashboard');
        if(Auth::user()->user_type == User::USER_TYPE_ADMIN){
            $events = Array();
        $schedules = Schedule::all();
        foreach($schedules as $schedule){
            $events[]=[
                      'title' => $schedule->user->first_name.' '.$schedule->user->last_name,
                      'start' => $schedule->start,
                      'end' => $schedule->end
                    ];
        }
            return view('admin.dashboard.admin.index',compact('events'));
        }elseif (Auth::user()->user_type == User::USER_TYPE_ANESTHEIOLOGISTS){
            // return view('admin.dashboard.admin.index');
        }else{
            // return view('admin.dashboard.medical.index');
        }

    }

}
