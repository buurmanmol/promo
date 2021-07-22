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

    /**
     * returns the index page for invoices
     * 
     * @author Kevin
     * 
     * @version 1.0.0
     */
    public function index()
    {   
        return Inertia::render('Admin/Invoice/Index', ['user' => Auth::user()]);

    }

    /**
     * Generates a pdf and allowes it to be downloaded
     * 
     * @author Kevin
     * 
     * @version 2.0.0
     */
    public function generatePdf(Invoice $invoice) {
        $pdfPath = storage_path("app/public/" .$invoice->invoice_path);
        return response()->download($pdfPath);
    }

    /**
     * Gets a list of all users, passes it to and loads the create.vue
     * 
     * @author Kevin
     * 
     * @version 1.0.0
     */
    public function createIndex(){
        $usersList = User::all(
            "id",
            "first_name", 
            "last_name", 
            "email",
        );
        return Inertia::render('Admin/Invoice/Create', ['usersList' => $usersList, 'user' => Auth::user()]);
    }

    /**
     * Stores uploaded file and saves the path
     * Creates invoice with all data
     * 
     * @author Kevin
     * 
     * @version 1.0.0
     */
    public function create(Request $request)
    {
        $pathToFile = $request->file('file')->store('invoices', 'public');
        $invoice = Invoice::create([
            'invoice_name' => $request->get('invoiceName'),
            'invoice_path' => $pathToFile,
            'user_id' => $request->get('userId'),
            'price' => $request->get('price'), 
        ]);

        return ['invoice' => $invoice];
    }
    
    /**
     * finds client linked to the given invoice
     * loads update page
     * 
     * @author Kevin
     * 
     * @version 1.0.0
     */
    public function updateIndex(Invoice $invoice, Request $request)
    {
        $client = User::find($invoice['user_id']);
        return Inertia::render('Admin/Invoice/Update',['invoice' => $invoice, 'client'=>$client, 'user' => Auth::user()]);
    }

    /**
     * updates invoice
     * 
     * @author Kevin
     * 
     * @version 1.0.0
     */
    public function update(Invoice $invoice, Request $request){
        $invoice->update($request->all());
        return ['invoice' => $invoice];
    }

    /**
     * deletes incoming invoice
     * 
     * @author Kevin
     * 
     * @version 1.0.0
     */
    public function delete(Invoice $invoice){
        $invoice->delete();
        return ['invoice' => $invoice];
    }
    
    /**
     * gets a list of all invoices, linked with user where user.id = invoice.user_id
     * 
     * @author Kevin
     * 
     * @version 1.0.0
     */
    public function getInvoices(){
        return Invoice::join('users', 'users.id', '=', 'invoices.user_id')
        ->orderBy('invoices.created_at','DESC')
        ->get(['users.first_name', 'users.last_name', 'users.email', 'users.phone_number', 'invoices.id', 'invoices.invoice_name', 'invoices.created_at', 'invoices.price', 'invoices.created_at']);
        
    }


    //================= User part ===================//

    /**
     * returns userIndex
     */
    public function userIndex(){
    
       $invoices = Invoice::where('user_id', Auth::user()['id'])
       ->orderBy('created_at','DESC')
       ->get(['id','invoice_name', 'created_at', 'price']); 

        return Inertia::render('User/Invoice/Index', ['invoices' => $invoices, 'user' => Auth::user()]);
    }
}
