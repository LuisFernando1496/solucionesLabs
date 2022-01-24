<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Sale;
use App\CashClosing;
use App\BranchOffice;
use App\Brand;
use App\Client;
use App\Category;
use App\Product;
use App\Provider;
use Excel;
use App\Exports\QuoteExport;

class QuotesController extends Controller
{
    public function index()
    {
        $branches;
        if (Auth::user()->rol_id == 1) {
            $branches = BranchOffice::all();
        } else {
            // return back()->withErrors(["error" => "No tienes permisos"]);
            $branches = [Auth::user()->branchOffice];
        }

        if (CashClosing::where('user_id', '=', Auth::user()->id)->where('status', '=', false)->count() == 0) {
            return view('quotes.index', ["branches" => $branches]);
        } else {
            return view('quotes.index', [
                'box' => CashClosing::where('user_id', '=', Auth::user()->id)->where('status', '=', false)->first(), "branches" => $branches, 'categories' => Category::all(),
                'clients' => Client::where('status', true)->get()
            ]);
        }
    }

    public function dowloadQuote(Request $request)
    {
        /*$send = Product::join('brands', 'products.brand_id', 'brands.id')
        ->join('categories', 'products.category_id', 'categories.id')
        ->where("products.states", "=", true)
        ->get();*/
        //->select('products.*')
        //, 'brands.name as brand_name', 'brands.id as brand_id', 'categories.name as category_name', 'categories.id as category_id')
        
        /*return view('quotes.create', [
            "send" => $send
        ]);*/
        return view('quotes.create');
        //return response()->json(['success' => false, 'error' => 'No existe el producto en la sucursal destino']);
        //return Excel::download(new QuoteExport($request), 'cotizacion.xlsx');
    }

    public function create()
    {
        $products = Product::where('status', true)->get();
        $offices = BranchOffice::where('status', true)->get();
        $providers = Provider::all();
        return view('quotes.create', [
            'products' => $products,
            'brands' => Brand::where('status', true)->get(), 
            'categories' => Category::where('status', true)->get(), 
            'offices' => $offices, 
            'providers' => $providers
        ]);
        /*$branches = BranchOffice::where('status', true)->where('id', '!=', auth()->user()->branch_office_id)->get();
        return view('quotes.create', [
            'branches' => $branches, 
            'categories' => Category::all()
        ]);*/
    }


}
