<?php

namespace App\Http\FileTraitement;

use Exception;

final class FindAndDeleteFile
{
    protected $folder;
    protected $file;

    public function verification($folder, $file)
    {
        $this->folder = $folder;
        $this->file = $file;

        $url_file = public_path('storage/'.config('global.' . $this->folder) . '/' . $this->file);

        if(file_exists($url_file))
        {
            try {
                unlink($url_file);
            } catch (Exception $e) {
                return redirect()->back();
            }
        }
    }

}
