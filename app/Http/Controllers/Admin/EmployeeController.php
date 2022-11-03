<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\MyHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Nette\Utils\Random;
use Spatie\Permission\Models\Role;
use App\Models\Employee;
use App\Models\User;
use Auth;
use Illuminate\Validation\Rule;

class EmployeeController extends Controller
{

    public function index()
    {
        $role = Role::find(Auth::user()->role_id);
        if($role->hasPermissionTo('users-index')){
            $permissions = Role::findByName($role->name)->permissions;
            foreach ($permissions as $permission)
                $all_permission[] = $permission->name;
            if(empty($all_permission))
                $all_permission[] = 'dummy text';
            $lims_employee_all = Employee::where('is_active', true)->get();
            return view('admin.employee.index', compact('lims_employee_all', 'all_permission'));
        }
        else
            return redirect()->back()->with('not_permitted', 'Sorry! You are not allowed to access this module');
    }

    public function create()
    {
        $role = Role::find(Auth::user()->role_id);
        if($role->hasPermissionTo('users-add')){
            $lims_role_list = Role::where('is_active', true)->get();
            return view('admin.employee.create', compact('lims_role_list'));
        }
        else
            return redirect()->back()->with('not_permitted', 'Sorry! You are not allowed to access this module');
    }

    public function store(Request $request)
    {
        $data = $request->except('image');
        $message = 'Employee created successfully';
        $this->validate($request, [
            'email' => [
                'max:255',
                Rule::unique('employees')->where(function ($query) {
                    return $query->where('is_active', true);
                }),
            ],
            'image' => 'image|mimes:jpg,jpeg,png,gif|max:100000',
        ]);
        $image = $request->image;
        if ($image) {
            $data['image'] = MyHelper::UploadImage($image,'employee');
        }
        $data['is_active'] = true;
        $data['code'] = Random::generate();
        $data['date_expiry'] = "";
        Employee::create($data);
        return redirect('employees')->with('message', $message);
    }

    public function update(Request $request, $id)
    {
        $lims_employee_data = Employee::find($request['id']);
        $this->validate($request, [
            'email' => [
                'email',
                'max:255',
                Rule::unique('employees')->ignore($lims_employee_data->id)->where(function ($query) {
                    return $query->where('is_active', true);
                }),
            ],
            'image' => 'image|mimes:jpg,jpeg,png,gif|max:100000',
        ]);

        $data = $request->except('image');
        $image = $request->image;
        if (!empty($image))
        {
            $image_path = 'employee/'.$lims_employee_data->image;
            MyHelper::deleteImage($image_path);
            $data['image'] = MyHelper::UploadImage($image,'employee');
        }else{
            $data['image'] = $lims_employee_data->image;
        }
        $lims_employee_data->update($data);
        return redirect('employees')->with('message', 'Employee updated successfully');
    }

    public function deleteBySelection(Request $request)
    {
        $employee_id = $request['employeeIdArray'];
        foreach ($employee_id as $id) {
            $lims_employee_data = Employee::find($id);
            $lims_employee_data->is_active = false;
            $lims_employee_data->save();
        }
        return 'Employee deleted successfully!';
    }
    public function destroy($id)
    {
        $lims_employee_data = Employee::find($id);
        $lims_employee_data->is_active = false;
        $lims_employee_data->save();
        return redirect('employees')->with('not_permitted', 'Employee deleted successfully');
    }
}
