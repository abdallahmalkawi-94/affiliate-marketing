<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\CategoryTransaction;
use App\Models\Transaction;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse|Response
     */
    public function index()
    {
        $transactions = Transaction::all();
        return response()->json(['status' => true , 'transactions' => $transactions]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse|Response
     */
    public function store(Request $request)
    {
        try {
            $user = Auth::user();
            $category_id = $request->category_id;
            $amount = $request->amount;
            $notes = $request->notes ?? null;

            $balance = $user->balance;
            $isIncome = Category::where('id' , $category_id)->select('is_income')->first()->is_income;
            if ($isIncome) {
                $balance += $amount;
            } else {
                if ($amount > $balance) {
                    return response()->json(['status' => false , 'message' => "You don't have enough balance."]);
                } else {
                    $balance -= $amount;
                }
            }

            $this->userEloquent->update(['id' => $user->id] , ['balance' => $balance]);
            Transaction::create(
                [
                    'category_id' => $category_id,
                    'amount' => $amount,
                    'notes' => $notes,
                ]);
            return response()->json(['status' => true , 'message' => 'Transaction added successfully.']);
        } catch (Exception $exception) {
            return response()->json(["status" => false, "message" => "exception_error", "errors" => $exception->getMessage()]);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param Transaction $transaction
     * @return Response
     */
    public function show(Transaction $transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Transaction $transaction
     * @return Response
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Transaction $transaction
     * @return Response
     */
    public function update(Request $request, Transaction $transaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Transaction $transaction
     * @return Response
     */
    public function destroy(Transaction $transaction)
    {
        //
    }
}
