<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataTables\PractitionerScheduleDataTable;
use App\Http\Requests\ScheduleRequest;
use App\Models\Schedule;
use App\Services\PractitionerScheduleService;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class PractitionerScheduleController extends Controller
{
    protected $scheduleService;

    public function __construct(PractitionerScheduleService $scheduleService)
    {
        $this->scheduleService = $scheduleService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(PractitionerScheduleDataTable $dataTable)
    {
        set_page_meta('Schedule');
        return $dataTable->render('medical_practitioners.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        set_page_meta('Create Schedule');
        return view('anesthesiologist.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ScheduleRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = Auth::user()->id;
        try {
        $this->scheduleService->storeOrUpdate($data, null);
        record_created_flash();

        } catch (\Exception $e) {
        }
        return redirect()->route('admin.schedules.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            set_page_meta('Edit Schedule');
            $schedule = $this->scheduleService->get($id);
            return view('anesthesiologist.edit', compact('schedule'));
        } catch (\Exception $e) {
            log_error($e);
        }
        return back();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ScheduleRequest $request, string $id)
    {
        $data = $request->validated();
        try {
            $this->scheduleService->storeOrUpdate($data, $id);
            record_updated_flash();
            return redirect()->route('admin.schedules.index');
        } catch (\Exception $e) {
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $this->scheduleService->delete($id);
            record_deleted_flash();
            return back();
        } catch (\Exception $e) {
            return back();
        }
    }


    //Show all schedule to admin;
    public function showAllSchedule(){
        $events = Array();
        $schedules = Schedule::all();
        foreach($schedules as $schedule){
            $events[]=[
                      'title' => $schedule->user->first_name.' '.$schedule->user->last_name,
                      'start' => $schedule->start,
                      'end' => $schedule->end
                    ];
        }

        set_page_meta('Schedule');
        return view('admin.schedule.index', ['events' => $events]);
    }
}
