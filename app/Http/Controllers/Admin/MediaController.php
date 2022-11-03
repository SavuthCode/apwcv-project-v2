<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Medias;
use App\Services\MediaService;
use Illuminate\Http\Request;
use Youtube;
use function React\Promise\all;

class MediaController extends Controller
{
    protected $mediaService;
    public function __construct(MediaService $mediaService)
    {
        $this->mediaService = $mediaService;
    }



    public function index()
    {
        return view('admin.media.index');
    }

    public function data(Request $request)
    {
        $columns = array(
            0 =>'id',
            1 =>'title',
            2 =>'description',
            3 =>'data',
            4 =>'type',
            5 => 'is_active',
        );
        $totalData = Medias::where([
            ['is_active', true],
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
                ])
                ->limit($limit)
                ->orderBy($order,$dir)
                ->get();
        else
        {
            $search = $request->input('search.value');
            $medias =  Medias::where([
                ['title', 'LIKE', "%{$search}%"],
                ['is_active', true],
            ])->offset($start)
                ->limit($limit)
                ->orderBy($order,$dir)->get();

            $totalFiltered = Medias::where([
                ['title','LIKE',"%{$search}%"],
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
                if($media->type = "image")
                {
                    $nestedData['data'] = '<img src="'.url('media', $image).'" height="70" width="70">';
                    $nestedData['type'] = $media->type;
                }
                elseif($media->type = "video")
                {
                    $nestedData['data'] = '<iframe width="70" height="70"
                                            src="https://www.youtube.com/embed/'.$media->data.'?controls=0">
                                           </iframe>';
                    $nestedData['type'] = $media->type;
                }
                $nestedData['title'] = $media->title;
                $nestedData['description'] = $media->description;
                $nestedData['is_active'] = $media->is_active;

                $nestedData['options'] = '<div class="btn-group">
                            <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">'.trans("file.action").'
                              <span class="caret"></span>
                              <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <ul class="dropdown-menu edit-options dropdown-menu-right dropdown-default" user="menu">
                                <li>
                                    <button type="button" data-id="'.$media->id.'" class="open-EditbrandDialog btn btn-link" data-toggle="modal" data-target="#editModal" ><i class="dripicons-document-edit"></i> '.trans("file.edit").'</button>
                                </li>
                                <li class="divider"></li>'.
                    \Form::open(["route" => ["media.destroy", $media->id], "method" => "DELETE"] ).'
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

    public function video()
    {
        return view('admin.media.video');
    }

    public function image()
    {
        return view('admin.media.image');
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
        //
    }

    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        Youtube::delete('VIDEO_ID');
    }
}
