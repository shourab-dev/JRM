<?php

namespace App\Http\Controllers\backend;

use App\Models\Student;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Fine;

class StudentController extends Controller
{

    public $rules;
    public function __construct()
    {
        $this->rules = [
            'batchId' => 'required',
            'studentNames' => 'required'
        ];
    }

    public function index()
    {
        //*
    }


    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate($this->rules, [
            'batchId.required' => 'Select a batch'
        ]);

        //*EXPLODING STUDENTS NAME;
        $studentNames = str($request->studentNames)->explode(',');

        foreach ($studentNames as $studentName) {
            $student = new Student();
            $student->batch_id = $request->batchId;
            $student->name = str($studentName)->trim()->headline();
            $student->save();
        }
        return back()->with('success', "Students Inserted Successfully");
    }


    //*GET FINE BY AJAX REQUEST
    public function getFine($id)
    {
        $fines = Student::with(['fines' => function ($q) {
            $q->latest();
        }])->select('id', 'name')->find($id);
        return json_encode($fines);
    }



    //* UPDATE FINE 
    public function updateFine(Request $request, $id)
    {
        // dd($request->all());

        $fines = Fine::where('student_id', $id)->get();
        foreach ($fines as $fine) {
            $fine->is_paid = false;
            $fine->save();
        }
        $fineIds = [];
        if ($request->updateValue) {
            foreach ($request->updateValue as $update) {
                $update = str($update)->explode(',');
                $fineId = $update[0];
                array_push($fineIds, $fineId);
            }
            $finesUpdate = Fine::find($fineIds);
            if (count($finesUpdate) > 0) {
                foreach ($finesUpdate as $updateFine) {
                    $updateFine->is_paid = true;
                    $updateFine->save();
                }
            } else {
                $finesUpdate->is_paid = true;
                $finesUpdate->save();
            }
        }




        // dd($finesUpdate);
        return back();
    }
}
