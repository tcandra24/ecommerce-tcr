<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Slider;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sliders = Slider::all();
        return view('admin.sliders.index', [ 'sliders' => $sliders ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.sliders.create');
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
            $dstFolder = 'public/images/sliders/';

            Storage::disk('local')->move($srcFolder . $filename, $dstFolder . $filename);

            Slider::create([
                'name' => $request->name,
                'link' => $request->link ?? '',
                'image' => $filename
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Slider saved successfully'
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
    public function edit(Slider $slider)
    {
        $size = Storage::disk('local')->size('public/images/sliders/'. basename($slider->image));
        return view('admin.sliders.edit', ['slider' => $slider, 'size' => $size]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Slider $slider)
    {
        $request->validate([
            'name' => 'required'
        ]);

        try {
            if (isset($request->images[0]['tmpImageName'])){
                $filename = $request->images[0]['tmpImageName'];
                $srcFolder = 'public/images/tmp/';
                $dstFolder = 'public/images/sliders/';

                if(Storage::disk('local')->exists('public/images/sliders/'. basename($slider->image))){
                    Storage::disk('local')->delete('public/images/sliders/'. basename($slider->image));
                }

                Storage::disk('local')->move($srcFolder . $filename, $dstFolder . $filename);

                $slider->update([
                    'name' => $request->name,
                    'link' => $request->link ?? '',
                    'image' => $filename
                ]);
            } else {
                $slider->update([
                    'name' => $request->name,
                    'link' => $request->link ?? '',
                ]);
            }

            return response()->json([
                'success' => true,
                'message' => 'Slider saved successfully'
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
            $slider = Slider::where('id', $id)->first();
            $slider->delete();

            if(Storage::disk('local')->exists('public/images/sliders/'. basename($slider->image))){
                Storage::disk('local')->delete('public/images/sliders/'. basename($slider->image));
            }

            return redirect()->to('/admin/sliders')->with('success', 'Slider deleted successfully');
        } catch (\Exception $e) {
            return redirect()->to('/admin/sliders')->with('error', $e->getMessage());
        }
    }
}
