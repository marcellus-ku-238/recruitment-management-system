<?php

namespace App\Http\Controllers\Api\V1;

use App\Services\JobService;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use App\Http\Requests\Job\Upsert;
use App\Http\Controllers\Controller;
use App\Http\Requests\Job\Apply;

class JobController extends Controller
{
    use ApiResponser;
    protected $service;

    public function __construct(JobService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        $jobs = $this->service->collection($request->all()); 
        return $this->success($jobs);
    }

    public function store(Upsert $request)
    {
        $job = $this->service->store($request->validated());
        return $this->success($job);
    }

    public function show($job, Request $request)
    {
        $job = $this->service->resource($job, $request->all()); 
        return $this->success($job);
    }

    public function update($job, Upsert $request)
    {
        $job = $this->service->update($job, $request->validated()); 
        return $this->success($job);
    }

    public function destroy($job)
    {
        $data = $this->service->destroy($job); 
        return $this->success($data);
    }

    public function applyJob(Apply $request)
    {
        $data = $this->service->applyJob($request->validated());
        return $this->success($data);
    }
}
