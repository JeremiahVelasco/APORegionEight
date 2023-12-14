<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 30; $i++) {
            $user = new user;
            $user->uid = fake()->numberBetween(00000 - 99999);
            $user->avatar = '/users/' . $user->uid . '.jpg';
            $user->fullname = fake()->name(15);
            $user->email = fake()->email();
            $user->password = bcrypt('secret');
            $user->classification = fake()->text(10);
            $user->chapter = fake()->text(15);
            $user->initiation_year = fake()->year();
            $user->batch_name = fake()->text(15);
            $user->baptismal_name = fake()->text(10);
            $user->ritualization_status = fake()->text(5);
            $user->ritualization_year = fake()->year();
            $user->position_held = fake()->text(10);
            $user->position_year = fake()->year();
            $user->alumni_assoc = fake()->text(10);
            $user->assoc_position = fake()->text(10);
            $user->assoc_position_year = fake()->year();
            $user->employment_status = fake()->text(10);
            $user->profession = fake()->text(10);
            $user->position = fake()->text(10);
            $user->save();
        }
    }
}
/*
$table->string('uid');
$table->string('fullname');
$table->string('email')->unique();
$table->string('password');
$table->string('classification');
$table->string('chapter');
$table->string('initiation_year');
$table->string('batch_name');
$table->string('baptismal_name');
$table->string('ritualization_status');
$table->string('ritualization_year');
$table->string('position_held');
$table->string('position_year');
$table->string('alumni_assoc');
$table->string('assoc_position');
$table->string('assoc_position_year');
$table->string('employmentstatus');
$table->string('profession');
$table->string('position');
*/