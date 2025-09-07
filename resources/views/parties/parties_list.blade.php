@extends('adminlte::page')

@section('title', 'All Parties')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1>All Parties</h1>
        <a href="{{ route('parties.create') }}" class="btn btn-success">Create Party</a>
    </div>
@stop

@section('content')
    <div class="card shadow rounded">
        <div class="card-body">
            <table id="partiesTable" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>SL</th>
                        <th>Actions</th>
                        <th>Party Name</th>
                        <th>Party Type</th>
                        <th>Contact Info</th>
                        <th>Address</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($parties as $index => $party)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>
                                <a href="{{ route('parties.edit', $party->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                
                                <form action="{{ route('parties.toggleStatus', $party->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('PATCH')
                                    @if($party->status)
                                        <button type="submit" class="btn btn-sm btn-warning">Deactivate</button>
                                    @else
                                        <button type="submit" class="btn btn-sm btn-success">Activate</button>
                                    @endif
                                </form>
                            </td>
                            <td>{{ $party->party_name }}</td>
                            <td>{{ $party->party_type }}</td>
                            <td>{{ $party->contact_info }}</td>
                            <td>{{ $party->address }}</td>
                            <td>
                                @if($party->status)
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-danger">Inactive</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('js')
    {{-- DataTables --}}
    <script>
        $(document).ready(function () {
            $('#partiesTable').DataTable({
                "lengthMenu": [10, 25, 50],
                "pageLength": 10,
                "ordering": true,
                "autoWidth": false,
            });
        });
    </script>
@stop
