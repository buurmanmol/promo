<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Company;
use App\Models\Invoice;
use App\Models\ProductType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\In;
use Inertia\Inertia;
use const http\Client\Curl\AUTH_ANY;

class PartController extends Controller
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

        $parts = ProductType::orderBy('name', 'ASC')->paginate(20);
        return Inertia::render('Admin/Part/Index', ['parts' => $parts, 'user' => Auth::user(), 'company' => Auth::user()->company]);

    }
    public function searchParts(Request $request)
    {
        $parts = ProductType::where('name', 'LIKE','%'. $request->get('search') . '%')->paginate(10)->setPath('/admin/parts');
        return ['parts' => $parts];
    }


    /**
     * Gets a list of all users, passes it to and loads the create.vue
     *
     * @author Kevin
     *
     * @version 1.0.0
     */
    public function createIndex(){
        $parts = ProductType::all();
        return Inertia::render('Admin/Part/Create', ['parts' => $parts]);
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
        $part = ProductType::create([
            'name' => $request->get('name'),
        ]);

        return ['parts' => $part];
    }


    /**
     * deletes incoming part
     *
     * @author Kevin
     *
     * @version 1.0.0
     */
    public function delete(ProductType $part){
        $part->delete();
        return ['part' => $part];
    }

    /**
     * gets a list of all invoices, linked with user where user.id = invoice.user_id
     *
     * @author Kevin
     *
     * @version 1.0.0
     */
    public function getParts(Request $request){

        $parts = ProductType::orderBy('created_at', 'DESC')
        ->paginate(10, ['*'], 'page', $request->get('page'))->setPath('/admin/parts');
        return ['parts' => $parts ];

    }

}
