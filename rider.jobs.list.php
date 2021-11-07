<?php

include_once ('controllers/JobController.php');
$status = '';
$msg = '';
$page = ($_GET['page'] == 'all') ? 'All' : 'My';

$job_controller =new JobController();
$jobs = $job_controller->getRiderJobList($page);

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
    <link href="./assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

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
            <div class="container-fluid">

                <!-- Page Heading -->
                <h1 class="h3 mb-4 text-gray-800"><?php echo $page ?> Jobs</h1>

                <!-- DataTales Example -->
                <div class="card shadow mb-4">
                    <div class="card-body">

                        <?php if ($msg != '') { ?>
                            <div class="alert alert-dismissible fade show <?php if ($status == 'error') { echo 'alert-danger'; } else { echo 'alert-success';} ?> " role="alert">
                                <?php echo $msg; ?>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        <?php } ?>

                        <div class="table-responsive">
                            <table class="table table-striped table-sm" id="jobs_table">
                                <thead>
                                <tr>
                                    <th>Job ID</th>
                                    <th>From</th>
                                    <th>Pick Up At</th>
                                    <th>To</th>
                                    <th>Deliver On</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>

                                <?php foreach ($jobs as $job) { ?>
                                    <tr>
                                        <td><?php
                                            echo 'E01' . str_pad($job['id'], 4, '0', STR_PAD_LEFT); ?></td>
                                        <td><?php
                                            echo $job['from_location']; ?></td>
                                        <td><?php
                                            echo date('Y-m-d | H:i A', strtotime($job['collect_date'])) ?></td>
                                        <td><?php
                                            echo $job['to_location']; ?></td>
                                        <td><?php
                                            echo date('Y-m-d | H:i A', strtotime($job['deliver_date'])) ?></td>
                                        <td class="text-center">
                                            <?php if ($job['status'] == 'New') { ?>
                                                <span class="badge badge-pill badge-success">New</span>
                                            <?php } elseif ($job['status'] == 'Pending') { ?>
                                                <span class="badge badge-pill badge-info">Pending</span>
                                            <?php } else { ?>
                                                <span class="badge badge-pill badge-danger">Complete</span>
                                            <?php } ?>
                                        </td>
                                        <td class="text-center">
                                            <button class="btn btn-sm btn btn-outline-secondary show_job" data-id="<?php echo $job['id']; ?>"><i class="fas fa-eye"></i></button>
                                        </td>
                                    </tr>
                                <?php } ?>

                                </tbody>
                            </table>
                        </div>
                    </div>
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
<script src="./assets/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="./assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>

<script>
    $(document).ready(function () {
        $('#jobs_table').DataTable();

        $('.nav-item .collapse-item').removeClass('active');
        $('.collapse').removeClass('show');
        <?php if ($_GET['page'] == 'all') { ?>
        $('#jobs_nav').addClass('active');
        <?php } else { ?>
        $('#my_jobs_nav').addClass('active');
        <?php } ?>
    });

    $('.show_job').on('click', function () {
        let id = $(this).data('id');
        window.location.href = 'rider.show.job.php?id='+id;
    })
</script>
</body>

</html>

