<?php

class Dbh
{
    private $hostname = "localhost";
    private $username = "root";
    private $password = "jerusalem1991";
    private $dbname = "zuriphp";

    protected function connect()
    {
        $conn = mysqli_connect($this->hostname, $this->username, $this->password, $this->dbname);

        if (!$conn) {
            echo "Something went wrong, try again later";
        }

        return $conn;
    }
}