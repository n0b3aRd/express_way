<?php

class Database
{

    public $database;

    public function __construct()
    {
        $this->database = new mysqli('localhost', 'root', '', 'delivery_max');

        if ($this->database->connect_errno) {
            echo 'Database connection failed. <br>';
            echo $this->database->connect_errno . ' - ' . $this->database->connect_error . '<br>';
        }

    }



}


?>
