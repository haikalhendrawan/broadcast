<?php require_once('include/function.php')?>
<?php logincheck()?>
<?php admincheck()?>
<?php require_once('include/header.php')?>

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
                        <h1 class="h3 mb-0 text-gray-900">Active Broadcast</h1>
                </div>
                
                    <!-- Tabel Active Broadcast -->
                    <div class="card shadow mb-4">
                        <div class="card-body">
                        <!-- <div><button onclick="restartCronJobs()" class="btn btn-primary mb-3 float-right">Update</button></div> -->
                            <div class="table-responsive">
                                <table class="table table-hover" id="rbroadcastTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                        <th>No</th>
                                        <th>Judul Broadcast</th>
                                        <th>Pesan</th>
                                        <th>Sender</th>
                                        <th>Tujuan</th>
                                        <th>Jadwal</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                        </tr>
                                    <tbody class="text-gray-900" id="rbroadcast-table-body">
                                    <?php readrbroadcast() //fungsi no.15?>
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

    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>

    <!--start and stop rbroadcast from nodejs server-->
    <script>
    function restartCronJobs() {
    // Send a request to stop all cron jobs
    $.get("http://localhost:8000/stop-cron-jobs", function(data, status) {
        console.log(`Stop cron jobs request status: ${status}`);
        // Send a request to start the cron jobs again
        $.get("http://localhost:8000/start-cron-jobs", function(data, status) {
        console.log(`Start cron jobs request status: ${status}`);
        });
    });

    Swal.fire({
    icon: 'success',
    title: 'Success',
    text: 'Broadcast has been activated/restarted',
    })
    }
    </script>

    <!--sweetalert hapus data rbroadcast-->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
    //show sweetalert to redirect to delete rbroadcast
    function hapusrbroadcast(dataid){
      Swal.fire({
      icon: 'warning',
      title: 'Delete Scheduled Broadast?',
      width: 400,
      showCancelButton: true,
      confirmButtonText: 'Delete',
      confirmButtonColor: 'red',
    }).then((result) => {
      if (result.isConfirmed) {
        window.location=("route-deleterbroadcast.php?rbroadcastid="+dataid);
        // Send a request to stop all cron jobs
        $.get("http://localhost:8000/stop-cron-jobs", function(data, status) {
        console.log(`Stop cron jobs request status: ${status}`);
        // Send a request to start the cron jobs again
        $.get("http://localhost:8000/start-cron-jobs", function(data, status) {
        console.log(`Start cron jobs request status: ${status}`);
        });
    });
      } 
    }
    )
    }

    //show sweet alert to redirect updaterbroadcast
    function updaterbroadcast(dataid){
      Swal.fire({
      icon: 'warning',
      title: 'Activate Broadcast?',
      width: 400,
      showCancelButton: true,
      confirmButtonText: 'Activate',
      confirmButtonColor: 'green',
    }).then((result) => {
      if (result.isConfirmed) {
        window.location=("route-updaterbroadcast.php?rbroadcastid="+dataid);
        // Send a request to stop all cron jobs
        $.get("http://localhost:8000/stop-cron-jobs", function(data, status) {
        console.log(`Stop cron jobs request status: ${status}`);
        // Send a request to start the cron jobs again
        $.get("http://localhost:8000/start-cron-jobs", function(data, status) {
        console.log(`Start cron jobs request status: ${status}`);
        });
    });
      } 
    }
    )
    }
    </script>


    <!--Convert cron expression to english language-->
    <script src="https://unpkg.com/cronstrue@latest/dist/cronstrue.min.js" async></script>
    <script>
    window.onload = function() {
        // Get all the table rows
        const rows = document.querySelectorAll('table tr');

        // Loop through each row
        rows.forEach(row => {
            // Get the cron expression cell
            const cronCell = row.querySelector('.cron-expression');

            // If the cell exists
            if (cronCell) {
                // Convert the cron expression to text using cronstrue
                const cronText = cronstrue.toString(cronCell.textContent);

                // Replace the cron expression with the cron text
                cronCell.textContent = cronText;
            }
        });
    }
    </script>

    <!--data tables-->
    <script>
    $(document).ready(function() {
    $('#rbroadcastTable').DataTable();
    });
    </script>

    <!--additional custom sidebar-->
    <script src="js/additionalsidebar.js"></script>
</body>

</html>