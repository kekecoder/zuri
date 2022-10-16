<?php
if (isset($_POST['submit'])) {
    $email = $_POST['email']; //complete this;
    $newpassword = $_POST['password']; //complete this;

    resetPassword($email, $newpassword);
}

function resetPassword($email, $password)
{
    //open file and check if the username exist inside
    //if it does, replace the password
    $user_path = '../storage/users.csv';
    $fp = fopen($user_path, 'r+');

    while (($data = fgetcsv($fp)) !== false) {
        if ($data[1] === $email) {
            $data[2] = $password;
        } else {
            echo 'email does not exist';
        }

        //var_dump($password);

        fputcsv($fp, explode(" ", $password));
        break;
    }
}