<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InterestedUser extends Model
{
    protected $table = 'interested_jobs';
    public const CREATED_AT = null;
    public const UPDATED_AT = null;
    use HasFactory;
}
