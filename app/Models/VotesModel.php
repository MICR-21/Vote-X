<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VotesModel extends Model
{
    use HasFactory;
    protected $table = 'votes';


    static public function getMyVotes($id){
        $return = self::select('votes.*')
        ->where('candidate_id', '=', $id);
        $return = $return->orderBy('id', 'desc')->paginate(5);

        return $return;
    }
}
