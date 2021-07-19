<?php

namespace Database\Seeders;

use App\Models\Phone;
use Illuminate\Database\Seeder;

class PhoneSeeder extends Seeder
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
//       dd($data);
//        dd($data);
       foreach($data as $item) {
//            dd($item['name']);

           Phone::create([
               'product_id' => $item['product_id'],
               'sku' => $item['sku'],
               'name' => $item['name'],
               'description' => $item['description'],
               'images' => $item['images'] ,
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
}
