<?php
session_start();
require_once ('Database.php');

class DashboardController
{
    protected $database;

    public function __construct()
    {
        $db = new Database();
        $this->database = $db->database;
    }

    public function getAdminData()
    {
        $data = [
            'employees' => 0,
            'new_jobs' => 0,
            'pending_jobs' => 0,
            'complete_jobs' => 0,
        ];

        //employee count
        $query = "SELECT count(id) AS count FROM users where is_admin = '0'";
        $result = $this->database->query($query);
        if ($result) {
            $data['employees'] = $result->fetch_assoc()['count'];
        }
        //new_jobs count
        $query = "SELECT count(id) AS count FROM jobs where is_delete = '0' AND status = 'New'";
        $result = $this->database->query($query);
        if ($result) {
            $data['new_jobs'] = $result->fetch_assoc()['count'];
        }
        //pending_jobs count
        $query = "SELECT count(id) AS count FROM jobs where is_delete = '0' AND status = 'Pending'";
        $result = $this->database->query($query);
        if ($result) {
            $data['pending_jobs'] = $result->fetch_assoc()['count'];
        }
        //complete_jobs count
        $query = "SELECT count(id) AS count FROM jobs where is_delete = '0' AND status = 'Complete'";
        $result = $this->database->query($query);
        if ($result) {
            $data['complete_jobs'] = $result->fetch_assoc()['count'];
        }

        return $data;
    }

    public function getRiderData()
    {
        $rider_id = $_SESSION['user']['id'];
        $data = [
            'new_jobs' => 0,
            'pending_jobs' => 0,
            'complete_jobs' => 0,
        ];

        //new_jobs count
        $query = "SELECT count(id) AS count FROM jobs where is_delete = '0' AND status = 'New'";
        $result = $this->database->query($query);
        if ($result) {
            $data['new_jobs'] = $result->fetch_assoc()['count'];
        }
        //pending_jobs count
        $query = "SELECT count(id) AS count FROM jobs where is_delete = '0' AND status = 'Pending' AND rider_id = {$rider_id}";
        $result = $this->database->query($query);
        if ($result) {
            $data['pending_jobs'] = $result->fetch_assoc()['count'];
        }
        //complete_jobs count
        $query = "SELECT count(id) AS count FROM jobs where is_delete = '0' AND status = 'Complete' AND rider_id = {$rider_id}";
        $result = $this->database->query($query);
        if ($result) {
            $data['complete_jobs'] = $result->fetch_assoc()['count'];
        }

        return $data;
    }

}