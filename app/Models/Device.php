<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    use HasFactory;
    protected $fillable = ['brands_models_id', 'product_type_id', 'user_id', 'is_repaired'];

    public function productType()
    {
        return $this->belongsTo(ProductType::class);
    }

    public function brandsModels()
    {
        return $this->belongsTo(BrandsModel::class);
    }

    public function repairs()
    {
        return $this->belongsToMany(Repair::class);
    }

    public function user()
    {
        return $this->hasOne(User::class);
    }
}
