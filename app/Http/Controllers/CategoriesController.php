<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoriesController extends Controller
{
    public function categoriesList(Request $request)
    {
        $categories_list = Category::all();

        return response()->json(
            [
                'message' => 'category list delivered',
                'categories_list' => $categories_list
            ],
            200);
    }

    public function categoriesUpdate(Request $request)
    {
        $data = $request->input('data');

        for ($i = 0; $i < count($data['category_id']); $i++) {
            $current_item = Category::find($data['category_id'][$i]);
            $current_item->discount_rate = $data['category_rate'][$i];
            $current_item->save();
        };

        return response()->json(
            [
                'message' => 'categories delivered'
            ],
            200);
    }
}
