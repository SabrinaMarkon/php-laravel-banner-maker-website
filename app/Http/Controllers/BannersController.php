<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Banner;
use App\Models\License;
use App\Models\Page;
use App\Http\Controllers\Controller;
use Session;
use Redirect;
use Validator;
use Response;
use File;
use DateTime;

class BannersController extends Controller
{
    /**
     * Show all banners.
     *
     * @return Response
     */
    public function index() {
        // Get the user's saved images.
        $savedimages = Banner::where('userid', Session::get('user')->userid)->orderBy('id', 'asc')->get();
        // Date/Time to attach to saved banner img src so they are kept refreshed (without this saved banners may need a manual browser
        // refresh in order to see changes.
        $today = date("YmdHis");
        // Get the image library tree.
        $directory = "images/thumbnails";
        $foldertree = $this->folderTree($directory);
        // Get all the files in all the subdirectories recursively.
        // Build array and preload list.
        $filetree = File::allFiles($directory);
        $preloadimages = '';
        foreach ($filetree as $file)
        {
            $extension = File::extension($file);
            if ($extension === 'gif' || $extension === 'png' || $extension === 'jpg' || $extension === 'jpeg') {
                $preloadimages .= '<img src="' . (string)$file . '">';
            }
        }

        $content = Page::where('slug', '=', 'banners')->first();
        Session::flash('page', $content);

        return view('pages.banners', compact('savedimages', 'today', 'foldertree', 'preloadimages'));
    }
    /**
     * Get any subfolders of the folder.
     *
     * @param $topdir  the top root directory.
     * @return $subdirs  The subdirectories of the topdir root directory.
     */
    public function getSubdirectories($topdir) {
        $subdirs = File::directories($topdir);
        return $subdirs;
    }
    /**
     * Build the list of directories for the image library folder select box.
     *
     * @param $directory  the top root directory.
     * @return $foldertree  the list of all directories in root with their subdirectories for the select box.
     */
    public function folderTree($directory) {
        $foldertree = '';
        $dirs = $this->getSubdirectories($directory);
        foreach ($dirs as $dir) {
            $show_dir_array = explode('thumbnails/', $dir);
            $show_dir = $show_dir_array[1];
            $foldertree .= '<option value="' . $show_dir . '">' . $show_dir . '</option>';
//            // get any subdirs of dir:
//            $dirs2 = $this->getSubdirectories($dir);
//            foreach ($dirs2 as $dir2) {
//                $show_dir_array2 = explode('thumbnails/', $dir2);
//                $show_dir2 = $show_dir_array2[1];
//                $foldertree .=  '<option value="' . $show_dir2 . '">' . $show_dir2 . '</option>';
//            }
        }
        return $foldertree;
    }
    /**
     * Get the list of files for the image library chooser depending on which category (folder) was chosen.
     *
     * @param $folder  the chosen image folder.
     * @return $filetree  the list of all files in the chosen directory.
     */
    public function fileTree(Request $request, $folder = null) {
        $folder = "images/thumbnails/" . $folder;
        $filetree = '';
        $resize = '';
        $files = File::files($folder);
        foreach ($files as $file)
        {
            // make sure the file is an image.
            $extension = File::extension($file);
            if ($extension === 'gif' || $extension === 'png' || $extension === 'jpg' || $extension === 'jpeg') {
                $file_fullpath_array = explode("/", $file);
                $filename = end($file_fullpath_array);
                $filedata = getimagesize($file);
                $width = $filedata[0];
                $height = $filedata[1];
                if ($width > 200) {
                    $resize = ' previewshrink';
                }
                $filetree .= '<img  id="' . $filename . '" class="imagepreviewdiv ui-widget-content' . $resize . '" src="' . (string)$file . '"><br>';
            }
        }
        return $filetree;
    }
    /**
     * Save banner.
     *
     * @return Response
     */
    public function getbanner(Request $request) {
        // First get the base-64 string from data
        $img_val = $request->get('img_val');
        $filteredData = substr($img_val, strpos($img_val, ",")+1);
        //Decode the string
        $unencodedData = base64_decode($filteredData);
        // get the background and border setting values from img_obj
        $img_obj = $request->get('img_obj');
        //var_dump(json_decode($img_obj));
        $img_obj = json_decode($img_obj);

        // Check if this is an existing banner or a new banner:
        $editingexistingimageid = $request->get('editingexistingimageid');
        if ($editingexistingimageid !== '') {
            // existing banner we need to update:
            // we need to get the existing filename:
            $banner = Banner::find($editingexistingimageid);
            $dlfile = $banner->filename;
            // we need to delete the old copy of the file from the server:
            $dlfilepath = 'mybanners/' . $dlfile;
            File::delete($dlfilepath);
            // we need to create that filename again on the server with the new data:
            file_put_contents('mybanners/' . $dlfile, $unencodedData);
        } else {
            // new banner to create.
            //Save the image with a random filename.
            $dlfilelong = md5(rand(0,9999999));
            $dlfileshort = substr($dlfilelong, 0, 12);
            $today = date("YmdHis");
            $dlfile = $today . $dlfileshort . ".png";
            $dlfilepath = 'mybanners/' . $dlfile;
            // write the file to the server.
            file_put_contents('mybanners/' . $dlfile, $unencodedData);
            $banner = new Banner();
            $banner->userid = Session::get('user')->userid;
        }

        // remove resize handles from htmlcode:
        $banner->htmlcode = trim($request->get('htmlcode'));
        $banner->filename = $dlfile;
        // save the fields in the object img_obj:
        $banner->width = $img_obj->width;
        $banner->height = $img_obj->height;
        $banner->bgcolor = $img_obj->bgcolor;
        $banner->bgimage = $img_obj->bgimage;
        $banner->bordercolor = $img_obj->bordercolor;
        $banner->borderwidth = $img_obj->borderwidth;
        $banner->borderstyle = $img_obj->borderstyle;
        // save image into the banners database table.
        $banner->save();
        Session::flash('message', 'Successfully saved your banner!');
        return Redirect::to('banners');
    }

    /**
     * Check to see if the user has purchased the license or not. If not, their banners should be watermarked.
     *
     * @param  string  $userid  the username we want to look up licenses for.
     * @return Response  whether the userid has a license for unwatermarked images.
     */
    public function licenseCheck(Request $request, $userid = null)
    {
        $license = License::where('userid', '=', $userid)->where('licenseenddate', '>=', new DateTime('now'))->orderBy('id', 'desc')->first();
        $watermark = 'yes'; // default is to have a watermark.
        if ($license) {
            // the user has a license so no watermark on images.
            $watermark = 'no';
        } else {
            // the user doesn't have an active license, so images they create need the watermark.
            $watermark = 'yes';
        }
        return $watermark;
    }


    /**
     * Display the specified image.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id, Request $request)
    {
        // get the page content for this id.
        $banner = Banner::find($id);
        return $banner;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $banner = Banner::find($id);
        // delete the file:
        $filename = $banner->filename;
        $filepath = 'mybanners/' . $filename;
        File::delete($filepath);
        // delete the record:
        $banner->delete();
        return $banner;
    }
}
