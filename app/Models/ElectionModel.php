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

    protected $dates = ['start_date', 'end_date'];

    public static function getElections()
    {
        $query = self::where('is_deleted', 0);

        if ($name = Request::get('name')) {
            $query->where('name', 'like', "%{$name}%");
        }

        if ($startDate = Request::get('start_date')) {
            $query->whereDate('start_date', $startDate);
        }

        if ($endDate = Request::get('end_date')) {
            $query->whereDate('end_date', $endDate);
        }

        return $query->orderBy('id', 'desc')->paginate(9);
    }

    public function isActive()
    {
        $now = Carbon::now();
        return $this->start_date <= $now && $this->end_date >= $now;
    }

    public function scopeActive($query)
    {
        $now = Carbon::now();
        return $query->where('start_date', '<=', $now)
                     ->where('end_date', '>=', $now)
                     ->where('is_deleted', 0);
    }

    public function determineWinner()
    {
        return DB::transaction(function () {
            CandidateModel::where('election', $this->id)->update(['is_winner' => false]);

            $winner = CandidateModel::select('candidates.*', DB::raw('COUNT(votes.id) as vote_count'))
                ->leftJoin('votes', 'candidates.id', '=', 'votes.candidate_id')
                ->where('candidates.election', $this->id)
                ->where('candidates.is_deleted', 0)
                ->groupBy('candidates.id')
                ->orderBy('vote_count', 'desc')
                ->first();

            if ($winner) {
                $winner->is_winner = true;
                $winner->save();
            }

            return $winner;
        });
    }

    public static function getSingle($id)
    {
        return self::findOrFail($id);
    }

    public function routeNotificationForAfricasTalking($notification)
    {
        return $this->phone;
    }

    public static function getTokenSingle($remember_token)
    {
        return self::where('remember_token', $remember_token)->first();
    }

    public static function getEmailSingle($email)
    {
        return self::where('email', $email)->first();
    }
}
