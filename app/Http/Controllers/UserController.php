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

    public function create()
    {
        $users = User::all();

        return Inertia::render('Admin/User/Create', ['user' => Auth::user()]);
    }

    public function update(User $user, Request $request)
    {
        $user->update($request->all());
        return Inertia::render('Admin/User/Update',['user' => $user]);
    }
}
