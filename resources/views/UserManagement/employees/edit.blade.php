@extends('adminlte::page')

@section('title', 'Employee - Edit')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1>Edit Employee</h1>
        <a href="{{ route('employees.all') }}" class="btn btn-secondary">All Employees</a>
    </div>
@stop

@section('content')
<div class="card">
    <div class="card-body">
        <form action="{{ route('employees.update', $employee->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="row">
                {{-- First Name --}}
                <div class="col-md-6 mb-3">
                    <label>First Name *</label>
                    <input type="text" name="first_name" class="form-control"
                           value="{{ old('first_name', $employee->first_name) }}" required>
                </div>

                {{-- Last Name --}}
                <div class="col-md-6 mb-3">
                    <label>Last Name *</label>
                    <input type="text" name="last_name" class="form-control"
                           value="{{ old('last_name', $employee->last_name) }}" required>
                </div>

                {{-- Mobile --}}
                <div class="col-md-6 mb-3">
                    <label>Mobile</label>
                    <input type="text" name="mobile" class="form-control"
                           value="{{ old('mobile', $employee->mobile) }}">
                </div>

                {{-- Email --}}
                <div class="col-md-6 mb-3">
                    <label>Email *</label>
                    <input type="email" name="email" class="form-control"
                           value="{{ old('email', $employee->email) }}" required>
                </div>

                {{-- Password --}}
                <div class="col-md-6 mb-3">
                    <label>New Password (leave blank to keep current)</label>
                    <input type="password" name="password" class="form-control">
                </div>

                {{-- Confirm Password --}}
                <div class="col-md-6 mb-3">
                    <label>Confirm Password</label>
                    <input type="password" name="password_confirmation" class="form-control">
                </div>

                {{-- Department --}}
                <div class="col-md-6 mb-3">
                    <label>Department</label>
                    <input type="text" name="department" class="form-control"
                           value="{{ old('department', $employee->department) }}">
                </div>

                {{-- Date of Joining --}}
                <div class="col-md-6 mb-3">
                    <label>Date of Joining</label>
                    <input type="date" name="joining_date" class="form-control"
                           value="{{ old('joining_date', $employee->joining_date) }}">
                </div>

                {{-- Salary --}}
                <div class="col-md-6 mb-3">
                    <label>Salary</label>
                    <input type="number" step="0.01" name="salary" class="form-control"
                           value="{{ old('salary', $employee->salary) }}">
                </div>

                {{-- Designation --}}
                <div class="col-md-6 mb-3">
                    <label>Designation</label>
                    <input type="text" name="designation" class="form-control"
                           value="{{ old('designation', $employee->designation) }}">
                </div>

                {{-- Address --}}
                <div class="col-md-12 mb-3">
                    <label>Address</label>
                    <textarea name="address" class="form-control">{{ old('address', $employee->address) }}</textarea>
                </div>

                {{-- Gender --}}
                <div class="col-md-6 mb-3">
                    <label>Gender</label>
                    <select name="gender" class="form-select">
                        <option value="">Choose...</option>
                        <option value="Male" {{ old('gender', $employee->gender) == 'Male' ? 'selected' : '' }}>Male</option>
                        <option value="Female" {{ old('gender', $employee->gender) == 'Female' ? 'selected' : '' }}>Female</option>
                        <option value="Other" {{ old('gender', $employee->gender) == 'Other' ? 'selected' : '' }}>Other</option>
                    </select>
                </div>

                {{-- Date of Birth --}}
                <div class="col-md-6 mb-3">
                    <label>Date of Birth</label>
                    <input type="date" name="dob" class="form-control"
                           value="{{ old('dob', $employee->dob) }}">
                </div>

                {{-- Role --}}
                <div class="col-md-6 mb-3">
                    <label>User Role *</label>
                    <select name="role" class="form-select" required>
                        <option value="">Choose...</option>
                        @foreach ($roles as $role)
                            <option value="{{ $role }}" {{ old('role', $employee->role) == $role ? 'selected' : '' }}>
                                {{ $role }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Status --}}
                <div class="col-md-6 mb-3">
                    <label>Status</label>
                    <select name="status" class="form-select">
                        <option value="1" {{ old('status', $employee->status) == '1' ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ old('status', $employee->status) == '0' ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>

                {{-- Can Login --}}
                <div class="col-md-6 mb-3">
                    <label>Can Login</label>
                    <select name="can_login" class="form-select">
                        <option value="1" {{ old('can_login', $employee->can_login) == '1' ? 'selected' : '' }}>Yes</option>
                        <option value="0" {{ old('can_login', $employee->can_login) == '0' ? 'selected' : '' }}>No</option>
                    </select>
                </div>

                {{-- Profile Picture --}}
                <div class="col-md-6 mb-3">
                    <label>Profile Picture</label>
                    <input type="file" name="profile_picture" class="form-control" accept=".jpg,.jpeg,.png">
                    @if($employee->profile_picture)
                        <div class="mt-2">
                            <img src="{{ asset('storage/' . $employee->profile_picture) }}" width="100">
                        </div>
                    @endif
                </div>
            </div>

            <div class="text-end mt-3">
                <button type="submit" class="btn btn-primary">Update Employee</button>
            </div>
        </form>
    </div>
</div>
@stop
