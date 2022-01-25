<?php

namespace App\Http\Controllers;

use App\Product;
use App\ProductsInQuotes;
use App\Quote;
use App\BranchOffice;
use App\CashClosing;
use App\Client;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class QuoteController extends Controller
{
      public function index()
    {
        $branches =0;
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
        //return Excel::download(new QuoteExport($request), 'cotizacion.xlsx');
        $folioBranch = Quote::latest()->where('branch_office_id', Auth::user()->branchOffice->id)->pluck('folio_branch_office')->first();
        $cotizacion = $request->all()["sale"];
       $total_cost_sale = 0;
                   
                    $cotizacion['branch_office_id'] = Auth::user()->branch_office_id;
                    $cotizacion['total_cost']= $cotizacion['cart_total'];
                    $cotizacion['user_id'] = Auth::user()->id;
                    if ($folioBranch == null) {
                        $cotizacion['folio_branch_office'] = 1;
                    } else {
                        $cotizacion['folio_branch_office'] = $folioBranch + 1;
                    }
                   
                    try {
                       
                        DB::beginTransaction();
                       
                        //AGREGAR PRODUCTOS DE LA VENTA
                       
                        $cotizacion = Quote::create($cotizacion);
                        
                        foreach ($request->all()["products"] as $key => $item) {
                            $product = Product::findOrFail($item['id']);
                            
                         
                            $newProductInSale = [
                                'product_id' => $item['id'],
                                'quote_id' => $cotizacion->id,
                                'quantity' => $item['quantity'],
                                'subtotal' => $item['subtotal'],
                                'sale_price' => $item['sale_price'],
                                'total' => $item['total'],
                                'total_cost' => $product->cost * $item['quantity'],
                                
                            ];
                          
                            $productInSale = new ProductsInQuotes($newProductInSale);
                            $productInSale->save();
                            
                        }
                       
                        DB::commit();
                        
                        return response()->json(['success' => true, 'data' =>Quote::where('id', $cotizacion->id)->with(['productsInQuotes.product.category', 'branchOffice', 'user'])->first() ]);
                    } catch (\Throwable $th) {
                        DB::rollBack();
                        return response()->json(['success' => false, 'error' => $th]);
                    }
     
    }

}
