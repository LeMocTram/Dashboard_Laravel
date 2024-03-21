<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'phone',
        'email',
        'address',
        'total',
        'fullname',
        'note',
        'method',
    ];

    // Định nghĩa mối quan hệ với model Customer
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
