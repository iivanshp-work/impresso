<?php
/**
 * Controller genrated using LaraAdmin
 * Help: http://laraadmin.com
 */

namespace App\Http\Controllers\LA;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response as FacadeResponse;
use Illuminate\Support\Facades\Input;
use Collective\Html\FormFacade as Form;

use Dwij\Laraadmin\Models\Module;
use Dwij\Laraadmin\Helpers\LAHelper;
use Zizaco\Entrust\EntrustFacade as Entrust;

use Auth;
use DB;
use File;
use Validator;
use Datatables;

use App\Models\Upload;

class UploadsController extends Controller
{
    public $show_action = true;
    public $view_col = 'name';
    public $listing_cols = ['id', 'name', 'path', 'extension', 'caption', 'user_id'];

    public function __construct() {
        // for authentication (optional)
        $this->middleware('auth', ['except' => 'get_file']);
        $module = Module::get('Uploads');
        $listing_cols_temp = array();
        foreach ($this->listing_cols as $col) {
            if ($col == 'id') {
                $listing_cols_temp[] = $col;
            } else if (Module::hasFieldAccess($module->id, $module->fields[$col]['id'])) {
                $listing_cols_temp[] = $col;
            }
        }
        $this->listing_cols = $listing_cols_temp;
    }

    /**
     * Display a listing of the Uploads.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $module = Module::get('Uploads');

        if (Module::hasAccess($module->id)) {
            return View('la.uploads.index', [
                'show_actions' => $this->show_action,
                'listing_cols' => $this->listing_cols,
                'module' => $module
            ]);
        } else {
            return redirect(config('laraadmin.adminRoute') . "/");
        }
    }

    /**
     * Get file
     *
     * @return \Illuminate\Http\Response
     */
    public function get_file($hash, $name = '') {

        try {
            if (is_numeric($hash)) {
                $upload = DB::table("uploads")->orWhere("id", $hash)->first();
            } else {
                $upload = DB::table("uploads")->where("hash", $hash)->first();
            }
        } catch (\PDOException $e) {

        }
        // Validate Upload Hash & Filename
        if (!isset($upload->id) || ($name && $upload->name != $name)) {
            return response()->json([
                'status' => "failure",
                'message' => "Unauthorized Access 1"
            ]);
        }
        if ($upload->public == 1) {
            $upload->public = true;
        } else {
            $upload->public = false;
        }
        /* commented for frontend
        // Validate if Image is Public
        if(!$upload->public && !isset(Auth::user()->id)) {
            return response()->json([
                'status' => "failure",
                'message' => "Unauthorized Access 2",
            ]);
        }*/
        /*
        commented for frontend
        if($upload->public || Entrust::hasRole('SUPER_ADMIN') || Auth::user()->id == $upload->user_id) {*/
        if (true) {

            $path = $upload->path;
            //$path = str_replace("/home/wwwmedadvisor24/storage/uploads", "D:\PROGRAMS\OpenServer\domains\med24.com\storage\uploads", $path);
            //test($path);
            if (!File::exists($path))
                abort(404);

            // Check if thumbnail
            $size = Input::get('s');
            $sizes = explode("-", $size);
            $size = isset($sizes[0]) ? $sizes[0] : $size;
            $size2 = isset($sizes[1]) ? $sizes[1] : $size;
            if (isset($size) && $size) {
                if ($size == "orig") {
                    list($original_width, $original_height, $original_type) = getimagesize($path);

                    $size = $original_width;
                    $size2 = $original_height;
                } elseif (!is_numeric($size)) {
                    $size = 150;
                    $size2 = $size;
                }
                $thumbpath = storage_path("thumbnails/" . basename($upload->path) . "-" . $size . "x" . $size2);
                if (File::exists($thumbpath)) {
                    $path = $thumbpath;
                } else {
                    // Create Thumbnail
                    LAHelper::createThumbnail($upload->path, $thumbpath, $size, $size2, [247, 247, 247]);
                    $path = $thumbpath;
                }
            }

            $file = File::get($path);
            $type = File::mimeType($path);
            $download = Input::get('download');
            if (isset($download)) {
                return response()->download($path, $upload->name);
            } else {
                $response = FacadeResponse::make($file, 200);
                $response->header("Content-Type", $type);
            }

            return $response;
        } else {
            return response()->json([
                'status' => "failure",
                'message' => "Unauthorized Access 3"
            ]);
        }
    }


