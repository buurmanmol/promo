<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Model;

class Repair extends Model
{
    use HasFactory;

    public function phone()
    {
        return $this->hasOne(Phone::class);
    }

    public function part()
    {
        return $this->hasOne(Part::class);
    }

    public function user()
    {
        return $this->hasOne(User::class);
    }
}
