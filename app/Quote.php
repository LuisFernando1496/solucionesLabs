<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quote extends Model
{
    protected $fillable =[
       
        'status',
        'cart_subtotal',
        'cart_total',
        'total_cost',
        'folio_branch_office',
        'branch_office_id',
        'user_id',
        'client_id',
    ];
    public function productsInQuotes(){
        return $this->hasMany(ProductsInQuotes::class);
    }
 public function branchOffice(){
        return $this->belongsTo(BranchOffice::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function client(){
        return $this->belongsTo(Client::class);
    }
}
