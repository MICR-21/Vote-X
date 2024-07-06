<?php

namespace App\Http\Controllers;

use App\Models\Election;
use App\Events\NewElectionAdded;
use Illuminate\Http\Request;

class ElectionController extends Controller
{
    public function index()
    {
        $elections = Election::all();

        if (request()->wantsJson()) {
            return response()->json($elections);
        }

        return view('elections.index', compact('elections'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'start' => 'required|date',
            'end' => 'required|date|after:start',
        ]);

        $election = Election::create([
            'name' => $request->name,
            'start' => $request->start,
            'end' => $request->end,
        ]);

        event(new NewElectionAdded($election));

        return response()->json([
            'success' => true,
            'election' => $election
        ]);
    }

    public function update(Request $request, Election $election)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'start' => 'required|date',
            'end' => 'required|date|after:start',
        ]);

        $election->update([
            'name' => $request->name,
            'start' => $request->start,
            'end' => $request->end,
        ]);

        return response()->json([
            'success' => true,
            'election' => $election
        ]);
    }

    public function destroy(Election $election)
    {
        $election->delete();

        return response()->json([
            'success' => true
        ]);
    }
}
