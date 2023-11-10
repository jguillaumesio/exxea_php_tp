<?php
return [
    'GET' => [
        '/' => ['BookController', 'index'],
        '/book/new' => ['BookController', 'form'],
        '/book/{id}' => ['BookController', 'show'],
    ],
    'POST' => [
        '/book/delete/{id}' => ['BookController', 'delete'],
        '/book/{id}' => ['BookController', 'update'],
        '/book' => ['BookController', 'create'],
    ],
];