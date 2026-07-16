<?php

namespace App\Interfaces;

use App\Http\Dto\ListEnterpriseDto;
use App\Models\Enterprise;
use Illuminate\Support\Collection;

interface EnterpriseServiceInterface
{
    public function list(ListEnterpriseDto $filters): Collection;

    public function findById(string $id): Enterprise;

    public function create(array $data): Enterprise;

    public function update(Enterprise $enterprise, array $data): Enterprise;

    public function delete(Enterprise $enterprise): void;
}
