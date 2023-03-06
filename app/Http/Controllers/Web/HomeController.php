<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\CategoryProduct;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        $listCategoryProduct = CategoryProduct::all();
        $listProduct = Product::all();
        $latestProducts = Product::getLatestProducts();
        return view('web.home.index', compact('listProduct', 'listCategoryProduct', 'latestProducts'));
    }

}
