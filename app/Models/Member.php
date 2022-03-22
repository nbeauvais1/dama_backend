<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $table = 'user';
    public const CREATED_AT = 'null';
    public const UPDATED_AT = 'null';
    protected $primaryKey = 'user_id';
    use HasFactory;
}

