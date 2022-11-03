<?php

namespace App\Services;

use App\Repositories\UserRepository;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use InvalidArgumentException;

class UserService
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function indexService()
    {

    }

    public function createService(){

    }

    public function storeService($data)
    {
        $validator = Validator::make($data, [
            'phone' => [
                'max:255',
                Rule::unique('users')->where(function ($query) {
                    return $query->where('is_active', 1);
                }),
            ],
        ]);


        if ($validator->fails()){
            throw new InvalidArgumentException($validator->errors()->first());
        }
        DB::beginTransaction();
        try {
            $user = $this->userRepository->storeRepository($data);
        }catch (Exception $e){
            DB::rollBack();
            Log::info($e->getMessage());
            throw new InvalidArgumentException($e->getMessage());
        }
        DB::commit();
        return $user;
    }

    public function getById($id)
    {

    }

    public function updateService($data,$input,$id)
    {
        $validator = Validator::make($data, [
            'email' => [
                'email',
                'max:255',
                Rule::unique('users')->ignore($id)->where(function ($query) {
                    return $query->where('is_active', false);
                }),
            ],
        ]);
        if ($validator->fails()){
            throw new InvalidArgumentException($validator->errors()->first());
        }
        DB::beginTransaction();
        try {
            $user = $this->userRepository->updateRepository($data, $input, $id);
        }catch (Exception $e){
            DB::rollBack();
            Log::info($e->getMessage());
            throw new InvalidArgumentException("Unable to update category data");
        }
        DB::commit();
        return $user;
    }

    public function profileUpdateService($data,$id)
    {
        DB::beginTransaction();
        try {
            $user = $this->userRepository->profileUpdateRepository($data,$id);
        }catch (Exception $e){
            DB::rollBack();
            Log::info($e->getMessage());
            throw new InvalidArgumentException($e->getMessage());
        }
        DB::commit();
        return $user;
    }

    public function changePasswordService($data,$id)
    {
        DB::beginTransaction();
        try {
            $category = $this->userRepository->changePasswordRepository($data, $id);
        }catch (Exception $e){
            DB::rollBack();
            Log::info($e->getMessage());
            throw new InvalidArgumentException('Unable to delete product data');
        }
        DB::commit();
        return $category;
    }

    public function deleteService($id)
    {
        DB::beginTransaction();
        try {
            $category = $this->userRepository->deleteRepository($id);
        }catch (Exception $e){
            DB::rollBack();
            Log::info($e->getMessage());
            throw new InvalidArgumentException('Unable to delete product data');
        }
        DB::commit();
        return $category;
    }
}
