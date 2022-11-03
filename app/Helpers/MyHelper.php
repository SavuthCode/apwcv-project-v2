<?php
namespace App\Helpers;

use File;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Exception;
use Image;
use Youtube;

Class MyHelper
{

   public static function uploadToYoutube($request,$title,$description){
       $video = Youtube::upload($request->file('video')->getPathName(), [
           'title'       => $title,
           'description' => $description
       ]);
       return $video->getVideoId();
   }

   public static function UploadImage($image, $nameFolder)
   {
       if (!empty($image)){
           $ext = pathinfo($image->getClientOriginalName(), PATHINFO_EXTENSION);
           $imageName = date("Ymdhis");
           $imageName = $imageName . '.' . $ext;
           $image->move($nameFolder, $imageName);
           return $imageName;
       }else{
           return null;
       }
   }

    public static function deleteImage($image_path) {

        if(File::exists($image_path)) {
            File::delete($image_path);
        }
    }

    public static function uploadMultipleImage($images)
    {
        $image_names = [];
        foreach ($images as $key => $image) {
            $ext = $image->getClientOriginalName();
            $imageName = date("Ymdhis");
            $imageName = $imageName . '.' . $ext;
            $image->move('media', $imageName);
            $image_names[] = $imageName;
        }
        return $image_names;
    }

    public static function uploadMultipleFile($file)
    {
        $ext = pathinfo($file->getClientOriginalName(), PATHINFO_EXTENSION);
        $fileName = strtotime(date('Y-m-d H:i:s'));
        $fileName = $fileName . '.' . $ext;
        $file->move('product/files', $fileName);
        return $fileName;
    }


    public static function deleteMultipleImage($images)
    {
        foreach(explode(",", $images) as $image){
            $image_path = public_path().'/images/product/'.$image;
            if(File::exists($image_path)) {
                File::delete($image_path);
            }
        }
    }

    public static function deleteMultipleFile($file)
    {
        $files_path = public_path().'product/files/'.$file;
        if(File::exists($files_path)) {
            File::delete($files_path);
        }
    }

    public static function UploadCover($image,$nameFolder)
    {
        if ($image==null){
            return null;
        }else{
            $input = time().'.'.$image->extension();
            $destinationPath = public_path($nameFolder);
            $img = Image::make($image->path());
            $img->resize(100, 100, function ($constraint) {
                $constraint->aspectRatio();
            })->save($destinationPath.'/'.$input);
            return  $input;
        }
    }


    public static function order()
    {
        $customer_id = Auth::id();
            $carts=DB::table('carts')
                -> join('products', 'products.id', '=', 'carts.product_id')
                ->select('products.image','products.name','products.price')
                ->where('carts.customer_id',$customer_id)
                ->get();
        return $carts;
    }
}

?>
