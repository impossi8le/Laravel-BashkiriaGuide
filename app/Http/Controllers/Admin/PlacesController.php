<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Places;
use App\Models\Categories;
use App\Models\Routes;
use App\Models\Organisations;
use App\Models\Locations;
use App\Models\Attributes;

use Illuminate\Support\Facades\Storage;



// use App\Models\Places;

use Illuminate\Http\Request;

class PlacesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $new_places = new Places();
        $places = $new_places ->all();
        return view('admin.places.index', compact('places'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Categories::whereNotNull('parent_id')->get(); // Только подкатегории
        $routes = Routes::all();
        $organisations = Organisations::all();
        $locations = Locations::all();
        $attributes = Attributes::all();

        return view('admin.places.create', compact('categories', 'routes', 'organisations', 'attributes', 'locations'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $path = null; // Инициализация переменной перед условным блоком

        // Валидация входящих данных
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'address' => 'nullable|string',
            'orientation' => 'nullable|in:1,2',
            'subcategoryId' => 'required|exists:categories,id',
            'disabilities' => 'nullable|in:1,2', 

            // 'locationId' => 'required|exists:locations,id',
            // 'organisationId' => 'nullable|exists:organisations,id', // Если это поле не используется, его нужно убрать из валидации
        ]);


        // dd($request->all());

        if($request->hasFile('image')) {
            $file = $request->file('image');
            // dd($file);
            $path = $file->store('places', 'public');
        }

        // Создание нового места
        $place = new Places();
        $place->name = $validatedData['name'];
        $place->description = $validatedData['description'];
        $place->address = $validatedData['address'];
        $place->orientationImg = $request->input('orientation'); // Используйте input для получения данных напрямую из запроса
        $place->subcategoryId = $validatedData['subcategoryId'];
        $place->disabilities = $validatedData['disabilities'];


        
        // $place->img = $path;
        if ($path !== null) {
            $place->img = $path; // Присваивание пути изображения, если файл был загружен
        }

        // $place->locationId = $validatedData['locationId'];

        $place->save(); // Сначала сохраняем место

        // Если предоставлен routeId, связываем его с местом через таблицу связи
        if ($request->has('routeId') && $request->routeId) {
            // Проверяем существование маршрута перед добавлением
            $routeExists = Routes::where('id', $request->routeId)->exists();
            if ($routeExists) {
                $place->routes()->attach($request->routeId);
                // dd('Route is attached');
            } else {
                return back()->withErrors(['routeId' => 'Выбранный маршрут не существует.']);
            }
        }

         // Связывание с организацией
        if ($request->has('organisationId') && $request->organisationId) {
            $organisationExists = Organisations::where('id', $request->organisationId)->exists();
            if ($organisationExists) {
                $place->organisations()->attach($request->organisationId);
            } else {
                return back()->withErrors(['organisationId' => 'Выбранная организация не существует.']);
            }
        }

        // Связывание с атрибутами
        if ($request->has('attributeId') && $request->attributeId) {
            $attributeExists = Attributes::where('id', $request->attributeId)->exists();
            if ($attributeExists) {
                $place->attributes()->attach($request->attributeId);
            } else {
                return back()->withErrors(['attributeId' => 'Выбранная организация не существует.']);
            }
        }
 
        // Перенаправляем пользователя с сообщением об успехе
        return redirect()->route('places.index')->with('success', 'Место успешно создано.');    
    }
    

    /**
     * Display the specified resource.
     */
    public function show(Places $places)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Places $place)
    {
        $categories = Categories::whereNotNull('parent_id')->get(); // Только подкатегории
        $routes = Routes::all();
        $organisations = Organisations::all();
        $locations = Locations::all();
        $place->load('routes', 'organisations'); // Загружаем связанные маршруты и организации
        $attributes = Attributes::all();

        return view('admin.places.edit', [
            'place' => $place,
            'categories' => $categories,
            'routes' => $routes,
            'organisations' => $organisations,
            'locations' => $locations,
            'attributes' => $attributes

        ]);
    }
    
    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Places $place)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'address' => 'nullable|string',
            'orientationImg' => 'nullable|in:1,2',
            'subcategoryId' => 'nullable|exists:categories,id',
            'disabilities' => 'nullable|in:1,2',
            'locationId' => 'nullable',

            
            // Other fields as needed
        ]);
    
        if ($request->hasFile('image')) {
            // Check if the file is an image
            $validatedData = $request->validate([
                'image' => 'image',
            ]);
    
            // Delete the old file if it exists
            if ($place->img) {
                Storage::delete($place->img);
            }
    
            // Upload the new file and save its path
            $path = $request->file('image')->store('places', 'public'); // Make sure the path and disk are correct
            $place->img = $path;
        }
    
        // Update the 'disabilities' field using the request input
        $place->disabilities = $request->input('disabilities');
    
        $place->fill($validatedData);
        $place->save();
    
        if ($request->has('routeId')) {
            $place->routes()->sync($request->routeId);
        }
    
        if ($request->has('organisationId')) {
            $place->organisations()->sync($request->organisationId);
        }

        if ($request->has('attributeId')) {
            $place->attributes()->sync($request->attributeId);
        }
    
        // Redirect with a success message
        return redirect()->route('places.index')->with('success', 'Место обновлено успешно.');
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Places $place)
    {
        // Удаление связанных записей из связующих таблиц
        $place->routes()->detach(); // Удаляем связи с маршрутами
        $place->organisations()->detach(); // Удаляем связи с организациями
    
        // Удаляем связанное изображение, если оно есть
        if ($place->img) {
            Storage::delete($place->img);
        }
    
        // Удаление самого объекта place
        $place->delete();
    
        // Перенаправление на список мест с сообщением об успешном удалении
        return redirect()->route('places.index')->with('success', 'Место удалено успешно.');
        
    
    }
    
}
