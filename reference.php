<?php require_once('include/function.php');?>
<?php logincheck();?>
<?php admincheck()?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Tables</title>

    <!-- Custom fonts for this template -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <!--Bootstrap-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/additionalsidebar.css">
</head>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <?php require_once("include/sidebar.php");?>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php include_once("include/topbar.php");?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    
                    <!--User Reference-->
                    <div class="d-sm-flex align-items-center justify-content-between mb-2">
                        <h1 class="h3 mb-0 text-gray-900">Daftar User</h1>   
                    </div>
                    <div class=" align-right justify-content-between mb-2 text-right">
                        <a class="btn btn-primary align-right mx-auto" href="adduser.php?type=user" name="adduserbutton" id="adduserbutton"><i class="fas fa-plus mr-2"></i>Add user</a>
                    </div>
                    <!-- Card dan Tabel User -->
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover" id="userTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th class="text-gray-900">No</th>
                                            <th class="text-gray-900">Nama</th>
                                            <th class="text-gray-900">NIP</th>
                                            <th class="text-gray-900">Bidang</th>
                                            <th class="text-gray-900">Nomor HP</th>
                                            <th class="text-gray-900">Role</th>
                                            <th class="text-gray-900">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-gray-900">
                                    <?php readuser() //fungsi admin no.1;?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!--Group Reference-->
                    <div class="d-sm-flex align-items-center justify-content-between mb-2">
                        <h1 class="h3 mb-0 text-gray-900 mt-2">Daftar Group</h1>   
                    </div>
                    <div class=" align-right justify-content-between mb-2 text-right">
                        <a class="btn btn-primary align-right mx-auto" href="adduser.php?type=group" name="addgroupbutton" id="addgroupbutton"><i class="fas fa-plus mr-2"></i>Add grup</a>
                    </div>

                    <!-- Card dan Tabel Group -->
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover" id="grupTable" width="100%" cellspacing="0">
                                <thead>
                                        <tr>
                                            <th class="text-gray-900">No</th>
                                            <th class="text-gray-900">Nama Grup</th>
                                            <th class="text-gray-900">Group ID</th>
                                            <th class="text-gray-900">Action</th>
                                        </tr>
                                </thead>
                                <tbody class="text-gray-900">
                                <?php readgroup(); //fungsi admin no.11?>
                                </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <?php include_once("include/contentfooter.php");?>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <?php include_once("include/scrolltotop.php");?>

    <!-- Include Modal-->
    <?php include_once("include/modal.php");?>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
 

    <!--Initialize page level table-->
    <script>
    $(document).ready(function() {
    $('#userTable').DataTable();
    });

    $(document).ready(function() {
    $('#grupTable').DataTable();
    });
    </script>

    <!--sweet alert-->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

     <!--delete user script-->
    <script>
    function hapusdata(route, dataid, type){
      Swal.fire({
      icon: 'warning',
      title: 'Delete'+type+'?',
      width: 400,
      showCancelButton: true,
      confirmButtonText: 'Delete',
      confirmButtonColor: 'red',
    }).then((result) => {
      if (result.isConfirmed) {
        window.location=(route+dataid)
      } 
    }
    )
    }
    </script>

<script>
    function resetPassword(route, dataid, title){
      Swal.fire({
      icon: 'warning',
      title: title+' ?',
      html: 'Password user ini akan di reset menjadi default (NIP)',
      width: 400,
      showCancelButton: true,
      confirmButtonText: 'Reset',
      confirmButtonColor: 'red',
    }).then((result) => {
      if (result.isConfirmed) {
        window.location=(route+dataid)
      } 
    }
    )
    }
    </script>
    <script src="js/additionalsidebar.js"></script>


</body>

</html>