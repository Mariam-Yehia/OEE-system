<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MachineRecord;
use App\Models\Product;
use App\Models\Machine;
use App\Models\User;
use Carbon\Carbon;

class MachineRecordSeeder extends Seeder
{
    public function run(): void
    {
        $product1 = Product::find(1);
        $product2 = Product::find(2);
        $machine1 = Machine::find(1);
        $machine2 = Machine::find(2);
        $user1 = User::find(1);
        $user2 = User::find(2);

        $records = [
            ['product_id' => $product1->id, 'machine_id' => $machine1->id, 'user_id' => $user1->id, 'quantity' => 100, 'start_time' => Carbon::now()->subHours(5), 'end_time' => Carbon::now()->subHours(4)],
            ['product_id' => $product1->id, 'machine_id' => $machine2->id, 'user_id' => $user2->id, 'quantity' => 200, 'start_time' => Carbon::now()->subHours(3), 'end_time' => Carbon::now()->subHours(2)],
            ['product_id' => $product2->id, 'machine_id' => $machine1->id, 'user_id' => $user1->id, 'quantity' => 150, 'start_time' => Carbon::now()->subHours(2), 'end_time' => Carbon::now()->subHour()],
            ['product_id' => $product2->id, 'machine_id' => $machine2->id, 'user_id' => $user2->id, 'quantity' => 180, 'start_time' => Carbon::now()->subHours(4), 'end_time' => Carbon::now()->subHours(1)],
        ];

        foreach ($records as $record) {
            MachineRecord::create($record);
        }
    }
}
