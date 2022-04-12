<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailList extends Model
{
    use HasFactory;
    protected $table = 'email_list';
    public const CREATED_AT = null;
    public const UPDATED_AT = null;
}
