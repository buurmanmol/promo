<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\BrandsModel;
use Illuminate\Http\Request;

class BrandsModelsController extends Controller
{
    public function getBrandModels(Brand $brand)
    {
        $models = BrandsModel::where('brand', $brand->name)->get();

        return ['data' => $models];
    }

    public function getBrandsModelsByName(Request $request)
    {
        $models = BrandsModel::where('brand', $request->get('brand'))->get();
//        dd($models);
        return ['data' => $models];
    }
}
