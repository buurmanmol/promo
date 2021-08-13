<?php

namespace App\Http\Controllers;

use App\Models\Repair;
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
        $invoices = Invoice::with('user')
        ->orderBy('created_at', 'DESC')
        ->paginate(10);

        return Inertia::render('Admin/Invoice/Index', ['invoices' => $invoices, 'user' => Auth::user(), 'company' => Auth::user()->company]);

    }

    public function updateWallet(Company $company, Request $request){
        $price = $request->get('price');
        $newWallet = $company->wallet - $request->get('price');

        $company->update(['wallet' => $newWallet]);

        return ['company' => $company];
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
    public function createIndex(Repair $repair, User $user){
        $usersList = User::all(
            "id",
            "first_name",
            "last_name",
            "company_id",
            "email",
        );
        
        if($user->id !== null){
            $usersList =User::select(
                "id",
                "first_name",
                "last_name",
                "company_id",
                "email",
            )
            ->where("id", $user->id)->get(); 
        }
        return Inertia::render('Admin/Invoice/Create', ['repair'=>$repair, 'usersList' => $usersList, 'selectedPerson' => $user, 'user' => Auth::user(), 'company' => Auth::user()->company]);
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

        if($request->file('file') !== null){
            $pathToFile = $request->file('file')->store('invoices', 'public');
            $invoice = Invoice::create([
                'invoice_name' => $request->get('invoiceName'),
                'invoice_path' => $pathToFile,
                'user_id' => $request->get('userId'),
                'price' => $request->get('price'),
            ]);

            $repair = '';
            if($request->get('repairId') !== 'undefined') {
                $repair = Repair::find($request->get('repairId'));
                $repair->invoice_id = $invoice->id;
                $repair->save();
            }
            return ['invoice' => $invoice, 'repair' => $repair];
        }



        $invoice = Invoice::create([
            'invoice_name' => $request->get('invoiceName'),
            'user_id' => $request->get('userId'),
        ]);
        $repair = '';
//        dd($request->get('repairId'));
        if($request->get('repairId') !== 'undefined') {
            $repair = Repair::find($request->get('repairId'));
            $repair->invoice_id = $invoice->id;
            $repair->save();
        }
        return ['invoice' => $invoice, 'repair' => $repair];
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
        return Inertia::render('Admin/Invoice/Update',['invoice' => $invoice, 'client'=>$client, 'user' => Auth::user(), 'company' => Auth::user()->company]);
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
     * uploads PDF
     *
     * @author Kevin
     *
     * @version 1.0.0
     */
    public function uploadPdf(Request $request){
        $pathToFile = "File Not Found";
        if($request->file('file') !== null){
            $pathToFile = $request->file('file')->store('invoices', 'public');
        }
        return $pathToFile;

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
    public function getInvoices(Request $request){

        $invoices = Invoice::with('user')
        ->orderBy('created_at', 'DESC')
        ->paginate(10, ['*'], 'page', $request->get('page'));
        return ['invoices' => $invoices ];

    }


    public function searchInvoice(Request $request)
    {
        $invoices = Invoice::with('user')
        ->orderBy('created_at', 'DESC')
        ->where('invoice_name', 'LIKE','%'. $request
        ->get('search') . '%')
        ->paginate(10)
        ->setPath('/admin/invoices');
//        dd($companies);
        return ['invoices' => $invoices];
    }

    //================= Company part ===================//
    /**
     * returns managerIndex
     */
    public function companyIndex(){


        $users = User::where('company_id', Auth::user()->company->id)->get();
        $managerArray = [];
        foreach ($users as $user) {
            if ($user->role === 'manager') {
                array_push($managerArray, $user);
            }
        }
        foreach($managerArray as $manager) {
            $users = User::with('invoices')
            ->where('manager_id', $manager->id)
            ->get();
            $manager->users = $users;
        }

        return Inertia::render('Company/Invoice/Index', ['managers' => $managerArray, 'user' => Auth::user(), 'company' => Auth::user()->company]);
     }

    //================= Manager part ===================//
    /**
     * returns managerIndex
     */
    public function managerIndex(){

        $staff = User::with('invoices')
        ->where('company_id', Auth::user()->company_id)
        ->where('manager_id', Auth::user()->id)
        ->paginate(10);

         return Inertia::render('Manager/Invoice/Index', ['staff' => $staff, 'user' => Auth::user(), 'company' => Auth::user()->company]);
     }

    //================= User part ===================//

    /**
     * returns userIndex
     */
    public function userIndex(){

       $invoices = Invoice::where('user_id', Auth::user()['id'])
       ->orderBy('created_at','DESC')
       ->get(['id','invoice_name', 'created_at', 'price']);

        return Inertia::render('User/Invoice/Index', ['invoices' => $invoices, 'user' => Auth::user(), 'company' => Auth::user()->company]);
    }
}
