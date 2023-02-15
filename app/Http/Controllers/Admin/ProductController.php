<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CategoryProduct;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        $listProduct = Product::all();
        return view('admin.product.index', compact('listProduct'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        $listCategory = CategoryProduct::all();
        return view('admin.product.create', compact('listCategory'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        try {
            $data = $request->all();

            $product = new Product();
            $product->fill($data);
            $product->save();

            if ($request->has('image')) {
                $imagePath = 'product_images/' . $product->getAttribute('id');

                $imageUrl = uploadImage($request->file('image'), 'avatar', $imagePath);
                $product->setAttribute('image', $imageUrl);
                $product->save();
            }

            return redirect()->route('admin.products.index')->with('success', 'Thêm thành công');

        }catch (\Exception $exception){
            Log::error($exception->getMessage());
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return View
     */
    public function edit(int $id): View {
        $product = Product::find($id);
        $listCategory = CategoryProduct::all();
        return view('admin.product.edit', compact('product', 'listCategory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(Request $request, int $id): \Illuminate\Http\RedirectResponse {
        try {
            $product = Product::find($id);
            $data = $request->all();
            $product->fill($data);

            if ($request->has('image')) {
                $imagePath = 'product_images/' . $product->getAttribute('id');
                $imageUrl = uploadImage($request->file('image'), 'avatar', $imagePath);
                $product->setAttribute('image', $imageUrl);
                $product->save();
            }

            $product->save();
            return redirect()->route('admin.products.index')->with('success', 'Sửa thành công');
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy(int $id): \Illuminate\Http\RedirectResponse {
        try {
            $product = Product::find($id);
            $product->delete();
            return redirect()->back()->with('success', 'Xóa thành công');
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }
}
