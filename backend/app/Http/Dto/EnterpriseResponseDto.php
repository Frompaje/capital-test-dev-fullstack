<?php

namespace App\Http\Dto;

use App\Models\Enterprise;

final readonly class EnterpriseResponseDto
{
    private function __construct(
        public string $id,
        public string $name,
        public string $city,
        public string $state,
        public string $totalValue,
        public int $unitsQuantity,
        public string $unitValue,
        public string $status,
        public string $createdAt,
        public string $updatedAt,
    ) {}

    public static function fromModel(Enterprise $enterprise): self
    {
        return new self(
            id:            $enterprise->id,
            name:          $enterprise->name,
            city:          $enterprise->city,
            state:         $enterprise->state,
            totalValue:    $enterprise->total_value,
            unitsQuantity: $enterprise->units_quantity,
            unitValue:     $enterprise->unit_value,
            status:        $enterprise->status,
            createdAt:     $enterprise->created_at->toISOString(),
            updatedAt:     $enterprise->updated_at->toISOString(),
        );
    }

    public function toArray(): array
    {
        return [
            'name'  => $this->name,
            'city'  => $this->city,
            'state' => $this->state,
        ];
    }
}
