<?php namespace App\lib\File;

/**
 * Class FileUploader
 * @package App\Helpers\Libs
 */
class FileUploader extends BaseUploader
{
    /**
     * @param $file
     * @param $directory
     * @return string
     */
    public static function move($file, $directory)
    {
        $filename = hash_hmac('tiger128,3', microtime(), 'negahi') . self::fileExtension($file);
        $file->move('uploads/' . $directory, $filename);
        return 'uploads/' . $directory . '/' . $filename;
    }
}
