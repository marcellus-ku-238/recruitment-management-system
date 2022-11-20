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

        $filters = $inputs['filters'];
        if (!empty($filters)) {
            if (array_key_exists('company_name', $filters)) {
                $jobs = $jobs->whereCompanyName($filters['company_name']);
            }

            if (array_key_exists('employment_type', $filters)) {
                $jobs = $jobs->whereEmploymentType($filters['employment_type']);
            }

            if (array_key_exists('industry_type', $filters)) {
                $jobs = $jobs->whereIndustryType($filters['industry_type']);
            }
            
            if (array_key_exists('experince', $filters)) {
                $jobs = $jobs->whereExperince($filters['experince']);
            }
        }

        if (!empty($inputs['search'])) {
            $jobs = $jobs->search($inputs['search']);
        }
        return $jobs->paginate(config('site.pagination.limit'));
    }

    public function store($inputs = [])
    {
        $job = JobDescription::create($inputs);
        if (!empty($inputs['tags'])) $job->attachTags($inputs['tags']);
        return $job;
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
        if (!empty($inputs['tags'])) $job->syncTags($inputs['tags']);
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

    public function applyJob($id)
    {
        $job = $this->resource($id);
        $job->applicants()->attach(auth()->id());
        return [
            'message' => 'Job applied successfully.'
        ];
    }
}
