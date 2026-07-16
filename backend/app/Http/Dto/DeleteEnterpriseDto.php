<?php

namespace App\Http\Dto;

use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

final readonly class DeleteEnterpriseDto
{
    private function __construct(
        public string $id,
    ) {}

    public static function fromArray(array $inputData): self
    {
        $id = $inputData['id'] ?? null;

        if (empty($id) || !Str::isUuid($id)) {
            throw ValidationException::withMessages([
                'id' => ['O ID informado não é um UUID válido.'],
            ]);
        }

        return new self(id: $id);
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
        ];
    }
}
