<?php

namespace App\Http\Controllers\Admin\Assign_Anesthesiologist;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DataTables\AssignAnesthesiologistDataTable;
use App\DataTables\ShowAssignDateToAnesthesiologist;
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
    public function index()
    {

         set_page_meta('Assignment');
        //return response()->json(["assign" => $assign]);
        return view('admin.assign_anesthesiologists.index');
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
        $data = $request->all();
        $assignment = $this->assignAnesthesiologistService->storeOrUpdate($data, null);
        try {

            if($assignment){
                $schedule = Schedule::where('user_id','=',$assignment->anesthesiologist_id)->where('available_date','=',$assignment->assignment_date)->first();
                $schedule->status = "assigned";
                $schedule->save();
                record_created_flash();
               }


        } catch (\Exception $e) {
        }
        return redirect()->route('admin.anesthesiologists.index');


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

    //get all assignment
    public function getAllAssignment(){
        $assignments = Assignment::all();

        $data = [
            'status'=>200,
            'message'   => 'Successfully fetch',
            'events'=> $assignments,
        ];
        // dd($data);

        return response()->json($data);
    }


}
