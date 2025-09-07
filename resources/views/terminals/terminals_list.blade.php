@extends('adminlte::page')

@section('title', 'Terminals - All')

@section('content_header')
<div class="d-flex justify-content-between align-items-center">
    <h1>All Terminals</h1>
    <a href="{{ route('terminals.create') }}" class="btn btn-primary">Add Terminal</a>
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
                        <th>Terminal Short Name</th>
                        <th>Terminal Type</th>
                        <th>Address</th>
                        <th>About</th>
                        <th>Status</th>
                        <th>Created Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($terminals as $index => $terminal)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>
                                {{-- Edit --}}
                                <a href="{{ route('terminals.edit', $terminal->id) }}" class="btn btn-warning btn-sm">Edit</a>

                                {{-- Delete --}}
                                <form action="{{ route('terminals.destroy', $terminal->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this terminal?')">
                                        Delete
                                    </button>
                                </form>
                            </td>
                            <td>{{ $terminal->terminal_name }}</td>
                            <td>{{ $terminal->terminal_short_name }}</td>
                            <td>{{ $terminal->terminal_type ?? '-' }}</td>
                            <td>{{ $terminal->address ?? '-' }}</td>
                            <td>{{ $terminal->about ?? '-' }}</td>
                            <td>
                                @if($terminal->status)
                                    <span class="badge badge-success">Active</span>
                                @else
                                    <span class="badge badge-secondary">Inactive</span>
                                @endif
                            </td>
                            <td>{{ $terminal->created_at->format('m/d/Y') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        <div class="mt-3">
            {{ $terminals->links() }}
        </div>
    </div>
</div>
@stop
