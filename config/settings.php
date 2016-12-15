<?php
return [
    'user' => [
        'is_admin' => 1,
        'avatar_path' => '/uploads/user/avatar',
        'paginate' => 10,
        'default_password_seeder' => '123123',
        'page' => 1,
    ],
    'answer' => [
        'is_correct_answer' => 1,
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
];