    /**
     * Crop Image
     * @param $imagesPath
     * @param $filePath
     * @param $newFileName
     * @param $fileType
     * @param $thumb
     * @return bool
     */
    function cropImage($imagesPath, $filePath, $newFileName, $fileType, $thumb) {
        $result = false;
        switch ($fileType) {
            case "image/gif":
            case "gif":
                $oldImg = imagecreatefromgif($filePath);
                break;
            case "image/jpeg":
            case "image/pjpeg":
            case "jpeg":
            case "jpg":
                $oldImg = imagecreatefromjpeg($filePath);
                break;
            default:
                $oldImg = imagecreatefrompng($filePath);
        }
        list($width, $height) = getimagesize($filePath);
        if($width == $height) {
            $x = $y = 0;
            $smallestSideWidth = $width;
            $smallestSideHeight = $height;

        }else if ($width > $height) {
            $y = 0;
            $x = ($width - $height) / 2;
            $smallestSideHeight = $height;
            $smallestSideWidth = $height;

        } else {
            $x = 0;
            $y = ($height - $width) / 2;
            $smallestSideHeight = $width;
            $smallestSideWidth = $width;
        }
        $ratio = $thumb["width"] / $thumb["height"];
        if ($oldImg) {
            $newImg = imagecreatetruecolor($thumb["width"], $thumb["height"]);
            imagecopyresampled($newImg, $oldImg,
                0, 0,
                $x, $y,
                $thumb["width"], $thumb["height"],
                $smallestSideWidth*$ratio, $smallestSideHeight
            );

            /*
             * if($width == $height) {

            $thumb_width = $width;
            $thumb_height = $height;

        }else if ($width > $height) {
            $y = 0;
            $x = ($width - $height) / 2;
            $thumb_width = $height;
            $thumb_height = $height;

        } else {
            $x = 0;
            $y = ($height - $width) / 2;
            $thumb_width = $width;
            $thumb_height = $width;
        }

        $original_aspect = $width / $height;
        $thumb_aspect = $thumb_width / $thumb_height;

        if ( $original_aspect >= $thumb_aspect ) {

            // If image is wider than thumbnail (in aspect ratio sense)
            $smallestSideHeight = $thumb_height;
            $smallestSideWidth = $width / ($height / $thumb_height);

        }
        else {
            // If the thumbnail is wider than the image
            $smallestSideWidth = $thumb_width;
            $smallestSideHeight = $height / ($width / $thumb_width);
        }


        if ($oldImg) {
            $newImg = imagecreatetruecolor($thumb["width"], $thumb["height"]);
            imagecopyresampled($newImg, $oldImg,
                0, 0,
                $x, $y,
                $thumb["width"], $thumb["height"],
                $smallestSideWidth, $smallestSideHeight
            );

            test([$width, $height,
                $thumb_width, $thumb_height,
                $original_aspect, $thumb_aspect,
                $x, $y,
                $thumb["width"], $thumb["height"],
                $smallestSideWidth, $smallestSideHeight]);

            /*imagecopyresampled($newImg, $oldImg,
                0 - ($smallestSideWidth - $thumb_width) / 2, // Center the image horizontally
                0 - ($smallestSideHeight - $thumb_height) / 2, // Center the image vertically
                0, 0,
                $smallestSideWidth, $smallestSideHeight,
                $width, $height
            );*/

            $newFilePath = $imagesPath . "/" . $newFileName;
            @unlink($newFilePath);

            switch ($fileType) {
                case "image/gif":
                case "gif":
                    $result = @imagegif($newImg, $newFilePath);
                    break;
                case "image/jpeg":
                case "image/pjpeg":
                case "jpeg":
                case "jpg":
                    $result = @imagejpeg($newImg, $newFilePath, 100);
                    break;
                default:
                    $result = @imagepng($newImg, $newFilePath);
            }
            if (!is_writeable($newFilePath)) @chmod($newFilePath, 0777);
            @imagedestroy($newImg);
        }

        return $result ? true : false;
    }
    /*
    function resizeImage($imagesPath, $filePath, $newFileName, $fileType, $thumb) {
        $result = false;
        switch ($fileType) {
            case "image/gif":
            case "gif":
                $oldImg = @imagecreatefromgif($filePath);
                break;
            case "image/jpeg":
            case "image/pjpeg":
            case "jpeg":
            case "jpg":
                $oldImg = @imagecreatefromjpeg($filePath);
                break;
            default:
                $oldImg = @imagecreatefrompng($filePath);
        }

        if ($oldImg) {
            $oldWidth = imagesx($oldImg);
            $oldHeight = imagesy($oldImg);

            $newWidth = $thumb["width"];
            if ($thumb["height"] > 0) {
                $newHeight = $thumb["height"];
            } else {
                $newHeight = ($newWidth * $oldHeight) / $oldWidth;
                $thumb["height"] = $newHeight;
            }

            if ($oldWidth > $oldHeight) $newHeight = (int)(($oldHeight * $thumb["width"]) / $oldWidth);
            else $newWidth = (int)(($oldWidth * $thumb["height"]) / $oldHeight);

            $newImg = imagecreatetruecolor($thumb["width"], $thumb["height"]);
            imagefill($newImg, 0, 0, imagecolorallocate($newImg, 0xFF, 0xFF, 0xFF));
            imagecopyresampled($newImg, $oldImg,
                ($newWidth == $thumb["width"] ? 0 : intval(($thumb["width"] - $newWidth) / 2)),
                ($newHeight == $thumb["height"] ? 0 : intval(($thumb["height"] - $newHeight) / 2)),
                0, 0,
                $newWidth, $newHeight,
                $oldWidth, $oldHeight
            );

            $newFilePath = $imagesPath . "/" . $newFileName;
            @unlink($newFilePath);
            switch ($fileType) {
                case "image/gif":
                case "gif":
                    $result = @imagegif($newImg, $newFilePath);
                    break;
                case "image/jpeg":
                case "image/pjpeg":
                case "jpeg":
                case "jpg":
                    $result = @imagejpeg($newImg, $newFilePath, 80);
                    break;
                default:
                    $result = @imagepng($newImg, $newFilePath);
            }
            if (!is_writeable($newFilePath)) @chmod($newFilePath, 0777);
            @imagedestroy($newImg);
        }

        return $result ? true : false;
    }

    function cropAlign($image, $cropWidth, $cropHeight, $horizontalAlign = 'center', $verticalAlign = 'middle') {
        $width = imagesx($image);
        $height = imagesy($image);
        $horizontalAlignPixels = calculatePixelsForAlign($width, $cropWidth, $horizontalAlign);
        $verticalAlignPixels = calculatePixelsForAlign($height, $cropHeight, $verticalAlign);
        return imageCrop($image, [
            'x' => $horizontalAlignPixels[0],
            'y' => $verticalAlignPixels[0],
            'width' => $horizontalAlignPixels[1],
            'height' => $verticalAlignPixels[1]
        ]);
    }

    function calculatePixelsForAlign($imageSize, $cropSize, $align) {
        switch ($align) {
            case 'left':
            case 'top':
                return [0, min($cropSize, $imageSize)];
            case 'right':
            case 'bottom':
                return [max(0, $imageSize - $cropSize), min($cropSize, $imageSize)];
            case 'center':
            case 'middle':
                return [
                    max(0, floor(($imageSize / 2) - ($cropSize / 2))),
                    min($cropSize, $imageSize),
                ];
            default: return [0, $imageSize];
        }
    }*/

