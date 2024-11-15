<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermissionCategory extends Model
{
    use HasFactory;
    protected $table = "permission_category";
    protected $fillable = [
        'name',
        'short_code',
    ];
}
