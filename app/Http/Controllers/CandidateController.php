<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Candidate;
use App\Models\Election;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CandidateController extends Controller
{
    // Display a listing of the candidates
    public function index()
    {
        $candidates = Candidate::all();
        $elections = Election::all();
        return view('candidate', compact('candidates', 'elections'));
    }


    // Show the form for editing the specified candidate
    public function edit($id)
    {
        $candidate = Candidate::find($id);
        return response()->json($candidate);
    }

    public function create()
    {
        $elections = Election::all();
        return view('candidates.create', compact('elections'));
    }

    public function store(Request $request)
{
    $request->validate([
        'election_id' => 'required|exists:elections,id',
        'name' => 'required|string|max:255',
        'description' => 'required|string',
        'party' => 'required|string|max:255',
        'image_url' => 'nullable|url',
    ]);

    Candidate::create([
        'election_id' => $request->election_id,
        'name' => $request->name,
        'description' => $request->description,
        'party' => $request->party,
        'image_url' => $request->image_url,
    ]);

    return redirect()->route('candidates.index')->with('success', 'Candidate added successfully.');
}


    public function update(Request $request, $id)
    {
    $candidate = Candidate::findOrFail($id);

    $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'required|string',
        'party' => 'required|string|max:255',
        'image_url' => 'nullable|url',
    ]);

    $candidate->update([
        'name' => $request->name,
        'description' => $request->description,
        'party' => $request->party,
        'image_url' => $request->image_url,
    ]);

    return redirect()->route('candidates.index')->with('success', 'Candidate updated successfully.');
    }



    // Remove the specified candidate from storage
    public function destroy($id)
    {
        $candidate = Candidate::find($id);

        // Delete image if exists
        if ($candidate->image && Storage::exists('public/' . Str::after($candidate->image, '/storage/'))) {
            Storage::delete('public/' . Str::after($candidate->image, '/storage/'));
        }

        $candidate->delete();

        return redirect()->route('candidates.index')->with('success', 'Candidate deleted successfully!');
    }

    // Show the specified candidate
    public function show($id)
    {
        $candidate = Candidate::find($id);
        return response()->json($candidate);
    }
}