    /*
     *
     * $im = imagecreatefrompng('https://i.stack.imgur.com/NJcML.png');
     * imagePng(cropAlign($im, 200, 250, 'center', 'middle'));
     * imagePng(cropAlign($im, 300, 150, 'left', 'top'));
     * imagePng(cropAlign($im, 1000, 250, 'right', 'middle'));
     */

    /*
     * $result = $this->storyImageModel->crop("videos", $record->image, $this->storyImageModel->newFileName(), $credit);
    function crop($folder, $fileName, $newFileName = "", $credit = "") {
    $error = false;
    $status = "";

    $folderModel = new FolderModel();
    $imagesPath = $folderModel->getFolder();
    $filePath = $imagesPath . "orig/" . $fileName;
    $destination = $folderModel->getDestination();

    if (!file_exists($filePath)) {
      $this->aws->downloadFile("images/" . $folder . "/orig/", $fileName, $destination);
    }

    $fileExt = strtolower(pathinfo($filePath, PATHINFO_EXTENSION));
    $newFileName = ($newFileName ? $newFileName : $this->newFileName()) . "." . $fileExt;

    if (!empty($this->thumbs)) {
      foreach ($this->thumbs as $thumb) {
        $folderModel->prepareDirectory($thumb["folder"]);
        if (!$this->cropImage($imagesPath, $filePath, $newFileName, $fileExt, $thumb, $credit)) {
          $error = "error_crop_image";
          break;
        }
        $tmpName = $imagesPath . $thumb["folder"] . "/" . $newFileName;
        exec("convert " . $tmpName . " -sampling-factor 4:2:0 -strip -quality " . self::JPEG_QUALITY . " -interlace JPEG " . $tmpName);
        $awsKey = "images/" . $folder . "/" . $thumb["folder"] . "/" . $newFileName;
        $this->aws->uploadFile($awsKey, $tmpName);
      }
    }

    if ($error) $status = $this->message($error);
    else {
      $awsKey = "images/" . $folder . "/orig/" . $newFileName;
      $this->aws->uploadFile($awsKey, $filePath);
    }

    $folderModel->cleanUp();

    return array("error" => $error, "status" => $status, "image" => $newFileName);
  }*/

