<?php

namespace App\Http\Controllers\Admin\Medical_Practitioner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DataTables\MedicalPractitionerDataTable;
use App\Services\UserService;
use App\Models\User;
use App\Http\Requests\MedicalPractitionerRequest;
use App\Http\Requests\MedicalPractitionerEditRequest;


class MedicalPractitionerController extends Controller
{

    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(MedicalPractitionerDataTable $dataTable)
    {
        set_page_meta('Medical Practitioners');
        return $dataTable->render('admin.medical_practitioners.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        set_page_meta('Create Medical_Practitioner');
        return view('admin.medical_practitioners.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MedicalPractitionerRequest $request)
    {
        $data = $request->validated();
        $data['user_type'] = User::USER_TYPE_MEDICAL_PRACTICES;
        try {
            $this->userService->storeOrUpdate($data, null);
            record_created_flash();
        } catch (\Exception $e) {
        }
        return redirect()->route('admin.medical_practitioners.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = User::where('id', $id)->first();
        return view('honorary-note', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            set_page_meta('Edit Medical Practitioner');
            $medical_practitioner = $this->userService->get($id);
            return view('admin.medical_practitioners.edit', compact('medical_practitioner'));
        } catch (\Exception $e) {
            log_error($e);
        }

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MedicalPractitionerEditRequest $request, string $id)
    {
        $data = $request->validated();
        //$data['user_type'] = User::USER_TYPE_MEDICAL_PRACTICES;
        $this->userService->storeOrUpdate($data, $id);
            record_updated_flash();
        try {
            // $this->userService->storeOrUpdate($data, null);
            // record_created_flash();
        } catch (\Exception $e) {
        }
        return redirect()->route('admin.medical_practitioners.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        try {
            $this->userService->delete($id);
            record_deleted_flash();
            return back();
        } catch (\Exception $e) {
            return back();
        }


    }
}
