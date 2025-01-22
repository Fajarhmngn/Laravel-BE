<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ["product_name", "price", "stock", "category_id", "product_image", "image_name"];
}
