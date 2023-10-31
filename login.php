<?php require_once('include/function.php')?>
<?php prevent2login()?>
<?php login()?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Login</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body style="background: linear-gradient(to top, rgba(94,231,223,0.5), rgba(180,144,202,0.5))"">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-5 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div>
                                <div class="p-5">
                                    <div class="h1 text-center">
                                    <i class="fas fa-dice-d6 text-primary"></i>
                                    </div>
                                    <form class="user" method="POST" action="login.php">
                                        <div class="form-group">
                                            <label for="inputnip">Username</label>
                                            <input type="text" class="form-control form-control-user"
                                                id="inputnip" name="inputnip"
                                                placeholder=" NIP">
                                        </div>
                                        <div class="form-group">
                                            <label for="inputpassword">Password</label>
                                            <input type="password" class="form-control form-control-user"
                                                id="inputpassword" name="inputpassword" placeholder="Default: NIP">
                                        </div>
                                        <button type="submit" name="submitlogin" id="submitlogin" class="btn btn-primary btn-user btn-block mt-4 ">
                                            Login
                                        </button>

                                        
                                        <!-- <div class="text-center mt-2">
                                        <a class="small" href="forgot-password.html">Forgot Password?</a>
                                        </div>-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
 
        </div>
        
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!--set timeout for alert-->
    <script>
    function timeoutAlert(){
    var alert=document.querySelector(".alert");

    if(alert){
        alert.style.transition= "opacity 0.5s";
        alert.style.opacity = "0";

        setTimeout(function(){
        alert.remove();
        },2000);
      }
    }
    </script>
    <script>setTimeout(timeoutAlert, 2500)</script>

</body>

</html>