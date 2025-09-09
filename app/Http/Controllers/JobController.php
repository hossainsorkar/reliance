<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Party;
use App\Models\Terminal;
use App\Models\Employee;
use App\Models\Bill;
use Illuminate\Http\Request;

class JobController extends Controller
{
    // Show list of jobs
    public function index()
    {
        $jobs = Job::with(['party', 'terminal', 'employee'])->get();
        return view('jobs.job_list', compact('jobs'));
    }

    // Show form to create new job
    public function create()
    {
        // Only active items
        $parties = Party::where('status', 1)->get();
        $terminals = Terminal::where('status', 1)->get();
        $employees = Employee::where('status', 1)->get();

        return view('jobs.add_job', compact('parties', 'terminals', 'employees'));
    }

    // Store new job
    public function store(Request $request)
    {
        // Validate input
        $validated = $request->validate([
            'invoice_no' => 'required|string|max:255',
            'buyer_name' => 'nullable|string|max:255',
            'value_usd' => 'nullable|numeric',
            'usd_rate_bdt' => 'nullable|numeric',
            'voucher_amount' => 'nullable|numeric',
            'party_id' => 'required|exists:parties,id',
            'terminal_id' => 'required|exists:terminals,id',
            'employee_id' => 'nullable|exists:employees,id',
            'items' => 'required|string',
            'quantity' => 'required|numeric',
            'weight' => 'nullable|numeric',
            'ctns_pieces' => 'nullable|numeric',
            'be_no' => 'required|string',
            'lc_no' => 'nullable|string',
            'sales_contact' => 'nullable|string',
            'ud_no' => 'nullable|string',
            'ud_amendment_no' => 'nullable|string',
            'master_awb_bl_no' => 'nullable|string',
            'house_awb_no' => 'nullable|string',
            'job_no' => 'required|string|max:255',
            'job_type' => 'required|string',
            'job_status' => 'required|string',
        ]);

        // Create Job
        $job = Job::create($validated);

        // --- Automatic Bill Creation ---
        Bill::create([
            'bill_date'       => now(),
            'bill_no'         => 'BILL-' . str_pad($job->id, 5, '0', STR_PAD_LEFT),
            'type'            => $job->job_type,
            'job_id'          => $job->id,
            'party_id'        => $job->party_id,
            'total_amount'    => $job->voucher_amount ?? 0,
            'received_amount' => 0,
            'due_amount'      => $job->voucher_amount ?? 0,
            'remarks'         => 'Automatically generated from job creation.',
        ]);
        // -----------------------------

        return redirect()->route('jobs.index')
                         ->with('success', 'Job and associated bill created successfully.');
    }

    // Edit job
    public function edit(Job $job)
    {
        $parties = Party::where('status', 1)->get();
        $terminals = Terminal::where('status', 1)->get();
        $employees = Employee::where('status', 1)->get();

        return view('jobs.edit_job', compact('job', 'parties', 'terminals', 'employees'));
    }

    // Update job
    public function update(Request $request, Job $job)
    {
        $validated = $request->validate([
            'invoice_no' => 'required|string|max:255',
            'buyer_name' => 'nullable|string|max:255',
            'value_usd' => 'nullable|numeric',
            'usd_rate_bdt' => 'nullable|numeric',
            'voucher_amount' => 'nullable|numeric',
            'party_id' => 'required|exists:parties,id',
            'terminal_id' => 'required|exists:terminals,id',
            'employee_id' => 'nullable|exists:employees,id',
            'items' => 'required|string',
            'quantity' => 'required|numeric',
            'weight' => 'nullable|numeric',
            'ctns_pieces' => 'nullable|numeric',
            'be_no' => 'required|string',
            'lc_no' => 'nullable|string',
            'sales_contact' => 'nullable|string',
            'ud_no' => 'nullable|string',
            'ud_amendment_no' => 'nullable|string',
            'master_awb_bl_no' => 'nullable|string',
            'house_awb_no' => 'nullable|string',
            'job_no' => 'required|string|max:255',
            'job_type' => 'required|string',
            'job_status' => 'required|string',
        ]);

        $job->update($validated);

        return redirect()->route('jobs.index')->with('success', 'Job updated successfully.');
    }

    // Delete job
    public function destroy(Job $job)
    {
        $job->delete();
        return redirect()->route('jobs.index')->with('success', 'Job deleted successfully.');
    }

    // Toggle job status
    public function toggleStatus(Job $job)
    {
        $job->job_status = $job->job_status === 'Active' ? 'Inactive' : 'Active';
        $job->save();

        return redirect()->route('jobs.index')->with('success', 'Job status updated successfully.');
    }

    // Show single job
    public function show($id)
    {
        $job = Job::with(['party', 'terminal', 'employee'])->findOrFail($id);
        return view('jobs.show', compact('job'));
    }
}
