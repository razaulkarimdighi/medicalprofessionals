<?php

namespace App\Http\Controllers\Admin\Permission;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
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
    public function store(Request $request)
    {
        //
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
}







// <?php

// namespace App\Http\Controllers\Admin\Anesthesiologist;

// use App\Http\Controllers\Controller;
// use Illuminate\Http\Request;
// use App\Models\User;
// use App\DataTables\AnesthesiologistDataTable;
// use App\Http\Requests\AnesthesiologistRequest;
// use App\Http\Requests\PermissionRequest;
// use App\Services\UserService;

// class AnesthesiologistController extends Controller
// {

//     protected $userService;

//     public function __construct(UserService $userService)
//     {
//         $this->userService = $userService;
//     }
//     /**
//      * Display a listing of the resource.
//      */
//     public function index(AnesthesiologistDataTable $dataTable)
//     {
//         set_page_meta('Anesthesiologis');
//         return $dataTable->render('admin.anesthesiologists.index');
//     }

//     /**
//      * Show the form for creating a new resource.
//      */
//     public function create()
//     {
//       set_page_meta('Create Anesthesiologist');
//       return view('admin.anesthesiologists.create');
//     }

//     /**
//      * Store a newly created resource in storage.
//      */
//     public function store(PermissionRequest $request)
//     {
//         $data = $request->validated();
//         $data['user_type'] = User::USER_TYPE_ANESTHEIOLOGISTS;
//         try {
//             $this->userService->storeOrUpdate($data, null);
//             record_created_flash();
//         } catch (\Exception $e) {
//         }
//         return redirect()->route('admin.anesthesiologists.index');

//     }

//     /**
//      * Display the specified resource.
//      */
//     public function show(string $id)
//     {
//         //
//     }

//     /**
//      * Show the form for editing the specified resource.
//      */
//     public function edit(string $id)
//     {


//         try {
//             set_page_meta('Edit Anesthesiologist');
//             $anesthesiologist = $this->userService->get($id);
//             return view('admin.anesthesiologists.edit', compact('anesthesiologist'));
//         } catch (\Exception $e) {
//             log_error($e);
//         }

//     }

//     /**
//      * Update the specified resource in storage.
//      */
//     public function update(PermissionRequest $request, string $id)
//     {
//         $data = $request->validated();
//         $this->userService->storeOrUpdate($data, $id);
//         try {

//             record_created_flash();
//         } catch (\Exception $e) {
//         }
//         return redirect()->route('admin.anesthesiologists.index');
//     }

//     /**
//      * Remove the specified resource from storage.
//      */
//     public function destroy(string $id)
//     {
//         try {
//             $this->userService->delete($id);
//             record_deleted_flash();
//             return back();
//         } catch (\Exception $e) {
//             return back();
//         }
//     }
// }

