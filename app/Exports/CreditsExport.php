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

class CreditsExport implements FromView
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

        $creditsTotalByClient = Sale::Join('clients', 'clients.id', '=', 'sales.client_id')
        ->whereNotNull('sales.status_credit')->whereBetween('sales.created_at',[$from, $to])
        ->where("sales.status",  "=", true)
        ->select('clients.name','clients.last_name', DB::raw('SUM(sales.cart_total) as cart_total'))
        ->groupBy("sales.client_id")->get();

        $creditsBySale = Sale::Join('clients', 'clients.id', '=', 'sales.client_id')
        ->whereNotNull('sales.status_credit')->whereBetween('sales.created_at',[$from, $to])
        ->where("sales.status",  "=", true)
        ->select('sales.id', 'clients.name','clients.last_name', 'sales.cart_total', 'sales.created_at')
        ->groupBy("sales.id")->get();

        $creditsTotal = Sale::whereNotNull('client_id')->whereNotNull('status_credit')->where("sales.status",  "=", true)->whereBetween('sales.created_at',[$from, $to])->sum('cart_total');

        return view('reports.reportCredits',["bySale" => $creditsBySale,
        "user" => Auth::user(),
        "byClient" =>$creditsTotalByClient,
        "total"=>$creditsTotal,
        "to" => $to,
        "from" =>$showFrom]);
    }
}