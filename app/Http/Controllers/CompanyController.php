<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use const http\Client\Curl\AUTH_ANY;

class CompanyController extends Controller
{
    public function index()
    {
        $companies = Company::all();

        return Inertia::render('Admin/Company/Index', ['companies' => $companies, 'user' => Auth::user()]);
    }
    public function details(Company $company)
    {
        return Inertia::render('Admin/Company/Details', ['company' =>$company]);
    }
}
