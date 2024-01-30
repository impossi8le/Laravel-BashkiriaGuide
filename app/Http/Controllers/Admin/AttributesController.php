<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attributes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AttributesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $new_attributes = new Attributes();
        $attributes = $new_attributes ->all();
        return view('admin.attributes.index', compact('attributes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.attributes.create');//

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if($request->hasFile('image')) {
            $file = $request->file('image');
            $path = $file->store('articles');
        }
        $new_attributes = new Attributes();
        $new_attributes->name = $request->name;
        $new_attributes->img = $path;
        $new_attributes->save();

        return redirect()->back()->withSuccess('Атрибут добавлен');
    }

    /**
     * Display the specified resource.
     */
    public function show(Attributes $attribute)
    {
        // 
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Attributes $attribute)
    {
        return view('admin.attributes.edit', ['attribute' => $attribute]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Attributes $attribute)
    {
        $data = $request->only(['name']);

        if ($request->hasFile('image')) {
            // Удаляем старый файл, если он есть
            if ($attribute->img) {
                Storage::delete($attribute->img);
            }

            // Загружаем новый файл и сохраняем путь к нему
            $path = $request->file('image')->store('attributes');
            $data['img'] = $path;
        }

        // // Обновляем статью в базе данных
        $attribute->update($data);
        return redirect()->route('attributes.index')->with('success', 'Статья обновлена успешно.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Attributes $attribute)
    {
        // Удаляем статью
        $attribute->delete();

        // Перенаправляем на список статей с сообщением об успешном удалении
        return redirect()->route('attributes.index')->with('success', 'Статья удалена успешно.');
        
    }
}
