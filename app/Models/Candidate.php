<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        // 'course_Or_strand',
        // 'school_level',
        'position',
        'partylist',
        'photo',
    ];
}
