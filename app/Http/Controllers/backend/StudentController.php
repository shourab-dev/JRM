<?php

namespace App\Http\Controllers\backend;

use App\Models\Student;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
}
