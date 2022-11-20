<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Tags\HasTags;

class JobDescription extends Model
{
    use HasFactory, SoftDeletes, HasTags;

    protected $fillable = [
        'title',
        'description',
        'company_name',
        'company_detail',
        'company_url',
        'employment_type',
        'industry_type',
        'experince'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'created_at' => 'timestamp',
        'updated_at' => 'timestamp'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'deleted_at'
    ];

    protected $appends = [
        'applicants_count',
    ];


    public function applicants()
    {
        return $this->belongsToMany(User::class);
    }

    public function getApplicantsCountAttribute()
    {
        return $this->applicants()->count() ?? 0;
    }
}
