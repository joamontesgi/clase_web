<?php

namespace App\Http\Controllers;
use App\Models\Employee;

use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index()
    {
        $employes = Employee::all();
        return response()->json($employes);
    }

    public function store(Request $request)
    {
        $employee = new Employee();
        $employee->name = $request->name;
        $employee->last_name = $request->last_name;
        $employee->salary = $request->salary;
        $employee->save();
        return response()->json($employee); 
    }
}
