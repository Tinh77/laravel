<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public $timestamps = false;
    public function categories()
    {
        return $this->belongsToMany('App\Category');
    }


    public function getCategoriesName() {
        $categories = CategoryProduct::where('product_id',$this->id)->get();
        $str = '';
        foreach ($categories as $category) {
            $str .= $category->category_id.',';
        }
        return $str;
    }
}
