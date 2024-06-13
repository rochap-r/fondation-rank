<?php

namespace Database\Seeders;

use App\Models\Role;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Role::factory(1)->create();
        Role::factory(1)->create(['name'=>"admin"]);
        // User::factory(10)->create();

        $admin=User::factory()->create([
            'name'=>'Chot',
            'sname'=>'Apend',
            'lname'=>'Rodrigue',
            'gender'=>'m',
            'phone'=>'243992522582',
            'description'=>"Rochap est ma dénomination, je suis un passionné de la technologie et de l'informatique,
            dans tout c'est concevoir,analyser et développer les solutions informatiques qui fait mon vrai dévouement.",
            'email'=>'rodriguechot@gmail.com',
            'role_id'=>2,
        ]);
    }
}
