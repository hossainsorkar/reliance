@extends('adminlte::page')

@section('title', 'Admins - All')

@section('content_header')
<div class="d-flex justify-content-between align-items-center">
    <h1>All Admins</h1>
    <a href="{{ route('admin.add') }}" class="btn btn-primary">Add Admin</a>
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
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>User Role</th>
                        <th>Department</th>
                        <th>Can Login</th>
                        <th>Action</th>
                        <th>Created By</th>
                        <th>Create Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($admins as $index => $admin)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $admin->first_name }}</td>
                            <td>{{ $admin->last_name }}</td>
                            <td>{{ $admin->email }}</td>
                            <td>{{ $admin->role }}</td>
                            <td>{{ $admin->department }}</td>
                            <td>{{ $admin->can_login ? 'Yes' : 'No' }}</td>
                            <td>
                                {{-- View button --}}
                                <a href="#" class="btn btn-info btn-sm" data-toggle="modal" data-target="#viewAdminModal{{ $admin->id }}">
                                    <i class="fas fa-eye"></i>
                                </a>

                                {{-- Edit button --}}
                                <a href="{{ route('admin.edit', $admin->id) }}" class="btn btn-warning btn-sm">
                                    Edit
                                </a>

                                {{-- Toggle Disable/Login button --}}
                                <form action="{{ route('admin.toggle-login', $admin->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        {{ $admin->can_login ? 'Disable' : 'Enable' }}
                                    </button>
                                </form>
                            </td>
                            <td>System</td>
                            <td>{{ $admin->created_at->format('m/d/Y') }}</td>
                        </tr>

                        {{-- Modal for viewing admin summary --}}
                        <div class="modal fade" id="viewAdminModal{{ $admin->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                          <div class="modal-dialog modal-sm" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title">{{ $admin->first_name }} {{ $admin->last_name }}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                                <p><strong>Email:</strong> {{ $admin->email }}</p>
                                <p><strong>User Role:</strong> {{ $admin->role }}</p>
                                <p><strong>Department:</strong> {{ $admin->department }}</p>
                                <p><strong>Can Login:</strong> {{ $admin->can_login ? 'Yes' : 'No' }}</p>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                              </div>
                            </div>
                          </div>
                        </div>

                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@stop
