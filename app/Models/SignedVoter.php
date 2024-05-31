<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SignedVoter extends Model
{
    use HasFactory;

    protected $fillable = [
        'voter',
        'scanner_in',
        'scan_in',
        'scanner_out',
        'scan_out',
    ];
}
