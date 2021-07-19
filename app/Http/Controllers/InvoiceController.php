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

        $invoices = Invoice::join('users', 'users.id', '=', 'invoices.user_id')
        ->orderBy('invoices.id','DESC')
        ->get(['users.first_name', 'users.last_name', 'users.email', 'invoices.id', 'invoices.invoice_name', 'invoices.created_at']);
        return Inertia::render('Admin/Invoice/Index', ['invoices' => $invoices, 'user' => Auth::user()]);

    }
    public function details(Invoice $invoice)
    {
        return Inertia::render('Admin/Invoice/Details', ['Invoice' => $invoice]);
    }

    public function generatePdf(Invoice $invoice) {
        dd($invoice);
        // return DOMPDF
    }

    public function createIndex(){
        $usersList = User::all(
            "id",
            "first_name", 
            "last_name", 
            "email",
        );
        return Inertia::render('Admin/Invoice/Create', ['usersList' => $usersList, 'user' => Auth::user()]);
    }

    public function create(Request $request)
    {
        $pathToFile = $request->file('file')->store('invoices', 'public');
        $invoice = Invoice::create([
            'invoice_name' => $request->get('invoiceName'),
            'invoice_path' => $pathToFile,
            'user_id' => $request->get('userId'),
        ]);

        return ['invoice' => $invoice];
    }
    
    public function updateIndex(Invoice $invoice, Request $request)
    {
        $client = User::find($invoice['user_id']);
        return Inertia::render('Admin/Invoice/Update',['invoice' => $invoice, 'client'=>$client, 'user' => Auth::user()]);
    }
}
