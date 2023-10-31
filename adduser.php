<?php require_once('include/function.php');?>
<?php adduser();?>
<?php addgroup();?>
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

                <?php if(isset($_GET['type'])){echo addUserOrGroup();}?>
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

    <!--Datepicker script-->
    <script type="text/javascript" src="datepicker/dist/js/bootstrap-datepicker.min.js"></script>
    <script type="text/javascript" src="js/datepickerinit.js"></script>

    <!--File Name Script-->
    <script src="js/inputfilename.js"></script>

    <!--Progress Bar Script-->
    <script src="js/progressbar.js"></script>

    <!--tombol find group id-->
    <script>
    async function logChats() {
    try {
        const response = await fetch('http://localhost:8000/log-chats');
        const data = await response.text(); // read response as plain text
        document.getElementById("chats-data").innerHTML = data; // update contents of the div element
    } catch (error) {
        console.error(error);
    }
    }
    </script>

    <script>
    // Client-side validation
    document.getElementById("adduserform").addEventListener("submit", function(event) {
        var NIPuserInput = document.getElementsByName("NIPuser")[0];
        if (NIPuserInput.value.trim() === "" || NIPuserInput.value.length !== 18 || /[a-zA-Z]/.test(NIPuserInput.value)) {
            event.preventDefault();
            alert("NIP Invalid");
        }

        var nomorHP = document.getElementsByName("nomorhpuser")[0].value;
        if (!nomorHP.endsWith("@c.us") || !nomorHP.startsWith('62')) {
        event.preventDefault();
        alert("Invalid input. Nomor HP should end with '@c.us'and start with '62'");
    }
    });
    </script>

    <script src="js/additionalsidebar.js></script>



</body>

</html>