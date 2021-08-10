<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\BrandsModel;
use App\Models\Company;
use App\Models\Device;
use App\Models\Model;
use App\Models\ProductType;
use App\Models\Repair;
use App\Models\Invoice;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Pagination\CursorPaginator;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class RepairController extends Controller
{

    public function planRepair(Repair $repair, Request $request)
    {
        $date = Carbon::create($request->get('repair_date'));
//        dd($request->get('repair_date'), $date);

//        dd($date);
        $repair->update([
           'repair_date' => $date
        ]);

        return $repair;
    }

    public function update(Repair $repair, Request $request)
    {
     $updated = $repair->update($request->all());
     return $updated . $repair;
    }

    public function updateIsRepaired(Repair $repair, Request $request)
    {
        $repair->update([
            'is_repaired' => $request->get('is_repaired')
        ]);

        return $repair;
    }

    public function delete(Repair $repair)
    {
        $repair->delete();
        return "deleted";
    }

    public function repairItem(Repair $repair)
    {
        $repair->update([
            'is_repaired' => true
        ]);

        return $repair;
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

    public function getRepairsPerUser(User $user) {
        $repairs = Repair::where('user_id', $user->id)->get();
        $fullArr = [];
        foreach($repairs as $repair) {
            $sameDate = Repair::where('user_id', $user->id)->whereBetween('created_at', [$repair->created_at->startOfDay(), $repair->created_at->endOfDay()])->with('productType', 'device.brandsModels') -> orderBy('created_at', 'desc')->get();
//            dd($sameDate);
            array_push($fullArr, $sameDate);
        }
        $s = array_unique($fullArr, SORT_REGULAR);
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

    public function searchRepairIndexAdmin(Request $request)
    {
        $newUsers = User::with(['repairs.device.brandsModels','repairs.productType','company', 'repairs' => function ($q) {
            $q->orderBy('created_at', 'desc');
        }])->where(function ($query) use($request) {
                $query->where('first_name', 'like', '%' . $request->get('search') . '%')
                    ->orWhere('last_name', 'like', '%' . $request->get('search') . '%');
            })->get();

        $array = [];
        foreach ($newUsers as $user) {
            $count = 0;
            foreach ($user->repairs as $repair) {
                if($repair->is_repaired === true){
                    $count++;
                }
            }
            if ($count < count($user->repairs)) {
                array_push($array, $user);
            }
        }
        foreach ($newUsers as $user) {
            $count = 0;

            foreach ($user->repairs as $repair) {

                if($repair->is_repaired === true){
                    $count++;
                }
            }
            if($count === count($user->repairs)) {
                array_push($array, $user);
            }
        }

//        dd($array);
        $data = $this->paginate($array);

        return ['users' => $data];
    }


    public function repairIndexAdmin()
    {
        $newUsers = User::with(['repairs.device.brandsModels','repairs.productType','company', 'repairs' => function ($q) {
            $q->orderBy('created_at', 'desc');
        }])->get();

        $array = [];
        foreach ($newUsers as $user) {
            $count = 0;
            foreach ($user->repairs as $repair) {
                if($repair->is_repaired === true){
                    $count++;
                }
            }
            if ($count < count($user->repairs)) {
                array_push($array, $user);
            }
        }
        foreach ($newUsers as $user) {
            $count = 0;

            foreach ($user->repairs as $repair) {

                if($repair->is_repaired === true){
                    $count++;
                }
            }
            if($count === count($user->repairs)) {
                array_push($array, $user);
            }
        }

//        dd($array);
        $data = $this->paginate($array);
        $brands_models = BrandsModel::all();
        $brands = Brand::all();
        $product_types = ProductType::all();
        return Inertia::render('Admin/Repair/Index', ['users' => $data, 'user' => Auth::user(),'brandsModels' => $brands_models, 'brands' => $brands, 'productTypes' => $product_types]);
    }
    public function paginate($items, $perPage = 10, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
       $pagination = new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
       $pagination->setPath('/admin/repairs') ;
       return $pagination;
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
                'manager_id' => $repair['manager'],
                'company_id' => $repair['company']['id'],
                'repair_date' => $repair['repair_date'],
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

        $sundays = [];
        $startDate = Carbon::parse(Carbon::now())->next(Carbon::SUNDAY);
        $endDate = Carbon::now()->add(1,'year');
        for ($date = $startDate; $date->lte($endDate); $date->addWeek()) {
            $sundays[] = $date->format('Y-m-d');
        }

        return Inertia::render('Admin/Repair/Create', ['sundays' => $sundays, 'users' => $users, 'currentUser' => Auth::user(), 'productTypes' => $productTypes]);
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

        $sundays = [];
        $startDate = Carbon::parse(Carbon::now())->next(Carbon::SUNDAY);
        $endDate = Carbon::now()->add(1,'year');
        for ($date = $startDate; $date->lte($endDate); $date->addWeek()) {
            $sundays[] = $date->format('Y-m-d');
        } 

        return Inertia::render('User/Repair/Create', ['sundays' => $sundays, 'devices' => $user->devices,'currentUser' => Auth::user(), 'company' => Auth::user()->company, 'models' => $models, 'brands' => $brands, 'productTypes' => $productTypes]);
    }

    public function indexManager()
    {
        $user = Auth::user();

        $users = User::with(['repairs.device.brandsModels','repairs.productType','company', 'repairs'])->where('manager_id', $user->id)->get();
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
        $invoices = Invoice::where('user_id', $user->id)
        ->orderBy('created_at','DESC')
        ->paginate(20);

        return Inertia::render('Company/Repair/Details', ['invoices' => $invoices, 'company' => $user->company()->first(), 'repairs' => $s,'currentUser' => Auth::user(),'user' => $user, 'devices' => $devices]);
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

        $user->company = $user->company()->first();
        $devices = Device::with('brandsModels')->where('user_id', $user->id)->paginate(20);
        return Inertia::render('Manager/Repair/Details', ['company' => $user->company()->first(), 'repairs' => $s,'currentUser' => Auth::user(),'user' => $user, 'devices' => $devices]);
    }

    public function managerCreate()
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

        $sundays = [];
        $startDate = Carbon::parse(Carbon::now())->next(Carbon::SUNDAY);
        $endDate = Carbon::now()->add(1,'year');
        for ($date = $startDate; $date->lte($endDate); $date->addWeek()) {
            $sundays[] = $date->format('Y-m-d');
        }

        return Inertia::render('Manager/Repair/Create', ['sundays' => $sundays, 'devices' => $user->devices,'currentUser' => Auth::user(), 'company' => Auth::user()->company, 'models' => $models, 'brands' => $brands, 'productTypes' => $productTypes]);
    }

    public function repairAll(Repair $repair)
    {
           $repair->update([
               'is_repaired' => 1
           ]);

        return ['data' => $repair];
    }

    public function companyCreate()
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

        $sundays = [];
        $startDate = Carbon::parse(Carbon::now())->next(Carbon::SUNDAY);
        $endDate = Carbon::now()->add(1,'year');
        for ($date = $startDate; $date->lte($endDate); $date->addWeek()) {
            $sundays[] = $date->format('Y-m-d');
        }

        return Inertia::render('Company/Repair/Create', ['sundays' => $sundays, 'devices' => $user->devices,'currentUser' => Auth::user(), 'company' => Auth::user()->company, 'models' => $models, 'brands' => $brands, 'productTypes' => $productTypes]);
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
            $users = User::with(['repairs.device.brandsModels','repairs.productType','company', 'repairs'])->where('manager_id', $manager->id)->get();
            $manager->users = $users;
        }
        
//        dd($managerArray);
        return Inertia::render('Company/Repair/Index', ['currentUser' => Auth::user(),'managers' => $managerArray, 'company' => Auth::user()->company]);
    }
}
