<?php

require_once('RiderController.php');

$msg = '';
$status = '';

/**
 * delete riders
 */
if (isset($_POST['delete'])) {

    if (isset($_POST['rider'])) {
        $rider_controller = new RiderController();
        $result = $rider_controller->deleteRider($_POST['rider']);
    }

}
/**
 *get rider list
 */
$rider_controller = new RiderController();
$riders = $rider_controller->getRiders();

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
    <link href="./assets/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>

<body id="page-top">

<!-- Page Wrapper -->
<div id="wrapper">

    <!-- Sidebar -->
    <?php
    require_once('./admin_layout/admin.sidebar.php') ?>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            <?php
            require_once('./admin_layout/admin.topbar.php') ?>
            <!-- End of Topbar -->

            <!-- Begin Page Content -->
            <div class="container-fluid">

                <!-- Page Heading -->
                <h1 class="h3 mb-4 text-gray-800">Employee List</h1>

                <!-- DataTales Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">All Employee</h6>
                    </div>
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
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                <tr>
                                    <th>EMP ID</th>
                                    <th>Name</th>
                                    <th>NIC</th>
                                    <th>Mobile</th>
                                    <th>Address</th>
                                    <th>action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                foreach ($riders as $rider) { ?>
                                    <tr>
                                        <td><?php
                                            echo 'EMP' . str_pad($rider['id'], 4, '0', STR_PAD_LEFT) ?></td>
                                        <td><?php
                                            echo $rider['fname'] . ' ' . $rider['lname'] ?></td>
                                        <td><?php
                                            echo $rider['nic'] ?></td>
                                        <td><?php
                                            echo $rider['mobile'] ?></td>
                                        <td><?php
                                            echo $rider['address'] ?></td>
                                        <td>
                                            <button class="btn btn-warning edit" data-id="<?php echo $rider['id']; ?>"><i class="fas fa-edit"></i></button>
                                            <button class="btn btn-danger delete" data-id="<?php echo $rider['id']; ?>"><i class="fas fa-trash-alt"></i></button>
                                        </td>
                                    </tr>

                                <?php
                                } ?>
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
        <?php
        require_once('./admin_layout/admin.footer.php') ?>
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
<?php
require_once('./genaral_layout/logout.model.php');
require_once('./genaral_layout/delete.model.php');
?>

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
        $('#dataTable').DataTable();
    });

    $('.delete').on('click', function () {
        let id = $(this).data('id');
        $('#delete_id').attr('name', 'rider');
        $('#delete_id').attr('value', id);
        $('#deleteModel form').attr('action', './admin.rider.list.php');
        $('#deleteModel').modal('show');
    })

</script>

</body>

</html>