    /**
     * Upload fiels via DropZone.js
     *
     * @return \Illuminate\Http\Response
     */
    public function upload_files($returnToCode = false, $file = null, $cropParams = []) {

        if (1) {
            $input = Input::all();

            if (Input::hasFile('file') || $file) {
                /*
                $rules = array(
                    'file' => 'mimes:jpg,jpeg,bmp,png,pdf|max:3000',
                );
                $validation = Validator::make($input, $rules);
                if ($validation->fails()) {
                    return response()->json($validation->errors()->first(), 400);
                }
                */
                if (!$file) {
                    $file = Input::file('file');
                }
                // print_r($file);

                $folder = storage_path('uploads');
                $filename = $file->getClientOriginalName();

                $date_append = date("Y-m-d-His-");
                $upload_success = $file->move($folder, $date_append . $filename);

                if ($upload_success) {

                    // Get public preferences
                    // config("laraadmin.uploads.default_public")
                    $public = Input::get('public');
                    if (isset($public)) {
                        $public = true;
                    } else {
                        $public = false;
                    }
                    $name = $this->transliterate(pathinfo($filename, PATHINFO_FILENAME));
                    if (!$name) {
                        $name = "filename";
                    }
                    $uploadData = [
                        "name" => $name,
                        "path" => $folder . DIRECTORY_SEPARATOR . $date_append . $filename,
                        "extension" => pathinfo($filename, PATHINFO_EXTENSION),
                        "caption" => "",
                        "hash" => "",
                        "public" => $public,
                        "user_id" => Auth::user()->id
                    ];
                    $upload = Upload::create($uploadData);
                    // apply unique random hash to file
                    while (true) {
                        $hash = strtolower(str_random(20));
                        if (!Upload::where("hash", $hash)->count()) {
                            $uploadData["hash"] = $hash;
                            $upload->hash = $hash;
                            break;
                        }
                    }
                    $upload->save();

                    $imagesPath = storage_path("thumbnails/");
                    //crop start
                    if (!empty($cropParams) && isset($cropParams['width']) && $cropParams['height']){
                        $size1 = $cropParams['width'];
                        $size2 = $cropParams['height'];
                        $path = $upload->path;
                        $newFileName = basename($path) . "-" . $size1 . "x" . $size2;
                        $fileType = File::mimeType($path);
                        $thumb = [
                            'width' => $size1,
                            'height' => $size2
                        ];
                        $cropped = $this->cropImage($imagesPath, $path, $newFileName, $fileType, $thumb);
                        if ($cropped) {
                            $upload->crop_url = url('files/' . $upload->hash . '/' . $upload->name . '?s=' . $size1 . '-' . $size2);
                        }
                    }
                    //crop end
                    $upload->url = url('files/' . $upload->hash . '/' . $upload->name);
                    if ($returnToCode) {
                        return [
                            "status" => "success",
                            "upload" => $upload
                        ];
                    } else {
                        return response()->json([
                            "status" => "success",
                            "upload" => $upload
                        ], 200);
                    }
                } else {
                    if ($returnToCode) {
                        return [
                            "status" => "error"
                        ];
                    } else {
                        return response()->json([
                            "status" => "error"
                        ], 400);
                    }
                }
            } else {
                if ($returnToCode) {
                    return [
                        'status' => "failure",
                        'message' => 'error: upload file not found.'
                    ];
                } else {
                    return response()->json('error: upload file not found.', 400);
                }
            }
        } else {
            if ($returnToCode) {
                return [
                    'status' => "failure",
                    'message' => "Unauthorized Access"
                ];
            } else {
                return response()->json([
                    'status' => "failure",
                    'message' => "Unauthorized Access"
                ]);
            }
        }
    }

