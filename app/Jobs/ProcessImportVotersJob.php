<?php

namespace App\Jobs;

use App\Models\RegisteredVoter;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Str;

class ProcessImportVotersJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(private array $rowData, private array $mapping)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // $voter = RegisteredVoter::firstOrCreate(['usn_or_lrn' => $this->rowData[$this->mapping['category']]]);

        // try {
        //     // generate voter id
        //     $voter_id = fake()->numerify('V############');
        //     $email = $this->rowData[$this->mapping['firstname']] . '@mail.com';

        //     // create a user account for the voter
        //     $voter_acc = User::query()->create([
        //         'name' => $this->rowData[$this->mapping['usn']],
        //         'email' => $email,
        //         'email_verified_at' => now(),
        //         // 'password' => static::$password ??= Hash::make($this->rowData[$this->mapping['firstname']]),
        //         'password' => $this->rowData[$this->mapping['firstname']],
        //         'type' => 'VOTER',
        //         'remember_token' => Str::random(10),
        //     ]);

        //     // store the data in the database voter table
        //     $voter = RegisteredVoter::query()->create([
        //         'voter_id' => $voter_id,
        //         'usn_or_lrn' => $this->rowData[$this->mapping['usn']],
        //         'first_name' => $this->rowData[$this->mapping['firstname']],
        //         'mid_name' => $this->rowData[$this->mapping['middlename']],
        //         'last_name' => $this->rowData[$this->mapping['lastname']],
        //         'strand_or_course' => $this->rowData[$this->mapping['strand']],
        //         'school_level' => $this->rowData[$this->mapping['schoollevel']],
        //         'year' => $this->rowData[$this->mapping['year']],
        //         'section' => $this->rowData[$this->mapping['section']],
        //         'house' => $this->rowData[$this->mapping['house']],
        //         'user_id' => $voter_acc->id,
        //     ]);
        // } catch (\Exception $e) {
        //     // FacadesLog::error($e->getMessage());
        //     // FacadesLog::info(json_encode($this->rowData));
        //     // dd($e->getMessage());
        // }


        // $category = ProductCategory::firstOrCreate(['name' => $this->rowData[$this->mapping['category']]]);
        // try {
        //     Product::updateOrCreate(
        //         ['name' => $this->rowData[$this->mapping['name']], 'category_id' => $category->id],
        //         [
        //             'description' => $this->rowData[$this->mapping['description']],
        //             'price' => $this->rowData[$this->mapping['price']],
        //             'stock_left' => $this->rowData[$this->mapping['stock']],
        //         ]
        //     );
        // } catch (\Exception $e) {
        //     Log::error($e->getMessage());
        //     Log::info(json_encode($this->rowData));
        // }
    }
}
