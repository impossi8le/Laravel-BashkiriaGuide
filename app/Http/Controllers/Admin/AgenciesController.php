<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Agencies;
use Illuminate\Http\Request;

class AgenciesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $new_agencies = new Agencies();
        $agencies = $new_agencies ->all();
        return view('admin.agencies.index', compact('agencies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.agencies.create');//
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if($request){

            $phones = explode(',', $request->phones); // Разбиваем строку на массив
            $phones = array_map('trim', $phones); // Убираем лишние пробелы

            $new_agencies = new Agencies();
            $new_agencies->name = $request->name;
            $new_agencies->phones = json_encode($phones);
            $new_agencies->save();

            return redirect()->back()->withSuccess('Агенство добавлено');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Agencies $agencies)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Agencies $agency)
    {
        return view('admin.agencies.edit', ['agency' => $agency]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Agencies $agency)
    {
        $phones = explode(',', $request->phones); // Преобразование строки в массив
        $phones = array_map('trim', $phones); // Удаление пробельных символов с начала и конца строки
    
        $agency->name = $request->name;
        $agency->phones = json_encode($phones); // Кодирование массива в JSON
        $agency->save();
    
        return redirect()->route('agencies.index')->with('success', 'Агентство обновлено');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Agencies $agency)
    {
        // Удаляем статью
        $agency->delete();

        // Перенаправляем на список статей с сообщением об успешном удалении
        return redirect()->route('agencies.index')->with('success', 'Статья удалена успешно.');
        
    }
}
