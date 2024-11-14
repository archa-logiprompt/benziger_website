<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Journal extends Model
{
    use HasFactory;
    protected $table = "journal";
    protected $fillable = [
        'paper_title',
        'department_id',
        'country_code',
        'paper',
        'abstract',
        'key_words'
    ];
}
