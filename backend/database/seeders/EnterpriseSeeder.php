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
                'status' => 'em_lancamento',
            ],
            [
                'name' => 'Parque das Flores',
                'city' => 'Campinas',
                'state' => 'SP',
                'total_value' => 8400000.00,
                'units_quantity' => 42,
                'unit_value' => 200000.00,
                'status' => 'em_obras',
            ],
            [
                'name' => 'Alto do Ipê',
                'city' => 'Belo Horizonte',
                'state' => 'MG',
                'total_value' => 15000000.00,
                'units_quantity' => 60,
                'unit_value' => 250000.00,
                'status' => 'entregue',
            ],
            [
                'name' => 'Mirante do Sol',
                'city' => 'Rio de Janeiro',
                'state' => 'RJ',
                'total_value' => 22000000.00,
                'units_quantity' => 80,
                'unit_value' => 275000.00,
                'status' => 'em_obras',
            ],
            [
                'name' => 'Jardins de Curitiba',
                'city' => 'Curitiba',
                'state' => 'PR',
                'total_value' => 9600000.00,
                'units_quantity' => 48,
                'unit_value' => 200000.00,
                'status' => 'entregue',
            ],
            [
                'name' => 'Costa Atlântica',
                'city' => 'Florianópolis',
                'state' => 'SC',
                'total_value' => 18000000.00,
                'units_quantity' => 36,
                'unit_value' => 500000.00,
                'status' => 'em_lancamento',
            ],
            [
                'name' => 'Reserva Ipiranga',
                'city' => 'Porto Alegre',
                'state' => 'RS',
                'total_value' => 7200000.00,
                'units_quantity' => 30,
                'unit_value' => 240000.00,
                'status' => 'em_obras',
            ],
            [
                'name' => 'Brisa do Mar',
                'city' => 'Fortaleza',
                'state' => 'CE',
                'total_value' => 16200000.00,
                'units_quantity' => 54,
                'unit_value' => 300000.00,
                'status' => 'entregue',
            ],
            [
                'name' => 'Horizonte Azul',
                'city' => 'Salvador',
                'state' => 'BA',
                'total_value' => 13500000.00,
                'units_quantity' => 45,
                'unit_value' => 300000.00,
                'status' => 'em_lancamento',
            ],
            [
                'name' => 'Vila dos Pinheiros',
                'city' => 'Brasília',
                'state' => 'DF',
                'total_value' => 11000000.00,
                'units_quantity' => 40,
                'unit_value' => 275000.00,
                'status' => 'em_obras',
            ],
            [
                'name' => 'Recanto das Águas',
                'city' => 'Goiânia',
                'state' => 'GO',
                'total_value' => 9800000.00,
                'units_quantity' => 35,
                'unit_value' => 280000.00,
                'status' => 'entregue',
            ],
            [
                'name' => 'Portal do Cerrado',
                'city' => 'Uberlândia',
                'state' => 'MG',
                'total_value' => 7600000.00,
                'units_quantity' => 38,
                'unit_value' => 200000.00,
                'status' => 'em_lancamento',
            ],
            [
                'name' => 'Estância Serrana',
                'city' => 'Petrópolis',
                'state' => 'RJ',
                'total_value' => 14500000.00,
                'units_quantity' => 29,
                'unit_value' => 500000.00,
                'status' => 'em_obras',
            ],
            [
                'name' => 'Bosque Imperial',
                'city' => 'Londrina',
                'state' => 'PR',
                'total_value' => 8900000.00,
                'units_quantity' => 44,
                'unit_value' => 202272.73,
                'status' => 'entregue',
            ],
            [
                'name' => 'Marina da Baía',
                'city' => 'Vitória',
                'state' => 'ES',
                'total_value' => 16800000.00,
                'units_quantity' => 56,
                'unit_value' => 300000.00,
                'status' => 'em_lancamento',
            ],
        ];

        foreach ($enterprises as $enterprise) {
            Enterprise::create($enterprise);
        }
    }
}
