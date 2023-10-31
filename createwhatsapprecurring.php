<?php include("include/function.php");?>
<?php logincheck();?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Create Whatsapp</title>

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


    <!--Datepicker-->
    <link rel="stylesheet" type="text/css" href="datepicker/dist/css/bootstrap-datepicker.min.css">
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
                <?php require_once('include/topbar.php');?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0">Kirim Broadcast (Scheduled Broadcast) </h1>
                    </div>

                <!-- Form-->
                    <div class="card shadow mb-4">
                     <div class="card-body">
                        <form method="POST" action="createwhatsapprecurring.php" id="broadcastform2" onsubmit="convertToCronExpression()">

                        <!-- Tujuan Broadcast-->
                            <div class="form-group">
                                <label for="exampleFormControlSelect1"class="text-gray-900 font-weight-bold">Tujuan</label>
                                <select class="form-control col-sm-3" id="number2" name="number2">
                                    <optgroup label="Group">
                                    <?php selectGroupContact()?>
                                    </optgroup>
                                    <optgroup label="Individual">
                                    <?php //selectIndividualContact()?>
                                    </optgroup>
                                </select>
                            </div>

                        <!--Isi Broadcast-->
                            <div class="form-group">
                                <label for="summernote2" class="font-weight-bold">Isi Pesan</label>
                                <textarea id="summernote2" name="message2" ></textarea>
                            </div>

                        <!--Recurring Option
                            <div class="form-group mt-3">
                                <p class="font-weight-bold"> Recurring Message?</p>
                                <div class="form-check mt-n2 ml-2">
                                    <input class="form-check-input" type="checkbox" value="" id="checkbox1">
                                    <label class="form-check-label" for="checkbox1">
                                        Ya
                                    </label>
                                </div>
                            </div>-->

                        <!-- Recurring Schedule-->
                        <div class="form-group">
                            <label for="recurringschedule"class="font-weight-bold">Recurring Schedule</label>
                            <select class="form-control col-sm-3" id="recurringschedule" name="recurringschedule" onchange="yesnoCheck(this);">
                                <option value ="no-schedule" selected>--Choose Recurring Schedule--</option>
                                <option value ="non-recurring">Non Recurring</option>
                                <option value ="every workday">Every Workday (Mon-Fri)</option>
                                <option value ="every day">Every Day (Mon-Sun)</option>
                                <!--<option>Every Week</option>
                                <option>Every Month</option>
                                <option>Custom</option>-->
                            </select>
                        </div>

                        <!--Recurring Date-->
                        <div class="form-group mt-3" id="ifYes" style="display: none;">
                            <label for="recurringdate" class=" font-weight-bold">Date</label>
                            <div class="input-group ">
                                <input type="date" class="form-control col-sm-2" id="recurringdate" name="recurringdate" aria-describedby="timehelp" placeholder="Tanggal">
                            </div>
                            <small class="form-text text-muted ml-1">Pesan akan di broadcast pada tanggal tersebut</small>
                        </div>

                        <!--Recurring Time-->
                        <div class="form-group mt-3">
                            <label for="recurringtime" class=" font-weight-bold">Time</label>
                            <input type="time" class="form-control col-sm-2" id="recurringtime" name="recurringtime" aria-describedby="timehelp" placeholder="Jam/Menit">
                            <small class="form-text text-muted ml-1">Pesan akan di broadcast setiap jam tersebut</small>
                        </div>

                        <!--Cron expression (hidden input)-->
                        <div>
                            <input type="hidden" name="cronexpression" value="" id="cronexpression">
                        </div>

                        <!-- Judul Pesan-->
                        <div class="form-group">
                        <label for="judulpesan" class="font-weight-bold">Judul Pesan</label>
                            <input class="form-control col-sm-5" name="judulpesan" id="judulpesan" placeholder="Input Title Here">
                        <small class="form-text text-muted ml-1">Contoh: Pesan pengingat absen pagi</small>
                        </div>

                        <!--Submit & Clear-->
                        <div class="form-group mt-5 text-center">
                            <button type="submitrbroadcast" name="submitrbroadcast" class="btn btn-primary mt-5">Submit Broadcast</button>
                            <!-- <button type="button" class="btn btn-primary mt-5" data-toggle="modal" data-target="#Modal1">Submit Broadcast</button> -->
                            <a href="createwhatsapprecurring.php" class="btn btn-outline-secondary mt-5">Reset</a>
                        </div>
                        </form>

                    </div>
                    <!-- card body -->

                </div>
                <!-- Card Shadow / End of Form -->


            <!-- Footer -->
            <?php include_once("include/contentfooter.php");?>
            <!-- End of Footer -->

            </div>
            <!--Main Content-->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <?php include_once('include/scrolltotop.php');?>

    <!-- Include Modal-->
    <?php include_once("include/modal.php");?>

    <!--Include Script-->
    <?php include_once("include/script.php");?>

    <!--Summernote Script-->
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
    <script>
    $(document).ready(function () {
    document.emojiButton ='fas fa-smile';
    document.emojiSource ='summernote/summernoteemoji/tam-emoji/img';
    $('#summernote2').summernote({
     placeholder: 'To insert emoji press (Win + .)',
    tabsize: 3,
    height: 500,
    toolbar: [
    ['font', ['bold', 'italic', 'strikethrough']],
    ]
    })
    });
    </script>

    <!--Form Input File Script show nama file saat upload-->
    <script>
    // Add the following code if you want the name of the file appear on select
    $(".custom-file-input").on("change", function() {
    var fileName = $(this).val().split("\\").pop();
    $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });
    </script>

    <!--Show Option Script menunjukan tambahan input saat non-recurring option dipilih-->
    <script>
    function yesnoCheck(that) {
    if (that.value == "non-recurring") {
        document.getElementById("ifYes").style.display = "block";
    } else {
        document.getElementById("ifYes").style.display = "none";
    }
    }
    </script>

    <!--Selected value Script-->
    <script>
    $(document).ready(function() {
    $('#recurringschedule').change(function() {
    const selectedNumber = $(this).val();
    $('option').removeAttr('selected');
    $(`option[value="${selectedNumber}"]`).attr('selected', 'selected');
    });
    });
    </script>

 <!--fill cronexpression hidden value-->
    <script>
    function convertToCronExpression() {
  
    const recurringSchedule = document.getElementById('recurringschedule').value;
    const time = document.getElementById('recurringtime').value;
    const date = document.getElementById('recurringdate').value;
    let cronExpression = '';

    // Convert the selected recurring schedule into a cron expression
    switch (recurringSchedule) {
        case 'no-schedule':
        break;
        case 'non-recurring':
            const dateParts = date.split('-');
            const selectedMinutes = time.split(':')[1];
            const selectedHours = time.split(':')[0];
            const selectedMonth = dateParts[1];
            cronExpression = `${selectedMinutes} ${selectedHours} ${dateParts[2]} ${selectedMonth} *`;
            break;
        case 'every workday':
            const workdayTimeParts = time.split(':');
            cronExpression = `${workdayTimeParts[1]} ${workdayTimeParts[0]} * * 1-5`;
            break;
        case 'every day':
            const dailyTimeParts = time.split(':');
            cronExpression = `${dailyTimeParts[1]} ${dailyTimeParts[0]} * * *`;
            break;
        }
    document.getElementById('cronexpression').value = cronExpression;
        }
    </script>

    <!--sweet alert script-->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
    function successCreateRbroadcast(){
    Swal.fire({
    icon: 'success',
    title: 'Success',
    text: 'Broadcast has been registered, please wait for admin approval',
    })
    }

    function failedCreateRbroadcast(){
    Swal.fire({
    icon: 'error',
    title: 'failed',
    text: 'Broadcast schedule failed',
    })
    }
    </script>

    <?php sendrbroadcast();?>

    <script src="js/additionalsidebar.js"></script>


</body>

</html>