<?php

namespace App\Http\Controllers;

use App\Models\ExpenseField;
use App\Models\Terminal;
use Illuminate\Http\Request;

class ExpenseFieldsController extends Controller
{
    /**
     * Display a listing of expense fields.
     */
    public function index()
    {
        $expenseFields = ExpenseField::with('terminal')->latest()->paginate(10);
        return view('terminals.expense_field_list', compact('expenseFields'));
    }

    /**
     * Show the form for creating a new expense field.
     */
    public function create()
    {
        $terminals = Terminal::all();
        return view('terminals.create_expense', compact('terminals'));
    }

    /**
     * Store a newly created expense field.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'terminal_id'      => 'required|exists:terminals,id',
            'expense_type'     => 'required|string|max:255',
            'commission_rate'  => 'required|numeric|min:0|max:9999999999999.99',
            'min_commission'   => 'nullable|numeric|min:0|max:999999999999999999.99',
            'max_commission'   => 'nullable|numeric|min:0|max:999999999999999999.99',
            'status'           => 'required|boolean',
        ], [
            'commission_rate.max' => 'The commission rate is too large. Please enter a valid amount.',
            'min_commission.max'  => 'The minimum commission is too large. Please enter a valid amount.',
            'max_commission.max'  => 'The maximum commission is too large. Please enter a valid amount.',
        ]);

        $validated['created_by'] = auth()->user()->name ?? 'System';

        ExpenseField::create($validated);

        return redirect()->route('expense-fields.index')->with('success', 'Expense Field created successfully.');
    }

    /**
     * Show the form for editing an expense field.
     */
    public function edit($id)
    {
        $expenseField = ExpenseField::findOrFail($id);
        $terminals = Terminal::all();
        return view('terminals.edit_expense', compact('expenseField', 'terminals'));
    }

    /**
     * Update the specified expense field.
     */
    public function update(Request $request, $id)
    {
        $expenseField = ExpenseField::findOrFail($id);

        $validated = $request->validate([
            'terminal_id'      => 'required|exists:terminals,id',
            'expense_type'     => 'required|string|max:255',
            'commission_rate'  => 'required|numeric|min:0|max:9999999999999.99',
            'min_commission'   => 'nullable|numeric|min:0|max:999999999999999999.99',
            'max_commission'   => 'nullable|numeric|min:0|max:999999999999999999.99',
            'status'           => 'required|boolean',
        ], [
            'commission_rate.max' => 'The commission rate is too large. Please enter a valid amount.',
            'min_commission.max'  => 'The minimum commission is too large. Please enter a valid amount.',
            'max_commission.max'  => 'The maximum commission is too large. Please enter a valid amount.',
        ]);

        $expenseField->update($validated);

        return redirect()->route('expense-fields.index')->with('success', 'Expense Field updated successfully.');
    }

    /**
     * Remove the specified expense field.
     */
    public function destroy($id)
    {
        $expenseField = ExpenseField::findOrFail($id);
        $expenseField->delete();

        return redirect()->route('expense-fields.index')->with('success', 'Expense Field deleted successfully.');
    }
}
