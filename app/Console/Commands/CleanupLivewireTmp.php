<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CleanupLivewireTmp extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:cleanup-livewire-tmp';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
{
      $path = public_path('storage/livewire-tmp');

    if (!is_dir($path)) {
        $this->info("No temp folder found at: " . $path);
        return;
    }

    $this->info("Folder found: " . $path);
    
    $deleted = 0;

    foreach (\Illuminate\Support\Facades\File::allFiles($path) as $file) {
        // Delete files older than 1 hour (adjust as needed)
        //if ($file->getMTime() < now()->subHours(1)->getTimestamp()) { 
        if (true){
            \Illuminate\Support\Facades\File::delete($file->getRealPath());
            $deleted++;
        }
    }

    $this->info("Deleted {$deleted} old temp files.");
    

    }

}

