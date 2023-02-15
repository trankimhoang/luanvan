<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CategoryProduct;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class CategoryProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        $listCategoryProduct = CategoryProduct::all();
        return view('admin.category_product.index', compact('listCategoryProduct'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        return view('admin.category_product.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        try {
            $data = $request->all();

            $categoryProduct = new CategoryProduct();
            $categoryProduct->fill($data);
            $categoryProduct->save();

            if ($request->has('image')) {
                $imagePath = 'category-product_images/' . $categoryProduct->getAttribute('id');

                $imageUrl = uploadImage($request->file('image'), 'avatar', $imagePath);
                $categoryProduct->setAttribute('image', $imageUrl);
                $categoryProduct->save();
            }

            return redirect()->route('admin.categoryProduct.index');

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
     * @return \Illuminate\Http\Response
     */
    public function edit(int $id): View
    {
        $categoryProduct = CategoryProduct::find($id);
        return view('admin.category_product.edit', compact('categoryProduct'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return RedirectResponse
     */
    public function update(Request $request, int $id): RedirectResponse
    {
        try {
            $categoryProduct = CategoryProduct::find($id);
            $data = $request->all();
            $categoryProduct->fill($data);

            if ($request->has('image')) {
                $imagePath = 'category-product_images/' . $categoryProduct->getAttribute('id');
                $imageUrl = uploadImage($request->file('image'), 'avatar', $imagePath);
                $categoryProduct->setAttribute('image', $imageUrl);
                $categoryProduct->save();
            }

            $categoryProduct->save();
            return redirect()->route('admin.categoryProduct.index')->with('success', 'Sửa thành công');
        }catch (\Exception $exception){
            Log::error($exception->getMessage());
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return RedirectResponse
     */
    public function destroy(int $id): \Illuminate\Http\RedirectResponse
    {
        try {
            $categoryProduct = CategoryProduct::find($id);
            $categoryProduct->delete();
            return redirect()->back()->with('success', 'Xóa thành công');

        }catch (\Exception $exception){
            Log::error($exception->getMessage());
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }
}
