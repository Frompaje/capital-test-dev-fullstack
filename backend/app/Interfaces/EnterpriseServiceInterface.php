<?php

namespace App\Interfaces;

use App\Http\Dto\ListEnterpriseDto;
use App\Http\Dto\ShowEnterpriseDto;
use App\Http\Dto\StoreEnterpriseDto;
use App\Models\Enterprise;
use Illuminate\Support\Collection;

interface EnterpriseServiceInterface
{
    public function list(ListEnterpriseDto $data): Collection;

    public function findById(ShowEnterpriseDto $data): Enterprise;

    public function create(StoreEnterpriseDto $data): Enterprise;

    public function update(Enterprise $enterprise, array $data): Enterprise;

    public function delete(Enterprise $enterprise): void;
}
