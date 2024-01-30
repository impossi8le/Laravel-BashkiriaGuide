<?php 

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Organisations;
use Illuminate\Http\Request;

class OrganisationsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $new_organisations = new Organisations();
        $organisations = $new_organisations ->all();
        return view('admin.organisations.index', compact('organisations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.organisations.create');//

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if($request){

            $phones = explode(',', $request->phones); // Разбиваем строку на массив
            $phones = array_map('trim', $phones); // Убираем лишние пробелы

            $new_organisationss = new Organisations();
            $new_organisationss->name = $request->name;
            $new_organisationss->link = $request->link;
            $new_organisationss->phones = json_encode($phones);
            $new_organisationss->save();

            return redirect()->back()->withSuccess('Агенство добавлено');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Organisations $organisation)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Organisations $organisation)
    {
        return view('admin.organisations.edit', ['organisation' => $organisation]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Organisations $organisation)
    {
        $phones = explode(',', $request->phones); // Преобразование строки в массив
        $phones = array_map('trim', $phones); // Удаление пробельных символов с начала и конца строки
    
        $organisation->name = $request->name;
        $organisation->link = $request->link;
        $organisation->phones = json_encode($phones); // Кодирование массива в JSON
        $organisation->save();
    
        return redirect()->route('organisations.index')->with('success', 'Агентство обновлено');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Organisations $organisation)
    {
        // Удаляем статью
        $organisation->delete();

        // Перенаправляем на список статей с сообщением об успешном удалении
        return redirect()->route('organisations.index')->with('success', 'Статья удалена успешно.');
    }
}
