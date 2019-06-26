<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller {

    public function create() {
        return $this->form(new Product());
    }

    public function edit($id) {

        $product = Product::find($id);

        if ($product) {
            return $this->form($product);
            
        } else {
            return back()->withErrors("Produto não encontrado.");
        }
    }

    private function form(Product $product) {
        return view("product.form", [ "product" => $product ]);
    }

    public function insert(Request $request) {

        $validation = $this->validation($request);

        if (!$validation->fails()) {
            return $this->save(new Product(), $request);
            
        } else {
            return back()->withErrors($validation)->withInput();
        }
    }

    public function update(Request $request) {

        $validation = $this->validation($request);

        if (!$validation->fails()) {
            return $this->save(Product::find($request->id), $request);
            
        } else {
            return back()->withErrors($validation)->withInput();
        }
    }

    private function validation(Request $request) {

        $validator = Validator::make($request->all(), [
            "name" => "required|string",
            "stock" => "required|numeric",
        ]);

        $validator->sometimes("id", "required|numeric|exists:products", function($request) {
            return $request->method == "put";
        });

        $validator->after(function($validator) use ($request) {
        
            $product = Product::where("name", $request->name)->first();

            if ($product && (!$request->id || $product->id != $request->id)) {
                $validator->errors()->add("name", "Já existe um produto com este nome!");
            }

        });

        return $validator;
    }

    private function save(Product $product, Request $request) {

        try {

            $product->name = $request->name;
            $product->stock = $request->stock;
            $product->min = $request->min ?? null;
            $product->save();

            Session::flash("success", "Produto salvo com sucesso!");
            return redirect("/");

        } catch (\Exception $e) {
            return back()->withErrors("Erro interno: ".$e->getMessage())->withInput();
        }
    }

    public function delete(Request $request) {

        if ($request->id) {

            $product = Product::find($request->id);

            if ($product && $product->delete()) {
                Session::flash("success", "Produto removido com sucesso!"); return back();
            }
        }

        return back()->withErrors("Requisição inválida.");
    }

    public function updateStock(Request $request) {

        if ($request->id && $request->stock && $request->stock >= 0) {

            $product = Product::find($request->id);

            if ($product) {

                $product->stock = $request->stock;
                $product->save();

                Session::flash("success", "Quantidade em estoque do produto alterada com sucesso!");
                return back();
            }
        }

        return back()->withErrors("Requisição inválida.");
    }
}
