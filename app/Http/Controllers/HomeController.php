<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
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
        if (Auth::user()->user_type == User::USER_TYPE_ADMIN) {
            $events = array();
            $schedules = Schedule::all();
            $totalSchedule = Schedule::count();
            $anesthesiologists = User::where('user_type',User::USER_TYPE_ANESTHEIOLOGISTS)->count();
            $medical_practitioners = User::where('user_type',User::USER_TYPE_MEDICAL_PRACTICES)->count();
            $notAssignedSchedule = Schedule::where('status',Schedule::NOT_ASSIGNED_SCHEDULE)->count();
            $assignedSchedule = Schedule::where('status',Schedule::ASSIGNED_SCHEDULE)->count();
            $assignedSchedules = Assignment::all();
            $totalUser = $anesthesiologists +  $medical_practitioners;
            foreach ($assignedSchedules as $schedule) {

                $events[] = [
                    'title' => $schedule->anesthesiologist->first_name . ' ' . $schedule->anesthesiologist->last_name .'<br/>'. ' with ' .'</br>'.$schedule->practicioner->first_name . ' ' . $schedule->practicioner->last_name,
                    'start' => $schedule->start,
                    'end' => $schedule->end
                ];
            }
            return view('admin.dashboard.admin.index', compact('events','totalUser','totalSchedule', 'notAssignedSchedule','assignedSchedule'));
        } elseif (Auth::user()->user_type == User::USER_TYPE_ANESTHEIOLOGISTS) {
            $events = array();
            $schedules = Assignment::where('anesthesiologist_id','=', Auth::user()->id)->get();
            $user_schedules = Schedule::where('user_id','=', Auth::user()->id)->count();

            $notAssignedSchedule = Schedule::where('user_id','=', Auth::user()->id)->where('status',Schedule::NOT_ASSIGNED_SCHEDULE)->count();
            $assignedSchedule = Schedule::where('user_id','=', Auth::user()->id)->where('status',Schedule::ASSIGNED_SCHEDULE)->count();
            foreach ($schedules as $schedule) {
                $events[] = [
                    'title' => $schedule->practicioner->first_name . ' ' . $schedule->practicioner->last_name,
                    'start' => $schedule->start,
                    'end' => $schedule->end
                ];
            }
            return view('admin.dashboard.anasthesiologist.index', compact('events','schedules','user_schedules','notAssignedSchedule','assignedSchedule'));
        } else {
            $events = array();
            $schedules = Assignment::where('practicioner_id','=', Auth::user()->id)->get();
            $user_schedules = Schedule::where('user_id','=', Auth::user()->id)->count();

            $notAssignedSchedule = Schedule::where('user_id','=', Auth::user()->id)->where('status',Schedule::NOT_ASSIGNED_SCHEDULE)->count();
            $assignedSchedule = Schedule::where('user_id','=', Auth::user()->id)->where('status',Schedule::ASSIGNED_SCHEDULE)->count();
            foreach ($schedules as $schedule) {
                $events[] = [
                    'title' => $schedule->anesthesiologist->first_name . ' ' . $schedule->anesthesiologist->last_name,
                    'start' => $schedule->start,
                    'end' => $schedule->end
                ];
            }
            return view('admin.dashboard.medical.index', compact('events','schedules','user_schedules','notAssignedSchedule','assignedSchedule'));
        }
    }
}
