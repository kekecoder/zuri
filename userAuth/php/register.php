<?php
if (isset($_POST['submit'])) {
    $username = trim($_POST['fullname']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    registerUser($username, $email, $password);
}

function registerUser($username, $email, $password)
{
    //save data into the file
    $user_path = '../storage/users.csv';
    $fp = fopen($user_path, 'a');

    $data = [
        'fullname' => $username,
        'email' => $email,
        'password' => $password
    ];

    fputcsv($fp, $data);

    echo "User Successfully registered";
}