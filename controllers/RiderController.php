<?php

require_once('Database.php');

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
        $this->database->close();
        return $riders;
    }

    public function editRider($id)
    {
        $query = "SELECT * FROM users where id = {$id}";
        $result = $this->database->query($query);

        if ($result->num_rows == 1) {
            $rider = $result->fetch_assoc();
            $this->database->close();
            return $rider;
        } else {
            return [
                'status' => 'error',
                'msg' => 'Something went wrong.'
            ];
        }
    }

    public function update($rider)
    {
        $msg = '';
        $status = '';

        $now = date('Y-m-d H:i:s', time());
        $id = $rider['id'];

        foreach ($rider as $key => $value) {
            $rider[$key] = $this->database->escape_string($value);
        }

        $query = "UPDATE users SET fname = '{$rider['fname']}', lname = '{$rider['lname']}', nic = '{$rider['nic']}', mobile = '{$rider['mobile']}', address = '{$rider['address']}', email = '{$rider['email']}', updated_at = '{$now}' WHERE id = '{$id}'";
        $result = $this->database->query($query);
        $this->database->close();
        if ($result) {
            $status = 'success';
            $msg = 'Employee updated successfully.';
        } else {
            $status = 'error';
            $msg = 'Something went wrong.';
        }

        return ['status' => $status, 'msg' => $msg];
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

    public function changePassword(array $password)
    {
        $status = 'error';
        $er_msg = '';
        $query = "SELECT * FROM users WHERE id = '{$password['rider_id']}' LIMIT 1";
        $result = $this->database->query($query);

        if ($result) {
            if ($result->num_rows == 1) {
                $user = $result->fetch_array();
                //check current password
                if (password_verify($password['current_pw'], $user['password'])) {
                    //check new and confirm same
                    if ($password['new_pw'] == $password['confirm_pw']) {
                        //check length
                        if (strlen($password['new_pw']) >= 5) {
                            //change password
                            $new_password = password_hash($password['new_pw'], PASSWORD_DEFAULT);
                            $query = "UPDATE users SET password = '{$new_password}' WHERE id = '{$password['rider_id']}'";
                            $result = $this->database->query($query);
                            $this->database->close();
                            if ($result) {
                                $status = 'success';
                                $er_msg = 'Password changed successfully.';
                            } else {
                                $er_msg = 'Something went wrong.';
                            }
                        } else {
                            $er_msg = 'Password should have at least 5 characters.';
                        }

                    } else {
                        $er_msg = 'New password and Confirm password miss match.';
                    }
                } else {
                    $er_msg = 'Current password is invalid.';
                }
            } else {
                $er_msg = 'User not found.';
            }
        } else {
            $er_msg = 'Something went wrong.';
        }

        return ['status' => $status, 'msg' => $er_msg];
    }

}


?>