@extends('adminlte::page')

@section('title', 'Add Job')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1>Add Job</h1>
        <a href="{{ route('jobs.index') }}" class="btn btn-primary">All Jobs</a>
    </div>
@stop

@section('content')
    <div class="card shadow rounded-2xl">
        <div class="card-body">
            <form action="{{ route('jobs.store') }}" method="POST">
                @csrf

                {{-- Invoice & Financial Info --}}
                <h5 class="mb-3">Invoice & Financial Info</h5>
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label>Invoice No *</label>
                        <input type="text" name="invoice_no" class="form-control" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label>Buyer Name</label>
                        <input type="text" name="buyer_name" class="form-control">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label>Value (USD) *</label>
                        <input type="number" step="0.01" name="value_usd" class="form-control">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label>USD Rate (BDT) *</label>
                        <input type="number" step="0.01" name="usd_rate_bdt" class="form-control">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label>Voucher Amount *</label>
                        <input type="number" step="0.01" name="voucher_amount" class="form-control">
                    </div>
                </div>

{{-- Party, Terminal & Employee --}}
<h5 class="mt-4 mb-3">Party, Terminal & Employee</h5>
<div class="row">
{{-- Party --}}
<div class="col-md-4 mb-3">
    <label>Party (Bill To) *</label>
    <select name="party_id" class="form-control" required>
        <option value="">Choose...</option>
        @foreach($parties as $party)
            <option value="{{ $party->id }}">{{ $party->party_name }}</option>
        @endforeach
    </select>
</div>

{{-- Terminal --}}
<div class="col-md-4 mb-3">
    <label>Terminal *</label>
    <select name="terminal_id" class="form-control" required>
        <option value="">Choose...</option>
        @foreach($terminals as $terminal)
            <option value="{{ $terminal->id }}">{{ $terminal->terminal_name }}</option>
        @endforeach
    </select>
</div>

{{-- Employee --}}
<div class="col-md-4 mb-3">
    <label>Employee</label>
    <select name="employee_id" class="form-control">
        <option value="">Choose...</option>
        @foreach($employees as $employee)
            <option value="{{ $employee->id }}">{{ $employee->first_name }} {{ $employee->last_name }}</option>
        @endforeach
    </select>
</div>

</div>


</div>


                {{-- Shipment Info --}}
                <h5 class="mt-4 mb-3">Shipment Info</h5>
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label>Items *</label>
                        <input type="text" name="items" class="form-control">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label>Quantity *</label>
                        <input type="number" name="quantity" class="form-control">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label>Weight</label>
                        <input type="number" step="0.01" name="weight" class="form-control">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label>CTNS Pieces</label>
                        <input type="number" name="ctns_pieces" class="form-control">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label>B/E No *</label>
                        <input type="text" name="be_no" class="form-control">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label>L/C No</label>
                        <input type="text" name="lc_no" class="form-control">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label>Sales Contact</label>
                        <input type="text" name="sales_contact" class="form-control">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label>U/D No</label>
                        <input type="text" name="ud_no" class="form-control">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label>U/D Amendment No</label>
                        <input type="text" name="ud_amendment_no" class="form-control">
                    </div>
                </div>

                {{-- Air/Sea Info --}}
                <h5 class="mt-4 mb-3">Master Air Way Bill / BL Number</h5>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <input type="text" name="master_awb_bl_no" class="form-control"
                               placeholder="Enter Master AWB or BL Number (For AIR/CTG only)">
                    </div>
                </div>

                <h5 class="mt-4 mb-3">House Air Way Bill Number</h5>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <input type="text" name="house_awb_no" class="form-control"
                               placeholder="Enter House AWB Number (Air shipments only)">
                    </div>
                </div>

                {{-- Job Details --}}
                <h5 class="mt-4 mb-3">Job Details</h5>
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label>Job No *</label>
                        <input type="text" name="job_no" class="form-control" required>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label>Job Type *</label>
                        <select name="job_type" class="form-control">
                            <option value="">Choose...</option>
                            <option value="Import">Import</option>
                            <option value="Export">Export</option>
                            <option value="Local">Local</option>
                        </select>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label>Job Status *</label>
                        <select name="job_status" class="form-control">
                            <option value="">Choose...</option>
                            <option value="Pending">Pending</option>
                            <option value="Ongoing">Ongoing</option>
                            <option value="Completed">Completed</option>
                        </select>
                    </div>
                </div>

                {{-- Submit --}}
                <div class="mt-4">
                    <button type="submit" class="btn btn-success">Save Job</button>
                </div>
            </form>
        </div>
    </div>
@stop
