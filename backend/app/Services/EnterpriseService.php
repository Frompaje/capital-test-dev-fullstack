<?php

namespace App\Services;

use App\Http\Dto\ListEnterpriseDto;
use App\Http\Dto\ShowEnterpriseDto;
use App\Interfaces\EnterpriseServiceInterface;
use App\Models\Enterprise;
use Illuminate\Support\Collection;

class EnterpriseService implements EnterpriseServiceInterface
{
    public function list(ListEnterpriseDto $data): Collection
    {
        return Enterprise::orderBy('name', 'asc')
            ->byName($data->name )
            ->byStatus($data->status)
            ->get();
    }

    public function findById(ShowEnterpriseDto $data): Enterprise
    {
        return Enterprise::byId($data->id)->firstOrFail();
    }

    public function create(array $data): Enterprise
    {
        return Enterprise::create($data);
    }

    public function update(Enterprise $enterprise, array $data): Enterprise
    {
        $enterprise->update(array_filter($data, fn($value) => $value !== null));

        return $enterprise->fresh();
    }

    public function delete(Enterprise $enterprise): void
    {
        $enterprise->delete();
    }
}
