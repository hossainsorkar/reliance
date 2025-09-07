@extends('adminlte::page')

@section('title', 'Expense Fields - All')

@section('content_header')
<div class="d-flex justify-content-between align-items-center">
    <h1>All Expense Fields</h1>
    <a href="{{ route('expense-fields.create') }}" class="btn btn-primary">Add Expense Field</a>
</div>
@stop

@section('content')
@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="card">
    <div class="card-body table-responsive">
        <div style="overflow-x:auto;">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>SL</th>
                        <th>Action</th>
                        <th>Terminal Name</th>
                        <th>Expense Type</th>
                        <th>Commission Rate</th>
                        <th>Min Commission</th>
                        <th>Max Commission</th>
                        <th>Created By</th>
                        <th>Status</th>
                        <th>Created Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($expenseFields as $index => $expenseField)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>
                                <a href="{{ route('expense-fields.edit', $expenseField->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('expense-fields.destroy', $expenseField->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Delete this expense field?')">Delete</button>
                                </form>
                            </td>
                            <td>{{ $expenseField->terminal->terminal_name }}</td>
                            <td>{{ $expenseField->expense_type }}</td>
                            <td>{{ $expenseField->commission_rate }}%</td>
                            <td>{{ $expenseField->min_commission ?? '-' }}</td>
                            <td>{{ $expenseField->max_commission ?? '-' }}</td>
                            <td>{{ $expenseField->created_by }}</td>
                            <td>
                                @if($expenseField->status)
                                    <span class="badge badge-success">Active</span>
                                @else
                                    <span class="badge badge-secondary">Inactive</span>
                                @endif
                            </td>
                            <td>{{ $expenseField->created_at->format('m/d/Y') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="mt-3">
            {{ $expenseFields->links() }}
        </div>
    </div>
</div>
@stop
