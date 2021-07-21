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
        return Inertia::render('Dashboard', ['user' => Auth::user()]);
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
            'password' => bcrypt($request->get('password'))
        ]);

        $company = Company::where('id', $request->get('company'))->first();
        $user->company()->attach($company);

        return ['user' => $user];
    }

    public function updateIndex(User $user, Request $request)
    {
        $user = $user->with('company')->first();

//        $company = $user->company;
//        $company->users()->attach($user);
        return Inertia::render('Admin/User/Update',['user' => $user]);
    }

    public function update(User $user, Request $request)
    {
        $user->update($request->all());
        $company = $request->get('company');
        $selectedCompany = Company::where('id', $company)->first();
        if(!empty($request->get('originalCompany'))) {
//            dd($request->get('originalCompany'));
            $user->company()->detach($request->get('originalCompany'));
        }

        $user->company()->attach($selectedCompany);
//        $company->users()->attach($user);

        return ['user' => $user];
    }

    public function delete(User $user)
    {
        $user->delete();
        return 'deleted';
    }
}
