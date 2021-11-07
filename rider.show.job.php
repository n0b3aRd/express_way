<?php

require_once ('controllers/JobController.php');
require_once ('controllers/RiderController.php');

$msg = '';
$status = '';
$job = [];
$employee = 'N/A';

/**
 * get job
 */
if (isset($_POST['get_job'])) {
    $job_controller = new JobController();
    $result = $job_controller->riderGetJob($_POST['job']['id']);
}

/**
 * get job
 */
if (isset($_POST['job_done'])) {
    $job_controller = new JobController();
    $result = $job_controller->riderJobDone($_POST['job']['id']);
}

/**
 * show job(show exsisting data of job )
 */
if (isset($_GET['id']) || isset($_POST['job']['id'])) {
    $job_id = (isset($_POST['job'])) ? $_POST['job']['id'] : $_GET['id'];
    $job_controller = new JobController();
    $job = $job_controller->editJob($job_id);

    if (count($job) < 3) {
        $status = $job['status'];
        $msg = $job['msg'];
        $job = [];
    } else {
        //get assign employee
        if ($job['rider_id'] != null) {
            $rider_controller = new RiderController();
            $rider = $rider_controller->editRider($job['rider_id']);

            if (count($rider) > 3) {
                $employee = $rider['fname'] . ' ' . $rider['lname'];
            }
        }
    }
}

/**
 * set result to show
 */
if (!empty($result)) {
    $status = $result['status'];
    $msg = $result['msg'];
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Express Way</title>

    <!-- Custom fonts for this template-->
    <link href="./assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="./assets/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

<!-- Page Wrapper -->
<div id="wrapper">

    <!-- Sidebar -->
    <?php require_once ('./rider_layout/rider.sidebar.php') ?>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            <?php require_once ('./rider_layout/rider.topbar.php') ?>
            <!-- End of Topbar -->

            <!-- Begin Page Content -->
            <div class="container">

                <!-- Page Heading -->
                <h1 class="h3 mb-4 text-gray-800">Job Details</h1>

                <!-- DataTales Example -->
                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Job ID: <?php echo 'E01' . str_pad($job['id'], 4, '0', STR_PAD_LEFT); ?></h6>
                        <h6 class="m-0 font-weight-bold text-primary">Job Status:
                            <?php if ($job['status'] == 'New') { ?>
                                <span class="badge badge-pill badge-success ml-1">New</span>
                            <?php } elseif ($job['status'] == 'Pending') { ?>
                                <span class="badge badge-pill badge-info ml-1">Pending</span>
                            <?php } else { ?>
                                <span class="badge badge-pill badge-danger ml-1">Complete</span>
                            <?php } ?>
                        </h6>
                        <h6 class="m-0 font-weight-bold text-primary">Employee: <?php echo $employee; ?></h6>
                    </div>
                    <form action="rider.show.job.php" method="post" id="job_show">
                        <!-- Card Body -->
                        <div class="card-body">

                            <?php if ($msg != '') { ?>
                                <div class="alert alert-dismissible fade show <?php if ($status == 'error') { echo 'alert-danger'; } else { echo 'alert-success';} ?> " role="alert">
                                    <?php echo $msg; ?>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            <?php } ?>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">From</label>
                                        <input type="text" id="from" class="form-control" disabled
                                               value="<?php if (!empty($job)) echo $job['from_location']; ?>"
                                               name="job[from_location]" placeholder="Pick up location">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Sender Name</label>
                                        <input type="text" id="sender" class="form-control" disabled
                                               value="<?php if (!empty($job)) echo $job['sender']; ?>"
                                               name="job[sender]" placeholder="Name of the sender">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Address</label>
                                        <input type="text" id="from_address" class="form-control" disabled
                                               value="<?php if (!empty($job)) echo $job['from_address']; ?>"
                                               name="job[from_address]" placeholder="Pick up address">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Pick Up Date</label>
                                        <input type="datetime-local" id="pickup_date" class="form-control" disabled
                                               value="<?php if (!empty($job)) echo date('Y-m-d\TH:i:s', strtotime($job['collect_date'])); ?>"
                                               name="job[collect_date]" placeholder="Pick up before">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Sender Mobile</label>
                                        <input type="text" id="sender_mobile" class="form-control" disabled
                                               value="<?php if (!empty($job)) echo $job['sender_mobile']; ?>"
                                               name="job[sender_mobile]" placeholder="Sender's contact number">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">To</label>
                                        <input type="text" id="to" class="form-control" disabled
                                               value="<?php if (!empty($job)) echo $job['to_location']; ?>"
                                               name="job[to_location]" placeholder="Delivery location">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Receiver Name</label>
                                        <input type="text" id="reciver" class="form-control" disabled
                                               value="<?php if (!empty($job)) echo $job['receiver']; ?>"
                                               name="job[receiver]" placeholder="Name of the receiver">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Address</label>
                                        <input type="text" id="to_address" class="form-control" disabled
                                               value="<?php if (!empty($job)) echo $job['to_address']; ?>"
                                               name="job[to_address]" placeholder="Delivery address">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Delivery Date</label>
                                        <input type="datetime-local" id="delever_date" class="form-control" disabled
                                               value="<?php if (!empty($job)) echo date('Y-m-d\TH:i:s', strtotime($job['deliver_date'])); ?>"
                                               name="job[deliver_date]" placeholder="Deliver on">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Receiver Mobile</label>
                                        <input type="text" id="reciver_mobile" class="form-control" disabled
                                               value="<?php if (!empty($job)) echo $job['receiver_mobile']; ?>"
                                               name="job[receiver_mobile]" placeholder="Receiver's contact number">
                                    </div>
                                </div>
                            </div>

                            <input type="hidden" name="job[id]" value="<?php if (!empty($job)) echo $job['id']; ?>">

                        </div>
                        <!-- Card footer -->
                        <div class="card-footer">
                            <div class="row justify-content-between">
                                <div>
                                    <button class="btn btn-sm btn-primary px-4 list" type="reset" value="reset">Back to list</button>
                                </div>
                                <div>
                                    <?php if ($job['status'] == 'New') { ?>
                                        <button class="btn btn-sm btn-success px-4 " type="submit" name="get_job">Get Job</button>
                                    <?php } elseif ($job['status'] == 'Pending') { ?>
                                    <button class="btn btn-sm btn-success px-4 " type="submit" name="job_done">Job Done</button>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <!--table end-->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
        <?php require_once ('./rider_layout/rider.footer.php') ?>
        <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<?php require_once ('./genaral_layout/logout.model.php') ?>

<!-- Bootstrap core JavaScript-->
<script src="./assets/vendor/jquery/jquery.min.js"></script>
<script src="./assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="./assets/vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="./assets/js/sb-admin-2.min.js"></script>
<script>
    var page = '';
    <?php if ($job['rider_id'] != null) { ?>
        page = 'my';
    <?php } else { ?>
        page = 'all';
    <?php } ?>
    $(document).ready(function () {
        $('.nav-item .collapse-item').removeClass('active');
        $('.collapse').removeClass('show');
        if (page === 'all') {
            $('#jobs_nav').addClass('active');
        } else {
            $('#my_jobs_nav').addClass('active');
        }
    });

    $('.list').on('click', function () {
        window.location.href = 'rider.jobs.list.php?page='+page;
    });
</script>
</body>

</html>

