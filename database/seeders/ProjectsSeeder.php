<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProjectsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $projects = [];
        for($i=0;$i<5000;$i++){
            $projects[] = [
                "name"=> "Projeto ".$i,
                "promoter_id" => mt_rand (1, 10),
                "wallet" => mt_rand (150000, 350000) / 10
            ];
        }
        foreach($projects as $project){
            DB::table('projects')->insert([
                'name' => $project['name'],
                'promoter_id' => $project['promoter_id'],
                'wallet' => $project['wallet'],
            ]);
        }
    }
}
