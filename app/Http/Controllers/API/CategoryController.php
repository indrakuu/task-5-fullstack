<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryStoreRequest;
use App\Http\Requests\CategoryUpdateRequest;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index(){
        $categories = Category::all();
        if($categories){
            return response()->json([
                'status' => 200,
                'message' => 'Categories retrieved successfully',
                'data' => $categories
            ], 200);
            
        }else{
            return response()->json([
                'status' => 404,
                'message' => 'Categories not found',
                'data' => null
            ], 404);
        }
    }
    
    public function show($id){
        $category = Category::find($id);
        if(!$category){
            return response()->json([
                'status' => 404,
                'message' => 'Catergory not found'
            ], 404);
        }
        return response()->json([
            'status' => 200,
            'message' => $category
        ], 200);
    }
    
    public function store(CategoryStoreRequest $request){
        $validated = $request->validated();
        $validated['user_id'] = auth()->user()->id;
        $category = Category::create($validated);
        return response()->json([
            'message' => 'Category created successfully',
            'catergory' => $category
        ], 201);
    }

    public function update(CategoryUpdateRequest $request, $id){
        $validated = $request->validated();
        $category = auth()->user()->categories()->find($id);
        if(!$category){
            return response()->json([
                'message' => 'Catergory not found'
            ], 404);
        }
        $category->update($validated);
        return response()->json([
            'message' => 'Catergory updated successfully',
            'catergory' => $category
        ], 200);
    }
    
    public function destroy($id){
        $catergory = auth()->user()->categories()->find($id);
        if(!$catergory){
            return response()->json([
                'message' => 'Catergory not found'
            ], 404);
        }
       if($category->articles->count() > 0){
            return response()->json([
                'message' => 'Catergory has articles'
            ], 400);
        }
        
        $catergory->delete();
        return response()->json([
            'message' => 'Catergory deleted'
        ], 200);
    }
}