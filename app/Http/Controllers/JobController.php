<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\Party;
use App\Models\Terminal;
use App\Models\Employee;
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
        $validated = $request->validate([
            'invoice_no' => 'required|string|max:255',
            'value_usd' => 'nullable|numeric',
            'usd_rate_bdt' => 'nullable|numeric',
            'voucher_amount' => 'nullable|numeric',
            'party_id' => 'required|exists:parties,id',
            'terminal_id' => 'required|exists:terminals,id',
            'employee_id' => 'nullable|exists:employees,id',
            'job_no' => 'required|string|max:255',
        ]);

        Job::create($validated);

        return redirect()->route('jobs.index')->with('success', 'Job created successfully.');
    }

    // Edit, Update & Delete can be prepared later
    public function edit(Job $job)
    {
        $parties = Party::all();
        $terminals = Terminal::all();
        $employees = Employee::all();
        return view('jobs.edit_job', compact('job', 'parties', 'terminals', 'employees'));
    }

    public function update(Request $request, Job $job)
    {
        $validated = $request->validate([
            'invoice_no' => 'required|string|max:255',
            'value_usd' => 'nullable|numeric',
            'usd_rate_bdt' => 'nullable|numeric',
            'voucher_amount' => 'nullable|numeric',
            'party_id' => 'required|exists:parties,id',
            'terminal_id' => 'required|exists:terminals,id',
            'employee_id' => 'nullable|exists:employees,id',
            'job_no' => 'required|string|max:255',
        ]);

        $job->update($validated);

        return redirect()->route('jobs.index')->with('success', 'Job updated successfully.');
    }

    public function destroy(Job $job)
    {
        $job->delete();
        return redirect()->route('jobs.index')->with('success', 'Job deleted successfully.');
    }

    public function toggleStatus(Job $job)
{
    $job->job_status = $job->job_status === 'Active' ? 'Inactive' : 'Active';
    $job->save();

    return redirect()->route('jobs.index')->with('success', 'Job status updated successfully.');
}


public function show($id)
{
    $job = Job::findOrFail($id);
    return view('jobs.show', compact('job'));
}

}
