<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;
    protected $table = "department";
    protected $fillable = [
        'name', 
        'description', 
        'image'
    ];


    public function journal(){
        return $this->hasMany(Journal::class);
    }
    public function staff(){
        return $this->hasMany(Staff::class);
    }
}
