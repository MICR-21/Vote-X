<?php


namespace App\Http\Controllers;

use App\Models\Election;
use App\Models\Candidate;
use Illuminate\Http\Request;

class ElectionController extends Controller
{
    public function index()
    {
        $elections = Election::with('candidates')->get();
        return view('elections.index', compact('elections'));
    }

    public function create()
    {
        return view('elections.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'candidates.*.name' => 'required|string|max:255',
        ]);

        $election = Election::create(['name' => $request->name]);

        foreach ($request->candidates as $candidateData) {
            $election->candidates()->create($candidateData);
        }

        return redirect()->route('elections.index')->with('success', 'Election and candidates created successfully.');
    }

    public function edit(Election $election)
    {
        return view('elections.edit', compact('election'));
    }

    public function update(Request $request, Election $election)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $election->update(['name' => $request->name]);

        // Handle updating candidates here if needed

        return redirect()->route('elections.index')->with('success', 'Election updated successfully.');
    }

    public function destroy(Election $election)
    {
        $election->delete();

        return redirect()->route('elections.index')->with('success', 'Election deleted successfully.');
    }
    public function showCandidates(Election $election)
    {
        // Assuming you have a relationship defined in Election model to candidates
        $candidates = $election->candidates;

        return view('elections.candidates', compact('candidates'));
    }
//     public function showElectionPage()
// {
//     $candidates = Candidate::all(); // Assuming you have a Candidate model
//     return view('election', compact('candidates'));
// }
//     public function submitVote(Request $request)
// {
//     $request->validate([
//         'candidate_id' => 'required|exists:candidates,id',
//     ]);

//     // Process the vote, e.g., save to the database

//     return redirect()->back()->with('success', 'Your vote has been submitted!');
// }


}

