<?php require_once('include/function.php')?>
<?php logincheck();?>
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
    <link href="summernote/summernoteemoji/tam-emoji/css/emoji.css" rel="stylesheet">

    <!--Bootstrap-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
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

                <!-- Data Content -->
                <div class="container-fluid">
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-900">Feedback</h1>
                    </div>

                    <small class="mt-1"> <p>Apabila Bapak/Ibu menemui <i>bug</i> maupun permasalahan dalam aplikasi; atau ingin memberikan saran pengembangan aplikasi kedepan silahkan untuk dapat mengisi form berikut:  </p></small>
                
                <!-- Isi Form-->
                <div class="card shadow mb-4">
                    <div class="card-body">
                    <form action="createfeedback.php" method="POST">
                    <!--Isi Broadcast-->
                        <div class="form-group">
                            <label for="feedbacknote" class="text-gray-900 font-weight-bold">Feedback/Saran</label>
                            <textarea id="feedbacknote" name="feedbacknote"></textarea>
                        </div>

                    <!--Anonymous Checklist-->
                    <div class="form-check mt-3 text-center mt-2 mb-n4">
                        <input type="checkbox" class="form-check-input" id="anonymous" name="anonymous">
                        <label class="form-check-label text-gray-900 " for="anonymous">Anonymous</label>
                    </div>


                    <!--Submit & Clear-->
                        <div class="form-group text-center">
                            <button type="submit" name="submitfeedback" class="btn btn-primary mt-5">Submit Feedback</button>
                            <button type="button" class="btn btn-outline-secondary mt-5">Reset</button>
                        </div>
                    </form> 
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
    <!--End of Page Wrapper -->

    <!-- Include Scroll to Top Button-->
    <?php include_once("include/scrolltotop.php");?>
    
    <!--include Script-->
    <?php require_once("include/script.php");?>
    

    <!--Summernote Script-->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>


    <script>
    $(document).ready(function () {
    document.emojiButton ='fas fa-smile';
    document.emojiSource ='summernote/summernoteemoji/tam-emoji/img';
    $('#feedbacknote').summernote({
     placeholder: 'To insert emoji press (Win + .)',
    tabsize: 3,
    height: 500,
    toolbar: [
    ['font', ['bold', 'italic', 'strikethrough']],
    ]
    })
    });
    </script>

<!--sweet alert script-->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php tambahfeedback()?>
<script src="js/additionalsidebar.js"></script>


</body>

</html>