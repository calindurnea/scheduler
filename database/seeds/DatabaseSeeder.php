<?php

use App\Color;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement("SET foreign_key_checks = 0");

        DB::table('users')->truncate();
        DB::table('schedules')->truncate();
        //DB::table('shifts')->truncate();
        DB::table('role_user')->truncate();

        for ($i = 0; $i < 7; $i++) {
            DB::table('schedules')->insert([
                'dow' => $i,
                'start' => rand(6,10).":00:00",
                'duration' => rand(7, 14),
            ]);
        }

        factory(App\User::class, 5)->create()->each(function ($user) {
            $user->roles()->attach(3);
        });

        $admin = App\User::create([
            'first_name' => 'Administrator',
            'email' => 'admin@mail.dk',
            'password' => bcrypt('password'),
            'remember_token' => str_random(10),
        ]);
        $admin->roles()->attach(1);
    }
}
