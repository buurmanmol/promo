<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Model;

class Part extends Model
{
    use HasFactory;
    public function phone()
    {
        return $this->hasOne(Phone::class);
    }

    public function repairs()
    {
        return $this->belongsToMany(Repair::class);
    }
}
