<?php

namespace App\Services;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use \Illuminate\Support\Str;
use App\Services\BaseService;

class MedicalPractitionerService extends BaseService
{
    protected $model;

    public function __construct()
    {
        $this->model = User::class;
    }

    public function storeOrUpdate($data, $id = null)
    {
        try {
            // manage additional data
            $data['first_name'] = $data['first_name'];
            $data['last_name'] = $data['last_name'];
            $data['email'] = $data['email'];
            $data['phone'] = $data['phone'];
            $data['address'] = $data['address'];
            $data['password'] = Hash::make($data['password']);

            // Call patent method
            return parent::storeOrUpdate($data, $id);
        } catch (\Exception $e) {
            $this->logFlashThrow($e);
        }
    }
}

