<?php

namespace App\Traits;

use App\Http\Dto\StoreEnterpriseDto;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

trait ValidatesEnterpriseRules
{
    private function validateStoreRules(StoreEnterpriseDto $data): void
    {
        $validator = Validator::make((array) $data, [
            'totalValue'    => ['required', 'numeric', 'gt:0'],
            'unitsQuantity' => ['required', 'numeric', 'gt:0'],
            'unitValue'     => ['required', 'numeric', 'gt:0'],
        ], [
            'totalValue.required'    => 'O valor total é obrigatório.',
            'totalValue.numeric'     => 'O valor total deve ser um número.',
            'totalValue.gt'          => 'O valor total deve ser maior que zero.',
            'unitsQuantity.required' => 'A quantidade de unidades é obrigatória.',
            'unitsQuantity.numeric'  => 'A quantidade de unidades deve ser um número.',
            'unitsQuantity.gt'       => 'A quantidade de unidades deve ser maior que zero.',
            'unitValue.required'     => 'O valor da unidade é obrigatória.',
            'unitValue.numeric'      => 'O valor da unidade deve ser um número.',
            'unitValue.gt'           => 'O valor da unidade deve ser maior que zero.',
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }
    }
}
