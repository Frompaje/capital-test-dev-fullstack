<?php

namespace App\Http\Dto;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

final readonly class StoreEnterpriseDto
{
    private function __construct(
        public string $name,
        public string $city,
        public string $state,
        public float $totalValue,
        public int $unitsQuantity,
        public float $unitValue,
        public string $status,
    ) {}

    public static function fromArray(array $inputData): self
    {
        $validator = Validator::make($inputData, [
            'name'           => 'required|string|max:255|unique:enterprises,name',
            'city'           => 'required|string|max:255',
            'state'          => 'required|string|size:2',
            'total_value'    => 'required|numeric|gt:0',
            'units_quantity' => 'required|integer|min:1',
            'unit_value'     => 'required|numeric|gt:0',
            'status'         => 'required|in:em_lancamento,em_obras,entregue',
        ], [
            'name.required'           => 'O nome do empreendimento é obrigatório.',
            'name.max'                => 'O nome não pode ter mais de 255 caracteres.',
            'name.unique'             => 'Já existe um empreendimento com esse nome.',
            'city.required'           => 'A cidade é obrigatória.',
            'city.max'                => 'O nome da cidade não pode ter mais de 255 caracteres.',
            'state.required'          => 'O estado é obrigatório.',
            'state.size'              => 'O estado deve conter exatamente 2 letras (ex: SP, RJ).',
            'total_value.required'    => 'O valor total é obrigatório.',
            'total_value.numeric'     => 'O valor total deve ser um número.',
            'total_value.gt'          => 'O valor total deve ser maior que zero.',
            'units_quantity.required' => 'A quantidade de unidades é obrigatória.',
            'units_quantity.integer'  => 'A quantidade de unidades deve ser um número inteiro.',
            'units_quantity.min'      => 'A quantidade de unidades deve ser maior que zero.',
            'unit_value.required'     => 'O valor da unidade é obrigatório.',
            'unit_value.numeric'      => 'O valor da unidade deve ser um número.',
            'unit_value.gt'           => 'O valor da unidade deve ser maior que zero.',
            'status.required'         => 'O status é obrigatório.',
            'status.in'               => 'O status informado é inválido. Use: em_lancamento, em_obras ou entregue.',
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        $validated = $validator->validated();

        return new self(
            name:          $validated['name'],
            city:          $validated['city'],
            state:         $validated['state'],
            totalValue:    (float) $validated['total_value'],
            unitsQuantity: (int) $validated['units_quantity'],
            unitValue:     (float) $validated['unit_value'],
            status:        $validated['status'],
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
