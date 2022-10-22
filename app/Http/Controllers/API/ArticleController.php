<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\http\Requests\ArticleStoreRequest;
use App\http\Requests\ArticleUpdateRequest;

class ArticleController extends Controller
{
    public function index(){
        $articles = Article::paginate(10);
        if($articles){
            return response()->json([
                'status' => 200,
                'message' => 'Articles retrieved successfully',
                'data' => $articles
            ], 200);
        }else{
            return response()->json([
                'status' => 404,
                'message' => 'Articles not found',
                'data' => null
            ], 404);
        }
    }
    
    public function show($id){
        $article = Article::find($id);
        if(!$article){
            return response()->json([
                'status' => 404,
                'message' => 'Article not found'
            ], 404);
        }
        return response()->json([
            'status' => 200,
            'message' => $article
        ], 200);
    }
    
    public function store(ArticleStoreRequest $request){
        
        $validated = $request->validated();
        $validated['user_id'] = auth()->user()->id;
        $article = Article::create($validated);
        return response()->json([
            'message' => 'Article created successfully',
            'article' => $article
        ], 201);
    }

    public function update(ArticleUpdateRequest $request, $id){
        $validated = $request->validated();
        $article = auth()->user()->articles()->find($id);
        if(!$article){
            return response()->json([
                'message' => 'Article not found'
            ], 404);
        }
        $article->update($validated);
        return response()->json([
            'message' => 'Article updated successfully',
            'article' => $article
        ], 200);
    }

    public function destroy($id){
        $article = auth()->user()->articles()->find($id);
        if(!$article){
            return response()->json([
                'message' => 'Article not found'
            ], 404);
        }
        $article->delete();
        return response()->json([
            'message' => 'Article deleted'
        ], 200);
    }
}