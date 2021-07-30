<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\BrandsModel;
use App\Models\Device;
use App\Models\ProductType;
use App\Models\Repair;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class DeviceController extends Controller
{
    public function update(Device $device, Request $request)
    {
        $device->update($request->all());

        return $device;
    }

    public function delete(Device $device){
        $device->delete();
        return ['device' => $device];
    }
 
    public function getDevices(Request $request){
        return User::with('devices.brandsModels','devices.productType', 'company')->paginate(10, ['*'], 'page', $request->get('page'));
        // return Inertia::render('Admin/Device/Index', ['users' => $users, 'user' => Auth::user()]);
    }
     
    public function deviceAll(User $user)
    {
        $devices = Device::where('user_id', $user->id)->get();

        foreach($devices as $device) {
            Device::where('id', $device->id)->update([
                'is_deviceed' => 1,
            ]);
        }

        return $devices;
    }

    public function deviceIndex()
    {
        $devices = Device::with('brandsModels')->where('user_id', auth()->user()->id)->paginate(20);

        return Inertia::render('User/Device/Index', ['devices' => $devices, 'company' => Auth::user()->company, 'user' => Auth::user()]);
    }

    public function deviceIndexAdmin()
    {
        $users = User::with('devices.brandsModels','devices.productType', 'company')->paginate(10);
        return Inertia::render('Admin/Device/Index', ['users' => $users, 'user' => Auth::user()]);
    }

    public function createDevices(User $user, Request $request)
    {
        $devices = $request->all();
        foreach($devices as $device) {
            Device::create([
                'brands_models_id' => $device['model']['id'],
                'user_id' => $user->id,
            ]);
        }
        return $devices;
    }

    public function completeIndex()
    {
        $devices = Device::with('brandsModels')->where('user_id', Auth::user()->id)->get();
        return Inertia::render('User/Device/Complete', ['user' => Auth::user(), 'company' => Auth::user()->company, 'devices' => $devices]);
    }

    public function createIndex()
    {
        $brands = Brand::all();
        $productTypes = ProductType::all();
        $models = BrandsModel::all();
        $users = User::with('company')->get();

        return Inertia::render('Admin/Device/Create', ['currentUser' => Auth::user(),'users' => $users, 'models' => $models, 'brands' => $brands, 'productTypes' => $productTypes]);
    }

    public function getUniqueDevices(User $user)
    {
     $devices = Device::where('user_id', $user->id)->with('brandsModels')->get();
        $arr = [];
     foreach($devices as $device) {
         array_push($arr, $device);
     }
        $a = array_unique($arr);

        return ['data' => $a];
    }

    public function create(Request $request)
    {
        $devices = $request->all();
        foreach($devices as $device) {
            Device::create([
                'brands_models_id' => $device['model']['id'],
                'user_id' => $device['user']['id'],
                'is_repaired' => 0
            ]);
        }
        return $devices;
    }
}
