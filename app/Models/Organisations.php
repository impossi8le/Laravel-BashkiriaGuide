<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organisations extends Model
{
    use HasFactory;

    protected $table = 'organisations';

    protected $casts = [
        'phones' => 'array'
    ];
    
}
 