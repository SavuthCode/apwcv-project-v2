<?php
namespace App\Repositories;

use App\Models\Permission;
use Illuminate\Support\Facades\Auth;

class PermissionRepository
{

    public function storeRepository($data)
    {
        $data['guard_name'] = 'web';
        $sl_permission_data = Permission::create($data);
        return $sl_permission_data->fresh();
    }

    public function editRepository($id)
    {
        $sl_permission_data = Permission::findOrFail($id);
        return $sl_permission_data->fresh();
    }

    public function updateRepository($data,$id)
    {
        $sl_permission_data = Permission::find($data['permission_id']);
        $sl_permission_data->update($data);
        return $sl_permission_data->fresh();
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

            $warehouse = Permission::firstOrNew([ 'name'=>$data['name'], 'is_active'=>true, 'created_by'=>Auth::id() ]);
            $warehouse->name = $data['name'];
            $warehouse->phone = $data['phone'];
            $warehouse->email = $data['email'];
            $warehouse->address = $data['address'];
            $warehouse->is_active = true;
            $warehouse->created_by = Auth::id();
            $warehouse->save();
        }
        return $warehouse->fresh();
    }

    public function deleteBySelectionRepository($permission_id)
    {
        foreach ($permission_id as $id) {
            $sl_permission_data = Permission::find($id);
            $sl_permission_data->is_active = false;
            $sl_permission_data->delete();
        }
        return $sl_permission_data->fresh();
    }

    public function deleteRepository($id)
    {
        $sl_permission_data = Permission::find($id);
        $sl_permission_data->is_active = false;
        $sl_permission_data->delete();
        return $sl_permission_data->fresh();
    }

}
