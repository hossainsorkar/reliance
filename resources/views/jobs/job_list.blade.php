@extends('adminlte::page')

@section('title', 'All Jobs')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1>All Jobs</h1>
        <a href="{{ route('jobs.create') }}" class="btn btn-primary">Add Job</a>
    </div>
@stop

@section('content')
    <div class="card shadow rounded-2xl">
        <div class="card-body">
            <div class="table-responsive">
                <table id="jobsTable" class="table table-bordered table-striped" style="width:100%">
                    <thead class="thead-dark">
                        <tr>
                            <th>ID</th>
                            <th>Invoice No</th>
                            <th>Buyer</th>
                            <th>Value (USD)</th>
                            <th>Voucher Amount</th>
                            <th>Party</th>
                            <th>Terminal</th>
                            <th>Employee</th>
                            <th>Job No</th>
                            <th>Job Type</th>
                            <th>Job Status</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($jobs as $job)
                            <tr>
                                <td>{{ $job->id }}</td>
                                <td>{{ $job->invoice_no }}</td>
                                <td>{{ $job->buyer_name }}</td>
                                <td>{{ $job->value_usd }}</td>
                                <td>{{ $job->voucher_amount }}</td>
<td>{{ $job->party ? $job->party->party_name : '-' }}</td>
<td>{{ $job->terminal ? $job->terminal->terminal_name : '-' }}</td>
<td>{{ $job->employee ? $job->employee->first_name.' '.$job->employee->last_name : '-' }}</td>

                                <td>{{ $job->job_no }}</td>
                                <td>{{ $job->job_type }}</td>
                                <td>
                                    @if($job->job_status === 'Active')
                                        <span class="badge badge-success">Active</span>
                                    @elseif($job->job_status === 'Inactive')
                                        <span class="badge badge-danger">Inactive</span>
                                    @else
                                        <span class="badge badge-secondary">{{ $job->job_status }}</span>
                                    @endif
                                </td>
                                <td>{{ $job->created_at->format('Y-m-d') }}</td>
<td>
    <a href="{{ route('jobs.edit', $job->id) }}" class="btn btn-sm btn-info">Edit</a>
    <form action="{{ route('jobs.toggle', $job->id) }}" method="POST" class="d-inline">
        @csrf
        @method('PATCH')
        <button type="submit" class="btn btn-sm {{ $job->job_status === 'Active' ? 'btn-warning' : 'btn-success' }}">
            {{ $job->job_status === 'Active' ? 'Deactivate' : 'Activate' }}
        </button>
    </form>
</td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop

@section('js')
    {{-- DataTables setup --}}
    <script>
        $(document).ready(function () {
            $('#jobsTable').DataTable({
                "scrollX": true,
                "pageLength": 10,
                "lengthMenu": [10, 25, 50, 100],
                "ordering": true,
                "autoWidth": false,
            });
        });
    </script>
@stop
