<?php

use Illuminate\Database\Seeder;

use App\Model\Word;
use App\Model\Lesson;
use App\Model\Answer;
use App\Model\Result;
use App\Model\Category;

class ResultTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $lessons = Lesson::all();
        $idCategorArray = Category::all()->pluck('id')->all();

        foreach ($lessons as $lesson) {
            $wordRand = Word::inRandomOrder()
                ->whereCategoryId($idCategorArray[array_rand($idCategorArray, 1)])
                ->take(5)
                ->get();

            foreach ($wordRand as $word) {
                $result = new Result;
                $result->lesson_id = $lesson->id;
                $idAnswerArray = Answer::whereWordId($word->id)
                    ->get()
                    ->pluck('id')
                    ->all();
                $result->word_id = $word->id;
                $result->category_id = $word->category_id;
                $result->answer_id = $idAnswerArray[array_rand($idAnswerArray, 1)];
                $result->save();
            }
        }
    }
}
