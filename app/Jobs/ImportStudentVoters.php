<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use App\Models\RegisteredVoter;
use App\Models\User;
use Illuminate\Support\Str;

class ImportStudentVoters implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $file;
    public $header;
    /**
     * Create a new job instance.
     */
    public function __construct($_file, $header)
    {
        $this->file = $_file;
        $this->header = $header;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // sleep(5);
        foreach ($this->file as $voter) {
            // inserts the data
            $votersData = array_combine($this->header, $voter);
            
            // generate voter id
            $voter_id = fake()->numerify('V############');
            $email = $votersData['LAST NAME'] . '@mail.com';

            // create a user account for the voter
            $voter_acc = User::query()->create([
                'name' => $votersData['USN'],
                'email' => $email,
                'email_verified_at' => now(),
                // 'password' => static::$password ??= Hash::make($data[3]),
                'password' => $votersData['LAST NAME'],
                'type' => 'VOTER',
                'remember_token' => Str::random(10),
            ]);

            // dd($voter_acc->id);

            // store the data in the database voter table
            $voter = RegisteredVoter::query()->create([
                'voter_id' => $voter_id,
                'usn_or_lrn' => $votersData['USN'],
                'first_name' => $votersData['FIRST NAME'],
                'mid_name' => $votersData['MIDDLE NAME'],
                'last_name' => $votersData['LAST NAME'],
                'strand_or_course' => $votersData['STRAND'],
                'school_level' => $votersData['school Level'],
                'year' => $votersData['year'],
                'section' => $votersData['SECTION'],
                'house' => $votersData['HOUSES'],
                'user_id' => $voter_acc->id,
            ]);
        }
    }
}
