<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
   protected $fillable = [
        'customer_name',
        'table_number',
        'optional_message',
        'payment_method',
        'cart_items',
    ];
    public function items()
    {
        return $this->hasMany(TransactionItem::class);
    }
}
