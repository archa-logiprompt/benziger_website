<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GeneralSettings extends Model
{
    use HasFactory;
    protected $table = "general_settings";
    protected $fillable = [
        'logo',
        'contact',
        'whatsappContact',
        'email',
        'address_line1',
        'address_line2',
        'city',
        'state',
        'country',
        'postalCode',
        'apiKey',
        'apiSecret',
        'payment',
        'amount'

    ];
}
