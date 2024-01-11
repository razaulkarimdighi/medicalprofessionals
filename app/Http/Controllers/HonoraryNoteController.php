<?php

namespace App\Http\Controllers;

use App\Http\Requests\HonoraryNoteRequest;
use App\Models\Schedule;
use App\Services\Utils\FileUploadService;
use Illuminate\Http\Request;

class HonoraryNoteController extends Controller
{
    protected $fileUploadService;

    public function __construct( FileUploadService $fileUploadService)
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
    public function updateHonoraryNote( Request $request, $id ){
        dd($request);
    }
}
