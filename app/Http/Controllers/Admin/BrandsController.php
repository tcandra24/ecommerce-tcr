<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\BrandRequest;
use Illuminate\Support\Str;

use App\Models\Brand;
use App\Traits\ImageTrait;
use Illuminate\Support\Facades\Storage;

class BrandsController extends Controller
{
    use ImageTrait;

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
    public function store(BrandRequest $request)
    {
        try {
            $filename = $this->upload('public/images/brands/', $request);

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
    public function update(BrandRequest $request, Brand $brand)
    {
        try {
            if (isset($request->images[0]['tmpImageName'])){
                $filename = $this->upload('public/images/brands/', $request, $brand);

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

            return redirect()->to('/admin/brands')->with('success', 'Brand deleted successfully');
        } catch (\Exception $e) {
            return redirect()->to('/admin/brands')->with('error', $e->getMessage());
        }
    }
}
