<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use App\Http\Resources\PlacesResource;
use App\Models\Places;
use Illuminate\Http\Request;


class PlacesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $places = Places::all();
        return PlacesResource::collection($places);
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $places = $query 
                ? Places::where('name', 'LIKE', "%{$query}%")->get()
                : Places::all();
    
        // Check if the request is AJAX
        if ($request->ajax()) {
            // Return partial HTML view with the places list
            return view('partials.placesList', compact('places'))->render(); 
        }
    
        // If not an AJAX request, return the full page
        return view('app.search', compact('places'));
    }
    
    public function map(Request $request)
    {
        return view('app.map');
    }
    public function maps(Request $request)
    {
        return view('app.maps');
    }
    public function show($id)
    {
        $place = Places::findOrFail($id); // Find the place by id or throw an exception if not found
        return view('app.place', compact('place')); // Return the view with the place data
    }

    
}
