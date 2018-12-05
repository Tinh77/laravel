<?php
/**
 * Created by PhpStorm.
 * User: Tinh
 * Date: 12/3/2018
 * Time: 8:06 AM
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class CategoryProduct extends Model
{
    public $table = 'category_product';

    public function category_product()
    {
        return $this->belongsTo('App\Category');
    }
}
