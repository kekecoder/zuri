<?php
$person = [
    "person1" => [
        'firstname' => 'Andrew',
        'lastname' => 'Zuri'
    ],
    "person2" => [
        "firstname" => 'Samuel',
        "lastname" => 'Hello'
    ]
];

var_dump($person['person2']['firstname']);