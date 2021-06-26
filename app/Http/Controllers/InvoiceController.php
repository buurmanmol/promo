<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Company;
use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\In;
use Inertia\Inertia;
use const http\Client\Curl\AUTH_ANY;

class InvoiceController extends Controller
{
    public function index()
    {

        $invoices = Invoice::all();
        return Inertia::render('Admin/Invoice/Index', ['invoices' => $invoices, 'user' => Auth::user()]);

    }
    public function details(Invoice $invoice)
    {
        return Inertia::render('Admin/Invoice/Details', ['Invoice' => $invoice]);
    }

    public function create()
    {
        $companies = Company::all("name");
        //$users = User::with([invoice, company]);
        $invoices = Invoice::all();

        return Inertia::render('Admin/Invoice/Create', ['companies' => $companies, 'user' => Auth::user()]);
    }
    
    public function update(User $user, Request $request)
    {
        //$invoice = Invoice::where('id', $request->id);
        //$user->update($request->all());
        return Inertia::render('Admin/Invoice/Update',['user' => Auth::user()]);
    }
}
