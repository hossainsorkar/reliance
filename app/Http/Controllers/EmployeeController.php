<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Branch; // Make sure Branch model is imported

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::orderBy('created_at','desc')->get();
        return view('UserManagement.employees.all', compact('employees'));
    }

    public function create()
    {
        // Example: predefined roles
        $roles = ['Admin', 'Manager', 'Staff', 'Supervisor'];

        return view('UserManagement.employees.add', compact('roles'));
    }

    public function store(Request $request)
{
    // Validate form input
    $validated = $request->validate([
        'first_name'        => 'required|string|max:255',
        'last_name'         => 'required|string|max:255',
        'mobile'            => 'nullable|string|max:20',
        'email'             => 'required|email|unique:employees,email',
        'password'          => 'required|string|min:6|confirmed', // matches password_confirmation
        'department'        => 'nullable|string|max:255',
        'joining_date'      => 'nullable|date',
        'salary'            => 'nullable|numeric',
        'designation'       => 'nullable|string|max:255',
        'address'           => 'nullable|string',
        'gender'            => 'nullable|in:Male,Female,Other',
        'dob'               => 'nullable|date',
        'role'              => 'required|string|max:100',
        'status'            => 'required|boolean',
        'can_login'         => 'required|boolean',
        'profile_picture'   => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
    ]);

    // Handle file upload if exists
    $profilePicturePath = null;
    if ($request->hasFile('profile_picture')) {
        $profilePicturePath = $request->file('profile_picture')->store('employees', 'public');
    }

    // Create employee record in employees table
    $employee = Employee::create([
        'first_name'     => $validated['first_name'],
        'last_name'      => $validated['last_name'],
        'mobile'         => $validated['mobile'] ?? null,
        'email'          => $validated['email'],
        'password'       => bcrypt($validated['password']), // hash password
        'department'     => $validated['department'] ?? null,
        'joining_date'   => $validated['joining_date'] ?? null,
        'salary'         => $validated['salary'] ?? null,
        'designation'    => $validated['designation'] ?? null,
        'address'        => $validated['address'] ?? null,
        'gender'         => $validated['gender'] ?? null,
        'dob'            => $validated['dob'] ?? null,
        'role'           => $validated['role'],
        'status'         => $validated['status'],
        'can_login'      => $validated['can_login'],
        'profile_picture'=> $profilePicturePath,
    ]);

    return redirect()->route('employees.all')
                     ->with('success', 'Employee created successfully.');
}



    // Show Employee modal
    public function show(string $id)
    {
        //
    }

// Show edit form
public function edit($id)
{
    $employee = Employee::findOrFail($id);
    $roles = ['Admin', 'Manager', 'Staff', 'Supervisor']; // same as create
    return view('UserManagement.employees.edit', compact('employee', 'roles'));
}

// Update employee
public function update(Request $request, $id)
{
    $employee = Employee::findOrFail($id);

    $validated = $request->validate([
        'first_name'        => 'required|string|max:255',
        'last_name'         => 'required|string|max:255',
        'mobile'            => 'nullable|string|max:20',
        'email'             => 'required|email|unique:employees,email,' . $employee->id,
        'password'          => 'nullable|string|min:6|confirmed',
        'department'        => 'nullable|string|max:255',
        'joining_date'      => 'nullable|date',
        'salary'            => 'nullable|numeric',
        'designation'       => 'nullable|string|max:255',
        'address'           => 'nullable|string',
        'gender'            => 'nullable|in:Male,Female,Other',
        'dob'               => 'nullable|date',
        'role'              => 'required|string|max:100',
        'status'            => 'required|boolean',
        'can_login'         => 'required|boolean',
        'profile_picture'   => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
    ]);

    // Handle file upload if new profile picture is provided
    if ($request->hasFile('profile_picture')) {
        $profilePicturePath = $request->file('profile_picture')->store('employees', 'public');
        $validated['profile_picture'] = $profilePicturePath;
    }

    // If password is not empty, hash it
    if (!empty($validated['password'])) {
        $validated['password'] = bcrypt($validated['password']);
    } else {
        unset($validated['password']); // don’t overwrite old password
    }

    $employee->update($validated);

    return redirect()->route('employees.all')
                     ->with('success', 'Employee updated successfully.');
}


    // Delete
    public function destroy(string $id)
    {
        //
    }

    // Toggle login
    public function toggleLogin($id)
    {
        $employee = Employee::findOrFail($id);
        $employee->can_login = !$employee->can_login;
        $employee->save();
        $status = $employee->can_login ? 'enabled' : 'disabled';
        return redirect()->route('employees.all')->with('success', "Employee login {$status}.");
    }

    // Branches page
    public function branches()
    {
        $branches = Branch::orderBy('created_at', 'desc')->get();
        return view('UserManagement.employees.branches', compact('branches'));
    }

    // Store new Branch
public function storeBranch(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'division_name' => 'required|string|max:255', // must match input name
    ]);

    Branch::create([
        'name' => $request->name,
        'division_name' => $request->division_name, // include this!
        'status' => true,
    ]);

    return redirect()->route('employees.branches')->with('success', 'Branch added successfully.');
}


    // Toggle branch status (enable/disable)
    public function toggleBranch($id)
    {
        $branch = Branch::findOrFail($id);
        $branch->status = !$branch->status;
        $branch->save();

        return redirect()->route('employees.branches')->with('success', 'Branch status updated.');
    }


    // Update branch
public function updateBranch(Request $request, $id)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'division_name' => 'required|string|max:255',
        'status' => 'required|boolean',
    ]);

    $branch = Branch::findOrFail($id);
    $branch->update([
        'name' => $request->name,
        'division_name' => $request->division_name,
        'status' => $request->status,
    ]);

    return redirect()->route('employees.branches')->with('success', 'Branch updated successfully.');
}

}
