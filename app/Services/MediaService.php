<?php

namespace App\Services;

use App\Repositories\MediaRepository;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use InvalidArgumentException;

class MediaService
{
    protected $mediaRepository;

    public function __construct(MediaRepository $mediaRepository)
    {
        $this->mediaRepository = $mediaRepository;
    }

    public function indexService()
    {
        return $this->mediaRepository->indexRepository();
    }

    public function storeService($request)
    {
        DB::beginTransaction();
        try {
            $media = $this->mediaRepository->storeRepository($request);
        }catch (Exception $e){
            DB::rollBack();
            Log::info($e->getMessage());
            throw new InvalidArgumentException($e->getMessage());
        }
        DB::commit();
        return $media;
    }

    public function editService($id)
    {
        DB::beginTransaction();
        try {
            $media = $this->mediaRepository->editRepository($id);
        }catch (Exception $e){
            DB::rollBack();
            Log::info($e->getMessage());
            throw new InvalidArgumentException($e->getMessage());
        }
        DB::commit();
        return $media;
    }

    public function updateService($request)
    {
        DB::beginTransaction();
        try {
            $media = $this->mediaRepository->updateRepository($request);
        }catch (Exception $e){
            DB::rollBack();
            Log::info($e->getMessage());
            throw new InvalidArgumentException($e->getMessage());
        }
        DB::commit();
        return $media;
    }

    public function importService($upload)
    {
        DB::beginTransaction();
        try {
            $media = $this->mediaRepository->importRepository($upload);
        }catch (Exception $e){
            DB::rollBack();
            Log::info($e->getMessage());
            throw new InvalidArgumentException($e->getMessage());
        }
        DB::commit();
        return $media;
    }

    public function deleteBySelectionService($id)
    {
        DB::beginTransaction();
        try {
            $media = $this->mediaRepository->deleteBySelectionRepository($id);
        }catch (Exception $e){
            DB::rollBack();
            Log::info($e->getMessage());
            throw new InvalidArgumentException($e->getMessage());
        }
        DB::commit();
        return $media;
    }

    public function deleteService($id)
    {
        DB::beginTransaction();
        try {
            $media = $this->mediaRepository->deleteRepository($id);
        }catch (Exception $e){
            DB::rollBack();
            Log::info($e->getMessage());
            throw new InvalidArgumentException($e->getMessage());
        }
        DB::commit();
        return $media;
    }
}
