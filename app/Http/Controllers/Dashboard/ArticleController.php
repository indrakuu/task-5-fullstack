<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use App\Http\Requests\ArticleStoreRequest;
use App\Http\Requests\ArticleUpdateRequest;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::latest()->paginate(10);
        return view('dashboard.article.index', compact('articles'));
    }
    
    public function create()
    {
        $categories = Category::all();
        return view('dashboard.article.create', compact('categories'));
    }

    public function store(ArticleStoreRequest $request)
    {
        $validated = $request->validated();
        $imageName = time().'.'.$request->image->extension();  
        $validated['image'] = $request->file('image')->storeAs('public/images', $imageName);
        $validated['user_id'] = auth()->user()->id;
        
        Article::create($validated);
        
        return redirect()->route('dashboard.article')->with('success', 'Article created successfully.');
    }

    public function show($id)
    {
        $article = Article::find($id);
        $categories = Category::all();
        return view('dashboard.article.detail', compact('article','categories'));
    }

    public function update(ArticleUpdateRequest $request, $id)
    {
        $validated = $request->validated();
        $images = $request->image;
        if($images)
        {
            if($request->old_image)
            {
                \Storage::delete($request->old_image);
            }
            $imageName = time().'.'.$request->image->extension();  
            $validated['image'] = $request->file('image')->storeAs('public/images', $imageName);
        }
        $validated['user_id'] = auth()->user()->id;
        $article = Article::find($id);
        $article->update($validated);
        return redirect()->route('dashboard.article')->with('success', 'Article updated successfully.');
    }

    public function destroy($id)
    {
        $article = Article::find($id);
        if($article->image)
        {
            \Storage::delete($article->image);
        }
        Article::destroy($id); 
        return redirect()->route('dashboard.article')->with('success', 'Article deleted successfully.');
    }
}