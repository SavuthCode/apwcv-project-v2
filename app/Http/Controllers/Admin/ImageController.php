<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Medias;
use App\Services\MediaService;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    protected $mediaService;
    public function __construct(MediaService $mediaService)
    {
        $this->mediaService = $mediaService;
    }

    public function index()
    {
      return view('admin.image.index');
    }

    public function data(Request $request)
    {
        $columns = array(
            0 =>'id',
            1 =>'title',
            2 =>'description',
            3 =>'data',
            5 => 'is_active',
        );
        $totalData = Medias::where([
            ['is_active', true],
            ['type', 'image'],
        ])->count();
        $totalFiltered = $totalData;

        if($request->input('length') != -1)
            $limit = $request->input('length');
        else
            $limit = $totalData;
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        if(empty($request->input('search.value')))
            $medias = Medias::offset($start)
                ->where([
                    ['is_active', true],
                    ['type', 'image'],
                ])
                ->limit($limit)
                ->orderBy($order,$dir)
                ->get();
        else
        {
            $search = $request->input('search.value');
            $medias =  Medias::where([
                ['title', 'LIKE', "%{$search}%"],
                ['type', 'image'],
                ['is_active', true],
            ])->offset($start)
                ->limit($limit)
                ->orderBy($order,$dir)->get();

            $totalFiltered = Medias::where([
                ['title','LIKE',"%{$search}%"],
                ['type', 'image'],
                ['is_active', true],
            ])->count();
        }
        $data = array();
        if(!empty($medias))
        {
            foreach ($medias as $key=>$media)
            {
                $nestedData['id'] = $media->id;
                $nestedData['key'] = $key;
                $images = explode(",", $media->data);
                $image = htmlspecialchars($images[0]);
                $nestedData['data'] = '<img src="'.url('media', $image).'" height="70" width="70">';
                $nestedData['title'] = $media->title;
                $nestedData['description'] = $media->description;
                if ($media->is_active == true)
                    $nestedData['is_active'] = '<a href="'.route('category-status-update',[$media['id'],0]).'"  class=" btn btn-link" >Active</a>';
                elseif($media->is_active == false)
                    $nestedData['is_active'] = '<a href="'.route('category-status-update',[$media['id'],1]).'"  class=" btn btn-link" >Disabled</a>';

                $nestedData['options'] = '<div class="btn-group">
                            <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">'.trans("file.action").'
                              <span class="caret"></span>
                              <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <ul class="dropdown-menu edit-options dropdown-menu-right dropdown-default" user="menu">
                                <li>
                                <a href="'.route("image.edit", $media->id).'" class="btn btn-link"><i class="dripicons-document-edit"></i>'.trans("file.edit").'</a>
                                </li>
                                <li class="divider"></li>'.
                    \Form::open(["route" => ["image.destroy", $media->id], "method" => "DELETE"] ).'
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

    public function create()
    {
        $lims_category_list = Category::where('is_active',true)->get();
        return view('admin.image.create',compact('lims_category_list'));
    }

    public function store(Request $request)
    {
        try {
            $this->mediaService->storeService($request);
        }catch (\Exception $e){
            return redirect()->back()->with('not_permitted', $e->getMessage());
        }
        return view('admin.media.index')->with('message', 'Category inserted successfully');
    }

    public function show($id)
    {
        //
    }
    public function edit($id)
    {
        $lims_media_data = Medias::where('id', $id)->first();
        $lims_category_list = Category::where('is_active',true)->get();
        return view('admin.image.edit',compact('lims_media_data','lims_category_list'));
    }

    public function imageProduct(Request $request, $id)
    {
        try {
            $this->mediaService->updateService($request, $id);
        }catch (\Exception $e){
            return redirect()->back()->with('not_permitted', $e->getMessage());
        }
        return redirect('image')->with('message', 'image updated successfully');
    }

    public function destroy($id)
    {
        try {
            $this->mediaService->deleteService($id);
        }catch (\Exception $e){
            return redirect()->back()->with('not_permitted', $e->getMessage());
        }
        return redirect('image')->with('not_permitted', 'Image deleted successfully');
//        Youtube::delete('VIDEO_ID');
    }
}
