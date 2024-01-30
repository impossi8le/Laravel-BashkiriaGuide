<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Locations;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LocationsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $locations = Locations::all(); // Получаем все записи из таблицы locations
        return view('admin.locations.index', compact('locations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.locations.create');//
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if($request){
            if($request->hasFile('image')) {
                $file = $request->file('image');
                $path = $file->store('category');
            }
            $location = new Locations();
            $location->name = $request->name;
            $location->point = $request->point;
            $location->address = $request->address;
            $location->img = $path;
            $location->save();
        
            return redirect()->route('locations.index')->with('success', 'Категория создана успешно.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Locations $locations)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Locations $location)
    {
        return view('admin.locations.edit', ['location' => $location]);
    }
    // $locations
    // locations
    // $location
    // location
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Locations $location)
    {
        // Validate and get the request data
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'parent_id' => 'nullable|integer',
            // Include other validation rules as necessary
        ]);
    
        if ($request->hasFile('image')) {
            // Удаляем старый файл, если он есть
            if ($location->img) {
                Storage::delete($location->img);
            }
    
            // Загружаем новый файл и сохраняем путь к нему
            $path = $request->file('image')->store('category');
            $data['img'] = $path;
        }
    
        // Обновляем категорию в базе данных
        $location->update($data);
    
        return redirect()->route('locations.index')->with('success', 'Категория обновлена успешно.');
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Locations $location)
    {
        // Удаляем статью
        $location->delete();

        // Перенаправляем на список статей с сообщением об успешном удалении
        return redirect()->route('locations.index')->with('success', 'Статья удалена успешно.');
        
    }
}
