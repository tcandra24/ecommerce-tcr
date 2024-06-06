<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CategoryRequest;
use Illuminate\Support\Str;

use App\Models\Category;
use App\Traits\ImageTrait;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    use ImageTrait;

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
    public function store(CategoryRequest $request)
    {
        try {
            $filename = $this->upload('public/images/categories/', $request);

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
    public function update(CategoryRequest $request, Category $category)
    {
        try {
            if (isset($request->images[0]['tmpImageName'])){
                $filename = $this->upload('public/images/categories/', $request, $category);

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

            return redirect()->to('/admin/categories')->with('success', 'Category deleted successfully');
        } catch (\Exception $e) {
            return redirect()->to('/admin/categories')->with('error', $e->getMessage());
        }
    }
}
