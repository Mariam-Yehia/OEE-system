<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MachineRecord;
use App\Models\Company;
use App\Models\ProductionLine;
use App\Models\Machine;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class RecordController extends Controller
{
   
    public function store(Request $request)
    {
        //validate input with custom error messages
        $validated = $request->validate([
            'company_id'     => 'required|exists:companies,id',
            'line_id'        => 'required|exists:production_lines,id',
            'machine_id'     => 'required|exists:machines,id',
            'product_id'     => 'required|exists:products,id',
            'start_datetime' => 'required|date|after_or_equal:now',
        ], [
            'company_id.required' => 'Please select a company.',
            'company_id.exists'   => 'The selected company is invalid.',

            'line_id.required'    => 'Please select a production line.',
            'line_id.exists'      => 'The selected line does not exist.',

            'machine_id.required' => 'Please select a machine.',
            'machine_id.exists'   => 'The selected machine does not exist.',

            'product_id.required' => 'Please select a product.',
            'product_id.exists'   => 'The selected product is invalid.',

            'start_datetime.required'       => 'Please select a start date & time.',
            'start_datetime.date'           => 'Start date & time must be a valid date.',
            'start_datetime.after_or_equal' => 'Start date & time cannot be in the past.',
        ]);

        //extra validation to ensure relationships are correct
        $company = Company::find(id: $validated['company_id']);
        $line    = ProductionLine::find($validated['line_id']);
        $machine = Machine::find($validated['machine_id']);
        $product = Product::find($validated['product_id']);

        if ($line->company_id != $company->id) {
            return response()->json([
                'errors' => ['line_id' => ['The selected line does not belong to this company.']]
            ], 422);
        }

        if ($machine->line_id != $line->id) {
            return response()->json([
                'errors' => ['machine_id' => ['The selected machine does not belong to this line.']]
            ], 422);
        }

        if ($product->line_id != $line->id || $product->company_id != $company->id){
            return response()->json([
                'errors' => ['product_id' => ['The selected product does not belong to this company/line.']]
            ], 422);
        }

        if ($machine->status === 'running'){
            return response()->json([
                'status' => 'error',
                'message' => 'this machine is already running. Please stop it before starting again'
            ], 422);

        }

        //Create machine record
        $record = MachineRecord::create([
            'product_id'  => $validated['product_id'],
            'machine_id'  => $validated['machine_id'],
            'start_time'  => $validated['start_datetime'],
            'end_time'    => null,
        ]);

        $machine->status = 'running';
        $machine->save();

        return response()->json([
            'status'  => 'success',
            'message' => 'Machine successfully activated',
            'record'  => $record,
            'machine' => $machine
        ]);
    }
}
