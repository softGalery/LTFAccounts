<?php

namespace App\Http\Controllers;

use App\Models\Liability;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Auth;

class LiabilityController extends Controller
{
   public function index()
   {
         return view('admin.pages.liability');
   }

   public function getLiabilty()
   {
    $user_id = Auth::id();
    return Liability::where('user_id', $user_id)->get();
   }

   // This section is for creating a new liability
   public function createLiability(Request $request)
        {
            $validatedData = $request->validate([
                'loan_name' => 'required|string|max:255',
                'lender_name' => 'required|string|max:255',
                'loan_amount' => 'required|numeric|min:0',
                'interest_rate' => 'required|numeric|min:0',
                'start_date' => 'required|date',
                'end_date' => 'required|date|after_or_equal:start_date',
                'paid' => 'required|numeric|min:0',
                'notes' => 'nullable|string|max:1000',
            ]);

            try {

                $user_id = Auth::id();
                $loan_amount = (float) $validatedData['loan_amount'];
                $interest_rate = (float) $validatedData['interest_rate'];
                $paid = (float) $validatedData['paid'];

                // Calculate total amount
                $total_amount = $loan_amount + ($loan_amount * ($interest_rate / 100));

                // Prevent overpayment
                if ($paid > $total_amount) {
                    return response()->json([
                        'status' => 'error',
                        'message' => 'Paid amount cannot exceed total amount.'
                    ], 422);
                }

                // Calculate outstanding amount
                $remaining_amount = $total_amount - $paid;

                $liability = Liability::create([
                    'loan_name' => $validatedData['loan_name'],
                    'lender_name' => $validatedData['lender_name'],
                    'loan_amount' => $loan_amount,
                    'interest_rate' => $interest_rate,
                    'start_date' => $validatedData['start_date'],
                    'end_date' => $validatedData['end_date'],
                    'paid' => $paid,
                    'total_amount' => $total_amount,
                    'outstanding_amount' => $remaining_amount,
                    'notes' => $validatedData['notes'] ?? null,
                    'user_id' => $user_id,
                ]);

                return response()->json([
                    'status' => 'success',
                    'message' => 'Liability created successfully',
                    'data' => $liability
                ], 201);

            } catch (\Exception $e) {

                return response()->json([
                    'status' => 'failed',
                    'message' => 'Failed to create liability',
                    'error' => $e->getMessage()
                ], 500);
            }
        }

    public function deleteLiability(Request $request)
    {
        $user_id = Auth::id();
        $liability_id = $request->input('id');

        return Liability::where('id', $liability_id)->where('user_id', $user_id)->delete();
    }

}
