<?php

namespace App\Services;
use App\Services\BaseService;
use App\Models\Assignment;

class AssignAnesthesiologistService extends BaseService
{
    protected $model;

    public function __construct()
    {
        $this->model = Assignment::class;
    }

    public function storeOrUpdate($data, $id = null)
    {

        try {
            // manage additional data
            // $data['practicioner_id'] = $data['practicioner_id'];
            // $data['available_date'] = $data['available_date'];


            // Call patent method

            return parent::storeOrUpdate($data, $id);
        } catch (\Exception $e) {
            $this->logFlashThrow($e);
        }
    }
}

