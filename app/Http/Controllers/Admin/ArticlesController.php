<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Articles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArticlesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $new_articles = new Articles();
        $articles = $new_articles ->all();
        return view('admin.articles.index', compact('articles'));

        // return view('admin.articles.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.articles.create');
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
        $new_articles = new Articles();
        $new_articles->heading = $request->heading;
        $new_articles->description = $request->description;
        $new_articles->link = $request->link;
        $new_articles->img = $path;
        $new_articles->save();

        return redirect()->back()->withSuccess('Слайд добавлен');
    }

    /**
     * Display the specified resource.
     */
    public function show(Articles $articles)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Articles $article)
    {   
        return view('admin.articles.edit', ['article' => $article]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Articles $article)
    {
        $data = $request->only(['heading', 'description', 'link']);

        if ($request->hasFile('image')) {
            // Удаляем старый файл, если он есть
            if ($article->img) {
                Storage::delete($article->img);
            }

            // Загружаем новый файл и сохраняем путь к нему
            $path = $request->file('image')->store('articles');
            $data['img'] = $path;
        }

        // // Обновляем статью в базе данных
        $article->update($data);
        return redirect()->route('articles.index')->with('success', 'Статья обновлена успешно.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Articles $article)
    {
        // Удаляем файл, если он есть
        if ($article->img) {
            Storage::delete($article->img);
        }

        // Удаляем статью
        $article->delete();

        // Перенаправляем на список статей с сообщением об успешном удалении
        return redirect()->route('articles.index')->with('success', 'Статья удалена успешно.');
    }
}
