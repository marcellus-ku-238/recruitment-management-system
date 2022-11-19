<?php

namespace App\Services;

use App\Models\User;

class UserService
{
    protected $model;

    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public function applyJob($inputs = [])
    {
        $user = $this->model->findOrFail(auth()->id());
        $user->appliedJobs()->attach($inputs['jobId']);
        return [
            'message' => 'Job applied successfully.'
        ];
    }   
}