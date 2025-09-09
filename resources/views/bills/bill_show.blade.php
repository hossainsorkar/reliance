@extends('adminlte::page')

@section('title', 'Bill Details')

@section('content_header')
    <h1>Bill Details</h1>
    <a href="{{ route('bills.register') }}" class="btn btn-primary float-right">Back to Bill Register</a>
@stop

@section('content')
<div class="card shadow rounded-2xl p-3">
    <div class="card-body">
        <h4 class="mb-3">Bill Information</h4>
        <div class="row mb-2">
            <div class="col-md-4">
                <strong>Bill No:</strong> {{ $bill->bill_no }}
            </div>
            <div class="col-md-4">
                <strong>Bill Date:</strong> {{ $bill->bill_date->format('d-m-Y') }}
            </div>
            <div class="col-md-4">
                <strong>Status:</strong> {{ $bill->status ? 'Active' : 'Inactive' }}
            </div>
        </div>

        <h4 class="mt-4 mb-2">Party & Job Info</h4>
        <div class="row mb-2">
            <div class="col-md-4">
                <strong>Party Name:</strong> {{ $bill->party->party_name ?? 'N/A' }}
            </div>
            <div class="col-md-4">
                <strong>Job No:</strong> {{ $bill->job->job_no ?? 'N/A' }}
            </div>
            <div class="col-md-4">
                <strong>Terminal:</strong> {{ $bill->job->terminal->terminal_name ?? 'N/A' }}
            </div>
        </div>

        <h4 class="mt-4 mb-2">Financial Info</h4>
        <div class="row mb-2">
            <div class="col-md-3">
                <strong>Total Amount:</strong> ${{ number_format($bill->total_amount, 2) }}
            </div>
            <div class="col-md-3">
                <strong>Received Amount:</strong> ${{ number_format($bill->received_amount, 2) }}
            </div>
            <div class="col-md-3">
                <strong>Due Amount:</strong> ${{ number_format($bill->due_amount, 2) }}
            </div>
            <div class="col-md-3">
                <strong>Remarks:</strong> {{ $bill->remarks ?? 'None' }}
            </div>
        </div>
    </div>
</div>
@stop
