<?php
return [
    'user' => [
        'is_admin' => 1,
        'avatar_path' => '/uploads/user/avatar',
        'paginate' => 10,
        'default_password_seeder' => '123123',
    ],
    'answer' => [
        'is_correct_answer' => 1,
    ],
    'filter' => [
        'all' => 'all',
        'no_learned' => 'no learned',
        'learned' => 'learned',
    ],
];
