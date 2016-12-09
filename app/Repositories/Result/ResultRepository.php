<?php
namespace App\Repositories\Result;

use Auth;
use App\Repositories\BaseRepository;
use App\Model\Word;
use App\Model\Category;
use App\Model\Result;
use App\Model\Answer;

class ResultRepository extends BaseRepository
{
    public function __construct(User $user)
    {
        $this->model = $user;
    }
}
