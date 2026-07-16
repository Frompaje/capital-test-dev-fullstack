<?php

namespace App\Http\Dto;

final readonly class ListEnterpriseDto
{
    private function __construct(
        public ?string $name,
        public ?string $status,
    ) {}

    public static function fromArray(array $inputData): self
    {
        return new self(
            name: $inputData['name'] ?? null,
            status: $inputData['status'] ?? null,
        );
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'status' => $this->status,
        ];
    }
}
