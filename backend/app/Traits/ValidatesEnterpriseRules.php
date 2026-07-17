<?php

namespace App\Traits;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

trait ValidatesEnterpriseRules
{
    private function validateNumericRules(array $values): void
    {
        $validator = Validator::make($values, [
            'total_value'    => ['required', 'numeric', 'gt:0'],
            'units_quantity' => ['required', 'numeric', 'min:1'],
            'unit_value'     => ['required', 'numeric', 'gt:0'],
        ], [
            'total_value.required'    => 'O valor total é obrigatório.',
            'total_value.numeric'     => 'O valor total deve ser um número.',
            'total_value.gt'          => 'O valor total deve ser maior que zero.',
            'units_quantity.required' => 'A quantidade de unidades é obrigatória.',
            'units_quantity.numeric'  => 'A quantidade de unidades deve ser um número.',
            'units_quantity.min'      => 'A quantidade de unidades deve ser maior que zero.',
            'unit_value.required'     => 'O valor da unidade é obrigatório.',
            'unit_value.numeric'      => 'O valor da unidade deve ser um número.',
            'unit_value.gt'           => 'O valor da unidade deve ser maior que zero.',
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
    }
}
