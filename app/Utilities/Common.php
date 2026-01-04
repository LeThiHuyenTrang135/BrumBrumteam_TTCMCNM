<?php

namespace App\Utilities;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use Carbon\Carbon;

class Common
{
    /**
     * Upload file to public path and return relative path
     * @param UploadedFile|null $file
     * @param string $path (relative to public/) e.g. 'front/img/user'
     * @return string|null
     */
    public static function uploadFile($file, $path)
    {
        $file_name_original = $file->getClientOriginalName();
        $extension = $file->getClientOriginalExtension();
        $file_name_without_extension = Str::replaceLast($extension, '', $file_name_original);

        $str_time_now = Carbon::now()->format('ymd_his');
        $file_name = Str::slug($file_name_without_extension) . '_' . uniqid() . '_' . $str_time_now . '.' . $extension;

        $file->move($path, $file_name);

        return $file_name;

    }
}
