<?php

namespace App\Http\Controllers;

use App\DataTables\ScheduleDataTableForAdmin;
use App\DataTables\ScheduleDataTableForAnesthesiologist;
use App\DataTables\ScheduleDataTableForMedicalPractitioner;
use App\Http\Requests\PractitionerScheduleRequest;
use App\Services\PractitionerScheduleService;
use Illuminate\Http\Request;
use App\DataTables\ScheduleDataTable;
use App\Http\Requests\ScheduleRequest;
use App\Services\Utils\FileUploadService;
use App\Models\Schedule;
use App\Services\ScheduleService;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\File;

class PractitionerScheduleController extends Controller
{
    protected $scheduleService;
    protected $fileUploadService;


    public function __construct(PractitionerScheduleService $scheduleService, FileUploadService $fileUploadService)
    {
        $this->scheduleService = $scheduleService;
        $this->fileUploadService = $fileUploadService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(ScheduleDataTableForMedicalPractitioner $dataTable)
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
        return view('medical_practitioners.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PractitionerScheduleRequest $request)
    {
        //$data = $request->validated();
        //$data['user_id'] = Auth::user()->id;
        try {
            //$schedule = $this->scheduleService->storeOrUpdate($data, null);
            $schedule = Schedule::create([
                'user_id' => Auth::user()->id,
                'start' => $request['start'],
                'end' => $request['end'],
                'anesthesiology_type' => $request['anesthesiology_type'],
                'honorary_note' => $request['honorary_note'],
            ]);
            if ($schedule) {
                $image = $this->fileUploadService->upload($request['honorary_note'], Schedule::FILE_STORE_HONORARY_PATH, false, true);
                $schedule->honorary_note = $image;
                $schedule->save();
            }
            record_created_flash();
            return redirect()->route('admin.practitioners.index');
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
            return view('medical_practitioners.edit', compact('schedule'));
        } catch (\Exception $e) {
            log_error($e);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PractitionerScheduleRequest $request, string $id)
    {

        $schedule = Schedule::find($id);
        $schedule->user_id = Auth::user()->id;
        $schedule->start = $request->start;
        $schedule->anesthesiology_type = $request->anesthesiology_type;
        $schedule->end = $request->end;

        if ($request->hasFile('honorary_note')) {

            $destination = 'storage/file' . $schedule->honorary_note;
            if (File::exists($destination)) {
                File::delete($destination);
            }
            $file = $request->file('honorary_note');
            $extention = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extention;
            $file->move('storage/file/', $filename);
            $schedule->honorary_note = $filename;
        }
        $schedule->save();
        record_updated_flash();
        return redirect()->route('admin.get.anesthesiologist.schedule');

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
        $events = array();
        $schedules = Schedule::all();
        foreach ($schedules as $schedule) {
            $events[] = [
                'title' => $schedule->user->first_name . ' ' . $schedule->user->last_name,
                'start' => $schedule->start,
                'end' => $schedule->end
            ];
        }

        set_page_meta('Schedule');
        return view('admin.schedule.index', ['events' => $events]);
    }
}
