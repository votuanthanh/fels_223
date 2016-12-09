<?php

use Illuminate\Database\Seeder;
use App\Model\Category;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        for ($i = 0; $i < 10; $i++) {
            Category::create([
                'name' => $faker->word,
                'description' => $faker->catchPhrase,
            ]);
        }
    }
}
