@extends('adminlte::page')

@section('title', 'Edit Expense Field')

@section('content_header')
    <h1>Edit Expense Field</h1>
@stop

@section('content')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="card">
    <div class="card-body">
        <form action="{{ route('expense-fields.update', $expenseField->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="terminal_id">Terminal</label>
                <select name="terminal_id" class="form-control" required>
                    @foreach($terminals as $terminal)
                        <option value="{{ $terminal->id }}" {{ $expenseField->terminal_id == $terminal->id ? 'selected' : '' }}>
                            {{ $terminal->terminal_name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="expense_type">Expense Type</label>
                <input type="text" name="expense_type" class="form-control" value="{{ old('expense_type', $expenseField->expense_type) }}" required>
            </div>

            <div class="form-group">
                <label for="commission_rate">Commission Rate (%)</label>
                <input type="number" step="0.01" name="commission_rate" class="form-control" value="{{ old('commission_rate', $expenseField->commission_rate) }}" required>
            </div>

            <div class="form-group">
                <label for="min_commission">Min Commission</label>
                <input type="number" step="0.01" name="min_commission" class="form-control" value="{{ old('min_commission', $expenseField->min_commission) }}">
            </div>

            <div class="form-group">
                <label for="max_commission">Max Commission</label>
                <input type="number" step="0.01" name="max_commission" class="form-control" value="{{ old('max_commission', $expenseField->max_commission) }}">
            </div>

            <div class="form-group">
                <label for="status">Status</label>
                <select name="status" class="form-control">
                    <option value="1" {{ $expenseField->status ? 'selected' : '' }}>Active</option>
                    <option value="0" {{ !$expenseField->status ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>

            <button type="submit" class="btn btn-success">Update</button>
            <a href="{{ route('expense-fields.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>
@stop
