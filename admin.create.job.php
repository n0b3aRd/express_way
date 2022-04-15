<?php

require_once('controllers/JobController.php');

$msg = '';
$status = '';
$job = [];
$option = 'New';
$btn = ['val' => 'save', 'text' => 'Save'];

/**
 * save job
 */
if (isset($_POST['save'])) {
    $job_controller = new JobController();
    $result = $job_controller->store($_POST['job']);
    //$job = [];
}

/**
 * edit job(show exsisting data of job )
 */
if (isset($_GET['id'])) {
    $job_controller = new JobController();
    $job = $job_controller->editJob($_GET['id']);

    if (count($job) < 3) {
        $status = $job['status'];
        $msg = $job['msg'];
        $job = [];
    }
    $option = 'Update';
    $btn = ['val' => 'update', 'text' => 'Update'];
}

/**
 * update job
 */
if (isset($_POST['update'])) {
    $job_controller = new JobController();
    $result = $job_controller->update($_POST['job']);
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
    <?php require_once ('./admin_layout/admin.sidebar.php') ?>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            <?php require_once ('./admin_layout/admin.topbar.php') ?>
            <!-- End of Topbar -->

            <!-- Begin Page Content -->
            <div class="container">

                <!-- Page Heading -->
                <h1 class="h3 mb-4 text-gray-800"><?php echo $option; ?> Job</h1>

                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Enter Job Details</h6>
                    </div>
                    <form action="admin.create.job.php" method="post" id="job_create">
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
                                        <input type="text" id="from" class="form-control" required
                                               value="<?php if (!empty($job)) echo $job['from_location']; ?>"
                                               name="job[from_location]" placeholder="Pick up location">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Sender Name</label>
                                        <input type="text" id="sender" class="form-control" required
                                               value="<?php if (!empty($job)) echo $job['sender']; ?>"
                                               name="job[sender]" placeholder="Name of the sender">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Address</label>
                                        <input type="text" id="from_address" class="form-control" required
                                               value="<?php if (!empty($job)) echo $job['from_address']; ?>"
                                               name="job[from_address]" placeholder="Pick up address">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Pick Up Date</label>
                                        <input type="datetime-local" id="pickup_date" class="form-control" required
                                               value="<?php if (!empty($job)) echo date('Y-m-d\TH:i:s', strtotime($job['collect_date'])); ?>"
                                               name="job[collect_date]" placeholder="Pick up before">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Sender Mobile</label>
                                        <input type="text" id="sender_mobile" class="form-control" required
                                               value="<?php if (!empty($job)) echo $job['sender_mobile']; ?>"
                                               name="job[sender_mobile]" placeholder="Sender's contact number">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">To</label>
                                        <input type="text" id="to" class="form-control" required
                                               value="<?php if (!empty($job)) echo $job['to_location']; ?>"
                                               name="job[to_location]" placeholder="Delivery location">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Receiver Name</label>
                                        <input type="text" id="reciver" class="form-control" required
                                               value="<?php if (!empty($job)) echo $job['receiver']; ?>"
                                               name="job[receiver]" placeholder="Name of the receiver">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Address</label>
                                        <input type="text" id="to_address" class="form-control" required
                                               value="<?php if (!empty($job)) echo $job['to_address']; ?>"
                                               name="job[to_address]" placeholder="Delivery address">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Delivery Date</label>
                                        <input type="datetime-local" id="delever_date" class="form-control" required
                                               value="<?php if (!empty($job)) echo date('Y-m-d\TH:i:s', strtotime($job['deliver_date'])); ?>"
                                               name="job[deliver_date]" placeholder="Deliver on">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Receiver Mobile</label>
                                        <input type="text" id="reciver_mobile" class="form-control" required
                                               value="<?php if (!empty($job)) echo $job['receiver_mobile']; ?>"
                                               name="job[receiver_mobile]" placeholder="Receiver's contact number">
                                    </div>
                                </div>
                            </div>

                            <input type="hidden" name="job[id]" value="<?php if (!empty($job)) echo $job['id']; ?>">

                        </div>
                        <!-- Card footer -->
                        <div class="card-footer text-right">
                            <div class="">
                                <button class="btn btn-sm btn-danger px-4 mr-2" type="reset" value="reset">Clear</button>
                                <button class="btn btn-sm btn-success px-4" type="submit" name="<?php echo $btn['val'] ?>"><?php echo $btn['text'] ?></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
        <?php require_once ('./admin_layout/admin.footer.php') ?>
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
<script src="./assets/js/validator/jquery-1.11.1.js"></script>
<script src="./assets/js/validator/jquery.validate.js"></script>

<script>
    $(document).ready(function () {
        $.validator.addMethod(
            "regex",
            function(value, element, regexp) {
                var re = new RegExp(regexp);
                return this.optional(element) || re.test(value);
            },
            "Please enter valid mobile number."
        );

        $('#job_create').validate({
            rules: {
                "job[receiver_mobile]": {
                    required: true,
                    regex: /^(?:7|0|(?:\+94))[0-9]{8,9}$/
                },
                "job[sender_mobile]": {
                    required: true,
                    regex: /^(?:7|0|(?:\+94))[0-9]{8,9}$/
                }
            }
        });
        //set nav active state
        $('.nav-item .collapse-item').removeClass('active');
        $('.collapse').removeClass('show');
        $('#jobs_nav').addClass('active');
        <?php if (empty($job)) { ?>
        $('#new_job_nav').addClass('active');
        <?php } ?>
        $('#collapseTwo').addClass('show');
    });
</script>
</body>

</html>
