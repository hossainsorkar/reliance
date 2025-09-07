<?php

namespace App\Http\Controllers;

use App\Models\Terminal;
use Illuminate\Http\Request;

class TerminalsController extends Controller
{
    // Show all terminals (terminals_list)
    public function index()
    {
        $terminals = Terminal::latest()->paginate(10);
        return view('terminals.terminals_list', compact('terminals'));
    }

    // Show create form (create_terminal)
    public function create()
    {
        return view('terminals.create_terminal');
    }

    // Store new terminal
    public function store(Request $request)
    {
        $request->validate([
            'terminal_name' => 'required|string|max:255',
            'terminal_short_name' => 'required|string|max:50',
            'terminal_type' => 'nullable|string|max:100',
            'address' => 'nullable|string|max:255',
            'about' => 'nullable|string',
            'status' => 'required|boolean',
        ]);

        Terminal::create($request->all());

        return redirect()->route('terminals.index')->with('success', 'Terminal created successfully.');
    }

    // Show a single terminal (optional, not needed for now)
    public function show(Terminal $terminal)
    {
        return view('terminals.show', compact('terminal'));
    }

    // Edit terminal form
public function edit($id)
{
    $terminal = Terminal::findOrFail($id);
    return view('terminals.edit_terminal', ['terminal' => $terminal]);
}


    // Update terminal
public function update(Request $request, $id)
{
    $terminal = Terminal::findOrFail($id);

    $request->validate([
        'terminal_name' => 'required|string|max:255',
        'terminal_short_name' => 'required|string|max:255',
        'terminal_type' => 'nullable|string|max:255',
        'address' => 'nullable|string|max:255',
        'about' => 'nullable|string',
        'status' => 'required|boolean',
    ]);

    $terminal->update($request->only(
        'terminal_name',
        'terminal_short_name',
        'terminal_type',
        'address',
        'about',
        'status'
    ));

    return redirect()->route('terminals.index', $terminal->id)
                     ->with('success', 'Terminal updated successfully.');
}


    // Delete terminal
    public function destroy(Terminal $terminal)
    {
        $terminal->delete();
        return redirect()->route('terminals.index')->with('success', 'Terminal deleted successfully.');
    }
}
