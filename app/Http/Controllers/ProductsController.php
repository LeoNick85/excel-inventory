<?php

namespace App\Http\Controllers;

use App\Imports\ProductsImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

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
}
