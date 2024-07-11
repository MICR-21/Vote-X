<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;

class ElectionModel extends Model
{
    use HasFactory;
    protected $table = 'elections';


    static public function getElections()
    {
        $return = self::select('elections.*')
            ->where('is_delete', '=', 0);

                if (!empty(Request::get('name'))) {
                    $return = $return->where('name', 'like', '%'.Request::get('name').'%');
                }

                if (!empty(Request::get('start_date'))) {
                    $return = $return->whereDate('start_date', '=', Request::get('date'));
                }
                if (!empty(Request::get('end_date'))) {
                    $return = $return->whereDate('end_date', '=', Request::get('date'));
                }
        $return = $return->orderBy('id', 'desc')->paginate(9);

        return $return;
    }

    public function isActive()
    {
        $now = Carbon::now();
        return $this->start_date <= $now && $this->end_date >= $now;
    }

    // You can also add a scope to easily query active elections
    public function scopeActive($query)
    {
        $now = Carbon::now();
        return $query->where('start_date', '<=', $now)
                     ->where('end_date', '>=', $now);
    }

    static public function getCandidatesWithVoteCounts($electionId)
    {
        $return = self::select('candidates.*', DB::raw('COUNT(votes.id) as vote_count'))
            ->join('candidates', 'elections.id', '=', 'candidates.election_id')
            ->leftJoin('votes', 'candidates.id', '=', 'votes.candidate_id')
            ->where('elections.id', '=', $electionId)
            ->where('candidates.is_delete', '=', 0)
            ->groupBy('candidates.id')
            ->orderBy('vote_count', 'desc')
            ->paginate(5);

        return $return;
    }

    public function determineWinner()
    {
        DB::beginTransaction();
        try {
            // Reset all candidates' is_winner status for this election
            CandidateModel::where('election', $this->id)->update(['is_winner' => false]);

            $winner = CandidateModel::select('candidates.*', DB::raw('COUNT(votes.id) as vote_count'))
                ->leftJoin('votes', 'candidates.id', '=', 'votes.candidate_id')
                ->where('candidates.election', '=', $this->id)
                ->where('candidates.is_delete', '=', 0)
                ->groupBy('candidates.id')
                ->orderBy('vote_count', 'desc')
                ->first();

            if ($winner) {
                $winner->is_winner = true;
                $winner->save();
            }

            DB::commit();
            return $winner;
        } catch (\Exception $e) {
            DB::rollback();
            // Handle the error (log it, notify admin, etc.)
            return null;
        }
    }
    static public function getSingle($id){
        return self::find($id);
    }


    public function routeNotificationForAfricasTalking($notification)
    {
        return $this->phone;
    }

    static public function getTokenSingle($remember_token)
    {
        return ElectionModel::where('remember_token', '=', $remember_token)->first();
    }

    static public function getEmailSingle($email)
    {
        return ElectionModel::where('email', '=', $email)->first();
    }
}
