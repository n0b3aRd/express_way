<?php
//$user = $_SESSION['user'];

require_once('controllers/RiderController.php');

$msg = '';
$status = '';

/**
 * change password
 */
if (isset($_POST['save'])) {
    $password = [
        'rider_id' => $_POST['rider_id'],
        'current_pw' => $_POST['current_pw'],
        'new_pw' => $_POST['new_pw'],
        'confirm_pw' => $_POST['confirm_pw'],
    ];

    $rider_controller = new RiderController();
    $result = $rider_controller->changePassword($password);
    $password = [];
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
                <h1 class="h3 mb-4 text-gray-800">My Account</h1>

                <div class="row">
                    <div class="col-md-6 offset-md-3">
                        <div class="card shadow mb-4">
                            <!-- Card Header - Dropdown -->
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="mb-3 text-center">
                                        <img src="./assets/img/undraw_profile_2.svg" alt="user" style="width: 12rem">
                                    </div>
                                    <div id="details_div" class="text-center" style="display: <?php if(!empty($msg)) echo 'none'; ?>;">
                                        <h3><?php echo 'EMP' . str_pad($user['id'], 4, '0', STR_PAD_LEFT) ?></h3>
                                        <p class="h5 text-dark"><?php echo $user['fname'] . ' ' . $user['lname']; ?></p>
                                        <p class="mb-0"><i class="fas fa-address-card mr-2"></i><?php echo $user['nic'] ?></p>
                                        <p class="mb-0"><i class="fas fa-mobile-alt mr-2"></i><?php echo $user['mobile'] ?></p>
                                        <p class="text-primary"><i class="fas fa-at mr-2"></i><?php echo $user['email'] ?></p>
                                        <p class="font-italic "><?php echo $user['address'] ?></p>
                                        <button class="btn btn-primary mt-3" id="change_pw">Change Password</button>
                                    </div>
                                    <div id="change_pw_div" style="display: <?php if(empty($msg)) echo 'none'; ?>;">
                                        <form action="rider.account.php" method="post" id="change_pw_form">

                                            <?php if ($msg != '') { ?>
                                                <div class="alert alert-dismissible fade show <?php if ($status == 'error') { echo 'alert-danger'; } else { echo 'alert-success';} ?> " role="alert">
                                                    <?php echo $msg; ?>
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                            <?php } ?>

                                            <div class="form-group px-5">
                                                <label for="exampleInputEmail1">Current Password</label>
                                                <input type="password" name="current_pw" class="form-control" required
                                                       id="current_pw" placeholder="">
                                            </div>
                                            <div class="form-group px-5">
                                                <label for="exampleInputEmail1">New Password</label>
                                                <input type="password" name="new_pw" class="form-control" required
                                                       minlength="5"
                                                       id="new_pw" placeholder="">
                                            </div>
                                            <div class="form-group px-5">
                                                <label for="exampleInputEmail1">Confirm Password</label>
                                                <input type="password" name="confirm_pw" class="form-control" required
                                                       minlength="5"
                                                       id="confirm_pw" placeholder="">
                                            </div>
                                            <input type="hidden" name="rider_id" value="<?php echo $user['id']; ?>">
                                            <div class="form-group px-5 text-center">
                                                <button class="btn btn-secondary" id="cancel_btn" type="reset">Cancel</button>
                                                <button class="btn btn-primary" type="submit" name="save">Submit</button>
                                            </div>
                                        </form>
                                    </div>

                                </div>
                                <!-- Card footer -->
                        </div>
                    </div>
                </div>

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
<script src="./assets/js/validator/jquery-1.11.1.js"></script>
<script src="./assets/js/validator/jquery.validate.js"></script>

<script>
    $(document).ready(function () {
        $('.nav-item .collapse-item').removeClass('active');
        $('.collapse').removeClass('show');
        $('#my_account_nav').addClass('active');

        $('#change_pw').on('click', function () {
            $('#details_div').hide();
            $('#change_pw_div').show();
        });

        $('#cancel_btn').on('click', function () {
            $('#change_pw_div').hide();
            $('#details_div').show();
        })

        $('#change_pw_form').validate();

    })
</script>
</body>

</html>

