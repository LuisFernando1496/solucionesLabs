<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Sale;
use App\CashClosing;
use App\BranchOffice;
use App\Client;
use App\Category;

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
}
