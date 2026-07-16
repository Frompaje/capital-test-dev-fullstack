<?php

namespace App\Http\Dto;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

final readonly class ListEnterpriseDto
{
    private function __construct(
        public ?string $name,
        public ?string $status,
        public int $perPage,
        public int $page,
    ) {}

    public static function fromArray(array $inputData): self
    {
        $validator = Validator::make($inputData, [
            'name'     => 'sometimes|nullable|string|max:255',
            'status'   => 'sometimes|nullable|in:em_lancamento,em_obras,entregue',
            'per_page' => 'sometimes|integer|min:1|max:100',
            'page'     => 'sometimes|integer|min:1',
        ], [
            'name.string'      => 'O nome deve ser um texto.',
            'name.max'         => 'O nome não pode ter mais de 255 caracteres.',
            'status.in'        => 'O status informado é inválido. Use: em_lancamento, em_obras ou entregue.',
            'per_page.integer' => 'O campo per_page deve ser um número inteiro.',
            'per_page.min'     => 'O campo per_page deve ser no mínimo 1.',
            'per_page.max'     => 'O campo per_page deve ser no máximo 100.',
            'page.integer'     => 'O campo page deve ser um número inteiro.',
            'page.min'         => 'O campo page deve ser no mínimo 1.',
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        $validated = $validator->validated();

        return new self(
            name:    $validated['name'] ?? null,
            status:  $validated['status'] ?? null,
            perPage: (int) ($validated['per_page'] ?? 5),
            page:    (int) ($validated['page'] ?? 1),
        );
    }

    public function toArray(): array
    {
        return [
            'name'     => $this->name,
            'status'   => $this->status,
            'per_page' => $this->perPage,
            'page'     => $this->page,
        ];
    }
}
