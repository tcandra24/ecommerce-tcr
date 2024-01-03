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
        $products = Product::with('category', 'brand', 'images')->paginate(10);
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
                    'sku' => $request->sku,
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
    public function edit(Product $product)
    {
        $categories = Category::all();
        $brands = Brand::all();
        $images = ProductImage::select('name')->where('product_id', $product->id)->get();

        $images = $images->map(function($image){
            return [
                'name' => $image->name,
                'basename' => basename($image->name),
                'size' => Storage::disk('local')->size('public/images/products/'. basename($image->name)),
            ];
        });

        return view('admin.products.edit', [
            'product' => $product,
            'categories' => $categories,
            'brands' => $brands,
            'images' => $images,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'title' => 'required',
            'brand' => 'required',
            'category' => 'required',
            'description' => 'required',
            'price' => 'required',
            'sku' => 'required',
            'status' => 'required',
            'weight' => 'required',
            'stock' => 'required',
        ]);

        try {

            DB::transaction(function () use ($request, $product) {
                $product->update([
                    'title' => $request->title,
                    'sku' => $request->sku,
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

                    $images = ProductImage::where('product_id', $product->id)->get();
                    $srcFolder = 'public/images/tmp/';
                    $dstFolder = 'public/images/products/';

                    $add = [];
                    $delete = [];

                    // Check untuk hapus gambar
                    foreach($images as $image){
                        if(!in_array(basename($image->name), collect($request->images)->pluck('tmpImageName')->toArray())) {
                            array_push($delete, basename($image->name));
                        }
                    }

                    // Check untuk tambah gambar
                    foreach($request->images as $image){
                        $filename = $image['tmpImageName'];
                        if(!in_array($filename, $images->pluck('name')->map(function($image) {
                            return basename($image);
                        })->toArray())) {
                            array_push($add, $filename);
                        }
                    }

                    if (count($add) > 0){
                        foreach($add as $a){
                            ProductImage::create([
                                'product_id' => $product->id,
                                'name' => $a
                            ]);

                            Storage::disk('local')->move($srcFolder . $a, $dstFolder . $a);
                        }
                    }

                    if (count($delete) > 0){
                        foreach($delete as $d){
                            if(Storage::disk('local')->exists('public/images/products/'. basename($d))){
                                Storage::disk('local')->delete('public/images/products/'. basename($d));
                            }

                            $image = ProductImage::where('name', $d)->first();
                            $image->delete();
                        }
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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            DB::transaction(function () use ($id) {
                $productImages = ProductImage::where('product_id', $id)->get();

                foreach($productImages as $productImage){
                    if(Storage::disk('local')->exists('public/images/products/'. basename($productImage->name))){
                        Storage::disk('local')->delete('public/images/products/'. basename($productImage->name));
                        $productImage->delete();
                    }
                }

                $product = Product::where('id', $id)->first();
                $product->delete();
            });

            return redirect()->to('/admin/products')->with('success', 'Category deleted successfully');
        } catch (\Exception $e) {
            return redirect()->to('/admin/products')->with('error', $e->getMessage());
        }
    }
}
