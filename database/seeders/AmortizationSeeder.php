<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Project;
use Illuminate\Support\Facades\DB;
class AmortizationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $projects = Project::all();
        $amortizations = [];
        foreach ($projects as $project) {
            for($i=0;$i<10000;$i++){
                DB::table('amortizations')->insert([
                    "project_id" => $project->id,
                    "user_id" =>  mt_rand (1, 7),
                    "schedule_date" => $this->getRandomFutureDate(1, 120),
                    "state" => 1,
                    "amount" => mt_rand (1000, 3500),
                ]);
            }
            
        }
    }

    function getRandomFutureDate($minDaysAhead = 1, $maxDaysAhead = 30) {
        // Get the current timestamp
        $currentTimestamp = time();
    
        // Generate a random number of seconds between $minDaysAhead and $maxDaysAhead days
        $randomSeconds = rand($minDaysAhead * 24 * 60 * 60, $maxDaysAhead * 24 * 60 * 60);
    
        // Calculate the future timestamp
        $futureTimestamp = $currentTimestamp + $randomSeconds;
    
        // Convert the timestamp to a date
        $futureDate = date('Y-m-d H:i:s', $futureTimestamp);
    
        return $futureDate;
    }
    
}
