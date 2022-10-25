<?php
session_start();

require_once "../config.php";

//register users
function registerUser($fullnames, $country, $email, $gender, $password)
{
    //create a connection variable using the db function in config.php
    $conn = db();
    //check if user with this email already exist in the database
    $query = "SELECT * FROM Students WHERE email = '$email'";
    $result = mysqli_query($conn, $query);
    $user = mysqli_fetch_assoc($result);
    if ($user) {
        if ($user['email'] === $email) {
            echo "This email is already taken";
            exit;
        }
    }
    $query = "INSERT INTO Students(full_names, country, email, gender, password, created_at)VALUES('$fullnames', '$country', '$email', '$gender', '$password', NOW())";

    mysqli_query($conn, $query);
    echo "User successfully registered";
}


//login users
function loginUser($email, $password)
{
    //create a connection variable using the db function in config.php
    $conn = db();

    //open connection to the database and check if username exist in the database
    $query = "SELECT * FROM Students WHERE email = '$email' AND password = '$password'";
    $result = mysqli_query($conn, $query);
    $count = mysqli_fetch_assoc($result);
    if (mysqli_num_rows($result) == 1) {
        $_SESSION['username'] = $count['full_names'];
        header("Location: ../dashboard.php");
    } else {
        echo "Invalid Email/Password";
    }

    //if it does, check if the password is the same with what is given
    //if true then set user session for the user and redirect to the dasbboard
}


function resetPassword($email, $password)
{
    //create a connection variable using the db function in config.php
    $conn = db();
    $query = "SELECT * FROM Students WHERE email = '$email'";
    $result = mysqli_query($conn, $query);
    if (!mysqli_num_rows($result) == 1) {
        echo "Email does not exist";
        exit;
    }

    $query = "UPDATE Students SET password = '$password' WHERE email = '$email'";

    if (mysqli_query($conn, $query)) {
        echo "Password Updated";
    }

    //open connection to the database and check if username exist in the database
    //if it does, replace the password with $password given
}

function getusers()
{
    $conn = db();
    $sql = "SELECT * FROM Students";
    $result = mysqli_query($conn, $sql);
    echo "<html>
    <head></head>
    <body>
    <center><h1><u> ZURI PHP STUDENTS </u> </h1> 
    <table border='1' style='width: 700px; background-color: magenta; border-style: none'; >
    <tr style='height: 40px'><th>ID</th><th>Full Names</th> <th>Email</th> <th>Gender</th> <th>Country</th> <th>Action</th></tr>";
    if (mysqli_num_rows($result) > 0) {
        while ($data = mysqli_fetch_assoc($result)) {
            //show data
            echo "<tr style='height: 30px'>" .
                "<td style='width: 50px; background: blue'>" . $data['id'] . "</td>
                <td style='width: 150px'>" . $data['full_names'] .
                "</td> <td style='width: 150px'>" . $data['email'] .
                "</td> <td style='width: 150px'>" . $data['gender'] .
                "</td> <td style='width: 150px'>" . $data['country'] .
                "</td>
                <form action='action.php' method='post'>
                <input type='hidden' name='id'" .
                "value=" . $data['id'] . ">" .
                "<td style='width: 150px'> <button type='submit', name='delete'> DELETE </button>" .
                "</tr>";
        }
        echo "</table></table></center></body></html>";
    }
    //return users from the database
    //loop through the users and display them on a table
}

function deleteaccount($id)
{
    $conn = db();
    //delete user with the given id from the database
    $query = "DELETE FROM Students WHERE id = '$id'";
    $result = mysqli_query($conn, $query);
    if ($result) {
        echo "User Deleted";
    } else {
        echo "Error: Something went wrong";
    }
}