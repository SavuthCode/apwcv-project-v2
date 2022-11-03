<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Medias;
use App\Services\MediaService;
use Illuminate\Http\Request;
use Youtube;

class VideoController extends Controller
{
    protected $mediaService;
    public function __construct(MediaService $mediaService)
    {
        $this->mediaService = $mediaService;
    }

    public function index()
    {
        return view('admin.video.create');
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
            ['type', 'video'],
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
                    ['type', 'video'],
                ])
                ->limit($limit)
                ->orderBy($order,$dir)
                ->get();
        else
        {
            $search = $request->input('search.value');
            $medias =  Medias::where([
                ['title', 'LIKE', "%{$search}%"],
                ['type', 'video'],
                ['is_active', true],
            ])->offset($start)
                ->limit($limit)
                ->orderBy($order,$dir)->get();

            $totalFiltered = Medias::where([
                ['title','LIKE',"%{$search}%"],
                ['type', 'video'],
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
                $nestedData['data'] = '<iframe width="70" height="70"
                                            src="https://www.youtube.com/embed/'.$media->data.'?controls=0">
                                           </iframe>';
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
        //
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
