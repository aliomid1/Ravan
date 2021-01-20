<?php

namespace App\lib\File;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic;

class ImageUploader extends BaseUploader
{
    public static function upload($file, $directory, $width = null, $old = null)
    {
        $path = 'uploads/' . $directory . '/';
        if (!is_null($old) or !empty($old))
            self::delete($old);

        File::exists($path) or File::makeDirectory($path, 0775, true, true);

        // $filename = hash_hmac('tiger128,3', microtime('false'), Str::random(3)) . self::fileExtension($file);
        $filename = time().$file->getClientOriginalName();
        
            $image = ImageManagerStatic::make($file->getRealPath());

        if (!is_null($width) or !empty($width)) {
            $image = $image->resize($width, null, function ($constraint) {
                $constraint->aspectRatio();
            });
        }

        if (config('image.watermark')) {
            $image = $image->insert(config('image.watermark_path'), 'bottom-right', 10, 10);
        }

        $image->save($path . $filename);
        return $path . $filename;
    }
}
