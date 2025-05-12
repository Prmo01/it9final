<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction; // make sure this matches your model

class TransactionLogController extends Controller
{
    public function index()
    {
        $transactions = Transaction::with(['items.product'])
            ->orderBy('created_at', 'desc')
            ->paginate(6);
        
        return view('transaction_log.index', compact('transactions'));
    }

}

