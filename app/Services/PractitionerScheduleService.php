<?php

namespace App\Services;


use App\Models\Schedule;
use Illuminate\Support\Facades\Hash;
use \Illuminate\Support\Str;
use App\Services\BaseService;

class PractitionerScheduleService extends BaseService
{

    protected $model;

    public function __construct()
    {
        $this->model = Schedule::class;
    }

    public function storeOrUpdate($data, $id = null)
    {
        try {
            // manage additional data
            // $data['available_date'] = $data['available_date'];
            // $data['start_time'] = $data['start_time'];
            // $data['end_time'] = $data['end_time'];
            // $data['available_date'] = Str::lower($data['available_date']);
            // $data['user_id'] = $data['user_id'];
            // $data['status'] = $data['status'];
            // Call patent method
            return parent::storeOrUpdate($data, $id);
        } catch (\Exception $e) {
            $this->logFlashThrow($e);
        }
    }
}

