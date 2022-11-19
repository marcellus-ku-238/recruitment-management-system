<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\ApplyJob;
use App\Services\UserService;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;

class UserController extends Controller
{
    use ApiResponser;

    protected $service;

    public function __construct(UserService $service)
    {
        $this->service = $service;
    }

    public function applyJob(ApplyJob $job)
    {
        $data = $this->service->applyJob($job);
        return $this->success($data);
    }
}
