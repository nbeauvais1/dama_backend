<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    protected $table = 'feedback';
    public const CREATED_AT = null;
    public const UPDATED_AT = null;
    protected $primaryKey = 'feedback_id';
    use HasFactory;
}
