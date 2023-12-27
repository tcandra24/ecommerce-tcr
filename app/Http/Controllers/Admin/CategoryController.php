<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        return view('admin.categories.index', [ 'categories' => $categories ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.categories.create');
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
            $dstFolder = 'public/images/categories/';

            Storage::disk('local')->move($srcFolder . $filename, $dstFolder . $filename);

            Category::create([
                'name' => $request->name,
                'slug' => Str::slug($request->name),
                'image' => $filename
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Category saved successfully'
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
    public function edit(Category $category)
    {
        $size = Storage::disk('local')->size('public/images/categories/'. basename($category->image));
        return view('admin.categories.edit', ['category' => $category, 'size' => $size]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required'
        ]);

        try {
            if (isset($request->images[0]['tmpImageName'])){
                $filename = $request->images[0]['tmpImageName'];
                $srcFolder = 'public/images/tmp/';
                $dstFolder = 'public/images/categories/';

                if(Storage::disk('local')->exists('public/images/categories/'. basename($category->image))){
                    Storage::disk('local')->delete('public/images/categories/'. basename($category->image));
                }

                Storage::disk('local')->move($srcFolder . $filename, $dstFolder . $filename);

                $category->update([
                    'name' => $request->name,
                    'slug' => Str::slug($request->name),
                    'image' => $filename
                ]);
            } else {
                $category->update([
                    'name' => $request->name,
                    'slug' => Str::slug($request->name)
                ]);
            }


            return response()->json([
                'success' => true,
                'message' => 'Categories saved successfully'
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
            $category = Category::where('id', $id)->first();
            $category->delete();

            if(Storage::disk('local')->exists('public/images/categories/'. basename($category->image))){
                Storage::disk('local')->delete('public/images/categories/'. basename($category->image));
            }

            return redirect()->to('/admin/categories')->with('success', 'Categories deleted successfully');
        } catch (\Exception $e) {
            return redirect()->to('/admin/categories')->with('error', $e->getMessage());
        }
    }
}
