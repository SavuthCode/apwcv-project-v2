<?php

namespace App\Services;

use App\Repositories\EmployeeRepository;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use InvalidArgumentException;

class EmployeeService
{
    protected $employeeRepository;

    public function __construct(EmployeeRepository $employeeRepository)
    {
        $this->employeeRepository = $employeeRepository;
    }

    public function indexService()
    {
        DB::beginTransaction();
        try {
            $employee = $this->employeeRepository->indexRepository();
        }catch (Exception $e){
            DB::rollBack();
            Log::info($e->getMessage());
            throw new InvalidArgumentException('Unable to index employee data');
        }
        DB::commit();
        return $employee;
    }

    public function storeService($data)
    {
        if(isset($data['user'])){
            $validator = Validator::make($data, [
                'name' => [
                    'max:255',
                    Rule::unique('users')->where(function ($query) {
                        return $query->where('is_deleted', false);
                    }),
                ],
                'email' => [
                    'email',
                    'max:255',
                    Rule::unique('users')->where(function ($query) {
                        return $query->where('is_deleted', false);
                    }),
                ],
            ]);
            if ($validator->fails()){
                throw new InvalidArgumentException($validator->errors()->first());
            }
        }

        $validator = Validator::make($data, [
            'email' => [
                'max:255',
                Rule::unique('employees')->where(function ($query) {
                    return $query->where('is_active', true);
                }),
            ],
            'image' => 'image|mimes:jpg,jpeg,png,gif|max:100000',
        ]);
        if ($validator->fails()){
            throw new InvalidArgumentException($validator->errors()->first());
        }
        DB::beginTransaction();
        try {
            $employee = $this->employeeRepository->storeRepository($data);
        }catch (Exception $e){
            DB::rollBack();
            Log::info($e->getMessage());
            throw new InvalidArgumentException('Unable to store employee data');
        }
        DB::commit();
        return $employee;
    }

    public function editService($id)
    {
        DB::beginTransaction();
        try {
            $employee = $this->employeeRepository->editRepository($id);
        }catch (Exception $e){
            DB::rollBack();
            Log::info($e->getMessage());
            throw new InvalidArgumentException('Unable to edit employee data');
        }
        DB::commit();
        return $employee;
    }

    public function updateService($data, $id, $lims_employee_data)
    {
        $validator = Validator::make($data, [
            'email' => [
                'email',
                'max:255',
                Rule::unique('employees')->ignore($id)->where(function ($query) {
                    return $query->where('is_active', true);
                }),
            ],
            'image' => 'image|mimes:jpg,jpeg,png,gif|max:100000',
        ]);
        if ($validator->fails()){
            throw new InvalidArgumentException($validator->errors()->first());
        }
        DB::beginTransaction();
        try {
            $employee = $this->employeeRepository->updateRepository($data, $id, $lims_employee_data);
        }catch (Exception $e){
            DB::rollBack();
            Log::info($e->getMessage());
            throw new InvalidArgumentException("Unable to update employee data");
        }
        DB::commit();
        return $employee;
    }

    public function importWarehouseService($upload)
    {
        DB::beginTransaction();
        try {
            $employee = $this->employeeRepository->importWarehouseRepository($upload);
        }catch (Exception $e){
            DB::rollBack();
            Log::info($e->getMessage());
            throw new InvalidArgumentException('Unable to import employee data');
        }
        DB::commit();
        return $employee;
    }

    public function deleteBySelectionService($employee_id)
    {
        DB::beginTransaction();
        try {
            $employee = $this->employeeRepository->deleteBySelectionRepository($employee_id);
        }catch (Exception $e){
            DB::rollBack();
            Log::info($e->getMessage());
            throw new InvalidArgumentException('Unable to deleteBySelection employee data');
        }
        DB::commit();
        return $employee;
    }

    public function deleteService($id)
    {
        DB::beginTransaction();
        try {
            $employee = $this->employeeRepository->deleteRepository($id);
        }catch (Exception $e){
            DB::rollBack();
            Log::info($e->getMessage());
            throw new InvalidArgumentException('Unable to delete employee data');
        }
        DB::commit();
        return $employee;
    }
}
