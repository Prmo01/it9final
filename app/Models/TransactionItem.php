<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionItem extends Model
{
    use HasFactory;

    protected $table = 'transaction_items'; // Define the table name if it's not pluralized correctly

    protected $fillable = [
        'transaction_id',
        'product_id',
        'quantity',
        'price',
        'discount',
    ];

    // Define the relationship with Transaction (belongs to)
    public function transaction()
{
    return $this->belongsTo(Transaction::class, 'transaction_id');
}

    // Define the relationship with Product (belongs to)
    public function product()
{
    return $this->belongsTo(Product::class, 'product_id');
}
}
