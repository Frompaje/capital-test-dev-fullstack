<?php

namespace App\Interfaces;

use App\Http\Dto\DeleteEnterpriseDto;
use App\Http\Dto\ListEnterpriseDto;
use App\Http\Dto\ShowEnterpriseDto;
use App\Http\Dto\StoreEnterpriseDto;
use App\Http\Dto\UpdateEnterpriseDto;

use App\Models\Enterprise;
use Illuminate\Support\Collection;

interface EnterpriseServiceInterface
{
    public function list(ListEnterpriseDto $data): Collection;

    public function findById(ShowEnterpriseDto $data): Enterprise;

    public function create(StoreEnterpriseDto $data): Enterprise;

    public function update(UpdateEnterpriseDto $data): Enterprise;

    public function delete(DeleteEnterpriseDto $data): Enterprise;
}
