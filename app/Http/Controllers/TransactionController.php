<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Transaction;
use Carbon\Carbon;

class TransactionController extends Controller
{
    public function showAllTransactions()
    {
        $user = auth()->user();
        $transactions = Transaction::where('user_id', $user->id)->get();
        $currentBalance = $user->balance;
        return view('welcome',compact('transactions','currentBalance'));
    }

    public function showDeposits()
    {
        $user = auth()->user();
        $deposits = Transaction::where('user_id', $user->id)
            ->where('transaction_type', 'deposit')
            ->get();
        return view('pages.deposit',compact('deposits'));
    }

    public function deposit(Request $request)
    {
        $user = User::find($request->input('user_id'));
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        // Validation (You can add more validation rules as needed)
        $request->validate([
            'amount' => 'required|numeric|min:0.01',
        ]);

        // Update the user's balance
        $amount = $request->input('amount');
        $user->balance += $amount;
        $user->save();

        // Create a deposit transaction
        $transaction = new Transaction([
            'user_id' => $user->id,
            'transaction_type' => 'deposit',
            'amount' => $amount,
            'fee' => 0, // No fee for deposits
            'date' => Carbon::now(),
        ]);
        $transaction->save();

        return back();
    }

    public function showWithdrawals()
    {
        $user = auth()->user();
        $withdrawals = Transaction::where('user_id', $user->id)
            ->where('transaction_type', 'withdrawal')
            ->get();
        return view('pages.withdrawl',compact('withdrawals'));
    }

    public function withdraw(Request $request)
    {
        $user = User::find($request->input('user_id'));
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        // Validation (You can add more validation rules as needed)
        $request->validate([
            'amount' => 'required|numeric|min:0.01',
        ]);

        $amount = $request->input('amount');
        $withdrawalFee = 0;

        // Check account type and apply withdrawal rate and free withdrawal conditions for Individual accounts
        if ($user->account_type === 'Individual') {
            // Check if it's Friday (5) or the first withdrawal of the month
            $today = Carbon::now()->dayOfWeek;
            $firstWithdrawalOfMonth = Transaction::where('user_id', $user->id)
                ->where('transaction_type', 'withdrawal')
                ->whereMonth('date', Carbon::now()->month)
                ->count() === 0;

            if ($today === 5 || $firstWithdrawalOfMonth) {
                $withdrawalFee = 0;
            } else {
                // Apply the fee to the amount withdrawn
                $withdrawalFee = min(1000, $amount) * 0.015 + max(0, $amount - 1000) * 0.025;
            }
        } elseif ($user->account_type === 'Business') {
            // Check if the total withdrawal is over 50K to decrease the withdrawal fee
            $totalWithdrawal = Transaction::where('user_id', $user->id)
                ->where('transaction_type', 'withdrawal')
                ->sum('amount');

            if ($totalWithdrawal >= 50000) {
                $withdrawalFee = $amount * 0.015;
            } else {
                $withdrawalFee = $amount * 0.025;
            }
        }

        // Calculate the final amount to withdraw (after deducting the withdrawal fee)
        $finalWithdrawalAmount = $amount + $withdrawalFee;

        // Check if the user has sufficient balance
        if ($user->balance < $finalWithdrawalAmount) {
            return 'Insufficient Balance!';
        }

        // Update the user's balance
        $user->balance -= $finalWithdrawalAmount;
        $user->save();

        // Create a withdrawal transaction
        $transaction = new Transaction([
            'user_id' => $user->id,
            'transaction_type' => 'withdrawal',
            'amount' => $amount,
            'fee' => $withdrawalFee,
            'date' => Carbon::now(),
        ]);
        $transaction->save();

        return back() ;
    }
}
