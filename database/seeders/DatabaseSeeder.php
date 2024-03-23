<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $users = [
            [
               'name'=>'Administrateur',
               'email'=>'admin@epf.africa',
               'type'=>2,
               'password'=> bcrypt('123456'),
            ],
            [
               'name'=>'Professuer',
               'email'=>'professeur@epf.africa',
               'type'=> 1,
               'password'=> bcrypt('123456'),
            ],
            [
               'name'=>'Etudiant',
               'email'=>'etudiant@epf.africa',
               'type'=>0,
               'password'=> bcrypt('123456'),
            ],
        ];

        foreach ($users as $key => $user) {
            User::create($user);
        }
    }
}
