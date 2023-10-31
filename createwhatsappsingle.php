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
                <?php include_once("include/topbar.php");?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0"> Kirim Broadcast (Single Broadcast) </h1>
                    </div>

                    <!-- Begin Form-->
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <form action="route-processbroadcast.php" method="POST" enctype="multipart/form-data" id="broadcast-form">

                        <!--Judul Broadcast-->
                            <div class="form-group">
                                <label for="judulbroadcast" class="text-gray-900 font-weight-bold">Judul Broadcast</label>
                                <input type="text" class="form-control" id="judulbroadcast" placeholder="Input Title Here" name="judulbroadcast">
                                <!--<small id="emailHelp" class="form-text text-muted">Max. 100 word</small>-->
                            </div>

                        <!--Deadline-->
                            <div class="form-group mt-3">
                            <label for="deadlinebroadcast" class="text-gray-900 font-weight-bold">Deadline</label>
                                <div class="input-group">
                                <input onfocus="(this.type='date')" onblur="(this.type='text')" class="form-control col-sm-2" id="deadlinebroadcast" type="text" placeholder="Input date here" name="deadlinebroadcast">
                                </div>
                            </div>
                            
                            <!-- Tujuan Broadcast-->
                            <div class="form-group">
                                <label for="number"class="text-gray-900 font-weight-bold">Tujuan</label>
                                <select class="form-control col-sm-3" id="number" name="number">
                                    <optgroup label="Group">
                                    <?php selectGroupContact()?>
                                    </optgroup>
                                    <optgroup label="Individual">
                                    <?php //selectIndividualContact()?>
                                    </optgroup>
                                </select>
                            </div>

                            <input type="hidden" name="userNIP" value="<?php echo $_COOKIE['logincookie'];?>">

                            <!--Isi Broadcast-->
                                <div class="form-group">
                                    <label for="summernote" class="font-weight-bold">Isi Pesan</label>
                                    <textarea id="summernote" name="message"></textarea>
                                </div>

                            <!--File -->
                                <label for="file" class="font-weight-bold"> File Panduan (Optional)</label>
                                <div class="input-group col-sm-5 ml-n3">
                                    <div class="custom-file"> 
                                        <input type="file" class="custom-file-input" id="file" name="file">
                                        <label class="custom-file-label" for="file">Choose file</label>
                                    </div> 
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-danger" type="button">Clear File</button>
                                    </div>
                                </div>
                                <small class="form-text text-muted mt-0 ml-2">Format file recommended pdf dan ukuran max 12 Mb </small>


                            <!--Submit & Clear-->
                                <div class="form-group mt-5 text-center">
                                    <button type="submit" name="submitbroadcast" class="btn btn-primary mt-5" id="submitbroadcast">Submit Broadcast</button>
                                    <!-- <button type="button" class="btn btn-primary mt-5" data-toggle="modal" data-target="#Modal1">Submit Broadcast</button> -->
                                    <a type="button" href="createwhatsappsingle.php" class="btn btn-outline-secondary mt-5">Reset</a>
                                </div>
                            </form> 
                        </div>
                        <!-- card body -->
                    </div>
                    <!--Card (Form End)-->

                </div>
                <!--End of Page Content-->

            </div>
            <!--Main Content-->

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
   
    <!-- Include Script-->
    <?php include_once("include/script.php");?>

    <!--Summernote Script-->
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
    <script>
    $(document).ready(function () {
    document.emojiButton ='fas fa-smile';
    document.emojiSource ='summernote/summernoteemoji/tam-emoji/img';
    $('#summernote').summernote({
     placeholder: 'To insert emoji press (Win + .)',
    tabsize: 3,
    height: 500,
    toolbar: [
    ['font', ['bold', 'italic', 'strikethrough']],
    ]
    })
    });
    </script>


    <!--Form Input File Script-->
    <script src="js/inputfilename.js"></script>

    <!--Datepicker script-->
    <script type="text/javascript" src="datepicker/dist/js/bootstrap-datepicker.min.js"></script>
    <script type="text/javascript" src="js/datepickerinit.js"></script>

    <!--Form Selected Value Script-->
    <script src="js/selectedvalue.js"></script>

    <!--Strip HTML From Summernote script-->
    <script src="js/striphtml.js"></script>

