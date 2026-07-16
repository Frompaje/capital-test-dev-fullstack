<?php

namespace App\Services;

use App\Http\Dto\ListEnterpriseDto;
use App\Http\Dto\ShowEnterpriseDto;
use App\Http\Dto\StoreEnterpriseDto;
use App\Interfaces\EnterpriseServiceInterface;
use App\Models\Enterprise;
use App\Traits\ValidatesEnterpriseRules;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Throwable;

class EnterpriseService implements EnterpriseServiceInterface
{
    use ValidatesEnterpriseRules;

    public function list(ListEnterpriseDto $data): Collection
    {
        try {
            return Enterprise::orderBy('name', 'asc')
                ->byName($data->name)
                ->byStatus($data->status)
                ->get();
        } catch (Throwable $exception) {
            Log::error('EnterpriseService::list failed', [
                'filters' => $data,
                'error'   => $exception->getMessage(),
                'trace'   => $exception->getTraceAsString(),
            ]);

            throw $exception;
        }
    }

    public function findById(ShowEnterpriseDto $data): Enterprise
    {
        try {
            return Enterprise::byId($data->id)->firstOrFail();
        } catch (Throwable $exception) {
            Log::error('EnterpriseService::findById failed', [
                'enterprise_id' => $data->id,
                'error'         => $exception->getMessage(),
                'trace'         => $exception->getTraceAsString(),
            ]);

            throw $exception;
        }
    }

    public function create(StoreEnterpriseDto $data): Enterprise
    {
        try {
            $this->validateStoreRules($data);

            return Enterprise::create($data->toArray());
        } catch (ValidationException $exception) {
            Log::warning('EnterpriseService::create validation failed', [
                'errors' => $exception->errors(),
            ]);

            throw $exception;
        } catch (Throwable $exception) {
            Log::error('EnterpriseService::create failed', [
                'payload' => $data->toArray(),
                'error'   => $exception->getMessage(),
                'trace'   => $exception->getTraceAsString(),
            ]);

            throw $exception;
        }
    }

    public function update(Enterprise $enterprise, array $data): Enterprise
    {
        try {
            $enterprise->update(array_filter($data, fn($value) => $value !== null));

            return $enterprise->fresh();
        } catch (Throwable $exception) {
            Log::error('EnterpriseService::update failed', [
                'enterprise_id' => $enterprise->id,
                'payload'       => $data,
                'error'         => $exception->getMessage(),
                'trace'         => $exception->getTraceAsString(),
            ]);

            throw $exception;
        }
    }

    public function delete(Enterprise $enterprise): void
    {
        try {
            $enterprise->delete();
        } catch (Throwable $exception) {
            Log::error('EnterpriseService::delete failed', [
                'enterprise_id' => $enterprise->id,
                'error'         => $exception->getMessage(),
                'trace'         => $exception->getTraceAsString(),
            ]);

            throw $exception;
        }
    }
}
