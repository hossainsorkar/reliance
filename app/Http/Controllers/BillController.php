<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bill;
use App\Models\Job;
use App\Models\Party;

class BillController extends Controller
{
    // --- Bill Register Page ---
    public function register()
    {
        // Eager load related job and party to reduce queries
        $bills = Bill::with(['job', 'party'])->latest()->get();

        return view('bills.bill_register', compact('bills'));
    }

    // --- Bill Statement Page ---
public function statement()
{
    // Make sure Party model has a jobs() relation:
    // public function jobs() { return $this->hasMany(Job::class); }

    // Get parties that have jobs (and bills)
    $parties = Party::whereHas('jobs')->with(['jobs.bills'])->get();

    $data = $parties->map(function($party) {
        $jobs = $party->jobs;

        // Calculate start and end dates from jobs
        $startDate = $jobs->min('created_at'); // or use 'job_start_date' if available
        $endDate   = $jobs->max('created_at'); // or use 'job_end_date' if available

        // Sum total amounts from all bills of all jobs
        $totalAmount = $jobs->sum(function($job) {
            return $job->bills->sum('total_amount'); // assumes 'total_amount' column in Bill
        });

        $jobsCount = $jobs->count();

        return [
            'party_name'   => $party->party_name,
            'jobs_count'   => $jobsCount,
            'start_date'   => $startDate,
            'end_date'     => $endDate,
            'total_amount' => $totalAmount,
            'created_at'   => now(), // statement generation date
        ];
    });

    return view('bills.bill_statement', compact('data'));
}



    // --- Show single bill details ---
    public function show(Bill $bill)
    {
        // Load related job and party
        $bill->load(['job', 'party']);
        return view('bills.bill_show', compact('bill'));
    }

    // --- Toggle active/inactive bill ---
    public function toggleStatus(Bill $bill)
    {
        $bill->status = !$bill->status;
        $bill->save();

        return redirect()->route('bills.register')
                         ->with('success', 'Bill status updated successfully.');
    }
}
