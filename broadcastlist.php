<?php require_once ('include/function.php')?>
<?php logincheck();?>
<?php if(isset($_POST['donebroadcast'])){
 header('location:updatebroadcaststatus.php');
}?>
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
        <?php include_once("include/sidebar.php");?>
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
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 ">Broadcast List</h1>
                </div>
                
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
 
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover" id="table10" name="table10" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th class="text-gray-900">Deadline</th>
                                            <th class="text-gray-900">Judul Broadcast</th>
                                            <th class="text-gray-900">Tujuan</th>
                                            <th class="text-gray-900">Status</th>
                                        </tr>
                                    </thead>
                                   <!-- <tfoot>
                                        <tr>
                                            <th>Name</th>
                                            <th>Position</th>
                                            <th>Office</th>
                                            <th>Age</th>
                                            <th>Start date</th>
                                            <th>Salary</th>
                                        </tr>
                                    </tfoot>-->
                                    <tbody class="text-gray-900">
                                    <?php broadcastlist();?>
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
    <!-- Scroll to Top Button-->
    <?php require_once("include/modal.php");?>

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

    <!--Sort Date Script-->
    <script>
        jQuery.extend( jQuery.fn.dataTableExt.oSort, {
        "date-uk-pre": function ( a ) {
            var ukDatea = a.split('/');
            return (ukDatea[2] + ukDatea[1] + ukDatea[0]) * 1;
        },

        "date-uk-asc": function ( a, b ) {
            return ((a < b) ? -1 : ((a > b) ? 1 : 0));
        },

        "date-uk-desc": function ( a, b ) {
            return ((a < b) ? 1 : ((a > b) ? -1 : 0));
        }
        });

        $(document).ready(function() {
        $('#table10').dataTable( {
            "aoColumns": [
                { "sType": "date-uk" },
                null,
                null,
                null,
            ]
        });
        });
    </script>


<!--add event listener untuk setiap badge-->
<script>
var numberOfBadge = document.querySelectorAll('.badge-danger').length;
for(var i=0; i<numberOfBadge; i++){
var currentButton = document.querySelectorAll('.badge-danger')[i];
var findID = currentButton.dataset.broadcastid;
document.querySelectorAll('.badge-danger')[i].addEventListener("click", function(){
    updateStatus(findID)
})
}
</script>


<!--sweetalert for update status-->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
function updateStatus(dataid){
    Swal.fire({
    icon: 'warning',
    title: 'Sudah menyelesaikan broadcast ini?',
    width: 400,
    showCancelButton: true,
    confirmButtonText: 'Done',
    confirmButtonColor: 'green',
}).then((result) => {
    if (result.isConfirmed) {
    window.location=("route-updatestatus.php?broadcastid="+dataid)
    } 
}
)
}
</script>
<script src="js/additionalsidebar.js"></script>


</body>

</html>