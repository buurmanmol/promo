<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $table = 'invoices';

    protected $fillable = [
        'name',
        'invoice_path',
        'invoice_name',
        'user_id',
        'price',
        'id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function repair()
    {
        return $this->belongsTo(Repair::class);
    }
}
