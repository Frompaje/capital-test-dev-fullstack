<?php

namespace App\Services;

use App\Http\Requests\Enterprise\Dto\StoreEnterpriseData;
use App\Http\Requests\Enterprise\Dto\UpdateEnterpriseData;
use App\Models\Enterprise;
use Illuminate\Support\Collection;

class EnterpriseService
{
    public function list(array $request): Collection
    {
        return Enterprise::orderBy('name', 'desc')
            ->byName($request['name'])
            ->byStatus($request['status'])
            ->get();
    }

    public function findById(string $id): Enterprise
    {
        return Enterprise::findOrFail($id);
    }

    public function create(StoreEnterpriseData $data): Enterprise
    {
        return Enterprise::create([
            'name'           => $data->name,
            'city'           => $data->city,
            'state'          => $data->state,
            'total_value'    => $data->totalValue,
            'units_quantity' => $data->unitsQuantity,
            'unit_value'     => $data->unitValue,
            'status'         => $data->status,
        ]);
    }

    public function update(Enterprise $enterprise, UpdateEnterpriseData $data): Enterprise
    {
        $enterprise->update(array_filter([
            'name'           => $data->name,
            'city'           => $data->city,
            'state'          => $data->state,
            'total_value'    => $data->totalValue,
            'units_quantity' => $data->unitsQuantity,
            'unit_value'     => $data->unitValue,
            'status'         => $data->status,
        ], fn($value) => $value !== null));

        return $enterprise->fresh();
    }

    public function delete(Enterprise $enterprise): void
    {
        $enterprise->delete();
    }
}
