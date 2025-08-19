<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProductionLine;
use App\Models\Company;

class ProductionLineSeeder extends Seeder
{
    public function run(): void
    {
        $company1 = Company::find(1);
        $company2 = Company::find(2);

        $lines = [
            ['company_id' => $company1->id, 'name' => 'Line A', 'description' => 'Main assembly line'],
            ['company_id' => $company1->id, 'name' => 'Line B', 'description' => 'Packaging line'],
            ['company_id' => $company2->id, 'name' => 'Line C', 'description' => 'Metal works'],
            ['company_id' => $company2->id, 'name' => 'Line D', 'description' => 'Painting line'],
        ];

        foreach ($lines as $line) {
            ProductionLine::create($line);
        }
    }
}

