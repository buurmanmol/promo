<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\BrandsModel;
use App\Models\Model;
use App\Models\ProductType;
use App\Models\Repair;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class RepairController extends Controller
{
    public function update(Repair $repair, Request $request)
    {
     $repair->update($request->all());

     return $repair;
    }

    public function repairAll(User $user)
    {
        $repairs = Repair::where('user_id', $user->id)->get();

        foreach($repairs as $repair) {
            Repair::where('id', $repair->id)->update([
                'is_repaired' => 1,
            ]);
        }

        return $repairs;
    }

    public function repairIndex()
    {
        $repairs = Repair::where('user_id', auth()->user()->id)->get();
        $fullArr = [];
        foreach($repairs as $repair) {
            $sameDate = Repair::whereBetween('created_at', [$repair->created_at->startOfDay(), $repair->created_at->endOfDay()])->with('productType', 'brandsModels')->get();
            array_push($fullArr, $sameDate);
        }
            $s = array_unique($fullArr, SORT_REGULAR);

        foreach($s as $i) {
            $i->date = $i[0]->created_at;
        }

        return Inertia::render('User/Repair/Index', ['repairs' => $s, 'user' => Auth::user()]);
    }

    public function repairIndexAdmin()
    {
        $users = User::with('repairs.brandsModels','repairs.productType', 'company')->get();
        $brands_models = BrandsModel::all();
        $brands = Brand::all();
        $product_types = ProductType::all();
        return Inertia::render('Admin/Repair/Index', ['users' => $users, 'user' => Auth::user(),'brandsModels' => $brands_models, 'brands' => $brands, 'productTypes' => $product_types]);
    }

    public function createRepairs(User $user, Request $request)
    {
        $repairs = $request->all();
        foreach($repairs as $repair) {
            Repair::create([
                'brands_models_id' => $repair['model']['id'],
                'comment' => $repair['comment'] || '',
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
