<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Routes;
use App\Models\Organisations;
use App\Models\Attributes;
use App\Models\Locations;



class Places extends Model
{
    use HasFactory;
    protected $table = 'places';
    protected $fillable = ['name', 'description', 'address', 'attributedId', 'orientationImg', 'subcategoryId', 'locationId', 'routeId', 'organisationId'];


    public function routes()
    {
        return $this->belongsToMany(Routes::class, 'places_has_route', 'place_id', 'route_id');
    }

    public function organisations()
    {
        return $this->belongsToMany(Organisations::class, 'places_has_organisations', 'place_id', 'organisation_id');
    }

    public function attributes()
    {
        return $this->belongsToMany(Attributes::class, 'places_has_attribute', 'place_id', 'attribute_id');
    }

    public function location()
    {
        return $this->belongsTo(Locations::class, 'locationId');
    }
}
