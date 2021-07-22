<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\BrandsModel;
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
        $phone = BrandsModel::all();

        return ['data' => $phone];
    }

    public function index()
    {
        $phones = BrandsModel::orderBy('brand', 'asc')->paginate(20);

        return Inertia::render('Admin/Phone/Index', ['phones' => $phones, 'user' => Auth::user()]);
    }

    public function createIndex()
    {
        $phones = Brand::orderBy('name', 'asc')->get();

        return Inertia::render('Admin/Phone/Create', ['phones' => $phones, 'user'=>  Auth::user()]);
    }

    public function update(BrandsModel $phone, Request $request)
    {
        $phone->update($request->all());
        return Inertia::render('Admin/Phone/Update', ['phone' => $phone, 'user'=>  Auth::user()]);
    }

    public function updateIndex(BrandsModel $phone, Request $request)
    {
        $phones = Brand::orderBy('name', 'asc')->get();

        return Inertia::render('Admin/Phone/Update', ['phone' => $phone,'phones' => $phones, 'user'=>  Auth::user()]);
    }

    public function details(BrandsModel $phone)
    {
        return Inertia::render('Admin/Phone/Details', ['phone' => $phone]);

    }
    public function create(Request $request){
        $brand = Brand::where('name', $request->get('brand'))->first();

        $model = BrandsModel::create([
            'brand'=> $brand->name,
            'model'=> $request->get('model'),
        ]);
        return $model;
    }

    public function delete(BrandsModel $brandsModel){
        $brandsModel->delete();
        return $brandsModel;
    }

    public function getPhones()
    {
        $brandsModel =  BrandsModel::orderBy('brand', 'asc')->paginate(20);
        return $brandsModel;
    }
}
