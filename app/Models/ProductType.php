<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductType extends Model
{
    use HasFactory;

    protected $keyType = 'string';
    protected $table = 'product_types';

    public $incrementing = false;

    protected $fillable = [
        'name',
    ];
    public function repairs()
    {
        return $this->belongsToMany(Repair::class);
    }
}
