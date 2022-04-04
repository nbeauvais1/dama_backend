<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MembershipType extends Model
{
    protected $table = 'membership';
    public const CREATED_AT = 'null';
    public const UPDATED_AT = 'null';
    protected $primaryKey = 'membership_id';
    use HasFactory;
}
