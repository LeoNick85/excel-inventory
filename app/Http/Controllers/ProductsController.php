<?php

namespace App\Http\Controllers;

use App\Imports\ProductsImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class ProductsController extends Controller
{
    public function import(Request $request)
    {
        $request->validate([
            'import_file' => 'required|file|mimes:xls,xlsx'
        ]);

        $path = $request->file('import_file');
        $data = \Excel::import(new ProductsImport, $path);

        return response()->json(
                                [
                                    'message' => 'uploaded successfully',
                                    'excel'=> $data
                                ],
                                200);
    }

    public function search(Request $request)
    {
        $data = $request->input('data');
        $searchText = $data['search'];
        $searchOrder = $data['order'];

        $queryResults = Product::with('category')->where('name', 'like', "%{$searchText}%" )->orWhere('id', 'like',"%{$searchText}%")->get();

        $finalResults = array();

        foreach ($queryResults as $key=>$value){
            array_push($finalResults, array(
                'id' =>  $value->id,
                'name' => $value->name,
                'price' => $value->price,
                'category' => $value->category->name,
                'discount_rate' => $value->category->discount_rate,
                'discount_price' => ($value->price*(100-$value->category->discount_rate) /100)
            ));
        };

        $orderedResults = collect($finalResults)->sortBy($searchOrder)->chunk(1)->flatten(1);

        return response()->json(
            [
                'message' => 'search completed',
                'data'=> $orderedResults
            ],
            200);
    }
}
