@extends('adminlte::page')

@section('title', 'Edit Admin')

@section('content_header')
    <h1>Edit Admin</h1>
@stop

@section('content')
<div class="container">
    <form action="{{ route('admin.update', $admin->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row">
            {{-- First Name --}}
            <div class="col-md-6 mb-3">
                <label class="form-label">First Name *</label>
                <input type="text" name="first_name" class="form-control" value="{{ old('first_name', $admin->first_name) }}" required>
            </div>

            {{-- Last Name --}}
            <div class="col-md-6 mb-3">
                <label class="form-label">Last Name *</label>
                <input type="text" name="last_name" class="form-control" value="{{ old('last_name', $admin->last_name) }}" required>
            </div>

            {{-- Mobile --}}
            <div class="col-md-6 mb-3">
                <label class="form-label">Mobile</label>
                <input type="text" name="mobile" class="form-control" value="{{ old('mobile', $admin->mobile) }}">
            </div>

            {{-- Email --}}
            <div class="col-md-6 mb-3">
                <label class="form-label">Email *</label>
                <input type="email" name="email" class="form-control" value="{{ old('email', $admin->email) }}" required>
            </div>

            {{-- Department --}}
            <div class="col-md-6 mb-3">
                <label class="form-label">Department</label>
                <input type="text" name="department" class="form-control" value="{{ old('department', $admin->department) }}">
            </div>

            {{-- Role --}}
            <div class="col-md-6 mb-3">
                <label class="form-label">User Role *</label>
                <input type="text" name="role" class="form-control" value="{{ old('role', $admin->role) }}" required>
            </div>

            {{-- Status --}}
            <div class="col-md-6 mb-3">
                <label class="form-label">Status</label>
                <select name="status" class="form-select">
                    <option value="1" {{ $admin->status ? 'selected' : '' }}>Active</option>
                    <option value="0" {{ !$admin->status ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>

            {{-- Can Login --}}
            <div class="col-md-6 mb-3">
                <label class="form-label">Can Login</label>
                <select name="can_login" class="form-select">
                    <option value="1" {{ $admin->can_login ? 'selected' : '' }}>Yes</option>
                    <option value="0" {{ !$admin->can_login ? 'selected' : '' }}>No</option>
                </select>
            </div>

            {{-- Submit Button --}}
            <div class="text-end mt-3">
                <button type="submit" class="btn btn-primary">Update Admin</button>
            </div>
        </div>
    </form>
</div>
@stop
