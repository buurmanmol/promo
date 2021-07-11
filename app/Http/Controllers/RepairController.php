<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\BrandsModel;
use App\Models\Model;
use App\Models\ProductType;
use App\Models\Repair;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class RepairController extends Controller
{
    public function repairIndex()
    {
        $repair = Repair::with('productType', 'brandsModels')->where('user_id', auth()->user()->id)->get();

        return Inertia::render('User/Repair/Index', ['repairs' => $repair, 'user' => Auth::user()]);
    }

    public function createRepairs(User $user, Request $request)
    {
        $repairs = $request->all();
        foreach($repairs as $repair) {
            Repair::create([
                'brands_models_id' => $repair['model']['id'],
                'comment' => $repair['comment'],
                'product_type_id' => $repair['productType']['id'],
                'user_id' => $user->id,
            ]);
        }
        return $repairs;
    }

    public function completeIndex()
    {
        $repairs = Repair::with('brandsModels', 'productType')->where('user_id', Auth::user()->id)->get();
        return Inertia::render('User/Repair/Complete', ['user' => Auth::user(), 'repairs' => $repairs]);
    }

    public function createIndex()
    {
        $brands = Brand::all();
        $productTypes = ProductType::all();
        $models = BrandsModel::all();

        return Inertia::render('User/Repair/Create', ['user' => Auth::user(), 'models' => $models, 'brands' => $brands, 'productTypes' => $productTypes]);
    }
}