    /**
     * Get all files from uploads folder
     *
     * @return \Illuminate\Http\Response
     */
    public function uploaded_files(Request $request) {
        $page = $request->has('page') ? intval($request->input('page')) : 1;
        $keyword = $request->has('keyword') ? trim($request->input('keyword')) : '';
        $limit = 10;
        $offset = ($page - 1) * $limit;

        if (Module::hasAccess("Uploads", "view")) {
            $uploads = array();

            // print_r(Auth::user()->roles);
            if (Entrust::hasRole('SUPER_ADMIN')) {
                if ($keyword) {
                    $uploads = Upload::where('name', 'like', '%' . $keyword . '$%')->offset($offset)->limit($limit)->get();
                } else {
                    $uploads = Upload::where('id', '<>', 0)->offset($offset)->limit($limit)->orderBy('created_at', 'desc')->get();
                }

            } else {
                if (config('laraadmin.uploads.private_uploads')) {
                    // Upload::where('user_id', 0)->first();
                    $uploads = Auth::user()->uploads;
                } else {
                    if ($keyword) {
                        $uploads = Upload::where('name', 'like', '%' . $keyword . '$%')->offset($offset)->limit($limit)->orderBy('created_at', 'desc')->get();
                    } else {
                        $uploads = Upload::where('id', '<>', 0)->offset($offset)->limit($limit)->orderBy('created_at', 'desc')->get();
                    }
                }
            }
            $uploads2 = array();
            foreach ($uploads as $upload) {
                $u = (object)array();
                $u->id = $upload->id;
                $u->name = $this->transliterate($upload->name);
                $u->extension = $upload->extension;
                $u->hash = $upload->hash;
                $u->public = $upload->public;
                $u->caption = $upload->caption;
                $u->user = $upload->user->name;

                $uploads2[] = $u;
            }

            // $folder = storage_path('/uploads');
            // $files = array();
            // if(file_exists($folder)) {
            //     $filesArr = File::allFiles($folder);
            //     foreach ($filesArr as $file) {
            //         $files[] = $file->getfilename();
            //     }
            // }
            // return response()->json(['files' => $files]);
            return response()->json(['uploads' => $uploads2]);
        } else {
            return response()->json([
                'status' => "failure",
                'message' => "Unauthorized Access"
            ]);
        }
    }

    /**
     * Update Uploads Caption
     *
     * @return \Illuminate\Http\Response
     */
    public function update_caption() {
        if (Module::hasAccess("Uploads", "edit")) {
            $file_id = Input::get('file_id');
            $caption = Input::get('caption');

            $upload = Upload::find($file_id);
            if (isset($upload->id)) {
                if ($upload->user_id == Auth::user()->id || Entrust::hasRole('SUPER_ADMIN')) {

                    // Update Caption
                    $upload->caption = $caption;
                    $upload->save();

                    return response()->json([
                        'status' => "success"
                    ]);

                } else {
                    return response()->json([
                        'status' => "failure",
                        'message' => "Upload not found"
                    ]);
                }
            } else {
                return response()->json([
                    'status' => "failure",
                    'message' => "Upload not found"
                ]);
            }
        } else {
            return response()->json([
                'status' => "failure",
                'message' => "Unauthorized Access"
            ]);
        }
    }

