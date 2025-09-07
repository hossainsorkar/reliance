@extends('adminlte::page')

@section('title', 'Edit Party')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1>Edit Party</h1>
        <a href="{{ route('parties.index') }}" class="btn btn-primary">All Parties</a>
    </div>
@stop

@section('content')
    <div class="card shadow rounded">
        <div class="card-body">
            <form action="{{ route('parties.update', $party->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group mb-3">
                    <label for="party_name">Party Name</label>
                    <input type="text" name="party_name" id="party_name"
                           class="form-control @error('party_name') is-invalid @enderror"
                           value="{{ old('party_name', $party->party_name) }}" required>
                    @error('party_name')
                        <span class="text-danger small">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="party_type">Party Type</label>
                    <input type="text" name="party_type" id="party_type"
                           class="form-control @error('party_type') is-invalid @enderror"
                           value="{{ old('party_type', $party->party_type) }}" required>
                    @error('party_type')
                        <span class="text-danger small">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="contact_info">Contact Info</label>
                    <input type="text" name="contact_info" id="contact_info"
                           class="form-control @error('contact_info') is-invalid @enderror"
                           value="{{ old('contact_info', $party->contact_info) }}">
                    @error('contact_info')
                        <span class="text-danger small">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="address">Address</label>
                    <textarea name="address" id="address"
                              class="form-control @error('address') is-invalid @enderror">{{ old('address', $party->address) }}</textarea>
                    @error('address')
                        <span class="text-danger small">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="status">Status</label>
                    <select name="status" id="status"
                            class="form-control @error('status') is-invalid @enderror">
                        <option value="1" {{ old('status', $party->status) == '1' ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ old('status', $party->status) == '0' ? 'selected' : '' }}>Inactive</option>
                    </select>
                    @error('status')
                        <span class="text-danger small">{{ $message }}</span>
                    @enderror
                </div>

                <button type="submit" class="btn btn-success">Update Party</button>
            </form>
        </div>
    </div>
@stop
