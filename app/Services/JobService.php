<?php

namespace App\Services;

use App\Models\JobDescription;

class JobService
{
    protected $model;

    public function __construct(JobDescription $model)
    {
        $this->model = $model;   
    }

    public function collection($inputs = [])
    {
        $jobs = $this->model;
        return $jobs->paginate(config('site.pagination.limit'));
    }

    public function store($inputs = [])
    {
        return JobDescription::create($inputs);
    }

    public function resource($id, $inputs = [])
    {
        $job = $this->model;
        return $job->findOrFail($id);
    }

    public function update($id, $inputs = [])
    {
        $job = $this->resource($id);
        $job->update($inputs);
        return $job;
    }

    public function destroy($id)
    {
        $job = $this->resource($id);
        $job->delete();
        return [
            'message' => 'Entity deleted successfully.'
        ];
    }
}