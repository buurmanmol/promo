<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Device;
use App\Models\Invoice;
use App\Models\Repair;
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
        $companies = Company::orderBy('name', 'asc')->paginate(10);

        return Inertia::render('Admin/Company/Index', ['companies' => $companies, 'user' => Auth::user()]);
    }
    public function details(Company $company)
    {

        return Inertia::render('Admin/Company/Details', ['company' =>$company]);
    }

    public function adminDetails(Company $company)
    {
        $repairs = Company::where('id' , $company->id)->with('users.devices.brandsModels', 'users.invoices', 'users.repairs.device.brandsModels')->first();
        $fullArr = [];
//        dd($repairs);
        $companyUser = Company::where('id', $company->id)->with(['users' => function ($q) {
            $q->where('role', 'company');
        }])->first();
        $user = $companyUser->users[0];

        foreach($repairs->users as $user) {
            foreach ($user->repairs as $repair) {
                $sameDate = Repair::where('user_id', $user->id)->whereBetween('created_at', [$repair->created_at->startOfDay(), $repair->created_at->endOfDay()])->with(['user','productType', 'device.brandsModels']) -> orderBy('created_at', 'desc')->get();
//            dd($sameDate);
                $sameDate->user = $user;
//                dd($sameDate);
                array_push($fullArr, $sameDate);
            }
        }

        $s = array_unique($fullArr, SORT_REGULAR);
//        dd($user['id'], auth()->user()->id);

        $devices = (object)
        $deviceArray = [];
        foreach($repairs->users as $user) {
            foreach ($user->devices as $device) {
                array_push($deviceArray, $device);
            }
        }
        $devices->data = $deviceArray;
//        dd($devices);
        $invoices = [];
        foreach($repairs->users as $user) {
//            dd($user->invoices);
            foreach ($user->invoices as $invoice) {
                array_push($invoices, $invoice);
            }
        }
        return Inertia::render('Admin/Company/Details', ['invoices' => $invoices, 'company' => $company, 'repairs' => $s,'currentUser' => Auth::user(),'user' => $user, 'devices' => $devices]);
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
    public function getPaginatedCompanies(Request $request){
        $companies = Company::paginate(10, ['*'], 'page', $request->get('page'));
        return ['companies' => $companies];
    }
    public function delete(Company $company){
        if($company->id === Auth::user()->company_id){
            return ['error' => true, 'company' => $company];
        }
        $company->delete();
        return ['error' => false, 'companies' => $company];
    }
}
