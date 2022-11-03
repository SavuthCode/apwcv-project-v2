<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Services\PermissionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Exception;
use InvalidArgumentException;

class PermissionController extends Controller
{
    protected $permissionService;
    public function __construct(PermissionService $permissionService)
    {
        $this->permissionService = $permissionService;
    }

    public function index()
    {
        return view('admin.permission.create');
    }

    public function permissionData(Request $request)
    {
        $columns = array(
            0 =>'id',
            2 =>'name',
        );

        $totalData = Permission::get()->count();
        $totalFiltered = $totalData;

        if($request->input('length') != -1)
            $limit = $request->input('length');
        else
            $limit = $totalData;
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
        if(empty($request->input('search.value')))
            $permission = Permission::offset($start)
                ->limit($limit)
                ->orderBy($order,$dir)
                ->get();
        else
        {
            $search = $request->input('search.value');
            $permission =  Permission::where('name', 'LIKE', "%{$search}%")->offset($start)
                ->limit($limit)
                ->orderBy($order,$dir)->get();

            $totalFiltered = Permission::where('name','LIKE',"%{$search}%")->count();
        }
        $data = array();
        if(!empty($permission))
        {
            foreach ($permission as $key=>$permissions)
            {
                $nestedData['id'] = $permissions->id;
                $nestedData['key'] = $key;

                $nestedData['name'] = $permissions->name;

                $nestedData['options'] = '<div class="btn-group">
                            <button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">'.trans("file.action").'
                              <span class="caret"></span>
                              <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <ul class="dropdown-menu edit-options dropdown-menu-right dropdown-default" user="menu">
                                <li>
                                    <button type="button" data-id="'.$permissions->id.'" class="open-EditbrandDialog btn btn-link" data-toggle="modal" data-target="#editModal" ><i class="dripicons-document-edit"></i> '.trans("file.edit").'</button>
                                </li>
                                <li class="divider"></li>'.
                    \Form::open(["route" => ["permission.destroy", $permissions->id], "method" => "DELETE"] ).'
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
        $data = $request->all();
        try {
            $this->permissionService->storeService($data);
        }catch (Exception $e){
            return redirect()->back()->with('not_permitted', $e->getMessage());
        }
        return redirect('permission');
    }

    public function edit($id)
    {
        try {
            $lims_permission_data = $this->permissionService->editService($id);
        }catch (Exception $e){
            return redirect()->back()->with('not_permitted', $e->getMessage());
        }
        return $lims_permission_data;
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        try {
            $this->permissionService->updateService($data, $id);
        }catch (Exception $e){
            return redirect()->back()->with('not_permitted', $e->getMessage());
        }
        return redirect('permission');
    }

    public function importBrand(Request $request)
    {
        //get file
        $upload=$request->file('file');
        try {
            $ext = pathinfo($upload->getClientOriginalName(), PATHINFO_EXTENSION);
            if($ext != 'csv')
                return redirect()->back()->with('not_permitted', 'Please upload a CSV file');
            $this->permissionService->importService($upload);
        }catch (Exception $e){
            return redirect()->back()->with('not_permitted', $e->getMessage());
        }
        return redirect('permission')->with('message', 'Permission imported successfully');
    }


    public function deleteBySelection(Request $request)
    {
        $permission_id = $request['permissionIdArray'];
        try {
            $this->permissionService->deleteBySelectionService($permission_id);
        }catch (Exception $e){
            dd($e->getMessage());
        }
        return 'Permission deleted successfully!';
    }

    public function destroy($id)
    {
        try {
            $this->permissionService->deleteService($id);
        }catch (Exception $e){
            return redirect()->back()->with('not_permitted', $e->getMessage());
        }
        return redirect('permission')->with('not_permitted', 'Permission deleted successfully!');
    }

}
