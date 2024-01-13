<?php

namespace App\Http\Controllers;

use App\DataTables\ScheduleDataTableForAdmin;
use App\DataTables\ScheduleDataTableForAnesthesiologist;
use App\DataTables\ScheduleDataTableForMedicalPractitioner;
use Illuminate\Http\Request;
use App\DataTables\ScheduleDataTable;
use App\Http\Requests\ScheduleRequest;
use App\Services\Utils\FileUploadService;
use App\Models\Schedule;
use App\Services\ScheduleService;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class ScheduleController extends Controller
{
    protected $scheduleService;
    protected $fileUploadService;

    public function __construct(ScheduleService $scheduleService, FileUploadService $fileUploadService)
    {
        $this->scheduleService = $scheduleService;
        $this->fileUploadService = $fileUploadService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(ScheduleDataTable $dataTable)
    {
        set_page_meta('Schedule');
        return $dataTable->render('anesthesiologist.index');
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
        //$data = $request->validated();
        //$data['user_id'] = Auth::user()->id;
        try {
            //$schedule = $this->scheduleService->storeOrUpdate($data, null);
            $schedule = Schedule::create([
                'user_id' => Auth::user()->id,
                'start' => $request['start'],
                'end' => $request['end'],
                'honorary_note' => $request['honorary_note'],
            ]);
            if ($schedule) {
                $image = $this->fileUploadService->upload($request['honorary_note'], Schedule::FILE_STORE_HONORARY_PATH, false, true);
                $schedule->honorary_note = $image;
                $schedule->save();
            }
            record_created_flash();
            return redirect()->route('admin.get.anesthesiologist.schedule');
        } catch (\Exception $e) {
        }
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

            $schedule = Schedule::find($id);
            $schedule->user_id = Auth::user()->id;
            $schedule->start = $request->start;
            $schedule->end = $request->end;
            $schedule->honorary_note = 'image';
            $schedule->save();

            if ($schedule) {
                $image = $this->fileUploadService->upload($request['honorary_note'], Schedule::FILE_STORE_HONORARY_PATH, false, true);
                $schedule->honorary_note = $image;
                $schedule->save();
            }


            record_updated_flash();
            return redirect()->route('admin.get.anesthesiologist.schedule');

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
    public function showAllSchedule()
    {
        set_page_meta('Schedules');
        if (Auth::user()->user_type == User::USER_TYPE_ADMIN) {
            $events = array();
            $schedules = Schedule::all();
            foreach ($schedules as $schedule) {

                $events[] = [
                    'title' => $schedule->user->first_name . ' ' . $schedule->user->last_name,
                    'user_type' => $schedule->user->user_type,
                    'start' => $schedule->start,
                    'end' => $schedule->end,
                    'phone' => $schedule->user->phone,
                    'email' => $schedule->user->email,
                    'location' => $schedule->user->location,
                    'type_of_nesthesiology' => $schedule->anesthesiology_type,
                    'schedule_id' => $schedule->id,
                    'honorary_note' => $schedule->honorary_note,
                    // 'anesthesiologist_name' => $schedule->anesthesiologist->first_name .' '.$schedule->anesthesiologist->last_name,
                    // 'practitioner_name' => $schedule->practicioner->first_name .' '.$schedule->practicioner->last_name,
                    // 'phone' => $schedule->practicioner->phone,
                    // 'email' => $schedule->practicioner->email,
                ];
            }
            return view('admin.dashboard.admin.calender', compact('events'));
        }
    }

    //Show schedules to anesthesiologist;
    public function showAnesthesiologitSchedule(ScheduleDataTableForAnesthesiologist $dataTable)
    {
        set_page_meta('Schedules');
        return $dataTable->render('anesthesiologist.showschedule');
    }

    //Show schedules to medical practitioner;
    public function showMedicalPractitionerSchedule(ScheduleDataTableForMedicalPractitioner $dataTable)
    {
        set_page_meta('Schedules');
        return $dataTable->render('medical_practitioners.showschedule');
    }
}
