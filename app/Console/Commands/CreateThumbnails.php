<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
//use Intervention\Image\ImageManager;
use Intervention\Image\Facades\Image;
use File;

class CreateThumbnails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'thumbnails:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates thumbnails of images in the image library in the editorimages folder';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * We are getting all the uploaded images in the editorimages image library folder, converting them to thumbnails with Intervention Image, and saving the thumbnails into
     * the thumbnails image library folder. Since there are a lot of images in the library, we need to take every opportunity to improve loading times for users.
     * Execute the console command.
     * Can be run manually from the command line with:    php artisan thumbnails:create
     * Cronjob set up in protected function schedule()  in kernel.php
     * Don't forget the one server cronjob: * * * * * php /path/to/artisan schedule:run >> /dev/null 2>&1
     *
     * @return mixed
     */
    public function handle()
    {

        $directory_main = 'images/editorimages';
        $directory_thumbs = 'images/thumbnails';

        // 1) get all subdirectories in the main images folder (editorimages)
        $subdirs = File::directories($directory_main);

        foreach ($subdirs as $subdirpath) {

            // 2) $subdirpath for each subdir includes the main folder and subdir like editorimages/subdir, so we have to just get the subdir name out of that.
            $subdir_array = explode('editorimages/', $subdirpath);
            $subdir = $subdir_array[1];

            // 3) for each subdirectory, check if it also exists in thumbnails folder. If it doesn't, create it.
            $mainsubdir = $directory_main . '/' . $subdir;
            $thumbnailsubdir = $directory_thumbs . '/' . $subdir;
            if (!File::exists($thumbnailsubdir)) {
                // the subdir DOESN'T exist in the the thumbnail library, so create it:
                File::MakeDirectory($thumbnailsubdir);
            }
            // 4) Get each file in the MAIN folder's  subdir now. If it doesn't already exist in the THUMBNAIL folder's subdir, copy it over from the MAIN folder's subdir.
            $files = File::files($mainsubdir);
            foreach ($files as $filepath) {
                // 5) $filepath for each file includes the full path but we just want the file name.
                $file_fullpath_array = explode("/", $filepath);
                $file = end($file_fullpath_array);
                $thumbnailpath = $thumbnailsubdir . '/' . $file;
                if (!File::exists($thumbnailpath)) {
                    // 6) The thumbnail copy DOESN'T exist yet. Copy the image over, then resize it:
                    $mainfilepath = $mainsubdir . '/' . $file;
                    // 7) Make sure the file is gif, png, or jpg.
                    $extension = File::extension($mainfilepath);
                    if ($extension === 'jpg' || $extension === 'png' || $extension === 'gif' || $extension === 'jpeg') {

                        if (File::copy($mainfilepath, $thumbnailpath)) {
                            // 8) After copying the image over, get its existing width and height to see if it should be resized:
                            $filedata = getimagesize($thumbnailpath);
                            $width = $filedata[0];
                            $height = $filedata[1];
                            if ($width > 200) {
                                 //9a) The image is too wide for a thumnail, so resize it with Invervention Image and constrain aspect ratio (auto height):
                                $img = Image::make($thumbnailpath)->resize(200, null, function($constraint) {
                                    $constraint->aspectRatio();
                                })->save($thumbnailpath);
                                echo $thumbnailpath . " is wider than 200\n";
                                //exit;
                            } elseif ($height > 200 && $width > 100) {
                                // 9b) The image is too tall for a thumnail, and is wide enough that resizing it won't narrow it down to nothing, so resize it with Invervention Image and constrain aspect ratio (auto width):
                                $img = Image::make($thumbnailpath)->resize(null, 200, function($constraint) {
                                    $constraint->aspectRatio();
                                })->save($thumbnailpath);
                               echo $thumbnailpath . " is taller than 200\n";
                                //exit;
                            }
                        }

                    }
                }
            }
        }

    }
}
