<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\BrandsModel;
use App\Models\Company;
use App\Models\Device;
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

    public function details(User $user)
    {
        $repairs = Repair::where('user_id', $user->id)->get();
        $fullArr = [];
        foreach($repairs as $repair) {
            $sameDate = Repair::where('user_id', $user->id)->whereBetween('created_at', [$repair->created_at->startOfDay(), $repair->created_at->endOfDay()])->with('productType', 'device.brandsModels') -> orderBy('created_at', 'desc')->get();
//            dd($sameDate);
            array_push($fullArr, $sameDate);
        }
        $s = array_unique($fullArr, SORT_REGULAR);
//        dd($user['id'], auth()->user()->id);

        $user->company = $user->company()->get();
        $devices = Device::with('brandsModels')->where('user_id', $user->id)->paginate(20);
        return Inertia::render('Admin/Repair/Details', ['repairs' => $s,'currentUser' => Auth::user(),'user' => $user, 'devices' => $devices]);
    }

    public function repairIndex()
    {
        $repairs = Repair::where('user_id', auth()->user()->id)->get();
        $fullArr = [];
        foreach($repairs as $repair) {
            $sameDate = Repair::where('user_id', auth()->user()->id)->whereBetween('created_at', [$repair->created_at->startOfDay(), $repair->created_at->endOfDay()])->with('productType', 'device.brandsModels') -> orderBy('created_at', 'desc')->get();
            array_push($fullArr, $sameDate);
        }
            $s = array_unique($fullArr, SORT_REGULAR);

        return Inertia::render('User/Repair/Index', ['repairs' => $s, 'currentUser' => Auth::user(), 'company' => Auth::user()->company]);
    }

    public function repairIndexAdmin()
    {
        $users = User::with(['repairs.device.brandsModels','repairs.productType','company', 'repairs' => function ($q) {
            $q->orderBy('created_at', 'desc');
        }])->paginate(10)->setPath('/admin/repairs');

        $brands_models = BrandsModel::all();
        $brands = Brand::all();
        $product_types = ProductType::all();
        return Inertia::render('Admin/Repair/Index', ['users' => $users, 'user' => Auth::user(),'brandsModels' => $brands_models, 'brands' => $brands, 'productTypes' => $product_types]);
    }

    public function create()
    {

    }

    public function createRepairs(User $user, Request $request)
    {
        $repairs = $request->all();
        foreach($repairs as $repair) {
            Repair::create([
                'comment' => $repair['comment'] || '',
                'device_id' => $repair['device']['id'],
                'product_type_id' => $repair['productType']['id'],
                'manager_id' => $user->manager_id,
                'company_id' => $repair['company']['id'],
                'user_id' => $user->id,
            ]);
        }
        return $repairs;
    }

    public function completeIndex()
    {
        $repairs = Repair::with('device.brandsModels', 'productType')->where('user_id', Auth::user()->id)->get();
        return Inertia::render('User/Repair/Complete', ['user' => Auth::user(), 'company' => Auth::user()->company, 'repairs' => $repairs]);
    }

    public function createIndexAdmin()
    {
        $users= User::with('company','devices')->get();


        $productTypes = ProductType::all();

        return Inertia::render('Admin/Repair/Create', ['users' => $users, 'currentUser' => Auth::user(), 'productTypes' => $productTypes]);
    }

    public function createIndex()
    {

        $user = User::where('id', Auth::user()->id)->with('devices.brandsModels', 'company')->firstOrFail();
        $brandsNames = [];
        $modelNames = [];

        foreach($user->devices as $device) {
            array_push($brandsNames, $device->brandsModels->brand);
            array_push($modelNames, $device->brandsModels->model);
        }
        $uBrands = array_unique($brandsNames);
        $uModels = array_unique($modelNames);

        $brands = Brand::whereIn('name', $uBrands)->get();
        $productTypes = ProductType::all();
        $models = BrandsModel::whereIn('model', $uModels)->get();

        return Inertia::render('User/Repair/Create', ['devices' => $user->devices,'currentUser' => Auth::user(), 'company' => Auth::user()->company, 'models' => $models, 'brands' => $brands, 'productTypes' => $productTypes]);
    }

    public function indexManager()
    {
        $user = Auth::user();

        $users = User::with(['repairs.device.brandsModels','repairs.productType','company', 'repairs' => function ($q) use ($user) {
            $q->where('manager_id', $user->id);
        }])->get();


        return Inertia::render('Manager/Repair/Index', ['users' => $users, 'currentUser' => Auth::user(), 'company' => Auth::user()->company]);
    }

    public function detailsCompany(User $user)
    {
        $repairs = Repair::where('user_id', $user->id)->get();
        $fullArr = [];
        foreach($repairs as $repair) {
            $sameDate = Repair::where('user_id', $user->id)->whereBetween('created_at', [$repair->created_at->startOfDay(), $repair->created_at->endOfDay()])->with('productType', 'device.brandsModels') -> orderBy('created_at', 'desc')->get();
//            dd($sameDate);
            array_push($fullArr, $sameDate);
        }
        $s = array_unique($fullArr, SORT_REGULAR);
//        dd($user['id'], auth()->user()->id);

        $user->company = $user->company()->get();
        $devices = Device::with('brandsModels')->where('user_id', $user->id)->paginate(20);
        return Inertia::render('Company/Repair/Details', ['company' => $user->company()->get(), 'repairs' => $s,'currentUser' => Auth::user(),'user' => $user, 'devices' => $devices]);
    }

    public function detailsManager(User $user)
    {
        $repairs = Repair::where('user_id', $user->id)->get();
        $fullArr = [];
        foreach($repairs as $repair) {
            $sameDate = Repair::where('user_id', $user->id)->whereBetween('created_at', [$repair->created_at->startOfDay(), $repair->created_at->endOfDay()])->with('productType', 'device.brandsModels') -> orderBy('created_at', 'desc')->get();
//            dd($sameDate);
            array_push($fullArr, $sameDate);
        }
        $s = array_unique($fullArr, SORT_REGULAR);
//        dd($user['id'], auth()->user()->id);

        $user->company = $user->company()->get();
        $devices = Device::with('brandsModels')->where('user_id', $user->id)->paginate(20);
        return Inertia::render('Manager/Repair/Details', ['company' => $user->company()->get(), 'repairs' => $s,'currentUser' => Auth::user(),'user' => $user, 'devices' => $devices]);
    }


    public function indexCompany()
    {
        $users = User::where('company_id', Auth::user()->company->id)->get();
        $managerArray = [];
        foreach ($users as $user) {
            if ($user->role === 'manager') {
                array_push($managerArray, $user);
            }
        }
        foreach($managerArray as $manager) {
            $users = User::with(['repairs.device.brandsModels','repairs.productType','company', 'repairs' => function ($q) use ($manager) {
                $q->where('manager_id', $manager->id);
            }])->get();
            $manager->users = $users;
        }
        return Inertia::render('Company/Repair/Index', ['currentUser' => Auth::user(),'managers' => $managerArray, 'company' => Auth::user()->company]);
    }
}
