@extends('adminlte::page')

@section('title', 'Bill Statement')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1>Bill Statement</h1>
    </div>
@stop

@section('content')
<div class="card shadow rounded-2xl">
    <div class="card-body">
        <table id="billStatementTable" class="table table-striped table-bordered nowrap" style="width:100%">
            <thead>
                <tr>
                    <th>SL</th>
                    <th>Party Name</th>
                    <th>Jobs Count</th>
                    <th>Starting Date</th>
                    <th>End Date</th>
                    <th>Total Amount</th>
                    <th>Created At</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $index => $statement)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $statement['party_name'] ?? '-' }}</td>
                    <td>{{ $statement['jobs_count'] ?? 0 }}</td>
                    <td>
                        @if(!empty($statement['start_date']))
                            {{ \Carbon\Carbon::parse($statement['start_date'])->format('d-m-Y') }}
                        @else
                            -
                        @endif
                    </td>
                    <td>
                        @if(!empty($statement['end_date']))
                            {{ \Carbon\Carbon::parse($statement['end_date'])->format('d-m-Y') }}
                        @else
                            -
                        @endif
                    </td>
                    <td>
                        {{ isset($statement['total_amount']) ? number_format($statement['total_amount'], 2) : '0.00' }}
                    </td>
                    <td>
                        {{ !empty($statement['created_at']) ? \Carbon\Carbon::parse($statement['created_at'])->format('d-m-Y H:i') : '-' }}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@stop

@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css">
@stop

@section('js')
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>

<script>
$(document).ready(function() {
    $('#billStatementTable').DataTable({
        responsive: true,
        pageLength: 10,
        lengthMenu: [5, 10, 25, 50, 100],
        scrollX: true,
        dom: 'Blfrtip',
    });
});
</script>
@stop
