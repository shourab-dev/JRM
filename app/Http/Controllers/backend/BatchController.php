<?php

namespace App\Http\Controllers\backend;

use App\Models\Batch;
use App\Models\Student;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BatchController extends Controller
{
    public function index()
    {
        $batches =  Batch::withCount('students')->simplePaginate(15);

        return view('backend.batch.manage', compact('batches'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:batches,name'
        ]);

        $batch = new Batch();
        $this->batchHandler($batch, $request);
        return back()->with('success', 'Batch Inserted Successfully');
    }


    public function batchHandler($batch, $request)
    {
        $batch->name = $request->name;
        $batch->slug = str($request->name)->slug();
        $batch->save();
    }

    public function batchEdit(Batch $editedBatch)
    {
        $batches =  Batch::simplePaginate(15);

        return view('backend.batch.manage', compact('batches', 'editedBatch'));
    }
    public function update(Request $request, Batch $editedBatch)
    {
        $request->validate([
            'name' => 'required'
        ]);

        $this->batchHandler($editedBatch, $request);
        return to_route('batch.add')->with('success', "Batch Updated ☺ ");
    }


    public function view(Batch $batch)
    {
        $singleBatchInfo = Batch::with('students.fines')->select('id')->find($batch->id);
        $students = $singleBatchInfo->students->collect();
        $studentsDetails = [];

        foreach ($students as $student) {

            $total = $student->fines->sum('amount');
            $left = $student->fines->filter(function ($value) {
                return  $value->is_paid == 0;
            })->sum('amount');

            $studentsDetails[] = ['id' => $student->id, 'name' => $student->name, 'unPaid' => $left, 'total' => $total];
        }

        // dd($studentsDetails);

        return view('backend.batch.batchView', compact('batch', 'studentsDetails'));
    }
}
