@extends('adminlte::page')

@section('title', 'Edit Job')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1>Edit Job</h1>
        <a href="{{ route('jobs.index') }}" class="btn btn-primary">All Jobs</a>
    </div>
@stop

@section('content')
    <div class="card shadow rounded-2xl">
        <div class="card-body">
            <form action="{{ route('jobs.update', $job->id) }}" method="POST">
                @csrf
                @method('PUT')

                {{-- Invoice Info --}}
                <h5 class="mb-3">Invoice & Financial Info</h5>
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label>Invoice No *</label>
                        <input type="text" name="invoice_no" class="form-control"
                               value="{{ old('invoice_no', $job->invoice_no) }}" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label>Buyer Name</label>
                        <input type="text" name="buyer_name" class="form-control"
                               value="{{ old('buyer_name', $job->buyer_name) }}">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label>Value (USD) *</label>
                        <input type="number" step="0.01" name="value_usd" class="form-control"
                               value="{{ old('value_usd', $job->value_usd) }}">
                    </div>
                </div>

                {{-- Party, Terminal, Employee --}}
                <h5 class="mt-4 mb-3">Party, Terminal & Employee</h5>
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label>Party *</label>
                        <select name="party_id" class="form-control" required>
                            <option value="">Choose...</option>
                            @foreach($parties as $party)
                                <option value="{{ $party->id }}" {{ $job->party_id == $party->id ? 'selected' : '' }}>
                                    {{ $party->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label>Terminal *</label>
                        <select name="terminal_id" class="form-control" required>
                            <option value="">Choose...</option>
                            @foreach($terminals as $terminal)
                                <option value="{{ $terminal->id }}" {{ $job->terminal_id == $terminal->id ? 'selected' : '' }}>
                                    {{ $terminal->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label>Employee</label>
                        <select name="employee_id" class="form-control">
                            <option value="">Choose...</option>
                            @foreach($employees as $employee)
                                <option value="{{ $employee->id }}" {{ $job->employee_id == $employee->id ? 'selected' : '' }}>
                                    {{ $employee->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                {{-- Job Details --}}
                <h5 class="mt-4 mb-3">Job Details</h5>
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label>Job No *</label>
                        <input type="text" name="job_no" class="form-control"
                               value="{{ old('job_no', $job->job_no) }}" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label>Job Type *</label>
                        <select name="job_type" class="form-control">
                            <option value="">Choose...</option>
                            <option value="Import" {{ $job->job_type === 'Import' ? 'selected' : '' }}>Import</option>
                            <option value="Export" {{ $job->job_type === 'Export' ? 'selected' : '' }}>Export</option>
                            <option value="Local" {{ $job->job_type === 'Local' ? 'selected' : '' }}>Local</option>
                        </select>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label>Job Status *</label>
                        <select name="job_status" class="form-control">
                            <option value="">Choose...</option>
                            <option value="Pending" {{ $job->job_status === 'Pending' ? 'selected' : '' }}>Pending</option>
                            <option value="Ongoing" {{ $job->job_status === 'Ongoing' ? 'selected' : '' }}>Ongoing</option>
                            <option value="Completed" {{ $job->job_status === 'Completed' ? 'selected' : '' }}>Completed</option>
                            <option value="Active" {{ $job->job_status === 'Active' ? 'selected' : '' }}>Active</option>
                            <option value="Inactive" {{ $job->job_status === 'Inactive' ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>
                </div>

                {{-- Submit --}}
                <div class="mt-4">
                    <button type="submit" class="btn btn-success">Update Job</button>
                </div>
            </form>
        </div>
    </div>
@stop
