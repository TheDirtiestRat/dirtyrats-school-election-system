<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegisteredVoter extends Model
{
    use HasFactory;

    protected $fillable = [
        'voter_id',
        'usn_or_lrn',
        'first_name',
        'mid_name',
        'last_name',

        'school_level',

        'strand_or_course',
        'year',
        'section',

        'house',
        
        'user_id',
    ];
}
