<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NonMemberCourse extends Model
{
    use HasFactory;
    protected $table = 'nonmember_user_course';
    public $timestamps = false;
}
