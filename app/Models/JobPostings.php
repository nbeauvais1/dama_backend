<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobPostings extends Model
{
    protected $table = 'job_posting';
    public const CREATED_AT = null;
    public const UPDATED_AT = null;
    protected $primaryKey = 'posting_id';
    use HasFactory;
}
