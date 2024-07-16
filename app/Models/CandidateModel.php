<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Request;

class CandidateModel extends Model
{
    use HasFactory;
    protected $table = 'candidates';

    public function votes()
    {
        return $this->hasMany(VotesModel::class, 'candidate_id');
    }

    static public function getCandidates()
    {
        $return = self::select('candidates.*')
            ->where('is_delete', '=', 0);

                if (!empty(Request::get('email'))) {
                    $return = $return->where('email', 'like', '%'.Request::get('email').'%');
                }
                if (!empty(Request::get('name'))) {
                    $return = $return->where('name', 'like', '%'.Request::get('name').'%');
                }
                if (!empty(Request::get('date'))) {
                    $return = $return->whereDate('created_at', '=', Request::get('date'));
                }
        $return = $return->orderBy('id', 'desc')->paginate(5);

        return $return;
    }



    static public function getCandidatesWithVoteCounts($electionId)
{
    return self::withCount('votes')
        ->where('election', $electionId)
        ->where('is_delete', 0)
        ->orderBy('votes_count', 'desc')
        ->paginate(5);
}


    static public function getUnvotedCandidates()
    {
        $userId = Auth::user()->voter_id; // Assuming you're using Laravel's authentication

        // Query to get candidates that the user has not voted for
        $return = self::select('candidates.*')
            ->leftJoin('votes', function ($join) use ($userId) {
                $join->on('candidates.id', '=', 'votes.candidate_id')
                    ->where('votes.voter_id', '=', $userId);
            })
            ->whereNull('votes.id'); // Exclude candidates where the user has voted
            // ->where('candidates.is_delete', '=', 0);

        // Optional: Add additional filters if needed
        // if (!empty(Request::get('email'))) {
        //     $return->where('candidates.email', 'like', '%' . Request::get('email') . '%');
        // }
        // if (!empty(Request::get('name'))) {
        //     $return->where('candidates.name', 'like', '%' . Request::get('name') . '%');
        // }
        // if (!empty(Request::get('date'))) {
        //     $return->whereDate('candidates.created_at', '=', Request::get('date'));
        // }

        $return = $return->orderBy('votes.id', 'desc')->paginate(5);

        return $return;
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
        return CandidateModel::where('remember_token', '=', $remember_token)->first();
    }

    static public function getEmailSingle($email)
    {
        return CandidateModel::where('email', '=', $email)->first();
    }
}
