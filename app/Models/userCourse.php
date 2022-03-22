<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class userCourse extends Model
{
    protected $table = 'user_course';
    public const CREATED_AT = 'start_date';
    public const UPDATED_AT = 'end_date';
    protected $primaryKey = 'user_course_id';
    use HasFactory;
}
