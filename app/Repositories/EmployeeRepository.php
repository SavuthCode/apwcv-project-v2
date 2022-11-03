<?php
namespace App\Repositories;

use App\Helpers\MyHelper;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class EmployeeRepository
{

    public function indexRepository()
    {

//        return $lims_warehouse_all->fresh();
    }

    public function storeRepository($data)
    {
        if(isset($data['user'])){
            $data['is_active'] = true;
            $data['is_deleted'] = false;
            $data['password'] = bcrypt($data['password']);
            $data['phone'] = $data['phone_number'];
            User::create($data);
            $user = User::latest()->first();
            $data['user_id'] = $user->id;
            $message = 'Employee created successfully and added to user list';
        }
        //validation in employee table

        $data['image'] = MyHelper::UploadImage($data['image'], 'images/employee');
        $data['name'] = $data['employee_name'];
        $data['is_active'] = true;
        $data['created_by'] = Auth::id();
        Employee::create($data);
        $message = 'Employee created successfully';
        return $message;
    }

    public function editRepository($id)
    {

    }

    public function updateRepository($data, $id, $lims_employee_data)
    {
        if ($data['image']) {
            $image_path = 'images/employee/'.$lims_employee_data->image;
            MyHelper::deleteImage($image_path);
            $data['image'] = MyHelper::UploadImage($data['image'], 'images/employee');;
        }
        $lims_employee_data->update($data);
        return $lims_employee_data->fresh();
    }

    public function importRepository($upload)
    {

    }

    public function deleteBySelectionRepository($employee_id)
    {
        foreach ($employee_id as $id) {
            $lims_employee_data = Employee::find($id);
            if($lims_employee_data->user_id){
                $lims_user_data = User::find($lims_employee_data->user_id);
                $lims_user_data->is_deleted = true;
                $lims_user_data->save();
            }
            $lims_employee_data->is_active = false;
            $lims_employee_data->save();
        }
        return $lims_employee_data->fresh();
    }

    public function deleteRepository($id)
    {
        $lims_employee_data = Employee::find($id);
        if($lims_employee_data->user_id){
            $lims_user_data = User::find($lims_employee_data->user_id);
            $lims_user_data->is_deleted = true;
            $lims_user_data->save();
        }
        $lims_employee_data->is_active = false;
        $lims_employee_data->save();
        return $lims_employee_data->fresh();
    }

}
