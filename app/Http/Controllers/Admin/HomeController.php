<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Places;
use App\Models\Articles;
use App\Models\Routes;
use App\Models\Agencies;
use App\Models\Categories;
use App\Models\Organisations;
use App\Models\Attributes;
use App\Models\Locations;



class HomeController extends Controller
{
    public function index(){

        $articles_count = Articles::count();
        $routes_count = Routes::count();
        $agencies_count = Agencies::count();
        $categories_count = Categories::count();
        $organisations_count = Organisations::count();
        $places_count = Places::count();
        $attributes_count = Attributes::count();
        $locations_count = Locations::count();
        

        return view('admin.home.index', [
            'articles_count' => $articles_count,
            'routes_count' => $routes_count,
            'agencies_count' => $agencies_count,
            'categories_count' => $categories_count,
            'organisations_count' => $organisations_count,
            'places_count' => $places_count,
            'attributes_count' => $attributes_count,
            'locations_count' => $locations_count


        ]);    
    }
}
