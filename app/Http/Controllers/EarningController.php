<?php

namespace App\Http\Controllers;

use App\Models\Earning;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class EarningController extends Controller
{
    public function index()
    {
        return view('admin.pages.earning');
    }

    public function getEarnings()
    {
        $user_id = Auth::id();
        return Earning::where('user_id', $user_id)->get();
    }

    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:50',
            'description' => 'nullable|string|max:255',
            'amount' => 'required|numeric|min:0',
            'type' => 'required|in:cash,bank,accounts_receivable',
            'earning_date' => 'required|date'
        ]);
        try {
            $user_id = Auth::id();

        $earning = Earning::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'amount' => $request->input('amount'),
            'type' => $request->input('type'),
            'earning_date' => $request->input('earning_date'),
            'user_id' => $user_id
        ]);

        return response()->json([
            'status' => 'success', 
            'message' => 'Earning created successfully',
            'data' => $earning
            ], 201);
        }
        catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to create earning'
            ], 500);
        }
    }
}
