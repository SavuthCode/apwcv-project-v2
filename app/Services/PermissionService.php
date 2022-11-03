<?php

namespace App\Services;

use App\Repositories\PermissionRepository;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use InvalidArgumentException;

class PermissionService
{
    protected $permissionRepository;

    public function __construct(PermissionRepository $permissionRepository)
    {
        $this->permissionRepository = $permissionRepository;
    }

    public function storeService($data)
    {
        $validator = Validator::make($data, [
            'name' => [
                'max:255',
                Rule::unique('permissions')->where(function ($query) {
                    return $query;
                }),
            ],
        ]);
        if ($validator->fails()){
            throw new InvalidArgumentException($validator->errors()->first());
        }
        DB::beginTransaction();
        try {
            $permission = $this->permissionRepository->storeRepository($data);
        }catch (Exception $e){
            DB::rollBack();
            Log::info($e->getMessage());
            throw new InvalidArgumentException($e->getMessage());
        }
        DB::commit();
        return $permission;
    }

    public function editService($id)
    {
        DB::beginTransaction();
        try {
            $permission = $this->permissionRepository->editRepository($id);
        }catch (Exception $e){
            DB::rollBack();
            Log::info($e->getMessage());
            throw new InvalidArgumentException('Unable to edit permission data');
        }
        DB::commit();
        return $permission;
    }

    public function updateService($data,$id)
    {
        $validator = Validator::make($data, [
            'name' => [
                'max:255',
                Rule::unique('permissions')->ignore($data['permission_id'])->where(function ($query) {
                    return $query;
                }),
            ],
        ]);
        if ($validator->fails()){
            throw new InvalidArgumentException($validator->errors()->first());
        }
        DB::beginTransaction();
        try {
            $permission = $this->permissionRepository->updateRepository($data, $id);
        }catch (Exception $e){
            DB::rollBack();
            Log::info($e->getMessage());
            throw new InvalidArgumentException("Unable to update permission data");
        }
        DB::commit();
        return $permission;
    }

    public function importService($upload)
    {
        DB::beginTransaction();
        try {
            $permission = $this->permissionRepository->importRepository($upload);
        }catch (Exception $e){
            DB::rollBack();
            Log::info($e->getMessage());
            throw new InvalidArgumentException('Unable to import permission data');
        }
        DB::commit();
        return $permission;
    }

    public function deleteBySelectionService($permission_id)
    {
        DB::beginTransaction();
        try {
            $permission = $this->permissionRepository->deleteBySelectionRepository($permission_id);
        }catch (Exception $e){
            DB::rollBack();
            Log::info($e->getMessage());
            throw new InvalidArgumentException('Unable to deleteBySelection permission data');
        }
        DB::commit();
        return $permission;
    }

    public function deleteService($id)
    {
        DB::beginTransaction();
        try {
            $permission = $this->permissionRepository->deleteRepository($id);
        }catch (Exception $e){
            DB::rollBack();
            Log::info($e->getMessage());
            throw new InvalidArgumentException('Unable to delete warehouse data');
        }
        DB::commit();
        return $permission;
    }
}
