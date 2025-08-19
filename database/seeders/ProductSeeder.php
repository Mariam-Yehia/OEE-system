<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\ProductionLine;
use App\Models\Company;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $company1 = Company::find(1);
        $line1 = ProductionLine::find(1);
        $line2 = ProductionLine::find(2);

        $products = [
            ['company_id' => $company1->id, 'line_id' => $line1->id, 'code' => 'P1001', 'name' => 'Widget A'],
            ['company_id' => $company1->id, 'line_id' => $line1->id, 'code' => 'P1002', 'name' => 'Widget B'],
            ['company_id' => $company1->id, 'line_id' => $line2->id, 'code' => 'P2001', 'name' => 'Gadget X'],
            ['company_id' => $company1->id, 'line_id' => $line2->id, 'code' => 'P2002', 'name' => 'Gadget Y'],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}