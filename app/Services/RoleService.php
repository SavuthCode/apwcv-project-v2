<?php

namespace App\Services;

use App\Repositories\RoleRepository;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use InvalidArgumentException;

class RoleService
{
    protected $roleRepository;

    public function __construct(RoleRepository $roleRepository)
    {
        $this->roleRepository = $roleRepository;
    }

    public function indexService()
    {
        DB::beginTransaction();
        try {
            $role = $this->roleRepository->indexRepository();
        }catch (Exception $e){
            DB::rollBack();
            Log::info($e->getMessage());
            throw new InvalidArgumentException('Unable to index data');
        }
        DB::commit();
        return $role;
    }

    public function storeService($data)
    {
        $validator = Validator::make($data, [
            'name' => [
                'max:255',
                Rule::unique('roles')->where(function ($query) {
                    return $query->where('is_active', 1);
                }),
            ],
        ]);
        if ($validator->fails()){
            throw new InvalidArgumentException($validator->errors()->first());
        }
        DB::beginTransaction();
        try {
            $role = $this->roleRepository->storeRepository($data);
        }catch (Exception $e){
            DB::rollBack();
            Log::info($e->getMessage());
            throw new InvalidArgumentException('Unable to store role data');
        }
        DB::commit();
        return $role;
    }

    public function editService($id)
    {
        DB::beginTransaction();
        try {
            $role = $this->roleRepository->editRepository($id);
        }catch (Exception $e){
            DB::rollBack();
            Log::info($e->getMessage());
            throw new InvalidArgumentException('Unable to edit data');
        }
        DB::commit();
        return $role;
    }

    public function updateService($data,$id)
    {
        $validator = Validator::make($data, [
            'name' => [
                'max:255',
                Rule::unique('roles')->ignore($data["role_id"])->where(function ($query) {
                    return $query->where('is_active', 1);
                }),
            ],
        ]);
        if ($validator->fails()){
            throw new InvalidArgumentException($validator->errors()->first());
        }
        DB::beginTransaction();
        try {
            $role = $this->roleRepository->updateRepository($data, $id);
        }catch (Exception $e){
            DB::rollBack();
            Log::info($e->getMessage());
            throw new InvalidArgumentException("Unable to update role data");
        }
        DB::commit();
        return $role;
    }

    public function setPermissionService($request)
    {
        DB::beginTransaction();
        try {
            $role = $this->roleRepository->setPermissionRepository($request);
        }catch (Exception $e){
            DB::rollBack();
            Log::info($e->getMessage());
            throw new InvalidArgumentException($e->getMessage());
        }
        DB::commit();
        return $role;
    }

    public function deleteService($id)
    {
        DB::beginTransaction();
        try {
            $role = $this->roleRepository->deleteRepository($id);
        }catch (Exception $e){
            DB::rollBack();
            Log::info($e->getMessage());
            throw new InvalidArgumentException('Unable to delete product data');
        }
        DB::commit();
        return $role;
    }
}
