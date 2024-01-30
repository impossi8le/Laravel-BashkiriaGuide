<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agencies extends Model
{
    use HasFactory;

    protected $table = 'agency';

    protected $casts = [
        'phones' => 'array'
    ];
}
