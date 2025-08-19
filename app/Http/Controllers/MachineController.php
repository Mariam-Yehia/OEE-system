<?php

namespace App\Http\Controllers;

use App\Models\Machine;

class MachineController extends Controller
{
    public function getMachines($lineId)
    {
        $machines = Machine::where('line_id', $lineId)->get();

        if ($machines->count() > 0) {
            return response()->json([
                'status'   => 'success',
                'machines' => $machines
            ]);
        } else {
            return response()->json([
                'status'  => 'error',
                'message' => 'No machines found for this line'
            ]);
        }
    }
}