    /**
     * Update Uploads Filename
     *
     * @return \Illuminate\Http\Response
     */
    public function update_filename() {
        if (Module::hasAccess("Uploads", "edit")) {
            $file_id = Input::get('file_id');
            $filename = Input::get('filename');

            $upload = Upload::find($file_id);
            if (isset($upload->id)) {
                if ($upload->user_id == Auth::user()->id || Entrust::hasRole('SUPER_ADMIN')) {

                    // Update Caption
                    $upload->name = $this->transliterate($filename);
                    $upload->save();

                    return response()->json([
                        'status' => "success"
                    ]);

                } else {
                    return response()->json([
                        'status' => "failure",
                        'message' => "Unauthorized Access 1"
                    ]);
                }
            } else {
                return response()->json([
                    'status' => "failure",
                    'message' => "Upload not found"
                ]);
            }
        } else {
            return response()->json([
                'status' => "failure",
                'message' => "Unauthorized Access"
            ]);
        }
    }

    /**
     * Update Uploads Public Visibility
     *
     * @return \Illuminate\Http\Response
     */
    public function update_public() {
        if (Module::hasAccess("Uploads", "edit")) {
            $file_id = Input::get('file_id');
            $public = Input::get('public');
            if (isset($public)) {
                $public = true;
            } else {
                $public = false;
            }

            $upload = Upload::find($file_id);
            if (isset($upload->id)) {
                if ($upload->user_id == Auth::user()->id || Entrust::hasRole('SUPER_ADMIN')) {

                    // Update Caption
                    $upload->public = $public;
                    $upload->save();

                    return response()->json([
                        'status' => "success"
                    ]);

                } else {
                    return response()->json([
                        'status' => "failure",
                        'message' => "Unauthorized Access 1"
                    ]);
                }
            } else {
                return response()->json([
                    'status' => "failure",
                    'message' => "Upload not found"
                ]);
            }
        } else {
            return response()->json([
                'status' => "failure",
                'message' => "Unauthorized Access"
            ]);
        }
    }

    /**
     * Remove the specified upload from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function delete_file() {
        if (Module::hasAccess("Uploads", "delete")) {
            $file_id = Input::get('file_id');

            $upload = Upload::find($file_id);
            if (isset($upload->id)) {
                if ($upload->user_id == Auth::user()->id || Entrust::hasRole('SUPER_ADMIN')) {

                    // Update Caption
                    $upload->delete();

                    return response()->json([
                        'status' => "success"
                    ]);

                } else {
                    return response()->json([
                        'status' => "failure",
                        'message' => "Unauthorized Access 1"
                    ]);
                }
            } else {
                return response()->json([
                    'status' => "failure",
                    'message' => "Upload not found"
                ]);
            }
        } else {
            return response()->json([
                'status' => "failure",
                'message' => "Unauthorized Access"
            ]);
        }
    }


    public function transliterate($string) {
        $str = mb_strtolower($string, 'UTF-8');
        $leter_array = array(
            'a' => 'Р°',
            'b' => 'Р±',
            'v' => 'РІ',
            'g' => 'Рі',
            'd' => 'Рґ',
            'e' => 'Рµ,СЌ',
            'jo' => 'С‘',
            'zh' => 'Р¶',
            'z' => 'Р·',
            'i' => 'Рё,i',
            'j' => 'Р№',
            'k' => 'Рє',
            'l' => 'Р»',
            'm' => 'Рј',
            'n' => 'РЅ',
            'o' => 'Рѕ',
            'p' => 'Рї',
            'r' => 'СЂ',
            's' => 'СЃ',
            't' => 'С‚',
            'u' => 'Сѓ',
            'f' => 'С„',
            'kh' => 'С…',
            'ts' => 'С†',
            'ch' => 'С‡',
            'sh' => 'С€',
            'shch' => 'С‰',
            '' => 'СЉ',
            'y' => 'С‹',
            '' => 'СЊ',
            'yu' => 'СЋ',
            'ya' => 'СЏ',
        );

        foreach ($leter_array as $leter => $kyr) {
            $kyr = explode(',', $kyr); // РєРёСЂРёР»РёС‡РµСЃРєРёРµ СЃС‚СЂРѕРєРё СЂР°Р·РѕР±СЊРµРј РІ РјР°СЃСЃРёРІ СЃ СЂР°Р·РґРµР»РёС‚РµР»РµРј Р·Р°РїСЏС‚Р°СЏ.
            $str = str_replace($kyr, $leter, $str);
        }
        $str = preg_replace('/(\s|[^A-Za-z0-9-])+/', '-', $str);
        $str = trim($str, '-');
        return $str;
    }

}
