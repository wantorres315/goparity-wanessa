<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Wanessa Motta',
                'email' => 'wanessa.araujo.torres@gmail.com',
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'Wanessa Motta2',
                'email' => 'wanessa.araujo.torres2@gmail.com',
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'Wanessa Motta3',
                'email' => 'wanessa.araujo.torres3@gmail.com',
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'Wanessa Motta4',
                'email' => 'wanessa.araujo.torres4@gmail.com',
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'Wanessa Motta5',
                'email' => 'wanessa.araujo.torres5@gmail.com',
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'Wanessa Motta6',
                'email' => 'wanessa.araujo.torres6@gmail.com',
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'Wanessa Motta7',
                'email' => 'wanessa.araujo.torres7@gmail.com',
                'password' => Hash::make('password'),
            ],
        ];
        foreach($users as $user){
            DB::table('users')->insert([
                'name' => $user['name'],
                'email' => $user['email'],
                'password' => $user['password'],
            ]);
        }
       
    }
}
