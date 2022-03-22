<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class applications extends Model
{
    protected $table = 'applications';
    public const CREATED_AT = null;
    public const UPDATED_AT = null;
    protected $primaryKey = 'app_id';
    use HasFactory;
}
