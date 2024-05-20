<?php

namespace App\Jobs;
use Carbon\Carbon;
use App\Models\apprentis;
use App\Models\Assiduites;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class UpdateApprentisStatus implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // Get current date
        $currentDate = Carbon::now();

        // Get all assiduites that have reached their datefin
        $assiduites = Assiduites::where('datefin', '<=', $currentDate)->get();

        foreach ($assiduites as $assiduite) {
            // Find the apprentice and update the status
            $apprentis = Apprentis::find($assiduite->apprenti_id);
            if ($apprentis) {
                $apprentis->status = 'inactif';
                $apprentis->save();
            }
        }
    }
}
