<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Categories::with('parent')->get();
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.categories.create');//
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
            $category = new Categories();
            $category->name = $request->name;
            $category->parent_id = $request->parent_id ? $request->parent_id : null; // Установка parent_id, если он предоставлен
            $category->img = $path;
            $category->save();
        
            return redirect()->route('categories.index')->with('success', 'Категория создана успешно.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Categories $categories)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Categories $category)
    {
        return view('admin.categories.edit', ['category' => $category]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Categories $category)
    {
        // Validate and get the request data
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'parent_id' => 'nullable|integer',
            // Include other validation rules as necessary
        ]);
    
        if ($request->hasFile('image')) {
            // Удаляем старый файл, если он есть
            if ($category->img) {
                Storage::delete($category->img);
            }
    
            // Загружаем новый файл и сохраняем путь к нему
            $path = $request->file('image')->store('category');
            $data['img'] = $path;
        }
    
        // Обновляем категорию в базе данных
        $category->update($data);
    
        return redirect()->route('categories.index')->with('success', 'Категория обновлена успешно.');
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Categories $category)
    {
        // Удаляем статью
        $category->delete();

        // Перенаправляем на список статей с сообщением об успешном удалении
        return redirect()->route('categories.index')->with('success', 'Статья удалена успешно.');
        
    }
}
