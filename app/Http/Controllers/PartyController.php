<?php

namespace App\Http\Controllers;

use App\Models\Party;
use Illuminate\Http\Request;

class PartyController extends Controller
{
    /**
     * Display all parties.
     */
    public function index()
    {
        $parties = Party::latest()->get();
        return view('parties.parties_list', compact('parties'));
    }

    /**
     * Show form to create a party.
     */
    public function create()
    {
        return view('parties.add_party');
    }

    /**
     * Store a new party.
     */
    public function store(Request $request)
    {
        $request->validate([
            'party_name'   => 'required|string|max:255',
            'party_type'   => 'required|string|max:255',
            'contact_info' => 'nullable|string|max:255',
            'address'      => 'nullable|string',
            'status'       => 'required|boolean',
        ]);

        Party::create($request->all());

        return redirect()->route('parties.index')
                         ->with('success', 'Party created successfully.');
    }

    /**
     * Show a single party.
     */
    public function show(Party $party)
    {
        return view('parties.show', compact('party'));
    }

    /**
     * Edit party form.
     */
    public function edit(Party $party)
    {
        return view('parties.edit', compact('party'));
    }

    /**
     * Update a party.
     */
    public function update(Request $request, Party $party)
    {
        $request->validate([
            'party_name'   => 'required|string|max:255',
            'party_type'   => 'required|string|max:255',
            'contact_info' => 'nullable|string|max:255',
            'address'      => 'nullable|string',
            'status'       => 'required|boolean',
        ]);

        $party->update($request->all());

        return redirect()->route('parties.index')
                         ->with('success', 'Party updated successfully.');
    }

    /**
     * Delete a party.
     */
    public function destroy(Party $party)
    {
        $party->delete();

        return redirect()->route('parties.index')
                         ->with('success', 'Party deleted successfully.');
    }

    public function toggleStatus(Party $party)
{
    $party->status = !$party->status;
    $party->save();

    return redirect()->route('parties.index')
                     ->with('success', 'Party status updated successfully.');
}
}
