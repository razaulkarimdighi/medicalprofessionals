<?php

namespace App\Http\Controllers;

use App\Http\Requests\HonoraryNoteRequest;
use App\Models\Schedule;
use App\Services\Utils\FileUploadService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class HonoraryNoteController extends Controller
{
    protected $fileUploadService;

    public function __construct(FileUploadService $fileUploadService)
    {
        $this->fileUploadService = $fileUploadService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(HonoraryNoteRequest $request)
    {
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
    public function update(HonoraryNoteRequest $request, string $id)
    {
        // $fileName = time().'.'.$request->honorary_note->extension;
        // $image = $this->fileUploadService->upload($request['honorary_note'], Schedule::FILE_STORE_HONORARY_PATH, false, true);
        // $user->honorary_note = $image;
        // $user->save();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function updateHonoraryNote(Request $request)
    {
        // $validator  = $request->validate([
        //     'schedule_id'=>'required',
        //     'file'=> 'required|mimes:pdf'
        // ]);

        $validator = Validator::make($request->all(), [
            'file' => 'required|mimes:pdf',
            'schedule_id' => 'required',
        ]);




        if ($validator->fails()) {
            $response = [
                'status' => 'validation error',
                'response' => 403,
                'message' => $validator->errors()->first(),
            ];
            return response()->json($response);
        } else {
            $filename = time() . '.' . $request->file->extension();
            $request->file->move(public_path('storage/file'), $filename);
            $schedule = Schedule::find($request->schedule_id);
            $schedule->honorary_note = $filename;
            $schedule->save();
            $response = [
                'status' => 'success',
                'response' => 200,
                'message' => 'File Uploaded Successfully'
            ];
            return response()->json($response);
        }
    }
}
