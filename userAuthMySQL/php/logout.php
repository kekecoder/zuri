<?php
session_start();

function logout()
{
    $user = $_SESSION['username'] ?? false;
    if ($user) {
        unset($user);
        session_destroy();
    } else {
        header("Location: ../forms/login.html");
    }
}

logout();