<!-- Send form to Two endpoint script -->
<script>
    $(document).ready(function() {
    $("#broadcast-form").submit(function(e) {
    e.preventDefault();
    var form = $(this)[0];
    var formData = new FormData(form);

    // Make a copy of the file
    var file = formData.get("file");
    if (file) {
    var fileCopy = new File([file], file.name, {type: file.type});
    }

    // Show a loading alert
    var loadingAlert = Swal.fire({
    title: 'Sending Form Data',
    timer: 0,
    showConfirmButton: false,
    didOpen: () => {
        Swal.showLoading()
        const b = Swal.getHtmlContainer().querySelector('b')
        timerInterval = setInterval(() => {
        b.textContent = Swal.getTimerLeft()
        }, 100)
    },
    willClose: () => {
        clearInterval(timerInterval)
    }
    });

    // Send the form and file to the first endpoint
    $.ajax({
    url: "http://localhost:8000/submit-form",
    type: "POST",
    data: formData,
    processData: false,
    contentType: false,
    success: function(data) {
        console.log(data);

        // Send the form and file copy to the second endpoint
        if (fileCopy) {
        var formDataWithFileCopy = new FormData(form);
        formDataWithFileCopy.set("file", fileCopy);

        $.ajax({
            url: "http://localhost:8000/send-messageandfile-group",
            type: "POST",
            data: formDataWithFileCopy,
            processData: false,
            contentType: false,
            success: function(data) {
            console.log(data);

            // Close the loading alert and show a success alert
            loadingAlert.close();
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: 'Broadcast has been sent',
            }).then(function() {
                window.location.href = "home.php";
            });
            },
            error: function(xhr, status, error) {
            console.log(xhr.responseText);

            // Close the loading alert and show an error alert
            loadingAlert.close();
            Swal.fire({
                icon: 'error',
                title: 'Failed',
                text: 'Broadcast failed',
            });
            }
        });
        } else {

        // Close the loading alert and show a success alert
        loadingAlert.close();
        Swal.fire({
            icon: 'success',
            title: 'Success',
            text: 'Broadcast has been sent',
        }).then(function() {
            window.location.href = "home.php";
        });
        }
    },
    error: function(xhr, status, error) {
        console.log(xhr.responseText);

        // Close the loading alert and show an error alert
        loadingAlert.close();
        Swal.fire({
        icon: 'error',
        title: 'Failed',
        text: 'Broadcast failed',
        });
    }
    });
});
});
</script>

<!-- <script>
  $(document).ready(function() {
    $("#broadcast-form").submit(function(e) {
      e.preventDefault();
      var form = $(this)[0];
      var formData = new FormData(form);

      // Make a copy of the file
      var file = formData.get("file");
      if (file) {
        var fileCopy = new File([file], file.name, {type: file.type});
      }

      // Show a loading alert
      var loadingAlert = Swal.fire({
        title: 'Sending Form Data',
        width: 300,
        height: 1200,
        timer: 0,
        showConfirmButton: false,
        didOpen: () => {
          Swal.showLoading()
          const b = Swal.getHtmlContainer().querySelector('b')
          timerInterval = setInterval(() => {
            b.textContent = Swal.getTimerLeft()
          }, 100)
        },
        willClose: () => {
          clearInterval(timerInterval)
        }
      });

      // Send the form and file copy to the second endpoint
      if (fileCopy) {
        var formDataWithFileCopy = new FormData(form);
        formDataWithFileCopy.set("file", fileCopy);

        $.ajax({
          url: "http://localhost:8000/send-messageandfile-group",
          type: "POST",
          data: formDataWithFileCopy,
          processData: false,
          contentType: false,
          success: function(data) {
            console.log(data);

            // Close the loading alert and show a success alert
            loadingAlert.close();
            Swal.fire({
              icon: 'success',
              title: 'Success',
              text: 'Broadcast has been sent',
            }).then(function() {
              window.location.href = "home.php";
            });
          },
          error: function(xhr, status, error) {
            console.log(xhr.responseText);

            // Close the loading alert and show an error alert
            loadingAlert.close();
            Swal.fire({
              icon: 'error',
              title: 'Failed',
              text: 'Broadcast failed',
            });
          }
        });
      } else {
        // Close the loading alert and show an error alert if file is not present
        loadingAlert.close();
        Swal.fire({
          icon: 'error',
          title: 'Failed',
          text: 'File is required',
        });
      }
    });
  });
</script> -->

<!--sweet alert script-->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
    function successCreatebroadcast(){
    Swal.fire({
    icon: 'success',
    title: 'Success',
    text: 'Broadcast has been sent',
    })
    }

    function failedCreatebroadcast(){
    Swal.fire({
    icon: 'error',
    title: 'failed',
    text: 'Broadcast failed',
    })
    }
    </script>
    <script src="js/additionalsidebar.js"></script>




</body>

</html>