<?php

use Illuminate\Database\Seeder;
use App\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        User::create([
            'email' => $faker->email,
            'name' => 'Admin',
            'password' => config('settings.user.default_password_seeder'),
            'role' => 1,
            'avatar' => 'http://s3.amazonaws.com/37assets/svn/765-default-avatar.png',
        ]);

        for ($i = 0; $i < 50; $i++) {
            User::create([
                'email' => $faker->email,
                'name' => $faker->name,
                'password' => config('settings.user.default_password_seeder'),
                'role' => 0,
                'avatar' => 'http://s3.amazonaws.com/37assets/svn/765-default-avatar.png',
            ]);
        }
    }
}
