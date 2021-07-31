<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use const http\Client\Curl\AUTH_ANY;

class CompanyController extends Controller
{

    public function getCompanies()
    {
        $companies = Company::paginate(10)->setPath('/admin/companies');

        return ['companies' => $companies];
    }

    public function getCompaniesJson()
    {
        $companies = Company::all();

        return ['companies' => $companies];
    }

    public function searchCompany(Request $request)
    {
        $companies = Company::where('name', 'LIKE','%'. $request->get('search') . '%')->paginate(10)->setPath('/admin/companies');
//        dd($companies);
        return ['companies' => $companies];
    }

    public function getCompanyUser(Company $company)
    {
        $users = User::where('company_id', $company->id)->get();
        $companyArray = [];
        foreach ($users as $user) {
            if ($user->role === 'company') {
                array_push($companyArray, $user);
            }
        }

        return ['company' => $companyArray];
    }

    public function index()
    {
        $companies = Company::paginate(10);

        return Inertia::render('Admin/Company/Index', ['companies' => $companies, 'user' => Auth::user()]);
    }
    public function details(Company $company)
    {
        return Inertia::render('Admin/Company/Details', ['company' =>$company]);
    }

    public function createIndex()
    {
        return Inertia::render('Admin/Company/Create', ['user' => Auth::user()]);
    }

    public function create(Request $request)
    {
        $company = Company::create([
            'name' => $request->get('name'),
            'address' => $request->get('address'),
            'postal_code' => $request->get('postal_code'),
            'wallet' => $request->get('wallet'),
            'phone_number' => $request->get('phone_number'),
            'email' => $request->get('email'),
        ]);

        return ['company' => $company];
    }

    public function updateIndex(Company $company, Request $request)
    {
        return Inertia::render('Admin/Company/Update',['company' => $company]);
    }

    public function update(Company $company, Request $request)
    {
        $company->update($request->all());

        return ['company' => $company];
    }
}
