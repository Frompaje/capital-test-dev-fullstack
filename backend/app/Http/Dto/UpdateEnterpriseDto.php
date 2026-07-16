<?php

namespace App\Http\Dto;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

final readonly class UpdateEnterpriseDto
{
    private function __construct(
        public string $id,
        public ?string $name,
        public ?string $city,
        public ?string $state,
        public ?float $totalValue,
        public ?int $unitsQuantity,
        public ?float $unitValue,
        public ?string $status,
    ) {}

    public static function fromArray(string $id, array $inputData): self
    {
        if (!Str::isUuid($id)) {
            throw ValidationException::withMessages([
                'id' => ['O ID informado não é um UUID válido.'],
            ]);
        }

        $validator = Validator::make($inputData, [
            'name'           => "sometimes|filled|string|max:255|unique:enterprises,name,{$id}",
            'city'           => 'sometimes|filled|string|max:255',
            'state'          => 'sometimes|filled|string|size:2',
            'total_value'    => 'sometimes|numeric|gt:0',
            'units_quantity' => 'sometimes|integer|gt:0',
            'unit_value'     => 'sometimes|numeric|gt:0',
            'status'         => 'sometimes|filled|in:em_lancamento,em_obras,entregue',
        ], [
            'name.filled'            => 'O nome do empreendimento não pode ser vazio.',
            'name.string'            => 'O nome do empreendimento deve ser um texto.',
            'name.max'               => 'O nome não pode ter mais de 255 caracteres.',
            'name.unique'            => 'Já existe um empreendimento com esse nome.',
            'city.filled'            => 'A cidade não pode ser vazia.',
            'city.string'            => 'A cidade deve ser um texto.',
            'city.max'               => 'O nome da cidade não pode ter mais de 255 caracteres.',
            'state.filled'           => 'O estado não pode ser vazio.',
            'state.string'           => 'O estado deve ser um texto.',
            'state.size'             => 'O estado deve conter exatamente 2 letras (ex: SP, RJ).',
            'total_value.numeric'    => 'O valor total deve ser um número.',
            'total_value.gt'         => 'O valor total deve ser maior que zero.',
            'units_quantity.integer' => 'A quantidade de unidades deve ser um número inteiro.',
            'units_quantity.gt'      => 'A quantidade de unidades deve ser maior que zero.',
            'unit_value.numeric'     => 'O valor da unidade deve ser um número.',
            'unit_value.gt'          => 'O valor da unidade deve ser maior que zero.',
            'status.filled'          => 'O status não pode ser vazio.',
            'status.in'              => 'O status informado é inválido. Use: em_lancamento, em_obras ou entregue.',
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        $validated = $validator->validated();

        return new self(
            id:            $id,
            name:          $validated['name'] ?? null,
            city:          $validated['city'] ?? null,
            state:         $validated['state'] ?? null,
            totalValue:    isset($validated['total_value']) ? (float) $validated['total_value'] : null,
            unitsQuantity: isset($validated['units_quantity']) ? (int) $validated['units_quantity'] : null,
            unitValue:     isset($validated['unit_value']) ? (float) $validated['unit_value'] : null,
            status:        $validated['status'] ?? null,
        );
    }

    public function toArray(): array
    {
        return [
            'name'           => $this->name,
            'city'           => $this->city,
            'state'          => $this->state,
            'total_value'    => $this->totalValue,
            'units_quantity' => $this->unitsQuantity,
            'unit_value'     => $this->unitValue,
            'status'         => $this->status,
        ];
    }
}
