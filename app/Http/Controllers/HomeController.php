<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductMatch;

class HomeController extends Controller
{
    
    public function index()
    {
        $products = ProductMatch::has('product')->get();
        // $products = Product::has('match')->get();
        // echo "<pre>";
        //     print_r($products);
        // echo "</pre>";

        return view('home',compact('products'));
    }

    public function match(ProductMatch $pr, Request $r)
    {
        $id = $r->id;
        $products = ProductMatch::where('product_id',"=",$id)->with(['product','matchedProduct'])->get();

        return view('match',compact('products'));
    }

    public function m()
    {
        return view('m');
    }





}


