<?php

namespace App\Exports;

use App\Invoice;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Http\Request;
use App\User;
use App\Purchase;

use App\Product;
use DB;
use PDF;
use Excel;
use DateTime;
use DateTimeZone;
use Illuminate\Support\Facades\Auth;

class PurchasesExport implements FromView
{

    private $dataGlobal;
    public function __construct(Request $request)
    {
        $this->dataGlobal = $request;
    }
    
    public function view(): View
    {
        $from =  strval($this->dataGlobal->from);
        $to = strval($this->dataGlobal->to);

        $showFrom = $from;
        if($to == $from){
            $to = date('Y-m-d', strtotime('+1 day', strtotime($this->dataGlobal->to)));
        }

        $purchasesByDate = Purchase::Join('products', 'products.id', '=', 'purchases.product_id')
        ->select('products.name', 'products.cost', 'products.bar_code', DB::raw('sum(purchases.quantity) as quantity'), DB::raw('sum(purchases.total) as total'))
        ->whereBetween('purchases.created_at',[$from, $to])
        ->groupBy("products.bar_code")->get();

        $total = Purchase::whereBetween('purchases.created_at',[$from, $to])->sum('total');

        return view('reports.reportPurchases',["purchases" => $purchasesByDate,
        "user" => Auth::user(),
        "total"=>$total,
        "to" => $to,
        "from" =>$showFrom]);
    }
}