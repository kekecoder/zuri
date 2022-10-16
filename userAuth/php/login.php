<?php
session_start();
if (isset($_POST['submit'])) {
    $email = trim($_POST['email']); //finish this line
    $password = trim($_POST['password']); //finish this

    loginUser($email, $password);
}

function loginUser($email, $password)
{
    /*
        Finish this function to check if username and password 
    from file match that which is passed from the form
    */
    $user_path = '../storage/users.csv';
    $fp = fopen($user_path, 'r');

    $success = false;

    while (($data = fgetcsv($fp)) !== false) {
        // var_dump($data[2]);
        // exit;
        if ($data[1] === $email && $data[2] === $password) {
            $success = true;
            $_SESSION['username'] = $data[0];
            break;
        }
    }

    fclose($fp);
    if ($success) {
        header("Location: ../dashboard.php");
    } else {
        echo 'User does not exist';
    }
}