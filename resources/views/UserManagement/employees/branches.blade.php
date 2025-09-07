@extends('adminlte::page')

@section('title', 'Employee Branches')

@section('content_header')
<div class="d-flex justify-content-between align-items-center">
    <h1>Branches</h1>
    <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#addBranchModal">Add Branch</a>
</div>
@endsection

@section('content')
<div class="card">
    <div class="card-body table-responsive" style="overflow-x:auto;">
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>SL</th>
                    <th>Action</th>
                    <th>Name</th>
                    <th>Division Name</th>
                    <th>Status</th>
                    <th>Create Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach($branches as $index => $branch)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>
                        {{-- Edit button --}}
                        <a href="#" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editBranchModal{{ $branch->id }}">Edit</a>

                        {{-- Toggle Status --}}
                        <form action="{{ route('employees.branches.toggle', $branch->id) }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-danger btn-sm">
                                {{ $branch->status ? 'Disable' : 'Enable' }}
                            </button>
                        </form>
                    </td>
                    <td>{{ $branch->name }}</td>
                    <td>{{ $branch->division_name }}</td>
                    <td>{{ $branch->status ? 'Active' : 'Inactive' }}</td>
                    <td>{{ $branch->created_at->format('m/d/Y h:i:s A') }}</td>
                </tr>

                {{-- Edit Branch Modal --}}
                <div class="modal fade" id="editBranchModal{{ $branch->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <form action="{{ route('employees.branches.update', $branch->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title">Edit Branch</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <div class="form-group">
                                <label>Name *</label>
                                <input type="text" name="name" class="form-control" value="{{ $branch->name }}" required>
                            </div>
                            <div class="form-group">
                                <label>Division Name *</label>
                                <input type="text" name="division_name" class="form-control" value="{{ $branch->division_name }}" required>
                            </div>
                            <div class="form-group">
                                <label>Status *</label>
                                <select name="status" class="form-control" required>
                                    <option value="1" {{ $branch->status ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ !$branch->status ? 'selected' : '' }}>Inactive</option>
                                </select>
                            </div>
                          </div>
                          <div class="modal-footer">
                            <button type="submit" class="btn btn-success">Update Branch</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                          </div>
                        </div>
                    </form>
                  </div>
                </div>

                @endforeach
            </tbody>
        </table>
    </div>
</div>

{{-- Add Branch Modal --}}
<div class="modal fade" id="addBranchModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form action="{{ route('employees.branches.store') }}" method="POST">
        @csrf
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Add Branch</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group">
                <label>Name *</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <div class="form-group">
                <label>Division Name *</label>
                <input type="text" name="division_name" class="form-control" required>
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-success">Add Branch</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
    </form>
  </div>
</div>
@endsection
