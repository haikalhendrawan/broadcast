<?php require_once('include/function.php');?>
<?php logincheck();?>
<?php include_once('include/header.php');?>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!--Include Sidebar-->
        <?php include_once("include/sidebar.php");?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!--Include Topbar-->
                <?php include_once("include/topbar.php");?>

                <!-- Data Content -->
                <div class="container-fluid">
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-900">My Broadcast</h1>
                </div>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
 
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover" id="example" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th class="text-gray-900">Deadline</th>
                                            <th class="text-gray-900">Judul Broadcast</th>
                                            <th class="text-gray-900">Tujuan</th>
                                            <th class="text-gray-900">Status</th>
                                        </tr>
                                    </thead>
 
                                    <tbody class="text-gray-900">
                                    <?php mybroadcastlist()?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>  
                <!-- End Page Content-->

            </div>
            <!-- End of Main Content -->

        <!-- Include Content Footer -->
        <?php include_once("include/contentfooter.php")?>

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<?php include_once("include/scrolltotop.php");?>

<!-- Include Modal-->
<?php include_once("include/modal.php");?>

<!--include script-->
<?php include_once("include/script.php");?>

<!--Include Footer-->
<?php include_once("include/footer.php");?>

<!--Sort Date Script-->
<script src="js/datesorter.js"></script>

<!--add eventlistener to all badge danger-->
<script>
var numberOfBadge = document.querySelectorAll('.badge-danger').length;
for(var i=0; i<numberOfBadge; i++){
var currentButton = document.querySelectorAll('.badge-danger')[i];
var findID = currentButton.dataset.broadcastid;
document.querySelectorAll('.badge-danger')[i].addEventListener("click", function(){
    updateStatusMyBroadcast(findID)
})
}
</script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
function updateStatusMyBroadcast(dataid){
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