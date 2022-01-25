<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductsInQuotes extends Model
{
    protected $table = "products_quotes";
    protected $fillable = [
        'product_id',
        'quote_id',
        'quantity',
        'sale_price',
        'subtotal',
        'total',
        'total_cost',
    ];
    public function quote(){
        return $this->belongsTo(Quotes::class);
    }

    public function product(){
        return $this->belongsTo(Product::class);
    }
}
