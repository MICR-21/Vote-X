<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use App\Models\CandidateModel;
use App\Models\ElectionModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Auth;

class ElectionController extends Controller
{
    //
    public function electionlist(){
        $data['getRecord'] = ElectionModel::getElections();
        $getElections = ElectionModel::all();
        return view('admin.elections.list',$data);
    }



    public function addelectionroute(){
        return view('admin/elections/add');
    }



    public function addelection(Request $request)
{
    $now = Carbon::now();

    $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'required|string',
        'start_date' => 'required|date|after_or_equal:today',
        'start_time' => [
            'required',
            'date_format:H:i',
            function ($attribute, $value, $fail) use ($request, $now) {
                $startDateTime = Carbon::createFromFormat('Y-m-d H:i', $request->start_date . ' ' . $value);
                if ($startDateTime->lte($now)) {
                    $fail('The start date and time must be in the future.');
                }
            },
        ],
        'end_date' => 'required|date|after_or_equal:start_date',
        'end_time' => [
            'required',
            'date_format:H:i',
            function ($attribute, $value, $fail) use ($request) {
                $startDateTime = Carbon::createFromFormat('Y-m-d H:i', $request->start_date . ' ' . $request->start_time);
                $endDateTime = Carbon::createFromFormat('Y-m-d H:i', $request->end_date . ' ' . $value);
                if ($endDateTime->lte($startDateTime)) {
                    $fail('The end date and time must be after the start date and time.');
                }
            },
        ],
    ]);

    $startDateTime = Carbon::createFromFormat('Y-m-d H:i', $request->start_date . ' ' . $request->start_time);
    $endDateTime = Carbon::createFromFormat('Y-m-d H:i', $request->end_date . ' ' . $request->end_time);

    $election = new ElectionModel();
    $election->name = trim($request->name);
    $election->description = trim($request->description);
    $election->start_date = $startDateTime;
    $election->end_date = $endDateTime;
    $election->save();

    return redirect('admin/elections/list')->with('success', 'New election added successfully');
    }

    public function electionedit($id)
    {
    $data['getRecord'] = ElectionModel::getSingle($id);
    if(!$data['getRecord']) {
        return redirect('admin/elections/list')->with('error', 'Election not found');
    }
    return view('admin.elections.edit', $data);
    }

    public function updateelection($id, Request $request)
{
    $now = Carbon::now();
    $election = ElectionModel::getSingle($id);

    if(!$election) {
        return redirect('admin/elections/list')->with('error', 'Election not found');
    }

    $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'required|string',
        'start_date' => [
            'required',
            'date',
            function ($attribute, $value, $fail) use ($election, $now) {
                $newStartDate = Carbon::createFromFormat('Y-m-d', $value)->startOfDay();
                $currentStartDate = Carbon::parse($election->start_date)->startOfDay();
                if ($newStartDate->lt($now->startOfDay()) && $newStartDate->ne($currentStartDate)) {
                    $fail('The start date cannot be changed to a past date.');
                }
            },
        ],
        'start_time' => [
            'required',
            'date_format:H:i',
            function ($attribute, $value, $fail) use ($request, $now, $election) {
                $newStartDateTime = Carbon::createFromFormat('Y-m-d H:i', $request->start_date . ' ' . $value);
                $currentStartDateTime = Carbon::parse($election->start_date);
                if ($newStartDateTime->lt($now) && $newStartDateTime->ne($currentStartDateTime)) {
                    $fail('The start date and time cannot be changed to a past date and time.');
                }
            },
        ],
        'end_date' => 'required|date|after_or_equal:start_date',
        'end_time' => [
            'required',
            'date_format:H:i',
            function ($attribute, $value, $fail) use ($request) {
                $startDateTime = Carbon::createFromFormat('Y-m-d H:i', $request->start_date . ' ' . $request->start_time);
                $endDateTime = Carbon::createFromFormat('Y-m-d H:i', $request->end_date . ' ' . $value);
                if ($endDateTime->lte($startDateTime)) {
                    $fail('The end date and time must be after the start date and time.');
                }
            },
        ],
    ]);

    $startDateTime = Carbon::createFromFormat('Y-m-d H:i', $request->start_date . ' ' . $request->start_time);
    $endDateTime = Carbon::createFromFormat('Y-m-d H:i', $request->end_date . ' ' . $request->end_time);

    $election->name = trim($request->name);
    $election->description = trim($request->description);
    $election->start_date = $startDateTime;
    $election->end_date = $endDateTime;
    $election->save();

    return redirect('admin/elections/list')->with('success', 'Election updated successfully');
    }

    public function deleteelection($id)
{
    $election = ElectionModel::getSingle($id);
    if (!$election) {
        return redirect('admin/elections/list')->with('error', 'Election not found');
    }

    // Perform the deletion
    $election->delete();

    return redirect('admin/elections/list')->with('success', 'Election deleted successfully');

}
    public function dashboard()
{
        $now = now(); // Get the current time once

    $data = [
        'totalElections' => ElectionModel::where('is_delete', 0)->count(),
        'activeElections' => ElectionModel::where('is_delete', 0)
            ->where('start_date', '<=', $now)
            ->where('end_date', '>=', $now)
            ->count(),
        'upcomingElections' => ElectionModel::where('is_delete', 0)
            ->where('start_date', '>', now())
            ->count(),
        'completedElections' => ElectionModel::where('is_delete', 0)
            ->where('end_date', '<', now())
            ->count(),
        'totalCandidates' => CandidateModel::where('is_delete', 0)->count(),
        'totalVotes' => DB::table('votes')->count(),
    ];

    // Recent Elections with Winner
    $data['recentElections'] = ElectionModel::where('is_delete', 0)
        ->orderBy('end_date', 'desc')
        ->take(5)
        ->get()
        ->map(function ($election) {
            $election->total_votes = DB::table('votes')
                ->join('candidates', 'votes.candidate_id', '=', 'candidates.id')
                ->where('candidates.election', $election->id)
                ->count();
            $election->winner = $election->end_date < now() ? $election->determineWinner() : null;
            return $election;
        });

    // Voter Turnout Data
    $data['voterTurnoutData'] = DB::table('votes')
        ->join('candidates', 'votes.candidate_id', '=', 'candidates.id')
        ->join('elections', 'candidates.election', '=', 'elections.id')
        ->select(DB::raw('DATE(votes.created_at) as date'), DB::raw('COUNT(*) as turnout'))
        ->groupBy('date')
        ->orderBy('date')
        ->get();

    // Top Candidates
    $data['topCandidates'] = CandidateModel::select('candidates.name', DB::raw('COUNT(votes.id) as total_votes'))
        ->leftJoin('votes', 'candidates.id', '=', 'votes.candidate_id')
        ->where('candidates.is_delete', 0)
        ->groupBy('candidates.id')
        ->orderBy('total_votes', 'desc')
        ->take(10)
        ->get();

    return view('admin.dashboard', $data);
    }
}
