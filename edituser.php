<?php require_once('include/function.php');?>
<?php logincheck();?>
<?php updateuser()?>
<?php updategroup()?>
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

    <!--Summernote-->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">
    <link href="summernoteemoji/tam-emoji/css/emoji.css" rel="stylesheet">

    <!--Bootstrap-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

    <!--Datepicker-->
    <link rel="stylesheet" type="text/css" href="datepicker/dist/css/bootstrap-datepicker.min.css">

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
                    <span>Edit User</span>
                    </h3>
                    </div>
                
                <!-- Isi Form-->
                <div class="card shadow mb-4 col-sm-5 mx-auto">
                    <div class="card-body">
                    <?php 
                    if(isset($_GET['groupid'])){
                        showgroupdata();//function no.13
                    }else{
                        showuserdata();  //function no.3
                    }
                    ?>
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
    
    <!--Summernote Script-->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
    <script src="summernoteemoji/tam-emoji/js/config.js"></script>
    <script src="summernoteemoji/tam-emoji/js/tam-emoji.min.js"></script>
    <script src="js/summernoteinitializer.js"></script> <!--Summernote Initializer-->

    <!--Datepicker script-->
    <script type="text/javascript" src="datepicker/dist/js/bootstrap-datepicker.min.js"></script>
    <script type="text/javascript" src="js/datepickerinit.js"></script>

    <!--File Name Script-->
    <script src="js/inputfilename.js"></script>

    <!--Progress Bar Script-->
    <script src="js/progressbar.js"></script>

    <script>
    function showSelection(){
    var selectedDiv= document.querySelector("#groupdiv");
    var selectedDiv= document.querySelector('#groupdiv2');
    }
    </script>
    <script src="js/additionalsidebar.js"></script>



</body>

</html>