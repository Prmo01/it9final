<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use Carbon\Carbon;

class TransactionLogController extends Controller
{
    public function index()
    {
        // Fetch paginated transactions
        $transactions = Transaction::with(['items.product'])
            ->orderBy('created_at', 'desc')
            ->paginate(6);

        // Calculate sales summaries
        $today = Carbon::today();
        $weekStart = Carbon::now()->startOfWeek();
        $yearStart = Carbon::now()->startOfYear();

        $dailySales = Transaction::whereDate('created_at', $today)
            ->sum('total_with_tax');

        $weeklySales = Transaction::whereBetween('created_at', [$weekStart, Carbon::now()])
            ->sum('total_with_tax');

        $yearlySales = Transaction::whereBetween('created_at', [$yearStart, Carbon::now()])
            ->sum('total_with_tax');

        return view('transaction_log.index', compact('transactions', 'dailySales', 'weeklySales', 'yearlySales'));
    }
}