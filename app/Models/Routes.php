<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Agencies;

class Routes extends Model
{
    use HasFactory;
    
    protected $table = 'route';

    public function agency()
    {
        return $this->belongsTo(Agencies::class, 'agencyId');
    }
}
