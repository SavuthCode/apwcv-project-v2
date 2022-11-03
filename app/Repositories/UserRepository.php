<?php
namespace App\Repositories;
use App\Helpers\MyHelper;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;
use Hash;
use Illuminate\Support\Facades\Mail;

class UserRepository
{
//    protected $user;
//    protected $customer;
//
//    public function __construct(User $user, Customer $customer)
//    {
//        $this->user = $user;
//        $this->customer = $customer;
//    }
    public function indexRepository()
    {
    }

    public function createRepository(){

    }

    public function storeRepository($data)
    {
        $message = 'User created successfully';
        if(!isset($data['is_active']))
        $temporary_token = Str::random(40);
        $data['is_active'] = true;
        $data['password'] = bcrypt($data['password']);
        $data['image'] = '';
        $data['role_id'] = 2;
        $success = User::create($data);
        $success['accessToken'] =  $success->createToken('MyApp')-> accessToken;
        $success['temporary_token'] =  $temporary_token;
        $success['message'] =  true;
        return $success;
    }

    public function getById($id)
    {

    }

    public function updateRepository($data,$input,$id)
    {
        if(!isset($input['is_active']))
            $input['is_active'] = true;
        if(!empty($data['password']))
            $input['password'] = bcrypt($data['password']);
        $lims_user_data = User::find($id);

        if (!empty($data['image']))
        {
            $image_path = 'images/user/'.$lims_user_data->image;
            MyHelper::deleteImage($image_path);
            $input['image'] = MyHelper::UploadImage($data['image'],'images/user');
        }else{
            $data['image'] = $lims_user_data->image;
        }
        $lims_user_data->update($input);
        return $lims_user_data->fresh();
    }

    public function profileUpdateRepository($data, $id)
    {
        $lims_user_data = User::find($id);
        if (!empty($data['image'])){
            $image_path = 'images/user/'.$lims_user_data->image;
            MyHelper::deleteImage($image_path);
            $data['image'] = MyHelper::UploadImage($data['image'],'images/user');
//            $data['cover'] = MyHelper::UploadCover($data['cover'],'images/user');
        }else{
            $data['image'] = $lims_user_data->image;
        }

        $lims_user_data->update($data);
        return $lims_user_data->fresh();
    }

    public function changePasswordRepository($data,$id)
    {
        $lims_user_data = User::find($id);
        if (Hash::check($data['current_pass'], $lims_user_data->password)) {
            $lims_user_data->password = bcrypt($data['new_pass']);
            $lims_user_data->save();
            return $lims_user_data->fresh();
        }else{
            return false;
        }
    }

    public function deleteRepository($id)
    {
        $lims_user_data = User::find($id);
        $lims_user_data->is_active = false;
        $lims_user_data->save();
        return $lims_user_data->fresh();
    }
}
