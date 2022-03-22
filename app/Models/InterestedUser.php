<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InterestedUser extends Model
{
    protected $table = 'user_job';
    public const CREATED_AT = null;
    public const UPDATED_AT = null;
    protected $primaryKey = 'user_job_id';
    use HasFactory;
}
