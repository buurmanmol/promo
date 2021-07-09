<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\BrandsModel;
use App\Models\Model;
use App\Models\Part;
use App\Models\Phone;
use App\Models\ProductType;
use Illuminate\Database\Seeder;

class TechSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $filename = public_path('files/phones.json');
        $jsondata = file_get_contents($filename);
        $data = json_decode($jsondata, true);
        $product_types = $this->unique_multidim_array($data, 'product_type');
//        dd($product_types);
        foreach($product_types as $product_type) {
//            dd($product_type['product_type']);
            ProductType::create([
                'name' => $product_type['product_type']
            ]);
        }
        $brands = $this->unique_multidim_array($data, 'brand');
        foreach($brands as $brand) {
//            dd($product_type['product_type']);
            Brand::create([
                'name' => $brand['brand']
            ]);
        }

        $models = $this->unique_multidim_array($data, 'model');
        foreach($models as $model) {
//            dd($product_type['product_type']);
            BrandsModel::create([
                'brand' => $model['brand'],
                'model' => $model['model']
            ]);
        }

//       dd($data);
//        dd($data);
        foreach ($data as $item) {
//            dd($item['name']);
            Part::create([
                'product_id' => $item['product_id'],
                'sku' => $item['sku'],
                'name' => $item['name'],
                'description' => $item['description'],
                'images' => $item['images'],
                'brand' => $item['brand'],
                'model' => $item['model'],
                'extra_model' => $item['extra_model'],
                'product_type' => $item['product_type'],
                'product_group' => $item['product_group'],
                'color' => $item['color'],
                'extra_field' => $item['extra_field'],
                'quality_label' => $item['quality_label'],
                'price' => $item['price'],
                'qty' => $item['qty'],
                'wc_product_parent' => $item['wc_product_parent'],
                'wc_product_type' => $item['wc_product_type'],
                'status' => $item['status'],


            ]);
        }
    }
    private function unique_multidim_array($array, $key)
    {
        $temp_array = array();
        $i = 0;
        $key_array = array();

        foreach ($array as $val) {
            if (!in_array($val[$key], $key_array)) {
                $key_array[$i] = $val[$key];
                $temp_array[$i] = $val;
            }
            $i++;
        }
        return $temp_array;
    }

}
