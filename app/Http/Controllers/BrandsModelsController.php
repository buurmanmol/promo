<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\BrandsModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BrandsModelsController extends Controller
{
    public function getBrandModels(Brand $brand)
    {
        $models = BrandsModel::where('brand', $brand->name)->get();

        return ['data' => $models];
    }

    public function getUserBrandModels(Brand $brand)
    {
        $user = User::where('id', Auth::user()->id)->with('devices.brandsModels')->firstOrFail();
        $modelNames = [];
        foreach($user->devices as $device) {
            array_push($modelNames, $device->brandsModels->model);
        }
        $uModels = array_unique($modelNames);

        $models = BrandsModel::where('brand', $brand->name)->whereIn('model', $uModels)->get();

        return ['data' => $models];
    }

    public function getBrandsModelsByName(Request $request)
    {
        $models = BrandsModel::where('brand', $request->get('brand'))->get();
//        dd($models);
        return ['data' => $models];
    }
}
