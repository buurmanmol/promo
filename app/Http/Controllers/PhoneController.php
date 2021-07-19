<?php

namespace App\Http\Controllers;

use App\Models\Phone;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use App\Models\Invoice;
use Illuminate\Validation\Rules\In;
use const http\Client\Curl\AUTH_ANY;

class PhoneController extends Controller
{
    public function dashboard()
    {
        return Inertia::render('Dashboard');
    }

    public function kk()
    {
        $phone = Phone::all();

        return ['data' => $phone];
    }

    public function index()
    {
        $phones = Phone::orderBy('name', 'asc')->paginate(20);

        return Inertia::render('Admin/Phone/Index', ['phones' => $phones, 'user' => Auth::user()]);
    }

    public function create()
    {
        $phones = Phone::all();

        return Inertia::render('Admin/Phone/Create', ['phone'=>  Auth::user()]);
    }

    public function update(Phone $phones, Request $request)
    {
        $phones->update($request->all());
        return Inertia::render('Admin/Phone/Update', ['phone' => $phones]);
    }
}
