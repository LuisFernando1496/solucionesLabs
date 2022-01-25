<?php

namespace App\Exports;

use App\Invoice;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Http\Request;
use App\User;
use App\BranchOffice;
use App\Sale;

use App\CashClosing;
use App\Product;
use DB;
use PDF;
use Excel;
use DateTime;
use DateTimeZone;
use App\Box;
use App\ProductInSale;
use Illuminate\Support\Facades\Auth;

class QuoteExport implements FromView
{
    private $dataGlobal;
    public function __construct(Request $request)
    {
        $this->dataGlobal = $request;
    }
    
    public function view(): View
    {
        $send = Product::join('brands', 'products.brand_id', 'brands.id')
        ->join('categories', 'products.category_id', 'categories.id')
        ->where('products.branch_office_id', Auth::user()->branch_office_id)->where("products.bar_code", "=", $this->dataGlobal->search)
        ->where("products.stock", ">", 0)->where("products.status", "=", true)
        ->select('products.*', 'brands.name as brand_name', 'brands.id as brand_id', 'categories.name as category_name', 'categories.id as category_id')
        ->get();

        //return response()->json(['success' => false, 'error' => 'No existe el producto en la sucursal destino12']);
        return view('quotes.create', [
            "send" => $send
        ]);

    }
}