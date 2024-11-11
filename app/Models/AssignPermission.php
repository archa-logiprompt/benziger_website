<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignPermission extends Model
{
    use HasFactory;
    protected $table = "assign_permission";
    protected $fillable = [
        'role_id',
        'category_id',
        'can_view',
    ];
}
