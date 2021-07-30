<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
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
        return $this->hasMany(User::class);
    }
    public function managers() {
        $managers = User::where('company_id', $this->id)->where('role', 'manager')->get();
        dd($managers);
        return $managers;
    }
    public function repairs()
    {
        return $this->hasMany(Repair::class);
    }
}
