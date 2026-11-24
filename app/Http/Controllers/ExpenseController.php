<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Auth;
use App\Models\Expense;

class ExpenseController extends Controller
{
    public function createExpense(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:50',
            'description' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'type' => 'required|in:cash,bank,accounts_payable',
            'expense_date' => 'required|date',
            'img' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048'
        ]);
        try{
            $user_id = Auth::id();
            $img = $request->file('img');
            $t = time();
            $file_name = $img->getClientOriginalName();
            $img_name = "{$user_id}-{$t}-{$file_name}";
            $img_url= "uploads/expenses/{$img_name}";

            // Save image after validation
            $img->move(public_path('uploads/expenses'), $img_name);

            $amount = floatval($request->input('amount'));
                                
            $expense = Expense::create([
                'name' => $request->input('name'),
                'description' =>$request->input('description'),
                'amount' => $amount,
                'type' => $request->input('type'),
                'expense_date' =>$request->input('expense_date'),
                'img' => $img_url,
                'user_id' => $user_id
            ]);
            return response()->json([
                'status' => 'success',
                'message' => 'Expense add successfully',
                'data' => $expense
            ], 201);

        }
        catch(Exception $e){
            return response()->json([
                'status' => 'failed',
                'message' => 'Failed to create expense'
            ], 500);
        }
    }
}
