<?php

require_once ('RiderController.php');

$msg = '';
$status = '';
$rider = [];
/**
 * save rider
 */
if (isset($_POST['save']) && empty($rider)) {
    $rider = [
            'fname' => $_POST['fname'],
            'lname' => $_POST['lname'],
            'email' => $_POST['email'],
            'nic' => $_POST['nic'],
            'mobile' => $_POST['mobile'],
            'address' => $_POST['address'],
            'password' => $_POST['password'],
    ];

    $rider_controller = new RiderController();
    $result = $rider_controller->store($rider);
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
                <h1 class="h3 mb-4 text-gray-800">New Employee</h1>

                <div class="card shadow mb-4">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                        <h6 class="m-0 font-weight-bold text-primary">Enter Employee Details</h6>
                    </div>
                    <form action="admin.create.rider.php" method="post" id="employee_create">
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

                        <div class="form-group">
                            <label for="exampleInputEmail1">First Name</label>
                            <input type="text" name="fname" class="form-control" required
                                   id="fname" placeholder="First name of the employee">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Last Name</label>
                            <input type="text" name="lname" class="form-control" required
                                   id="lname" placeholder="Last name of the employee">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email address</label>
                            <input type="email" name="email" class="form-control" required
                                   id="email" placeholder="Email address of the employee">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">NIC</label>
                            <input type="text" name="nic" class="form-control" required
                                   id="nic" placeholder="NIC of the employee">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Mobile</label>
                            <input type="text" name="mobile" class="form-control" required
                                   id="mobile" placeholder="Mobile number of the employee">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Address</label>
                            <input type="text" name="address" class="form-control" required
                                   id="address" placeholder="Address of the employee">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Password</label>
                            <input type="text" name="password" class="form-control" readonly
                                   id="password" placeholder="Account Password of the employee">
                        </div>
                    </div>
                    <!-- Card footer -->
                    <div class="card-footer text-right">
                        <div class="">
                            <button class="btn btn-danger px-4 mr-2" type="reset">Clear</button>
                            <button class="btn btn-success px-4" type="submit" name="save">Save</button>
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
        $('#employee_create').validate();
    })

    $('#nic').keyup(function () {
        let val = $(this).val();
        $('#password').val(val);
    })
</script>

</body>

</html>
