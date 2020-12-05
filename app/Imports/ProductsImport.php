<?php

namespace App\Imports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use App\Helper\Helper;

class ProductsImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $existingProduct = Product::where('name', $row['nome_prodotto'])->get()->count();
        if ($existingProduct == 0) {
            return new Product([
                'category_id'=> Helper::setCategory($row['categoria']),
                'name' => $row['nome_prodotto'],
                'price' => Helper::setPrice($row['prezzo']),
            ]);
        }        
    }
}
