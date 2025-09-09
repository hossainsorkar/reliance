@extends('adminlte::page')

@section('title', 'Bill Register')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1>Bill Register</h1>
    </div>
@stop

@section('content')
<div class="card shadow rounded-2xl">
    <div class="card-body">
        <table id="billRegisterTable" class="table table-striped table-bordered nowrap" style="width:100%">
            <thead>
                <tr>
                    <th>Action</th>
                    <th>SL</th>
                    <th>Bill Date</th>
                    <th>Bill No</th>
                    <th>Type</th>
                    <th>Party Name</th>
                    <th>Total Bill Amount</th>
                    <th>Received Amount</th>
                    <th>Due (Balance)</th>
                    <th>Remarks</th>
                </tr>
            </thead>
            <tbody>
                @foreach($bills as $index => $bill)
                <tr>
                    <td>
                        <a href="{{ route('bills.show', $bill->id) }}" class="btn btn-sm btn-primary">View</a>
                        <form action="{{ route('bills.toggleStatus', $bill->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="btn btn-sm {{ $bill->status ? 'btn-success' : 'btn-warning' }}">
                                {{ $bill->status ? 'Active' : 'Inactive' }}
                            </button>
                        </form>
                    </td>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ \Carbon\Carbon::parse($bill->bill_date)->format('d-m-Y') }}</td>
                    <td>{{ $bill->bill_no }}</td>
                    <td>{{ $bill->type ?? '-' }}</td>
                    <td>{{ $bill->party->party_name ?? '-' }}</td>
                    <td>{{ number_format($bill->total_amount, 2) }}</td>
                    <td>{{ number_format($bill->received_amount, 2) }}</td>
                    <td>{{ number_format($bill->due_amount, 2) }}</td>
                    <td>{{ $bill->remarks ?? '-' }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@stop

@section('css')
<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css">
@stop

@section('js')
<!-- jQuery & DataTables JS -->
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>

<script>
$(document).ready(function() {
    $('#billRegisterTable').DataTable({
        responsive: true,
        pageLength: 10,
        lengthMenu: [5, 10, 25, 50, 100],
        scrollX: true,
        dom: 'Blfrtip', // optional buttons + search + length
    });
});
</script>
@stop
