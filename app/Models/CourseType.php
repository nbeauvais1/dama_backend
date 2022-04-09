<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseType extends Model
{
    protected $table = 'course_types';
    public const CREATED_AT = null;
    public const UPDATED_AT = null;
    protected $primaryKey = 'course_type';
    use HasFactory;
}
