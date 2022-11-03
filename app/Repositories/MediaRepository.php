<?php
namespace App\Repositories;

use App\Helpers\MyHelper;
use App\Models\Category;
use App\Models\Medias;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Youtube;

class MediaRepository
{

    public function indexRepository()
    {

    }

    public function storeRepository($request)
    {
        $data = $request->except('data');
        $images = $request->data;
        $data['is_active'] = true;
       if (!empty($request['data']))
       {
           if ($request['type'] == 'video'){
               $video = Youtube::upload($request->file('data')->getClientOriginalName(), [
                   'title'       => $request['title'],
                   'description' => $request['description'],
               ]);
               $data['data']  = $video->getVideoId();
               $data['type'] = 'video';

           }else{
               $data['data'] = implode(",", MyHelper::uploadMultipleImage($images) );
               $data['type'] = 'image';
           }
       }
        $media = Medias::create($data);

        return $media->fresh();
    }

    public function editRepository($id)
    {
        $lims_category_data = Category::findOrFail($id);
        return $lims_category_data->fresh();
    }

    public function updateRepository($request)
    {
        $data = $request->except('data');
        $images = $request->data;
        $lims_media_data = Medias::findOrFail($data['id']);
        if (!empty($request['data']))
        {
            if ($request['type'] == 'video'){
                $video = Youtube::upload($request->file('data')->getPathName(), [
                    'title'       => $request['title'],
                    'description' => $request['description'],
                ]);
                $data['data']  = $video->getVideoId();
                $data['type'] = 'video';
            }else{
                   if (!empty($data['type'] == 'image'))
                   {
                       $image_path = 'medai'.$lims_media_data->image;
                       MyHelper::deleteImage($image_path);
                       $data['data'] = implode(",", MyHelper::uploadMultipleImage($images) );
                       $data['type'] = 'image';
                   }else{
                       $data['image'] = $lims_media_data->image;
                   }
            }
        }
        $lims_media_data->update($data);
        return $lims_media_data->fresh();
    }

    public function importRepository($upload)
    {
        $filename =  $upload->getClientOriginalName();
        $filePath=$upload->getRealPath();
        //open and read
        $file=fopen($filePath, 'r');
        $header= fgetcsv($file);
        $escapedHeader=[];
        //validate
        foreach ($header as $key => $value) {
            $lheader=strtolower($value);
            $escapedItem=preg_replace('/[^a-z]/', '', $lheader);
            array_push($escapedHeader, $escapedItem);
        }
        //looping through othe columns
        while($columns=fgetcsv($file))
        {
            if($columns[0]=="")
                continue;
            foreach ($columns as $key => $value) {
                $value=preg_replace('/\D/','',$value);
            }
            $data= array_combine($escapedHeader, $columns);
            $category = Category::firstOrNew(['name' => $data['name'], 'name_kh' => $data['namekh'], 'slug' => Str::slug($data['name']), 'is_active' => true, 'created_by'=>Auth::id() ]);
            if($data['parentcategory']){
                $parent_category = Category::firstOrNew(['name' => $data['parentcategory'], 'is_active' => true, 'created_by'=>Auth::id()]);
                $parent_id = $parent_category->id;
            }
            else
                $parent_id = null;

            $category->parent_id = $parent_id;
            $category->is_active = true;
            $category->created_by = Auth::id();
            $category->save();
        }
        return $category->fresh();
    }

    public function deleteBySelectionRepository($category_id)
    {
        foreach ($category_id as $id) {
            $lims_product_data = Product::where('category_id', $id)->get();
            foreach ($lims_product_data as $product_data) {
                $product_data->delete();
            }
            $lims_category_data = Category::findOrFail($id);
            $lims_category_data->delete();
            $lims_category_data->childes()->delete();
            $image_path = 'images/category/'.$lims_category_data->image;
            MyHelper::deleteImage($image_path);
        }
        return $lims_category_data->fresh();
    }

    public function deleteRepository($id)
    {
        $media = Medias::findOrFail($id);
        $media->delete();
        $image_path = 'media'.$media->image;
        MyHelper::deleteImage($image_path);
        return $media->fresh();
    }

}
