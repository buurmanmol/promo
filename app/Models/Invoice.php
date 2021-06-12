<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'name',
        'factuur_id',
        'aantal',
        'omschrijving',
        'bedrag',
        'user_id',
        'company_id'
    ];
    public function user()
    {
        return $this->hasOne(User::class);
    }
}
