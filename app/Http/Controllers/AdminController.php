<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\Admin;


class AdminController extends Controller
{
    // Display all admins
public function index()
{
    // Fetch all admins ordered by creation date descending
    $admins = \App\Models\Admin::orderBy('created_at', 'desc')->get();

    // Pass the collection to the view
    return view('UserManagement.admin.all', compact('admins'));
}

    // Show add admin form
    public function create()
    {
        // For now: pass available roles
        $roles = ['Super Admin', 'Admin'];
        return view('UserManagement.admin.add', compact('roles'));
    }

public function store(Request $request)
{
    $validated = $request->validate([
        'first_name'        => ['required', 'string', 'max:100'],
        'last_name'         => ['required', 'string', 'max:100'],
        'mobile'            => ['nullable', 'string', 'max:20'],
        'email'             => ['required', 'email', 'unique:admins,email'],
        'password'          => ['required', 'confirmed', 'min:8'],
        'department'        => ['nullable', 'string', 'max:100'],
        'joining_date'      => ['nullable', 'date'],
        'salary'            => ['nullable', 'numeric', 'min:0'],
        'designation'       => ['nullable', 'string', 'max:100'],
        'address'           => ['nullable', 'string'],
        'gender'            => ['nullable', 'in:Male,Female,Other'],
        'dob'               => ['nullable', 'date'],
        'role'              => ['required', 'string'],
        'status'            => ['nullable', 'boolean'],
        'can_login'         => ['nullable', 'boolean'],
        'profile_picture'   => ['nullable', 'image', 'mimes:jpeg,jpg,png', 'max:2048'],
    ]);

    // Normalize
    $validated['status'] = $request->boolean('status');
    $validated['can_login'] = $request->boolean('can_login');

    // Hash password
    $validated['password'] = Hash::make($request->password);

    // Upload profile picture if exists
    if ($request->hasFile('profile_picture')) {
        $validated['profile_picture'] = $request->file('profile_picture')
            ->store('profile_pictures', 'public');
    }

    // Save to DB
    Admin::create($validated);

    return redirect()->route('admin.all')
        ->with('success', 'Admin created successfully.');
}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

// Show edit form
public function edit($id)
{
    $admin = \App\Models\Admin::findOrFail($id);
    return view('UserManagement.admin.edit', compact('admin'));
}

// Handle update
public function update(Request $request, $id)
{
    $admin = \App\Models\Admin::findOrFail($id);

    $validated = $request->validate([
        'first_name' => 'required|string|max:100',
        'last_name'  => 'required|string|max:100',
        'mobile'     => 'nullable|string|max:20',
        'email'      => 'required|email|unique:admins,email,'.$admin->id,
        'department' => 'nullable|string|max:100',
        'role'       => 'required|string',
        'status'     => 'nullable|boolean',
        'can_login'  => 'nullable|boolean',
    ]);

    $admin->update($validated);

    return redirect()->route('admin.all')->with('success', 'Admin updated successfully.');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }


    /**
 * Toggle the can_login status for an admin.
 */
public function toggleLogin($id)
{
    $admin = \App\Models\Admin::findOrFail($id);

    // Toggle the boolean value
    $admin->can_login = !$admin->can_login;
    $admin->save();

    $status = $admin->can_login ? 'enabled' : 'disabled';

    return redirect()->route('admin.all')
                     ->with('success', "Admin login has been {$status} successfully.");
}

}
