<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\AccountsPayable;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccountsPayableController extends Controller
{
    public function index()
    {
        return view('admin.pages.accountspayable');
    }

    public function listAccountsPayable()
    {
        $user_id = auth::user()->id;
        return AccountsPayable::where('user_id', $user_id)->get();
    }
    public function createAccountsPayable(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'nullable|string|max:255',
        'invoice_number' => 'required|string|max:255',
        'bill_date' => 'required|date',
        'due_date' => 'required|date|after_or_equal:bill_date',
        'total_amount' => 'required|numeric|min:0',
        'paid_amount' => 'required|numeric|min:0|lte:total_amount',
        'status' => 'required|string|max:255',
        'note' => 'nullable|string|max:255'
    ]);

    try {

        $user_id = auth()->id();

        $totalAmount = (float) $request->input('total_amount');
        $paidAmount = (float) $request->input('paid_amount');

        // Calculate balance automatically
        $balance = $totalAmount - $paidAmount;

        $accountsPayable = AccountsPayable::create([
            'user_id' => $user_id,
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'invoice_number' => $request->input('invoice_number'),
            'bill_date' => $request->input('bill_date'),
            'due_date' => $request->input('due_date'),
            'total_amount' => $totalAmount,
            'paid_amount' => $paidAmount,
            'balance_amount' => $balance,
            'status' => $request->input('status'),
            'note' => $request->input('note')
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Accounts Payable created successfully',
            'data' => $accountsPayable
        ], 201);

    } catch (Exception $e) {

        return response()->json([
            'status' => 'error',
            'message' => 'Failed to create Accounts Payable',
            'error' => $e->getMessage()
        ], 500);
    }
}

}
