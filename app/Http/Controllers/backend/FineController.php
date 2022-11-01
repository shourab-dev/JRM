<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Fine;
use Illuminate\Http\Request;

class FineController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'ids' => 'required',
            'amount' => 'required'
        ]);
        foreach ($request->ids as $studentId) {
            $fine = new Fine();
            $fine->student_id = $studentId;
            $fine->amount = $request->amount;
            $fine->is_paid = $request->is_paid ?? 0;
            $fine->save();
        }
        return response('Successfully Fines Added 😃', 200);
    }
}
