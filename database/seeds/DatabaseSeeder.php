<?php

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
        $this->call(CategoryTableSeeder::class);
        $this->call(WordTableSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(AnswerTableSeeder::class);
        $this->call(LessonTableSeeder::class);
        $this->call(ResultTableSeeder::class);
    }
}
