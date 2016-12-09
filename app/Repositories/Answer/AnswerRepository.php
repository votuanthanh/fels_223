<?php
namespace App\Repositories\Answer;

use Auth;
use App\Repositories\BaseRepository;
use App\Model\Answer;

class AnswerRepository extends BaseRepository
{
    public function __construct(Answer $answer)
    {
        $this->model = $answer;
    }
}
