<?php

namespace Database\Seeders;

use App\Models\Enterprise;
use Illuminate\Database\Seeder;

class EnterpriseSeeder extends Seeder
{
    public function run(): void
    {
        $enterprises = [
            [
                'name' => 'Residencial Vila Verde',
                'city' => 'São Paulo',
                'state' => 'SP',
                'total_value' => 12500000.00,
                'units_quantity' => 50,
                'unit_value' => 250000.00,
                'status' => 'launching',
            ],
            [
                'name' => 'Parque das Flores',
                'city' => 'Campinas',
                'state' => 'SP',
                'total_value' => 8400000.00,
                'units_quantity' => 42,
                'unit_value' => 200000.00,
                'status' => 'under_construction',
            ],
            [
                'name' => 'Alto do Ipê',
                'city' => 'Belo Horizonte',
                'state' => 'MG',
                'total_value' => 15000000.00,
                'units_quantity' => 60,
                'unit_value' => 250000.00,
                'status' => 'delivered',
            ],
            [
                'name' => 'Mirante do Sol',
                'city' => 'Rio de Janeiro',
                'state' => 'RJ',
                'total_value' => 22000000.00,
                'units_quantity' => 80,
                'unit_value' => 275000.00,
                'status' => 'under_construction',
            ],
            [
                'name' => 'Jardins de Curitiba',
                'city' => 'Curitiba',
                'state' => 'PR',
                'total_value' => 9600000.00,
                'units_quantity' => 48,
                'unit_value' => 200000.00,
                'status' => 'delivered',
            ],
            [
                'name' => 'Costa Atlântica',
                'city' => 'Florianópolis',
                'state' => 'SC',
                'total_value' => 18000000.00,
                'units_quantity' => 36,
                'unit_value' => 500000.00,
                'status' => 'launching',
            ],
            [
                'name' => 'Reserva Ipiranga',
                'city' => 'Porto Alegre',
                'state' => 'RS',
                'total_value' => 7200000.00,
                'units_quantity' => 30,
                'unit_value' => 240000.00,
                'status' => 'under_construction',
            ],
            [
                'name' => 'Amazonas Tower',
                'city' => 'Manaus',
                'state' => 'AM',
                'total_value' => 14000000.00,
                'units_quantity' => 40,
                'unit_value' => 350000.00,
                'status' => 'launching',
            ],
            [
                'name' => 'Solar do Cerrado',
                'city' => 'Goiânia',
                'state' => 'GO',
                'total_value' => 10500000.00,
                'units_quantity' => 35,
                'unit_value' => 300000.00,
                'status' => 'under_construction',
            ],
            [
                'name' => 'Brisa do Mar',
                'city' => 'Fortaleza',
                'state' => 'CE',
                'total_value' => 16200000.00,
                'units_quantity' => 54,
                'unit_value' => 300000.00,
                'status' => 'delivered',
            ],
            [
                'name' => 'Infinity Coast',
                'city' => 'Balneário Camboriú',
                'state' => 'SC',
                'total_value' => 45000000.00,
                'units_quantity' => 30,
                'unit_value' => 1500000.00,
                'status' => 'under_construction',
            ],
            [
                'name' => 'Morada do Sol',
                'city' => 'Ribeirão Preto',
                'state' => 'SP',
                'total_value' => 6400000.00,
                'units_quantity' => 32,
                'unit_value' => 200000.00,
                'status' => 'delivered',
            ],
            [
                'name' => 'Metropolitan Flat',
                'city' => 'Brasília',
                'state' => 'DF',
                'total_value' => 24000000.00,
                'units_quantity' => 60,
                'unit_value' => 400000.00,
                'status' => 'launching',
            ],
            [
                'name' => 'Portal do Nordeste',
                'city' => 'Recife',
                'state' => 'PE',
                'total_value' => 11200000.00,
                'units_quantity' => 28,
                'unit_value' => 400000.00,
                'status' => 'under_construction',
            ],
            [
                'name' => 'Pampa Green',
                'city' => 'Caxias do Sul',
                'state' => 'RS',
                'total_value' => 9000000.00,
                'units_quantity' => 45,
                'unit_value' => 200000.00,
                'status' => 'delivered',
            ],
        ];

        foreach ($enterprises as $enterprise) {
            Enterprise::create($enterprise);
        }
    }
}
