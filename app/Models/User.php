<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }



    static public function getAdmin()
    {
        $return = self::select('users.*')
            ->where('user_type', '=', 1)
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
    static public function getUsers()
    {
        $return = self::select('users.*')
            ->where('user_type', '=', 2)
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

    // static public function getCandidates()
    // {
    //     $return = self::select('candidates.*')
    //         ->where('is_delete', '=', 0);

    //             if (!empty(Request::get('email'))) {
    //                 $return = $return->where('email', 'like', '%'.Request::get('email').'%');
    //             }
    //             if (!empty(Request::get('name'))) {
    //                 $return = $return->where('name', 'like', '%'.Request::get('name').'%');
    //             }
    //             if (!empty(Request::get('date'))) {
    //                 $return = $return->whereDate('created_at', '=', Request::get('date'));
    //             }
    //     $return = $return->orderBy('id', 'desc')->paginate(5);

    //     return $return;
    // }



    static public function getCandidates()
    {
        $userId = Auth::user()->voter_id; // Assuming you're using Laravel's authentication

        // Query to get candidates that the user has not voted for
        $return = self::select('candidates')
            ->leftJoin('votes', function ($join) use ($userId) {
                $join->on('candidates.id', '=', 'votes.candidate_id')
                    ->where('votes.user_id', '=', $userId);
            })
            ->whereNull('votes.id') // Exclude candidates where the user has voted
            ->where('candidates.is_delete', '=', 0);

        // Optional: Add additional filters if needed
        if (!empty(Request::get('email'))) {
            $return->where('candidates.email', 'like', '%' . Request::get('email') . '%');
        }
        if (!empty(Request::get('name'))) {
            $return->where('candidates.name', 'like', '%' . Request::get('name') . '%');
        }
        if (!empty(Request::get('date'))) {
            $return->whereDate('candidates.created_at', '=', Request::get('date'));
        }

        $return = $return->orderBy('candidates.id', 'desc')->paginate(5);

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
        return User::where('remember_token', '=', $remember_token)->first();
    }

    static public function getEmailSingle($email)
    {
        return User::where('email', '=', $email)->first();
    }
}
