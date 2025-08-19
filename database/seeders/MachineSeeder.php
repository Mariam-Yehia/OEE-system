<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProductionLine;
use App\Models\Machine;

class MachineSeeder extends Seeder
{
    public function run(): void
    {
        $line1 = ProductionLine::find(1);
        $line2 = ProductionLine::find(2);

        $machines = [
            ['line_id' => $line1->id, 'name' => 'Cutter Machine', 'description' => 'Cuts metal sheets', 'status' => 'stopped'],
            ['line_id' => $line1->id, 'name' => 'Press Machine', 'description' => 'Presses components', 'status' => 'stopped'],
            ['line_id' => $line2->id, 'name' => 'Packaging Machine', 'description' => 'Packs goods', 'status' => 'stopped'],
        ];

        foreach ($machines as $machine) {
            Machine::create($machine);
        }
    }
}