<?php

namespace App\Http\Controllers;

use App\Models\ProductionLine;
use Illuminate\Http\Request;

class LineController extends Controller
{
    public function getLines($company_id)
    {
        // get all lines for a company
        $lines = ProductionLine::where('company_id', $company_id)->get();
        return response()->json($lines);
    }
}

