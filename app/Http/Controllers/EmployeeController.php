<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
{
    public function index()
    {
        $employee = Employee::orderBy('created_at', 'desc')->paginate(5); // Pagination
        return view('employee.view_employee', compact('employee'));
    }


    public function create()
    {
        return view('employee.add_employee');
    }

    public function store(Request $request)
    {
        // Validate the request
        $validated = $request->validate([
            'employee_first_name' => 'required|string|max:255',
            'employee_last_name' => 'required|string|max:255',
            'employee_email' => 'required|email',
            'employee_phone' => 'required|string|max:15',
            'employee_password' => 'required|string',
        ]);

        // Create a new employee instance
        $employee = new Employee();
        $employee->employee_first_name = $validated['employee_first_name'];
        $employee->employee_last_name = $validated['employee_last_name'];
        $employee->employee_email = $validated['employee_email'];
        $employee->employee_phone = $validated['employee_phone'];
        $employee->employee_password = Hash::make($validated['employee_password']); // Hash the password

        // Save the employee
        $employee->save();

        // Redirect with success message
        return redirect()->back()->with('success', 'Employee successfully added!');
    }



    public function edit($id)
    {
        // Fetch the employee from the database
        $employee = Employee::findOrFail($id);

        // Return the view with the employee data
        return view('employee.edit_employee', compact('employee'));
    }

    // Update the employee details
    public function update(Request $request, $id)
    {
        // Validate the incoming request data
        $validated = $request->validate([
            'employee_first_name' => 'required|string|max:255',
            'employee_last_name' => 'required|string|max:255',
            'employee_email' => 'required|email|max:255|unique:employees,employee_email,' . $id,
            'employee_phone' => 'required|numeric',
            'employee_password' => 'nullable|string|min:8|confirmed',  // Optional password field
        ]);

        // Fetch the employee from the database
        $employee = Employee::findOrFail($id);

        // Update the employee record with the validated data
        $employee->employee_first_name = $validated['employee_first_name'];
        $employee->employee_last_name = $validated['employee_last_name'];
        $employee->employee_email = $validated['employee_email'];
        $employee->employee_phone = $validated['employee_phone'];

        // If the password field is provided, hash it and update it
        if ($request->has('employee_password') && !empty($validated['employee_password'])) {
            $employee->employee_password = Hash::make($validated['employee_password']);
        }

        // Save the updated employee data
        $employee->save();

        // Flash a success message to the session
        return redirect()->route('employees.index')->with('success', 'Employee details updated successfully!');
    }

    public function destroy(Employee $employee)
    {
        // Deleting the user
        $employee->delete();

        // Redirecting with a success message
        return redirect()->route('employees.index')->with('success', 'User deleted successfully.');
    }



}
