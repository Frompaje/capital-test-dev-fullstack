<?php

namespace App\Services;

use App\Http\Dto\ListEnterpriseDto;
use App\Interfaces\EnterpriseServiceInterface;
use App\Models\Enterprise;
use Illuminate\Support\Collection;

class EnterpriseService implements EnterpriseServiceInterface
{
    public function list(ListEnterpriseDto $filters): Collection
    {
        return Enterprise::orderBy('name', 'asc')
            ->byName($filters->name )
            ->byStatus($filters->status)
            ->get();
    }

    public function findById(string $id): Enterprise
    {
        return Enterprise::findOrFail($id);
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
