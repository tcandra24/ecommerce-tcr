<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DropzoneController extends Controller
{
    public function upload(Request $request)
    {
        try {
            $image = $request->file('file');
            $image->storeAs('public/images/tmp', $image->hashName());

            return response()->json([
                'image' => $image->hashName()
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ]);
        }
    }

    public function remove(Request $request)
    {
        try {
            if(Storage::disk('local')->exists('public/images/tmp/'. basename($request->image))){
                Storage::disk('local')->delete('public/images/tmp/'. basename($request->image));

                return response()->json([
                    'message' => 'Success delete photo'
                ]);
            } else {
                return response()->json([
                    'message' => 'Photo not found'
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ]);
        }

    }
}
