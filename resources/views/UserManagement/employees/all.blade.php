@extends('adminlte::page')

@section('title', 'Employees - All')

@section('content_header')
<div class="d-flex justify-content-between align-items-center">
    <h1>All Employees</h1>
    <a href="{{ route('employees.add') }}" class="btn btn-primary">Add Employee</a>
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
                    @foreach($employees as $index => $employee)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $employee->first_name }}</td>
                            <td>{{ $employee->last_name }}</td>
                            <td>{{ $employee->email }}</td>
                            <td>{{ $employee->role }}</td>
                            <td>{{ $employee->department }}</td>
                            <td>{{ $employee->can_login ? 'Yes' : 'No' }}</td>
                            <td>
                                {{-- View button --}}
                                <a href="#" class="btn btn-info btn-sm" data-toggle="modal" data-target="#viewEmployeeModal{{ $employee->id }}">
                                    <i class="fas fa-eye"></i>
                                </a>

                                {{-- Edit button --}}
                                <a href="{{ route('employees.edit', $employee->id) }}" class="btn btn-warning btn-sm">Edit</a>

                                {{-- Toggle Can Login --}}
                                <form action="{{ route('employees.toggle-login', $employee->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        {{ $employee->can_login ? 'Disable' : 'Enable' }}
                                    </button>
                                </form>
                            </td>
                            <td>System</td>
                            <td>{{ $employee->created_at->format('m/d/Y') }}</td>
                        </tr>

                        {{-- Modal for viewing employee summary --}}
                        <div class="modal fade" id="viewEmployeeModal{{ $employee->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                          <div class="modal-dialog modal-sm" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title">{{ $employee->first_name }} {{ $employee->last_name }}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                                <p><strong>Email:</strong> {{ $employee->email }}</p>
                                <p><strong>User Role:</strong> {{ $employee->role }}</p>
                                <p><strong>Department:</strong> {{ $employee->department }}</p>
                                <p><strong>Can Login:</strong> {{ $employee->can_login ? 'Yes' : 'No' }}</p>
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
