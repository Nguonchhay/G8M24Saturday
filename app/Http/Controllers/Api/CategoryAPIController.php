<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Category;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\CategoryCollection;

class CategoryAPIController extends ApiController
{
    public function index()
    {
        $categories = Category::get();
        $res = new CategoryCollection($categories);
        return $this->sendSuccess($res, 'Category list');
    }

    public function store(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'name' => 'required|unique:categories|min:3|max:35'
        ]);
 
        if ($validator->fails()) {
            return $this->sendError(
                'Failed validation',
                [$data],
                422
            );
        }

        $category = Category::create($data);
        $res = [new CategoryResource($category)];

        return $this->sendSuccess($res, 'Category is saved');
    }

    public function update(Category $category, Request $request)
    {
        $category->name = $request->get('name');
        $category->save();
        $res = [new CategoryResource($category)];
        return $this->sendSuccess($res, 'Category is updated');
    }

    public function destroy(Category $category, Request $request)
    {
        $category->delete();
        $res = [];
        return $this->sendSuccess($res, 'Category is delete');
    }
}
