<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Model;

class Phone extends Model
{
    use HasFactory;

    public function repairs()
    {
        return $this->belongsToMany(Repair::class);
    }
    public function parts()
    {
        return $this->hasMany(Part::class);
    }

}
