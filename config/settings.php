<?php
return [
    'user' => [
        'is_admin' => 1,
        'member' => 0,
        'avatar_path' => public_path() . '/uploads/avatar/',
        'paginate' => 10,
        'default_password_seeder' => '123123',
        'page' => 1,
        'avatar_default' => 'default-avatar.png',
    ],
    'answer' => [
        'is_correct_answer' => 1,
        'not_correct_answer' => 0,
        'checked' => 'checked',
        'number_choice' => 2,
    ],
    'filter' => [
        'all' => 'all',
        'no_learned' => 'no learned',
        'learned' => 'learned',
    ],
    'status' => [
        'success' => 1,
        'fail' => 0,
    ],
    'action' => [
        'add' => 'add',
        'remove' => 'remove',
    ],
    'word' => [
        'limit_words_random' => 20,
    ],
];
