<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function detail($id){
        $product = Product::find($id);
        $latestProducts = Product::find($id);
        return view('web.product.detail', compact('product', 'latestProducts'));
    }

}
