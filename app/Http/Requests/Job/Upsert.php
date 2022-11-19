<?php

namespace App\Http\Requests\Job;

use Illuminate\Foundation\Http\FormRequest;

class Upsert extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => 'required|max:64',
            'description' => 'required|max:1024',
            'company_name' => 'required|max:64',
            'company_detail' => 'required|max:64',
            'company_url' => 'required|max:512',
            'employment_type' => 'required|max:64',
            'industry_type' => 'required|max:64',
            'experince' => 'required|max:64',
        ];
    }
}
