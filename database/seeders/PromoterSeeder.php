<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PromoterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $promoters = [
            [
                'promoter_name' => 'Promoter 1',
                'email' => 'wanessa.araujo.torres@gmail.com',
            ],
            [
                'promoter_name' => 'Promoter 2',
                'email' => 'wanessa.araujo.torres@promoter.com',
            ],
            [
                'promoter_name' => 'Promoter 3',
                'email' => 'wanessa.araujo.torres@promoter.com',
            ],
            [
                'promoter_name' => 'Promoter 4',
                'email' => 'wanessa.araujo.torres@promoter.com',
            ],
            [
                'promoter_name' => 'Promoter 5',
                'email' => 'wanessa.araujo.torres@promoter.com',
            ],
            [
                'promoter_name' => 'Promoter 6',
                'email' => 'wanessa.araujo.torres@promoter.com',
            ],
            [
                'promoter_name' => 'Promoter 7',
                'email' => 'wanessa.araujo.torres@promoter.com',
            ],
            [
                'promoter_name' => 'Promoter 8',
                'email' => 'wanessa.araujo.torres@promoter.com',
            ],
            [
                'promoter_name' => 'Promoter 9',
                'email' => 'wanessa.araujo.torres@promoter.com',
            ],
            [
                'promoter_name' => 'Promoter 10',
                'email' => 'wanessa.araujo.torres@promoter.com',
            ],
        ];
        foreach($promoters as $promoter){
            DB::table('promoters')->insert([
                'promoter_name' => $promoter['promoter_name'],
                'email' => $promoter['email'],
            ]);
        }
    }
}
