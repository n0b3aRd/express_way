<?php

require_once ('database.php');

class RiderController
{

    protected $database;

    public function __construct()
    {
        $db = new Database();
        $this->database = $db->database;
    }

    public function store($rider)
    {
        $msg = '';
        $status = '';

        $password = password_hash($rider['password'], PASSWORD_DEFAULT);
        $now = date('Y-m-d H:i:s', time());

        foreach ($rider as $key => $value) {
            $rider[$key] = $this->database->escape_string($value);
        }

        $query = "INSERT INTO users (fname, lname, nic, mobile, address, email, password, created_at, updated_at) VALUES ('{$rider['fname']}', '{$rider['lname']}', '{$rider['nic']}', '{$rider['mobile']}', '{$rider['address']}', '{$rider['email']}', '{$password}', '{$now}', '{$now}')";
        $result = $this->database->query($query);
        $this->database->close();
        if ($result) {
            //$id = $this->database->insert_id;
            $status = 'success';
            $msg = 'Employee added successfully.';
        } else {
            $status = 'error';
            $msg = 'Something went wrong.';
        }

        return ['status' => $status, 'msg' => $msg];

    }

    public function getRiders()
    {

        $query = "SELECT * FROM users where is_admin = 0";
        $result_set = $this->database->query($query);

        $riders = [];
        if ($result_set) {
            while ($result = $result_set->fetch_assoc()) {
                array_push($riders, $result);
            }
        } else {

            echo 'Query failed. <br>';
        }

        return $riders;
    }

    public function deleteRider($id)
    {
        $msg = '';
        $status = '';
        $query = "DELETE FROM users WHERE id = {$id} LIMIT 1";
        $result = $this->database->query($query);

        if ($result) {
            $msg = $this->database->affected_rows . ' Employee deleted.';
            $status = 'success';
        } else {
            $status = 'error';
            $msg = 'Something went wrong.';
        }

        return ['status' => $status, 'msg' => $msg];

    }

}


?>