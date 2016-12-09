<?php

use Illuminate\Database\Seeder;

use App\Model\Word;
use App\Model\Answer;

class AnswerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        $words = Word::all();

        foreach ($words as $word) {
            $numberRandom = rand(2, 5);
            $uniqueNumber = $this->getRandomNumbers(1, $numberRandom, 1)[0];

            for ($i = 1; $i <= $numberRandom; $i++) {
                Answer::create([
                    'word_id' => $word->id,
                    'content' => $faker->word,
                    'is_correct' => $uniqueNumber == $i ? 1 : 0,
                    'created_at' => $faker->dateTime($max = 'now'),
                    'updated_at' => $faker->dateTime($max = 'now'),
                ]);
            }
        }
    }

    public function getRandomNumbers($min, $max, $count)
    {
        if ($count > (($max - $min) + 1)) {
            return false;
        }
        $values = range($min, $max);
        shuffle($values);
        return array_slice($values, 0, $count);
    }
}
