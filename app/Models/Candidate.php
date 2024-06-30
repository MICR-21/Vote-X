<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'election_id'];

    public function election()
    {
        return $this->belongsTo(Election::class);
    }

}


// namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
// use Illuminate\Database\Eloquent\Model;

// class Candidate extends Model
// {
//     use HasFactory;

//     protected $fillable = [
//         'name',
//         'election_id',
//         // Add other fields if needed
//     ];

//     public function election()
//     {
//         return $this->belongsTo(Election::class);
//     }
// }

