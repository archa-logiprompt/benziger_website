<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JournalAuthor extends Model
{
    use HasFactory;
    use HasFactory;
    protected $table = "journal_author";
    protected $fillable = [
        'journal_id',
        'name', 
        'designation', 
        'organization',
        'email',
        'mobile',
        'address_line1',
        'address_line2',
        'city',
        'state',
        'country',
        'postalCode',
        'main'
    ];
}
