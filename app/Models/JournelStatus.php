<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JournelStatus extends Model
{
    use HasFactory;
    protected $table = "journel_status";
    protected $fillable = [
        'staffid',
        'journelid',
        'reason',
        'status',
    ];
}
