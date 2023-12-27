<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

use App\Models\Brand;
use Illuminate\Support\Facades\Storage;

class BrandsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands = Brand::all();
        return view('admin.brands.index', [ 'brands' => $brands ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.brands.create');
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
            'name' => 'required'
        ]);

        try {
            $filename = $request->images[0]['tmpImageName'];
            $srcFolder = 'public/images/tmp/';
            $dstFolder = 'public/images/brands/';

            Storage::disk('local')->move($srcFolder . $filename, $dstFolder . $filename);

            Brand::create([
                'name' => $request->name,
                'slug' => Str::slug($request->name),
                'image' => $filename
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Brand saved successfully'
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
    public function edit(Brand $brand)
    {
        $size = Storage::disk('local')->size('public/images/brands/'. basename($brand->image));
        return view('admin.brands.edit', ['brand' => $brand, 'size' => $size]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Brand $brand)
    {
        $request->validate([
            'name' => 'required'
        ]);

        try {
            if (isset($request->images[0]['tmpImageName'])){
                $filename = $request->images[0]['tmpImageName'];
                $srcFolder = 'public/images/tmp/';
                $dstFolder = 'public/images/brands/';

                if(Storage::disk('local')->exists('public/images/brands/'. basename($brand->image))){
                    Storage::disk('local')->delete('public/images/brands/'. basename($brand->image));
                }

                Storage::disk('local')->move($srcFolder . $filename, $dstFolder . $filename);

                $brand->update([
                    'name' => $request->name,
                    'slug' => Str::slug($request->name),
                    'image' => $filename
                ]);
            } else {
                $brand->update([
                    'name' => $request->name,
                    'slug' => Str::slug($request->name)
                ]);
            }


            return response()->json([
                'success' => true,
                'message' => 'Brand saved successfully'
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
            $brand = Brand::where('id', $id)->first();
            $brand->delete();

            if(Storage::disk('local')->exists('public/images/brands/'. basename($brand->image))){
                Storage::disk('local')->delete('public/images/brands/'. basename($brand->image));
            }

            return redirect()->to('/admin/brands')->with('success', 'Categories deleted successfully');
        } catch (\Exception $e) {
            return redirect()->to('/admin/brands')->with('error', $e->getMessage());
        }
    }
}
