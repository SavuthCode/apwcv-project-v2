<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Services\UserService;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Roles;
use Hash;
use Illuminate\Support\Facades\Auth;
use Keygen;
use Exception;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    protected $userService;
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {
        $role = Role::find(Auth::user()->role_id);
        if($role->hasPermissionTo('users-index')){
            $permissions = Role::findByName($role->name)->permissions;
            foreach ($permissions as $permission)
                $all_permission[] = $permission->name;
            $lims_user_list = User::where('is_active', true)->get();
            return view('admin.user.index', compact('lims_user_list', 'all_permission'));
        }
        else
            return redirect()->back()->with('not_permitted', 'Sorry! You are not allowed to access this module');
    }

    public function create()
    {
        $role = Role::find(Auth::user()->role_id);
        if($role->hasPermissionTo('users-add')){
            $lims_role_list = Roles::where('is_active', true)->get();
            return view('admin.user.create', compact('lims_role_list'));
        }
        else
            return redirect()->back()->with('not_permitted', 'Sorry! You are not allowed to access this module');
    }

    public function generatePassword()
    {
        $id = Keygen::numeric(6)->generate();
        return $id;
    }

    public function store(Request $request)
    {
        $data = $request->all();
        try {
            $message = $this->userService->storeService($data);
        }catch (Exception $e){
            dd($e->getMessage());
        }
        return redirect('user')->with('message1', $message);
    }

    public function edit($id)
    {
        $role = Role::find(Auth::user()->role_id);
        if($role->hasPermissionTo('users-add')){
            $lims_user_data = User::find($id);
            $lims_role_list = Roles::where('is_active', true)->get();
            return view('admin.user.edit', compact('lims_user_data', 'lims_role_list'));
        }
        else
            return redirect()->back()->with('not_permitted', 'Sorry! You are not allowed to access this module');
    }

    public function update(Request $request, $id)
    {
        if(!env('USER_VERIFIED'))
            return redirect()->back()->with('not_permitted', 'This feature is disable for demo!');
        $data = $request->all();
        $input = $request->except('password');
        try {
            $this->userService->updateService($data,$input,$id);
        }catch (Exception $e){
            dd($e->getMessage());
        }
        return redirect('user')->with('message2', 'Data updated successfullly');
    }

    public function profile($id)
    {
        $lims_user_data = User::find($id);
        return view('admin.user.profile', compact('lims_user_data'));
    }

    public function profileUpdate(Request $request, $id)
    {
        if(!env('USER_VERIFIED'))
            return redirect()->back()->with('not_permitted', 'This feature is disable for demo!');

        $data = $request->all();
        try {
            $this->userService->profileUpdateService($data, $id);
        }catch (Exception $e){
            dd($e->getMessage());
        }
        return redirect()->back()->with('message3', 'Data updated successfullly');
    }

    public function changePassword(Request $request, $id)
    {
        if(!env('USER_VERIFIED'))
            return redirect()->back()->with('not_permitted', 'This feature is disable for demo!');

        $input = $request->all();
        $lims_user_data = User::find($id);
        if($input['new_pass'] != $input['confirm_pass'])
            return redirect("user/" .  "profile/" . $id )->with('message2', "Please Confirm your new password");

        if (Hash::check($input['current_pass'], $lims_user_data->password)) {
            $lims_user_data->password = bcrypt($input['new_pass']);
            $lims_user_data->save();
        }
        else {
            return redirect("user/" .  "profile/" . $id )->with('message1', "Current Password doesn't match");
        }
        auth()->logout();
        return redirect('/');
    }

    public function deleteBySelection(Request $request)
    {
        $user_id = $request['userIdArray'];
        foreach ($user_id as $id) {
            $lims_user_data = User::find($id);
            $lims_user_data->is_deleted = true;
            $lims_user_data->is_active = false;
            $lims_user_data->save();
        }
        return 'User deleted successfully!';
    }

    public function destroy($id)
    {
        if(!env('USER_VERIFIED'))
            return redirect()->back()->with('not_permitted', 'This feature is disable for demo!');

        try {
            $this->userService->deleteService($id);
        }catch (Exception $e){
            dd($e->getMessage());
        }
        if(Auth::id() == $id){
            auth()->logout();
            return redirect('/login');
        }
        else
            return redirect('user')->with('message3', 'Data deleted successfullly');
    }
}
