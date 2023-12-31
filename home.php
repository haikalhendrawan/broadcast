<?php require_once('include/function.php')?>
<?php logincheck();?>
<?php include_once("include/header.php");?>

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

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0">Dashboard</h1>
                        <!--<a href="#" class="d-none d-sm-inline-block btn btn-sm btn-dark text-light shadow-sm" ><i
                                class="fas fa-download fa-sm text-white-50 mr-2"></i>Generate Report</a>-->
                    </div>
                    <!-- Content Row -->
                    <div class="row">

                        <!-- Broadcast Belum Selesai -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-danger  shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                                Broadcast Belum Selesai</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php countbroadcastnotdone()?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-thumbtack fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Broadcast Selesai -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success  shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Broadcast Selesai </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php countbroadcastdone()?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-bookmark fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Total Broadcast -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary  shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Broadcast
                                            </div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-auto">
                                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php countbroadcast()?></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Content Row -->

                    <div class="row">
                        <!-- Area Chart -->
                        <div class="col-xl-7 col-lg-5">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold ">Broadcast Received</h6>
                                </div>
                                <div class="card-body">
                                    <div class="chart-area">
                                        <canvas id="myAreaChart"></canvas>
                                    </div>
                                    <hr>

                                </div>
                            </div>
                            <input type="hidden" id="broadcastData" value="[<?php monthlyStatistic() //fungsi no.22?>]">

                            <!--Pie Chart-->
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold">Broadcast Chart</h6>
                                    <div class="dropdown no-arrow">
                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                        </a>
                                        <!-- <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in"
                                            aria-labelledby="dropdownMenuLink">
                                            <div class="dropdown-header">Dropdown Header:</div>
                                            <a class="dropdown-item" href="#">Action</a>
                                            <a class="dropdown-item" href="#">Another action</a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="#">Something else here</a>
                                        </div> -->
                                    </div>
                                </div>

                                <!--hidden value-->
                                <input type="hidden" id="count-broadcast" value="<?php countbroadcast()?>">
                                <input type="hidden" id="count-broadcast-done" value="<?php countbroadcastdone() ?>">
                                <input type="hidden" id="count-broadcast-not-done" value="<?php countbroadcastnotdone()?>">
                                <!-- Card Body -->
                                <div class="card-body">
                                    <div class="chart-pie pt-4 pb-2">
                                        <canvas id="broadcastchart"></canvas>
                                    </div>
                                    <div class="mt-4 text-center small">
                                        <span class="mr-2">
                                            <i class="fas fa-circle text-danger"></i> Broadcast Belum Selesai
                                        </span>
                                        <span class="mr-2">
                                            <i class="fas fa-circle" style="color:#1cc88a"></i> Broadcast Selesai
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <?php searchbar()?>
                        <!-- Announcement -->
                        <div class="col-xl-5 col-lg-7">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                <div
                                    class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold ">Announcement</h6>
                                    <div class="dropdown no-arrow">
                                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                        </a>
                                    </div>
                                </div>
                                <!-- Card Body -->
                                <div class="card-body">
                                    <p><b>Closed Testing Aplikasi Broadcast</b></p>
                                    Yth. Bapak/Ibu <br>
                                    mohon bantuan untuk melakukan testing pada beberapa fitur antara lain:<br>
                                    <ul>
                                    <li>fitur kirim broadcast</li>
                                    <li>fitur kirim broadcast terjadwal</li>
                                    <li>tindak lanjut broadcast (membaca broadcast, menyelesaikan, status, dll)</li>
                                    </ul>
                                    <br>
                                    untuk melakukan testing broadcast di whatsapp silahkan bergabung ke group berikut:<a href="https://chat.whatsapp.com/JXShsl1vwMG9cK2e3OVdud" target="_blank">https://chat.whatsapp.com/JXShsl1vwMG9cK2e3OVdud</a></br><br>
                                    Testing diperlukan untuk mengindentifikasi hal-hal seperti:<br>
                                    <ul>
                                    <li>bug</li>
                                    <li>logic/function yg belum sempurna</li>
                                    <li>ujicoba kapasitas server dan stabilisasi server</li>
                                    <li>dll</li>
                                    </ul>

                                    Apabila terdapat feedback/catatan silahkan input pada kolom dibawah 🙏<br>
                                    <hr>
                                    <?php tambahannouncement();?>
                                    <?php 
                                    function showannouncement(){
                                        global $conn;
                                        $query="SELECT isiFeedback FROM feedback";
                                        $result=mysqli_query($conn, $query);
                                        $num=1;
                                        while($row=mysqli_fetch_array($result)){
                                            echo "".$num. ". ". $row['0']."<br>";
                                            $num++;
                                        }
                                    }

                                    showannouncement();?>
                                    <hr>
                                        <form class="form-group" action ="home.php" method ="POST">
                                        <textarea class="form-control"  name="addanouncement"></textarea>
                                        <button type="submit" class="btn btn-primary mt-2" name='submitaddanouncement'>Submit</button>
                                        </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                    </div>
                    <!-- End of Row-->

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <?php include_once("include/footer.php");?>
            <!-- End of Footer -->
            <?php require_once('include/contentfooter.php');?>
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
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/broadcastchart.js"></script>

    <!--additional custom sidebar-->
    <script src="js/additionalsidebar.js"></script>

    <!--sweetalert-->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


</body>

</html>