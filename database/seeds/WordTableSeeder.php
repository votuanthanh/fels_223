<?php

use Illuminate\Database\Seeder;
use App\Model\Category;
use App\Model\Word;

class WordTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        $categories = Category::all();

        foreach ($categories as $category) {
            for ($i = 0; $i < 6; $i++) {
                Word::create([
                    'content' => $faker->word,
                    'category_id' => $category->id,
                    'created_at' => $faker->dateTime($max = 'now'),
                    'updated_at' => $faker->dateTime($max = 'now'),
                ]);
            }
        }
    }
}
