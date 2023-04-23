<?php

class Dbo extends mysqli
{
    protected string $hostname = "localhost";
    protected string $username = "root";
    protected string $password = "";
    protected string $database = "cars_db";

    public function default()
    {
        $this->local();
    }

    public function local()
    {
        parent::__construct($this->hostname, $this->username, $this->password, $this->database);

        if (mysqli_connect_error()) {
            die("ERROR DATABASE: " . mysqli_connect_error());
        }
    }
}