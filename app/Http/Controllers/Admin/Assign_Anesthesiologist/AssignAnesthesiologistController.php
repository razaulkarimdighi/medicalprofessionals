<?php

namespace App\Http\Controllers\Admin\Assign_Anesthesiologist;

use App\DataTables\ShowAssignmentToAnesthesiologistDataTable;
use App\DataTables\ShowAssignmentToPractitionersDataTable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DataTables\AssignAnesthesiologistDataTable;
use App\Services\AssignAnesthesiologistService;
use App\Models\Assignment;
use App\Models\User;
use App\Models\Schedule;

class AssignAnesthesiologistController extends Controller
{

    protected $assignAnesthesiologistService;

    public function __construct(AssignAnesthesiologistService $assignAnesthesiologistService)
    {
        $this->assignAnesthesiologistService = $assignAnesthesiologistService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(AssignAnesthesiologistDataTable $dataTable)
    {

        set_page_meta('Assignments');
        return $dataTable->render('admin.assign_anesthesiologists.index');

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {


        try {

            $data = $request->all();
            $schedule = Schedule::where('user_id','=', $data['anesthesiologist_id'])->where('id','=',$data['schedule'])->first();
            $ass = [
                'anesthesiologist_id' => $data['anesthesiologist_id'],
                'practicioner_id' => $data['practicioner_id'],
                'schedule_id' => $data['schedule'],
                'start' => $schedule->start,
                'end' => $schedule->end,
            ];
            $assignment = $this->assignAnesthesiologistService->storeOrUpdate($ass, null);

            if($assignment){
                $schedule = Schedule::where('user_id','=', $data['anesthesiologist_id'])->where('id','=',$data['schedule'])->first();
                $schedule->status = "assigned";
                $schedule->save();
                record_created_flash();
               }

        } catch (\Exception $e) {
        }
        return redirect()->route('admin.assign_anesthesiologists.index');


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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function getAnesthesiologist($id){
        set_page_meta('Assign Anesthesiologist');
        $schedules = Schedule::where('status','=',"not_assigned")->get();
        $anesthesiologists = User::where('user_type','=',"anesthesiologists")->get();
        $practicioner_id = $id;
        return view('admin.assign_anesthesiologists.create', compact('anesthesiologists','schedules', 'practicioner_id'));
    }

    //Show assignment to practitioner

    public function showAssignmentToPractitioners(ShowAssignmentToPractitionersDataTable $dataTable){

        set_page_meta('Assignments');
        return $dataTable->render('medical_practitioners.assignment');

    }


    //Show assignment to Anesthesiologist

    public function showAssignmentToAnesthesiologist(ShowAssignmentToAnesthesiologistDataTable $dataTable){

        set_page_meta('Assignments');
        return $dataTable->render('anesthesiologist.assignment');

    }

    //Anesthesiologist Dependent Dropdown Menu

    public function fetchSchedules(Request $request){


        $schedules = Schedule::where('user_id', $request->anesthesiologist)->where('status','=','not_assigned')->get();

        return response()->json([
            'status' => 'success',
            'schedules' => $schedules,
        ]);
    }







}
