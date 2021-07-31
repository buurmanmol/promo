<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Repair extends Model
{
    use HasFactory;
    protected $fillable = ['price','invoice_id','manager_id', 'company_id','device_id', 'product_type_id', 'user_id', 'comment', 'is_repaired'];
    protected $casts = [
        'is_repaired' => 'boolean'
    ];
    public function productType()
    {
        return $this->belongsTo(ProductType::class);
    }

    public function device()
    {
        return $this->belongsTo(Device::class);
    }

    public function manager()
    {
        return $this->belongsTo(User::class);
    }


    public function company()
    {
        return $this->belongsTo(Company::class);
    }


    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }
}
