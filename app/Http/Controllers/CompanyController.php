<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;

class CompanyController extends Controller
{
    //
    public function index()
    {
        return response()->json(Company::all());
    }

    // Get all lines for a company
    public function getLines($companyId)
    {
        $company = Company::with('lines')->findOrFail($companyId);
        return response()->json($company->lines);
    }

}
