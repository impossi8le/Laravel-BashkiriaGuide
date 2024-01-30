<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Routes;
use App\Models\Agencies;
use Illuminate\Http\Request;

class RoutesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() 
    {
        $new_routes = new Routes();
        $routes = $new_routes ->all();
        return view('admin.routes.index', compact('routes'));
        //     // Загрузка маршрутов вместе с агентствами
        // $routes = Routes::with('agency')->get();
        // return view('admin.routes.index', compact('routes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $agencies = Agencies::all(); // Получаем все агентства
        return view('admin.routes.create', compact('agencies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if($request){
               // Валидация входящих данных
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'pointStart' => 'required|string',
                'pointEnd' => 'required|string',
                'agencyId' => 'required|numeric', // Убедитесь, что ID агенства существует
            ]);

            // Создание и сохранение маршрута
            $route = new Routes();
            $route->name = $validatedData['name'];
            $route->pointStart = $validatedData['pointStart'];
            $route->pointEnd = $validatedData['pointEnd'];
            $route->agencyId = $validatedData['agencyId']; // Используйте snake_case для имён полей в базе данных
            $route->save();

            // Перенаправление на список маршрутов с сообщением об успехе
            return redirect()->route('routes.index')->with('success', 'Маршрут успешно создан.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Routes $routes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Routes $route)
    {

        $agencies = Agencies::all(); // Получаем все агентства
        return view('admin.routes.edit', compact('route', 'agencies'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Routes $route)
    {
            // Валидация входящих данных
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'pointStart' => 'required|string',
            'pointEnd' => 'required|string',
            'agencyId' => 'required|numeric', // Убедитесь, что ID агентства существует
        ]);
         // Обновление маршрута
        $route->name = $validatedData['name'];
        $route->pointStart = $validatedData['pointStart'];
        $route->pointEnd = $validatedData['pointEnd'];
        $route->agencyId = $validatedData['agencyId']; // Используйте snake_case для имён полей в базе данных
        $route->save();

        // Перенаправление на список маршрутов с сообщением об успехе
        return redirect()->route('routes.index')->with('success', 'Маршрут успешно обновлен.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Routes $route)
    {
        // Удаляем статью
        $route->delete();

        // Перенаправляем на список статей с сообщением об успешном удалении
        return redirect()->route('routes.index')->with('success', 'Статья удалена успешно.');

    }
}
