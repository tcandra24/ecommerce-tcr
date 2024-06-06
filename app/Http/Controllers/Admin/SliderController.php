<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SliderRequest;

use App\Models\Slider;
use App\Traits\ImageTrait;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{
    use ImageTrait;

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
    public function store(SliderRequest $request)
    {
        try {
            $filename = $this->upload('public/images/sliders/', $request);

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
    public function update(SliderRequest $request, Slider $slider)
    {
        try {
            if (isset($request->images[0]['tmpImageName'])){
                $filename = $this->upload('public/images/sliders/', $request, $slider);

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
