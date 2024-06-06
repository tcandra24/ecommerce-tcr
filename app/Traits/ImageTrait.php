<?php

namespace App\Traits;
use Illuminate\Support\Facades\Storage;

trait ImageTrait
{
    public function upload($path, $request, $model = null){
        $filename = $request->images[0]['tmpImageName'];
        $srcFolder = 'public/images/tmp/';
        $dstFolder = $path;

        if($model && Storage::disk('local')->exists($path. basename($model->image))){
            Storage::disk('local')->delete($path. basename($model->image));
        }

        Storage::disk('local')->move($srcFolder . $filename, $dstFolder . $filename);

        return $filename;
    }
}
