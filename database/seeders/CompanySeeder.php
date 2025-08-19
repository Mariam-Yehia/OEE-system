<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Company;

class CompanySeeder extends Seeder
{
    public function run(): void
    {
        $companies = [
            ['name' => 'ABC Manufacturing', 'location' => 'Cairo'],
            ['name' => 'XYZ Industries', 'location' => 'Alexandria'],
            ['name' => 'Delta Engineering', 'location' => 'Giza'],
            ['name' => 'FutureTech', 'location' => 'Mansoura'],
        ];

        foreach ($companies as $company) {
            Company::create($company);
        }
    }
}

