@extends('adminlte::page')

@section('title', 'Edit Terminal')

@section('content_header')
    <h1>Edit Terminal</h1>
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
        <form action="{{ route('terminals.update', $terminal->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="terminal_name">Terminal Name</label>
                <input type="text" name="terminal_name" class="form-control" value="{{ old('terminal_name', $terminal->terminal_name) }}" required>
            </div>

            <div class="form-group">
                <label for="terminal_short_name">Terminal Short Name</label>
                <input type="text" name="terminal_short_name" class="form-control" value="{{ old('terminal_short_name', $terminal->terminal_short_name) }}" required>
            </div>

            <div class="form-group">
                <label for="terminal_type">Terminal Type</label>
                <input type="text" name="terminal_type" class="form-control" value="{{ old('terminal_type', $terminal->terminal_type) }}">
            </div>

            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" name="address" class="form-control" value="{{ old('address', $terminal->address) }}">
            </div>

            <div class="form-group">
                <label for="about">About</label>
                <textarea name="about" class="form-control" rows="3">{{ old('about', $terminal->about) }}</textarea>
            </div>

            <div class="form-group">
                <label for="status">Status</label>
                <select name="status" class="form-control">
                    <option value="1" {{ $terminal->status ? 'selected' : '' }}>Active</option>
                    <option value="0" {{ !$terminal->status ? 'selected' : '' }}>Inactive</option>
                </select>
            </div>

            <button type="submit" class="btn btn-success">Update</button>
            <a href="{{ route('terminals.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>
@stop
