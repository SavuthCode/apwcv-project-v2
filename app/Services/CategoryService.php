<?php

namespace App\Services;

use App\Repositories\CategoryRepository;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use InvalidArgumentException;

class CategoryService
{
    protected $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function indexService()
    {
        return $this->categoryRepository->indexRepository();
    }

    public function storeService($data)
    {
        $validator = Validator::make($data, [
            'name' => [
                'max:255',
                Rule::unique('categories')->where(function ($query) {
                    return $query->where([
                        ['is_active', 1],
                        ['created_by', Auth::id()]
                    ]);
                }),
            ],
            'image' => 'image|mimes:jpg,jpeg,png,gif',
        ]);

        if ($validator->fails()){
            throw new InvalidArgumentException($validator->errors()->first());
        }
        DB::beginTransaction();
        try {
            $category = $this->categoryRepository->storeRepository($data);
        }catch (Exception $e){
            DB::rollBack();
            Log::info($e->getMessage());
            throw new InvalidArgumentException($e->getMessage());
        }
        DB::commit();
        return $category;
    }

    public function editService($id)
    {
        DB::beginTransaction();
        try {
            $category = $this->categoryRepository->editRepository($id);
        }catch (Exception $e){
            DB::rollBack();
            Log::info($e->getMessage());
            throw new InvalidArgumentException('Unable to edit category data');
        }
        DB::commit();
        return $category;
    }

    public function updateService($data)
    {
        $validator = Validator::make($data, [
            'name' => [
                'max:255',
                Rule::unique('categories')->ignore($data['category_id'])->where(function ($query) {
                    return $query->where([
                        ['is_active', true],
                        ['created_by', Auth::id()]
                    ]);
                }),
            ],
            'image' => 'image|mimes:jpg,jpeg,png,gif',
        ]);
        if ($validator->fails()){
            throw new InvalidArgumentException($validator->errors()->first());
        }
        DB::beginTransaction();
        try {
            $category = $this->categoryRepository->updateRepository($data);
        }catch (Exception $e){
            DB::rollBack();
            Log::info($e->getMessage());
            throw new InvalidArgumentException("Unable to update category data");
        }
        DB::commit();
        return $category;
    }

    public function importService($upload)
    {
        DB::beginTransaction();
        try {
            $category = $this->categoryRepository->importRepository($upload);
        }catch (Exception $e){
            DB::rollBack();
            Log::info($e->getMessage());
            throw new InvalidArgumentException('Unable to import category data');
        }
        DB::commit();
        return $category;
    }

    public function deleteBySelectionService($category_id)
    {
        DB::beginTransaction();
        try {
            $category = $this->categoryRepository->deleteBySelectionRepository($category_id);
        }catch (Exception $e){
            DB::rollBack();
            Log::info($e->getMessage());
            throw new InvalidArgumentException('Unable to deleteBySelection category data');
        }
        DB::commit();
        return $category;
    }

    public function deleteService($id)
    {
        DB::beginTransaction();
        try {
            $category = $this->categoryRepository->deleteRepository($id);
        }catch (Exception $e){
            DB::rollBack();
            Log::info($e->getMessage());
            throw new InvalidArgumentException($e->getMessage());
        }
        DB::commit();
        return $category;
    }
}
