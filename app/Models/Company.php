<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'name',
        'address',
        'postal_code',
        'phone_number',
        'wallet',
        'email'
    ];
    public function users()
    {
        return $this->belongsToMany(User::class);
    }

}
