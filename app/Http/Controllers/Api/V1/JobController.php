<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;

class JobController extends Controller
{
    use ApiResponser;
    protected $service;

    public function __construct($service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        $jobs = $this->service->collection($request->all()); 
        return $this->success($jobs);
    }

    public function store($request)
    {
        $job = $this->service->create($request->validated());
        return $this->success($job);
    }

    public function show($id, Request $request)
    {
        $job = $this->service->resource($id, $request->all()); 
        return $this->success($job);
    }

    public function update($id, Request $request)
    {
        $job = $this->service->update($id, $request->validated()); 
        return $this->success($job);
    }

    public function destroy($id)
    {
        $data = $this->service->destroy($id); 
        return $this->success($data);
    }
}
