<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Repair extends Model
{
    use HasFactory;
    protected $fillable = ['price','device_id', 'product_type_id', 'user_id', 'comment', 'is_repaired'];

    public function productType()
    {
        return $this->belongsTo(ProductType::class);
    }

    public function device()
    {
        return $this->belongsTo(Device::class);
    }

    public function user()
    {
        return $this->hasOne(User::class);
    }
}
