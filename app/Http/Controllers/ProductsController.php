<?php

namespace App\Http\Controllers;

use App\Imports\ProductsImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use App\Models\Product;

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

        $results = Product::where('name', 'like', "%{$searchText}%" )->orWhere('id', 'like',"%{$searchText}%")->get();

        return response()->json(
            [
                'message' => 'search completed',
                'data'=> $results
            ],
            200);
    }
}
