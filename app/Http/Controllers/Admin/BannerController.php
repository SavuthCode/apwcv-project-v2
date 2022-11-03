<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Helpers\MyHelper;
use App\Models\Banner;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BannerController extends Controller
{
    public function index()
    {
        return view('admin.banner.create');
    }

    public function bannerData(Request $request)
    {
        $columns = array(
            0 =>'id',
            2 =>'banner_type',
            3 =>'published',
        );

        $totalData = Banner::get()->count();
        $totalFiltered = $totalData;

        if($request->input('length') != -1)
            $limit = $request->input('length');
        else
            $limit = $totalData;
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        if(empty($request->input('search.value')))
            $banners = Banner::offset($start)
                ->limit($limit)
                ->orderBy($order,$dir)
                ->get();
        else
        {
            $search = $request->input('search.value');
            $banners =  Banner::where('banner_type', 'LIKE', "%{$search}%")->offset($start)
                ->limit($limit)
                ->orderBy($order,$dir)->get();

            $totalFiltered = Banner::where('banner_type', 'LIKE', "%{$search}%")->count();
        }
        $data = array();
        if(!empty($banners))
        {
            foreach ($banners as $key=>$banner)
            {
                $nestedData['id'] = $banner->id;
                $nestedData['key'] = $key;

                if($banner->photo)
                    $nestedData['photo'] = '<img src="'.url('images/banner', $banner->photo).'" height="70" width="70">';
                else
                    $nestedData['photo'] = '<img src="'.url('images/product/zummXD2dvAtI.png').'" height="80" width="80">';

                $nestedData['banner_type'] = $banner->banner_type;
                $nestedData['published'] = '<label class="switch"><input type="checkbox" class="status"
                                                                         id="'.$banner->id.'"'.$banner->published == 1 ? "checked" : "0".'<span
                                                    class="slider round"></span></label>';

                $nestedData['options'] = '<div class="btn-group">
                            <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">'.trans("file.action").'
                              <span class="caret"></span>
                              <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <ul class="dropdown-menu edit-options dropdown-menu-right dropdown-default" user="menu">
                                <li>
                                    <button type="button" data-id="'.$banner->id.'" data-url="'.$banner->url.'" class="open-EditBannerDialog btn btn-link" data-toggle="modal" data-target="#editModal" ><i class="dripicons-document-edit"></i> '.trans("file.edit").'</button>
                                </li>
                                <li class="divider"></li>'.
                    \Form::open(["route" => ["banners.destroy", $banner->id], "method" => "DELETE"] ).'
                                <li>
                                  <button type="submit" class="btn btn-link" onclick="return confirmDelete()"><i class="dripicons-trash"></i> '.trans("file.delete").'</button>
                                </li>'.\Form::close().'
                            </ul>
                        </div>';
                $data[] = $nestedData;
            }
        }
        $json_data = array(
            "draw"            => intval($request->input('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $data
        );

        echo json_encode($json_data);
    }

    public function store(Request $request)
    {
        $data = $request->except('image');
        $message = 'banner created successfully';
        $request->validate([
            'url' => 'required',
            'image' => 'required',
        ], [
            'url.required' => 'url is required!',
            'image.required' => 'Image is required!',

        ]);
        $image = $request->image;
        if ($image) {
            $data['photo'] = MyHelper::UploadImage($image,'images/banner');
        }
        Banner::create($data);
        return redirect('banners')->with('message', $message);
    }

    public function status(Request $request)
    {
        if ($request->ajax()) {
            $banner = Banner::find($request->id);
            $banner->published = $request->status;
            $banner->save();
            $data = $request->status;
            return response()->json($data);
        }
    }

    public function edit(Request $request)
    {
        $data = Banner::where('id', $request->id)->first();
        return response()->json($data);
    }

    public function update(Request $request, $id)
    {
        $banner = Banner::find($id);
        dd($banner);
        $data = $request->except('image');
        $image = $request->image;

        if (!empty($image))
        {
            $image_path = 'images/banner/'.$banner['photo'];
            MyHelper::deleteImage($image_path);
            $data['photo'] =  MyHelper::UploadImage($request->file('image'),'images/banner');
        }else{
            $data['photo'] = $banner->photo;
        }
        $banner->update($data);
        return redirect('banners')->with('message', 'Employee updated successfully');
    }

    public function destroy($id)
    {
        $banner = Banner::find($id);
        $image_path = 'images/banner/'.$banner->photo;
        MyHelper::deleteImage($image_path);
        $banner->delete();
        return redirect('banners')->with('message', 'banner deleted successfully');
    }
}
