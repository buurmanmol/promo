<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\In;
use Inertia\Inertia;

class UserController extends Controller
{
    public function dashboard()
    {
        return Inertia::render('Dashboard');
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
            'last_name' => $request->get('first_name'),
            'address' => $request->get('first_name'),
            'postal_code' => $request->get('first_name'),
            'city' => $request->get('first_name'),
            'province' => $request->get('first_name'),
            'email' => $request->get('first_name'),
            'password' => bcrypt($request->get('password'))
        ]);

        return ['user' => $user];
    }

    public function updateIndex(User $user, Request $request)
    {

        return Inertia::render('Admin/User/Update',['user' => $user]);
    }

    public function update(User $user, Request $request)
    {
        $user->update($request->all());
        return ['user' => $user];
    }
}
