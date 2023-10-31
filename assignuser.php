<?php require_once('include/function.php');?>
<?php logincheck();?>
<?php updateUserAssignment()?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Aplikasi Broadcast</title>

    <!-- Custom fonts for this template -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

    <!--Bootstrap-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->

        <?php include_once("include/sidebar.php");?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php require_once('include/topbar.php')?>
                <!-- End of Topbar -->
                

                <!-- Data Content -->
                <div class="container-fluid">
                    <div class="d-sm-flex align-items-center justify-content-between mb-5">
                    <h3>
                    <span><a  class= "h5" href="reference.php"><i class="fas fa-arrow-left mr-2"></i></a></span>
                    <span>Assign User</span>
                    </h3>
                    </div>
                
                <!-- Isi Form-->
                <div class="card shadow mb-4 col-sm-5 mx-auto">
                    <div class="card-body">
                    <h5 class="card-title">Assign Users to Group</h5>
                        <div class="container">
                            <div class="list-group">
                            <form method="POST" action="assignuser.php">
                            <?php showUserToAssign()?>
                            <input type="hidden" name="groupidHidden" id="groupidHidden" value="<?php echo $_GET['groupid'];?>">
                            </div>

                            <div class='form-group mt-5 text-center'>
                            <button type='submit' name='updateassignuser' id='updateassignuser' class='btn btn-primary'>Update</button>
                            <a type='button' href='' class='btn btn-outline-secondary' name='clearassignuser' id='clearassignuser'>Reset</a>
                            </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Data Content/container-fluid -->


            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <?php include_once("include/contentfooter.php");?>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!--End of Page Wrapper -->

    <!-- Include Scroll to Top Button-->
    <?php include_once("include/scrolltotop.php");?>

    <!-- Include Modal-->
    <?php include_once("include/modal.php");?>

    <!--include Script-->
    <?php include_once("include/script.php");?>
    <script src="js/additionalsidebar.js"></script>
    



</body>

</html>