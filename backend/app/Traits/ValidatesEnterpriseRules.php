<?php

namespace App\Traits;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

trait ValidatesEnterpriseRules
{
    private function validateNumericRules(array $values): void
    {
        $validator = Validator::make($values, [
            'totalValue'    => ['numeric', 'gt:0'],
            'unitsQuantity' => ['numeric', 'gt:0'],
            'unitValue'     => ['numeric', 'gt:0'],
        ], [
            'totalValue.numeric'    => 'O valor total deve ser um número.',
            'totalValue.gt'         => 'O valor total deve ser maior que zero.',
            'unitsQuantity.numeric' => 'A quantidade de unidades deve ser um número.',
            'unitsQuantity.gt'      => 'A quantidade de unidades deve ser maior que zero.',
            'unitValue.numeric'     => 'O valor da unidade deve ser um número.',
            'unitValue.gt'          => 'O valor da unidade deve ser maior que zero.',
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
    }
}
