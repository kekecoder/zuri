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
    $temp_csv = '../storage/temp.csv';
    $fp = fopen($user_path, 'r');
    if (!$temp_csv) {
        touch('../storage/temp.csv');
    }
    $fw = fopen($temp_csv, 'w');


    while (($data = fgetcsv($fp)) !== false) {
        if ($data[1] == $email) {
            $data[2] = $password;
            echo "Password changed successfully";
        } else {
            echo 'email does not exist';
        }

        fputcsv($fw, $data);
    }
    fclose($fp);
    fclose($fw);

    unlink('../storage/users.csv');
    rename($temp_csv, '../storage/users.csv');
}