<?php
session_start();
require_once ('database.php');

class LoginController
{
    protected $database;

    public function __construct()
    {
        $db = new Database();
        $this->database = $db->database;
    }

    public function login($email, $password)
    {
        $er_msg = '';
        $query = "SELECT * FROM users WHERE email = '{$email}' LIMIT 1";
        $result = $this->database->query($query);

        if ($result) {
            if ($result->num_rows == 1) {
                $user = $result->fetch_array();
                $this->database->close();
                if (password_verify($password, $user['password'])) {
                    //create user session
                    $_SESSION['user'] = $user;
                    if ($user['is_admin'] == 1){
                        header('Location:admin.dashboard.php');
                    } else {
                        //rider dashboard
                    }
                } else {
                    $er_msg = 'Invalid password.';
                }
            } else {
                $er_msg = 'User not found.';
            }
        } else {
            $er_msg = 'Something went wrong.';
        }

        return ['error_msg' => $er_msg, 'email' => $email];
//        $_SESSION['login_err'] = $er_msg;
//        header('index.php');
    }

}

?>