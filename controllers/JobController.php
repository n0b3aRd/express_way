<?php
session_start();
require_once('Database.php');

class JobController
{

    protected $database;

    public function __construct()
    {
        $db = new Database();
        $this->database = $db->database;
    }

    public function store($job)
    {
        $msg = '';
        $status = '';

        $now = date('Y-m-d H:i:s', time());

        foreach ($job as $key => $value) {
            $job[$key] = $this->database->escape_string($value);
        }

        $query = "INSERT INTO jobs ";
        $query .="(from_location, sender, from_address, collect_date, sender_mobile, to_location, receiver, to_address, deliver_date, receiver_mobile, created_at, updated_at)";
        $query .=" VALUES ('{$job['from_location']}', '{$job['sender']}', '{$job['from_address']}', '{$job['collect_date']}', '{$job['sender_mobile']}', '{$job['to_location']}', '{$job['receiver']}', '{$job['to_address']}', '{$job['deliver_date']}', '{$job['receiver_mobile']}', '{$now}', '{$now}')";

        $result = $this->database->query($query);
        $this->database->close();
        if ($result) {
            $status = 'success';
            $msg = 'Job added successfully.';
        } else {
            $status = 'error';
            $msg = 'Something went wrong.';
        }

        return ['status' => $status, 'msg' => $msg];

    }

    public function getJobList($status)
    {
        $status_filter = ($status == 'pending') ? " status != 'Complete'" : " status = 'Complete'";

        $query = "SELECT * FROM jobs where is_delete = 0 AND".$status_filter;
        $result_set = $this->database->query($query);

        $jobs = [];
        if ($result_set) {
            while ($result = $result_set->fetch_assoc()) {
                array_push($jobs, $result);
            }
        } else {

            echo 'Query failed. <br>';
        }
        $this->database->close();
        return $jobs;
    }

    public function editJob($id)
    {
        $query = "SELECT * FROM jobs where id = {$id}";
        $result = $this->database->query($query);

        if ($result->num_rows == 1) {
            $job = $result->fetch_assoc();
            $this->database->close();
            return $job;
        } else {
            return [
                'status' => 'error',
                'msg' => 'Something went wrong.'
            ];
        }
    }

    public function update($job)
    {
        $msg = '';
        $status = '';

        $now = date('Y-m-d H:i:s', time());
        $id = $job['id'];

        foreach ($job as $key => $value) {
            $job[$key] = $this->database->escape_string($value);
        }

        $query = "UPDATE jobs SET from_location='{$job['from_location']}', sender='{$job['sender']}', from_address='{$job['from_address']}', collect_date='{$job['collect_date']}', sender_mobile='{$job['sender_mobile']}', to_location='{$job['to_location']}', receiver='{$job['receiver']}', to_address='{$job['to_address']}', deliver_date='{$job['deliver_date']}', receiver_mobile='{$job['receiver_mobile']}', updated_at='{$now}' WHERE id={$id}";
        $result = $this->database->query($query);
        $this->database->close();
        if ($result) {
            $status = 'success';
            $msg = 'Job updated successfully.';
        } else {
            $status = 'error';
            $msg = 'Something went wrong.';
        }

        return ['status' => $status, 'msg' => $msg];
    }

    public function delete($id)
    {
        $msg = '';
        $status = '';
        $query = "UPDATE jobs SET is_delete='1' WHERE id = {$id}";
        $result = $this->database->query($query);

        if ($result) {
            $msg = $this->database->affected_rows . ' Job deleted.';
            $status = 'success';
        } else {
            $status = 'error';
            $msg = 'Something went wrong.';
        }

        return ['status' => $status, 'msg' => $msg];

    }

    /*
     * -----------------------------------------------Rider-------------------------------------------------------------
     */

    public function getRiderJobList($page)
    {
        $rider = ($page == 'All') ? 'rider_id is null' : 'rider_id='.$_SESSION['user']['id'];

        $query = "SELECT * FROM jobs where is_delete = 0 AND ".$rider;
        $result_set = $this->database->query($query);

        $jobs = [];
        if ($result_set) {
            while ($result = $result_set->fetch_assoc()) {
                array_push($jobs, $result);
            }
        } else {

            echo 'Query failed. <br>';
        }
        $this->database->close();
        return $jobs;
    }

    public function riderGetJob($job_id)
    {
        $rider_id = $_SESSION['user']['id'];

        $query = "UPDATE jobs SET rider_id={$rider_id}, status='Pending' WHERE id={$job_id}";
        $result = $this->database->query($query);
        $this->database->close();
        if ($result) {
            $status = 'success';
            $msg = 'You got the job.';
        } else {
            $status = 'error';
            $msg = 'Something went wrong.';
        }

        return ['status' => $status, 'msg' => $msg];
    }

    public function riderJobDone($job_id)
    {
        $query = "UPDATE jobs SET status='Complete' WHERE id={$job_id}";
        $result = $this->database->query($query);
        $this->database->close();
        if ($result) {
            $status = 'success';
            $msg = 'Job completed successfully.';
        } else {
            $status = 'error';
            $msg = 'Something went wrong.';
        }

        return ['status' => $status, 'msg' => $msg];
    }
}