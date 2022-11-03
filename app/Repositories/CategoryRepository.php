<?php
namespace App\Repositories;

use App\Models\Brand;
use App\Models\Category;
use App\Helpers\MyHelper;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CategoryRepository
{

    public function indexRepository()
    {

    }

    public function storeRepository($data)
    {
        $data['is_active'] = true;
        $data['slug'] = Str::slug($data['title_en']);
       if (!empty($data['image']))
       {
           $data['image'] = MyHelper::UploadImage($data['image'],'images/category');
       }
        $category = Category::create($data);
        return $category->fresh();
    }

    public function editRepository($id)
    {
        $lims_category_data = Category::findOrFail($id);
        $lims_parent_data = Category::where('id', $lims_category_data['parent_id'])->first();
        if($lims_parent_data)
            $lims_category_data['parent'] = $lims_parent_data['name'];
        return $lims_category_data->fresh();
    }

    public function updateRepository($data)
    {
        $lims_category_data = Category::findOrFail($data['category_id']);
        $data['slug'] = Str::slug($data['title_en']);
       if (!empty($data['image']))
       {
           $image_path = 'images/category/'.$lims_category_data->image;
           MyHelper::deleteImage($image_path);
           $data['image'] = MyHelper::UploadImage($data['image'],'images/category');
       }else{
           $data['image'] = $lims_category_data->image;
       }
        $lims_category_data->update($data);
        return $lims_category_data->fresh();
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
            $category = Category::firstOrNew(['title_kh' => $data['title_kh'], 'title_en' => $data['title_en'], 'slug' => Str::slug($data['title_en']), 'is_active' => true, 'created_by'=>Auth::id() ]);
            $category->is_active = true;
            $category->save();
        }
        return $category->fresh();
    }

    public function deleteBySelectionRepository($category_id)
    {
        foreach ($category_id as $id) {
            $lims_category_data = Category::findOrFail($id);
            $lims_category_data->delete();
            $image_path = 'images/category/'.$lims_category_data->image;
            MyHelper::deleteImage($image_path);
        }
        return $lims_category_data->fresh();
    }

    public function deleteRepository($id)
    {
        $lims_category_data = Category::findOrFail($id);
        $lims_category_data->delete();
        $image_path = 'images/category/'.$lims_category_data->image;
        MyHelper::deleteImage($image_path);
        return $lims_category_data->fresh();
    }

}
