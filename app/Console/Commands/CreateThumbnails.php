<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
//use Intervention\Image\ImageManager;
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

        // 2) for each subdirectory, check if it exists in thumbnails folder. If it doesn't, create it.
        foreach ($subdirs as $subdir) {
            $mainsubdir = $directory_main . '/' . $subdir;
            $thumbnailsubdir = $directory_thumbs . '/' . $subdir;
            if (!File::exists($thumbnailsubdir)) {
                // the subdir DOESN'T exist in the the thumbnail library, so create it:
                File::MakeDirectory($thumbnailsubdir);
            }
            // 3) Get each file in the MAIN folder's  subdir now. If it doesn't already exist in the THUMBNAIL folder's subdir, copy it over from the MAIN folder's subdir.
            $files = File::files($mainsubdir);
            foreach ($files as $file) {
                $thumbnailpath = $thumbnailsubdir . '/' . $file;
                if (!File::exists($thumbnailpath)) {
                    // 4) The thumbnail copy DOESN'T exist yet. Copy the image over, then resize it:
                    $mainfilepath = $mainsubdir . '/' . $file;
                    if (File::copy($mainfilepath, $thumbnailpath)) {
                        // 5) After copying the image over, resize it with Invervention Image and constrain aspect ratio (auto height):
                        $img = Image::make($thumbnailpath)->resize(300, null, function($constraint) {
                            $constraint->aspectRatio();
                        });
                    }
                }
            }
        }

    }
}
