<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'payment_method',
        'grand_total',
        'payment_status',
        'status',
        'currency',
        'shipping_amount',
        'shipping_method',
        'notes',
    ];
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }
    public function items()
    {
        return $this->hasMany(\App\Models\OrderItem::class);
    }

    public function product()
{
    return $this->belongsTo(Product::class);
}

    public function address()
    {
        return $this->hasOne(\App\Models\Address::class);
    }
}
