<?php
session_start();
function logout()
{
    /*
Check if the existing user has a session
if it does
destroy the session and redirect to login page
*/
    $old_user = $_SESSION['username'];
    unset($old_user);
    session_destroy();

    header("Location: ../forms/login.html");
}

logout();

// echo "HANDLE THIS PAGE";