<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\In;
use Inertia\Inertia;

class UserController extends Controller
{
    public function dashboard()
    {
        switch(Auth::user()->role){
            case "admin":
                return Inertia::render('Admin/Dashboard', ['user' => Auth::user(), 'company' => Auth::user()->company]);
                break;
            case "company":
                return Inertia::render('Company/Dashboard', ['user' => Auth::user(), 'company' => Auth::user()->company]);
                break;
            case "manager":
                return Inertia::render('Manager/Dashboard', ['user' => Auth::user(), 'company' => Auth::user()->company]);
                break;
            default:
                return Inertia::render('User/Dashboard', ['user' => Auth::user(), 'company' => Auth::user()->company]);
                break;
        }
    }

    public function getManagers(Company $company)
    {
        $users = User::where('company_id', $company->id)->get();
        $managerArray = [];
        foreach ($users as $user) {
            if ($user->role === 'manager') {
                array_push($managerArray, $user);
            }
        }

        return ['managers' => $managerArray];
    }

    public function indexCompanyManager(User $user)
    {
        $users = User::with(['repairs.device.brandsModels','repairs.productType','company', 'repairs' => function ($q) use ($user) {
            $q->where('manager_id', $user->id);
        }])->get();


        return Inertia::render('Manager/Repair/Index', ['users' => $users, 'currentUser' => Auth::user(), 'company' => Auth::user()->company]);
    }

    public function searchUser(Request $request)
    {
        $users = User::with('company')->where(function ($query) use($request) {
            $query->where('first_name', 'like', '%' . $request->get('search') . '%')
                ->orWhere('last_name', 'like', '%' . $request->get('search') . '%');
        })->paginate(10)->setPath('/admin/companies');//        dd($companies);
        return ['users' => $users];
    }

    public function getUsers(Request $request){
        $users = User::with('company')
        ->paginate(10, ['*'], 'page', $request->get('page'));
        return ['users' => $users];
    }

    public function index()
    {
        $users = User::orderBy('first_name', 'asc')->with('company')->paginate(10);
        return Inertia::render('Admin/User/Index', ['users' => $users, 'currentUser' => Auth::user()]);
    }

    public function createIndex()
    {
        $users = User::all();

        return Inertia::render('Admin/User/Create', ['currentUser' => Auth::user(), 'company' => Auth::user()->company]);
    }

    public function create(Request $request)
    {
       //dd($request->get('manager_id')); 
        $user = User::create([
            'first_name' => $request->get('first_name'),
            'last_name' => $request->get('last_name'),
            'address' => $request->get('address'),
            'postal_code' => $request->get('postal_code'),
            'city' => $request->get('city'),
            'phone_number' => $request->get('phone_number'),
            'province' => $request->get('province'),
            'email' => $request->get('email'),
            'company_id' => $request->get('company_id'),
            'role' => $request->get('role'),
            'password' => bcrypt($request->get('password'))
        ]);

        $managerId = $request->get('manager_id');
        if($managerId === null){
            $managerId = $user->id;
        }
        $user->update(['manager_id' => $managerId]);

        return ['user' => $user];
    }

    public function updateIndex(User $user, Request $request)
    {
            $company = Company::where('id', $user->company_id)->firstOrFail();
//        $company = $user->company;
//        $company->users()->attach($user);
        return Inertia::render('Admin/User/Update',['company' => $company,'user' => $user, 'currentUser' => Auth::user()]);
    }

    public function update(User $user, Request $request)
    {
//        dd($request->get('company_id'));
        $newUser = $user->update([
            'first_name' => $request->get('first_name'),
            'last_name' => $request->get('last_name'),
            'address' => $request->get('address'),
            'postal_code' => $request->get('postal_code'),
            'city' => $request->get('city'),
            'phone_number' => $request->get('phone_number'),
            'province' => $request->get('province'),
            'email' => $request->get('email'),
            'company_id' => $request->get('company_id'),
        ]);
//        $company = $request->get('company');

//        $company->users()->attach($user);

        return ['user' => $newUser];
    }

    public function delete(User $user)
    {
        $user->delete();
        return ['user' => $user];
    }
}
