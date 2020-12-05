<?php
namespace App\Helper;

use App\Models\Category;

class Helper
{
    public static function setCategory($category_name) {
        $same_category = Category::where('name', $category_name)->get();
        if ($same_category->count() == 0) {
            $new_category = new Category();
            $data = ['name' => $category_name];
            $new_category->fill($data);
            $new_category->save();
            return $new_category->id;
        } else {
            return $same_category->first()->id;
        }      
    }

    public static function setPrice($price) {
        $floatPrice = trim(str_replace("€","", $price));
        $floatPrice = floatval($floatPrice);
        return $floatPrice;        
    }
}
