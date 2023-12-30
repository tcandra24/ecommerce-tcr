<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use App\Models\Brand;
use App\Models\Category;
use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::with('category', 'brand', 'images')->get();
        $categories = Category::all();
        $brands = Brand::withCount('products')->get();

        return view('admin.products.index', [
            'products' => $products,
            'categories' => $categories,
            'brands' => $brands,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $brands = Brand::all();

        return view('admin.products.create', [
            'categories' => $categories,
            'brands' => $brands,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'brand' => 'required',
            'category' => 'required',
            'description' => 'required',
            'images' => 'required',
            'price' => 'required',
            'sku' => 'required',
            'status' => 'required',
            'weight' => 'required',
            'stock' => 'required',
        ]);

        try {

            DB::transaction(function () use ($request) {
                $product = Product::create([
                    'title' => $request->title,
                    'slug' => Str::slug($request->title),
                    'brand_id' => $request->brand,
                    'category_id' => $request->category,
                    'description' => $request->description,
                    'images' => $request->images,
                    'price' => $request->price,
                    'sku' => $request->sku,
                    'is_active' => $request->status,
                    'weight' => $request->weight,
                    'user_id' => Auth::user()->id,
                    'stock' => $request->stock,
                ]);

                foreach($request->images as $image) {
                    $filename = $image['tmpImageName'];
                    $srcFolder = 'public/images/tmp/';
                    $dstFolder = 'public/images/products/';

                    ProductImage::create([
                        'product_id' => $product->id,
                        'name' => $filename
                    ]);

                    Storage::disk('local')->move($srcFolder . $filename, $dstFolder . $filename);
                }
            });

            return response()->json([
                'success' => true,
                'message' => 'Product saved successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ]);
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
