<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BatchController extends Controller
{
    public function index()
    {
        return view('backend.batch.manage');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:batch,name'
        ]);

        $newBatch = new Batch();
        $newBatch->name = $request->name;
        $newBatch->slug = str($request->name)->slug();
        $newBatch->save();
        return back()->with('success', '');



    }
}
