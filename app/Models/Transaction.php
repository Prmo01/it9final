<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $table = 'transactions';

    // Define the primary key
    protected $primaryKey = 'transaction_id';

    protected $fillable = [
        'total',
        'discount',
        'total_with_tax',
        'payment_method',
        'payment_amount',
    ];

    // Define the relationship with TransactionItem
    public function items()
    {
        return $this->hasMany(TransactionItem::class, 'transaction_id');
    }
}