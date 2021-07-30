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
        if(Auth::user()->role === "admin"){
            $users = User::with('company')->get();
            return Inertia::render('Admin/User/Index', ['users' => $users, 'currentUser' => Auth::user()]);
        }
        return Inertia::render('Dashboard', ['user' => Auth::user(), 'company' => Auth::user()->company]);
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

    public function index()
    {
        $users = User::with('company')->get();
        return Inertia::render('Admin/User/Index', ['users' => $users, 'currentUser' => Auth::user()]);
    }

    public function createIndex()
    {
        $users = User::all();

        return Inertia::render('Admin/User/Create', ['user' => Auth::user()]);
    }

    public function create(Request $request)
    {
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
            'manager_id' => $request->get('manager_id'),
            'password' => bcrypt($request->get('password'))
        ]);

        return ['user' => $user];
    }

    public function updateIndex(User $user, Request $request)
    {
        $user->company = $user->company();

//        $company = $user->company;
//        $company->users()->attach($user);
        return Inertia::render('Admin/User/Update',['user' => $user, 'currentUser' => Auth::user()]);
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
        return 'deleted';
    }
}
