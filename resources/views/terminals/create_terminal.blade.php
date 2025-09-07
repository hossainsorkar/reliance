@extends('adminlte::page')

@section('title', 'Add Terminal')

@section('content_header')
    <h1>Add Terminal</h1>
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
        <form action="{{ route('terminals.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="terminal_name">Terminal Name</label>
                <input type="text" name="terminal_name" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="terminal_short_name">Terminal Short Name</label>
                <input type="text" name="terminal_short_name" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="terminal_type">Terminal Type</label>
                <input type="text" name="terminal_type" class="form-control">
            </div>

            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" name="address" class="form-control">
            </div>

            <div class="form-group">
                <label for="about">About</label>
                <textarea name="about" class="form-control" rows="3"></textarea>
            </div>

            <div class="form-group">
                <label for="status">Status</label>
                <select name="status" class="form-control">
                    <option value="1" selected>Active</option>
                    <option value="0">Inactive</option>
                </select>
            </div>

            <button type="submit" class="btn btn-success">Save</button>
            <a href="{{ route('terminals.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>
@stop
