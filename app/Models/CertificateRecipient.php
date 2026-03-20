<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CertificateRecipient extends Model
{
    protected $fillable = [
        'email',
        'last_name',
        'first_name',
        'middle_name',
        'full_name',
        'display_name',
        'raw',
    ];

    protected $casts = [
        'raw' => 'array',
    ];
}
