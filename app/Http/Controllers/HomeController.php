<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller {

    public function dashboard(Request $request) {

        $query = Product::select("*");

        if ($request->search) {
            $term = strtolower($request->search);
            $query->whereRaw('lower(name) like (?)',["%{$term}%"])->get();
        }

        if ($request->filter) {
            $query->whereRaw($request->filter == 1 ? 'stock > min' : 'stock <= min');
        }

        $products = $query->paginate(10);
        return view("dashboard", [ "products" => $products ]);

    }
}
