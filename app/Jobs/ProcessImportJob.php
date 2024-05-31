<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Jobs\ProcessImportVotersJob;

class ProcessImportJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $timeout = 1200;  // 20-minute timeout
    public function __construct(private string $filePath)
    {
    }
    public function handle()
    {
        $mapping = [
            'usn' => 0, 'firstname' => 1, 'middlename' => 2, 'lastname' => 3,
            'schoollevel' => 3, 'strand' => 4, 'year' => 5, 'section' => 6, 'house' => 7,
        ];
        $fileStream = fopen($this->filePath, 'r');
        $skipHeader = true;

        while ($row = fgetcsv($fileStream)) {
            // if ($skipHeader) {
            //     $skipHeader = false;
            //     continue;
            // }
            
            dispatch(new ProcessImportVotersJob($row, $mapping));
        }
        fclose($fileStream);
        unlink($this->filePath);  // Delete file after reading
    }
}
