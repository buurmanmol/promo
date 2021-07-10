<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Model;

class Repair extends Model
{
    use HasFactory;
    protected $fillable = ['brands_models_id', 'product_type_id', 'user_id', 'comment'];

    public function productType()
    {
        return $this->belongsTo(ProductType::class);
    }

    public function brandsModels()
    {
        return $this->belongsTo(BrandsModel::class);
    }

    public function user()
    {
        return $this->hasOne(User::class);
    }
}
