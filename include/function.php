<?php
require_once('include/db.php');
//1. fungsi send broadcast
function sendbroadcast(){
    if(isset($_POST['submitbroadcast'])){

        global $conn;

        $judulbroadcast= $_POST['judulbroadcast'];
        $deadline =$_POST['deadlinebroadcast'];
        $deadline = date('Y-m-d', strtotime($deadline));
        $isibroadcast = $_POST['message'];
        $isibroadcast= htmlspecialchars($isibroadcast);
        

        // Get the file data
        $file = $_FILES['file'];
        $filename = $file['name'];
        $filetype = $file['type'];
        $filesize = $file['size'];
        $filetemp = $file['tmp_name'];

        // Check if a file was uploaded
        if($filename) {
            // Move the uploaded file to a directory on the server
            $target_dir = "Uploads/";
            $target_file = $target_dir . basename($filename);
            move_uploaded_file($filetemp, $target_file);
        }

        $query = "INSERT INTO  broadcast (judulbroadcast, deadline, isibroadcast, filependukung) VALUES ('$judulbroadcast', '$deadline', '$isibroadcast', '$filename')";
        $insert= mysqli_query($conn, $query);

        if(!$insert){
            echo mysqli_error($conn); // print error message
             
         } else {
             echo "<script>successCreatebroadcast()</script>";
         }
    }
}

//2. fungsi membaca broadcast
function readbroadcast(){

    global $conn;
    $usernip = $_COOKIE['logincookie'];
    $broadcastid = $_GET['broadcastid'];
    $query = "SELECT * FROM broadcast WHERE broadcastid='".$broadcastid."'";
    $result1 = mysqli_query($conn, $query);
    $result=mysqli_fetch_assoc($result1);
    $previousPageUrl = $_SERVER['HTTP_REFERER'];

    $query2= "SELECT * FROM broadcast_activity WHERE broadcastid='".$broadcastid."'AND receivernip='".$usernip."'";
    $result2 = mysqli_query($conn, $query2);
    $row2 = mysqli_fetch_assoc($result2);
    $statusbroadcast = $row2['broadcaststatus'];

    $isibroadcastraw = $result['isibroadcast'];
    $isibroadcastdecode= htmlspecialchars_decode($isibroadcastraw);
    $isibroadcast=nl2br($isibroadcastdecode);
    $broadcastcreator=$result['broadcastcreator'];
    $filebroadcast=$result['filependukung'];
    $extension= pathinfo($filebroadcast, PATHINFO_EXTENSION);

    $showfile = "";
    if($extension=="pdf"){
        $showfile="
        <!--File Panduan pdf-->
        <div class='h6 mt-3'>File Panduan</div>
        <div>
            <a href='#' class='btn btn-primary btn-icon-split btn-sm' data-toggle='modal' data-target='#filemodal'>
                <span>
                    <i class='fas fa-eye'></i>
                </span>
                <span>Preview File</span>
            </a>
        </div>";
    }elseif($extension==NULL){
        $showfile= "";
    }else{
        $showfile="
        <!--File Panduan other than pdf-->
        <div class='h6 mt-3'>File Panduan</div>
        <div>
            <a href='Uploads/' download='".$filebroadcast."' class='btn btn-primary btn-icon-split btn-sm'>
                <span>
                    <i class='fas fa-download'></i>
                </span>
                <span>Preview File</span>
            </a>
        </div>";
    }
    

    $query3 = "SELECT nama, user_group.group_name, NIP FROM user INNER JOIN user_group ON user.group_id=user_group.groupID WHERE NIP = '".$broadcastcreator."'";
    $result3 = mysqli_query($conn, $query3);
    $row3 = mysqli_fetch_assoc($result3);

    $query4 = "SELECT * FROM groupchat WHERE groupnumber= '".$result['tujuanbroadcast']."'";
    $result4= mysqli_query($conn, $query4);
    $row4 = mysqli_fetch_assoc($result4);


    if($result && $filebroadcast!==NULL && $statusbroadcast!=='1'){
        echo"
        <!--Read Broadcast Header-->
        <div class='d-sm-flex align-items-center  mb-4'>
            <a href='".$previousPageUrl."' class='h5 mr-2 mt-2'><i class='fas fa-arrow-left'></i></a>
            <h1 class='h3 mb-0'>Broadcast ID #".$result['broadcastID']."</h1>
        </div>

        <!--Read Broadcast-->
        <div class='card shadow mb-4'>
            <div class='card-body'>

                <!--Judul Broadcast-->
                <div class='card mb-4 p-2 mt-3 text-center border-0'>
                    <h4>".$result['judulbroadcast']."</h4>
                </div>

                <div class='table'>
                    <table class='table table-borderless table-condensed col-sm-5 mb-5' style='line-height: 8px'>
                    <tbody>
                        <!--Deadline Broadcast-->
                        <tr>
                        <td class='font-weight-bold pl-0' style='width:10px'>Deadline</td>
                        <td class='font-weight-bold pl-0'>:</td>
                        <td class='pl-0'>".date('d-M-y', strtotime($result['deadline']))."</td>
                        </tr>
                        
                        <!--Tujuan Broadcast-->
                        <tr>
                        <td class='font-weight-bold pl-0' style='width:10px'>Tujuan</td>
                        <td class='font-weight-bold pl-0'>:</td>
                        <td class='pl-0'>".$row4['groupName']."</td>
                        </tr>

                        <!--Broadcast Sender-->
                        <tr>
                        <td class='font-weight-bold pl-0' style='width:10px'>Creator</td>
                        <td class='font-weight-bold pl-0'>:</td>
                        <td class='pl-0'>".$row3['group_name']." / ".$row3['NIP']."</td>
                        </tr>
                    </tbody>
                    </table>
                </div>

                <!--Isi Broadcast-->
                <div class='h5'>Isi Broadcast</div>
                <div class='card mb-4 py-0 border-left-primary text-justify'>
                <div class='card-body pl-2'>
                    
                ".$isibroadcast." 
                </div>
                </div>        
                
                ".$showfile."

                <!--Comment-->
                <!--<div class='h6 mt-3'>Comment</div>
                <form>
                <textarea type='text' name='comment' class='form-control col-sm-5'  placeholder='input comment here'></textarea>
                </form>-->
                
                <!--Done and cancel-->
                <div class='form-group mt-5 text-center'>
                <a class='btn btn-success mt-5' href='route-updatestatus.php?broadcastid=".$result['broadcastID']."'>Done</a>
                <a type='button' href='broadcastlist.php' class='btn btn-outline-secondary mt-5'>Later</a>
                </div>

            </div>
        </div>
        ";
    }elseif ($result && $filebroadcast==NULL && $statusbroadcast!=='1'){
        echo"
        <!--Read Broadcast Header-->
        <div class='d-sm-flex align-items-center  mb-4'>
            <a href='".$previousPageUrl."' class='h5 mr-2 mt-2'><i class='fas fa-arrow-left'></i></a>
            <h1 class='h3 mb-0'>Broadcast ID #".$result['broadcastID']."</h1>
        </div>

        <!--Read Broadcast-->
        <div class='card shadow mb-4'>
            <div class='card-body'>

                <!--Judul Broadcast-->
                <div class='card mb-4 p-2 mt-3 text-center border-0'>
                    <h4>".$result['judulbroadcast']."</h4>
                </div>

                <div class='table'>
                <table class='table table-borderless table-condensed col-sm-5 mb-5' style='line-height: 8px'>
                <tbody>
                    <!--Deadline Broadcast-->
                    <tr>
                    <td class='font-weight-bold pl-0' style='width:10px'>Deadline</td>
                    <td class='font-weight-bold pl-0'>:</td>
                    <td class='pl-0'>".date('d-M-y', strtotime($result['deadline']))."</td>
                    </tr>
                    
                    <!--Tujuan Broadcast-->
                    <tr>
                    <td class='font-weight-bold pl-0' style='width:10px'>Tujuan</td>
                    <td class='font-weight-bold pl-0'>:</td>
                    <td class='pl-0'>".$row4['groupName']."</td>
                    </tr>

                    <!--Broadcast Sender-->
                    <tr>
                    <td class='font-weight-bold pl-0' style='width:10px'>Creator</td>
                    <td class='font-weight-bold pl-0'>:</td>
                    <td class='pl-0'>".$row3['group_name']." / ".$row3['NIP']."</td>
                    </tr>
                </tbody>
                </table>
                </div>

                <!--Isi Broadcast-->
                <div class='h5'>Isi Broadcast</div>
                <div class='card mb-4 py-0 border-left-primary text-justify'>
                <div class='card-body pl-2'>
                    
                ".$isibroadcast." 
                </div>
                </div>  
                <!--Comment-->
                <!--<div class='h6 mt-3'>Comment</div>
                <form>
                <textarea type='text' name='comment' class='form-control col-sm-5'  placeholder='input comment here'></textarea>
                </form>-->
                
                <!--Done and cancel-->
                <div class='form-group mt-5 text-center'>
                <a class='btn btn-success mt-5' href='route-updatestatus.php?broadcastid=".$result['broadcastID']."'>Done</a>
                <a type='button' href='broadcastlist.php' class='btn btn-outline-secondary mt-5'>Later</a>
                </div>

            </div>
        </div>
        ";      
    }elseif($result && $filebroadcast!==NULL && $statusbroadcast=='1'){
        echo"
        <!--Read Broadcast Header-->
        <div class='d-sm-flex align-items-center  mb-4'>
            <a href='".$previousPageUrl."' class='h5 mr-2 mt-2'><i class='fas fa-arrow-left'></i></a>
            <h1 class='h3 mb-0'>Broadcast ID #".$result['broadcastID']."</h1>
        </div>

        <!--Read Broadcast-->
        <div class='card shadow mb-4'>
            <div class='card-body'>

                <!--Judul Broadcast-->
                <div class='card mb-4 p-2 mt-3 text-center border-0'>
                    <h4>".$result['judulbroadcast']."</h4>
                </div>

                <div class='table'>
                <table class='table table-borderless table-condensed col-sm-5 mb-5' style='line-height: 8px'>
                <tbody>
                    <!--Deadline Broadcast-->
                    <tr>
                    <td class='font-weight-bold pl-0' style='width:10px'>Deadline</td>
                    <td class='font-weight-bold pl-0'>:</td>
                    <td class='pl-0'>".date('d-M-y', strtotime($result['deadline']))."</td>
                    </tr>
                    
                    <!--Tujuan Broadcast-->
                    <tr>
                    <td class='font-weight-bold pl-0' style='width:10px'>Tujuan</td>
                    <td class='font-weight-bold pl-0'>:</td>
                    <td class='pl-0'>".$row4['groupName']."</td>
                    </tr>

                    <!--Broadcast Sender-->
                    <tr>
                    <td class='font-weight-bold pl-0' style='width:10px'>Creator</td>
                    <td class='font-weight-bold pl-0'>:</td>
                    <td class='pl-0'>".$row3['group_name']." / ".$row3['NIP']."</td>
                    </tr>
                </tbody>
                </table>
                </div>

                <!--Isi Broadcast-->
                <div class='h5'>Isi Broadcast</div>
                <div class='card mb-4 py-0 border-left-primary text-justify'>
                <div class='card-body pl-2'>
                    
                ".$isibroadcast." 
                </div>
                </div>        
                
                ".$showfile."

                <!--Comment-->
                <!--<div class='h6 mt-3'>Comment</div>
                <form>
                <textarea type='text' name='comment' class='form-control col-sm-5'  placeholder='input comment here'></textarea>
                </form>-->

            </div>
        </div>
        ";
    }else{
        echo"
        <!--Read Broadcast Header-->
        <div class='d-sm-flex align-items-center  mb-4'>
            <a href='".$previousPageUrl."' class='h5 mr-2 mt-2'><i class='fas fa-arrow-left'></i></a>
            <h1 class='h3 mb-0'>Broadcast ID #".$result['broadcastID']."</h1>
        </div>

        <!--Read Broadcast-->
        <div class='card shadow mb-4'>
            <div class='card-body'>

                <!--Judul Broadcast-->
                <div class='card mb-4 p-2 mt-3 text-center border-0'>
                    <h4>".$result['judulbroadcast']."</h4>
                </div>

                <div class='table'>
                <table class='table table-borderless table-condensed col-sm-5 mb-5' style='line-height: 8px'>
                <tbody>
                    <!--Deadline Broadcast-->
                    <tr>
                    <td class='font-weight-bold pl-0' style='width:10px'>Deadline</td>
                    <td class='font-weight-bold pl-0'>:</td>
                    <td class='pl-0'>".date('d-M-y', strtotime($result['deadline']))."</td>
                    </tr>
                    
                    <!--Tujuan Broadcast-->
                    <tr>
                    <td class='font-weight-bold pl-0' style='width:10px'>Tujuan</td>
                    <td class='font-weight-bold pl-0'>:</td>
                    <td class='pl-0'>".$row4['groupName']."</td>
                    </tr>

                    <!--Broadcast Sender-->
                    <tr>
                    <td class='font-weight-bold pl-0' style='width:10px'>Creator</td>
                    <td class='font-weight-bold pl-0'>:</td>
                    <td class='pl-0'>".$row3['group_name']." / ".$row3['NIP']."</td>
                    </tr>
                </tbody>
                </table>
                </div>

                <!--Isi Broadcast-->
                <div class='h5'>Isi Broadcast</div>
                <div class='card mb-4 py-0 border-left-primary text-justify'>
                <div class='card-body pl-2'>
                    
                ".$isibroadcast." 
                </div>
                </div>  
                <!--Comment-->
                <!--<div class='h6 mt-3'>Comment</div>
                <form>
                <textarea type='text' name='comment' class='form-control col-sm-5'  placeholder='input comment here'></textarea>
                </form>-->

            </div>
        </div>
        ";
    }
}

//3. fungsi fetch file
function fetchfile(){
    global $conn;
    $broadcastid = $_GET['broadcastid'];
    $query = "SELECT * FROM broadcast WHERE broadcastid='".$broadcastid."'";
    $result1 = mysqli_query($conn, $query);
    $result = mysqli_fetch_assoc($result1);

    if($result){
        echo $result['filependukung'];
    } else {echo "This broadcast doesn't include file";}
}
//4. fungsi menampilkan tabel broadcastlist
function broadcastlist(){

    global $conn;
    $usernip = $_COOKIE['logincookie'];
    $query = "SELECT broadcast.broadcastID, broadcast.deadline, broadcast.judulbroadcast, broadcast.tujuanbroadcast, broadcast_activity.broadcaststatus FROM broadcast_activity INNER JOIN broadcast ON broadcast_activity.broadcastID=broadcast.broadcastID WHERE receivernip='".$usernip."'";
    $result = mysqli_query($conn, $query);
    while($row=mysqli_fetch_assoc($result)){
        $query2 = "SELECT * FROM groupchat WHERE groupnumber='".$row['tujuanbroadcast']."'";
        $result2 = mysqli_query($conn, $query2);
        $row2 = mysqli_fetch_assoc($result2);
        $namaTujuan = $row2['groupName'];
        $deadline= $row['deadline'];
        $sortdate= date('d/m/y', strtotime($deadline));
        $status = $row['broadcaststatus'];

        if($status!=='1'){
                echo"
                <tr>
                <td>".$sortdate."</td>
                <td><a href='readbroadcast.php?broadcastid=".$row['broadcastID']."'>".$row['judulbroadcast']."</a></td>
                <td>".$namaTujuan."</td>
                <td>
                    <badge class='badge badge-pill badge-danger' data-broadcastid='".$row['broadcastID']."'>
                    Belum
                    </badge>
                </td>
                </tr>";
                } else {
                echo"<tr>
                <td>".$sortdate."</td>
                <td><a href='readbroadcast.php?broadcastid=".$row['broadcastID']."'>".$row['judulbroadcast']."</a></td>
                <td>".$namaTujuan."</td>
                <td><span class='badge badge-pill badge-success'>Sudah</span></td>
                </tr>";
                } 
    }
}

//5. fungsi insert feedback
function tambahannouncement(){

if(isset($_POST['submitaddanouncement'])){

global $conn;

$feedback = $_POST['addanouncement'];
$nip = $_COOKIE["logincookie"];
$query="INSERT INTO feedback(isiFeedback, sender) VALUES ('$feedback', '$nip');";
$insert = mysqli_query($conn, $query);
if(!$insert){
echo "insert data failed";
}else {echo "<meta http-equiv='refresh' content='0'>";}
    }
}

//6.fungsi update status broadcast melalui tombol done di halaman read broadcast
function donebroadcast(){
    global $conn;

    $broadcastid = $_POST['modalbroadcastid'];
    $query= "UPDATE broadcast SET broadcaststatus='1' WHERE broadcastid='".$broadcastid."'";
    $result=mysqli_query($conn, $query);
    if($result){
        header('location:broadcastlist.php');
    }
}

//7. Fungsi count jumlah broadcast
function countbroadcast(){
    global $conn;
    $usernip = $_COOKIE['logincookie'];
    $query = "SELECT COUNT(activityID) FROM broadcast_activity WHERE receivernip='".$usernip."'" ;
    $result = mysqli_query($conn,$query);
    $row = mysqli_fetch_array($result);

    if($row){
        echo $row[0];
    }
}

//8. Fungsi count jumlah broadcastdone
function countbroadcastdone(){
    global $conn;
    $usernip = $_COOKIE['logincookie'];
    $query = "SELECT COUNT(activityID) FROM broadcast_activity WHERE receivernip='".$usernip."' AND broadcaststatus='1'" ;
    $result = mysqli_query($conn,$query);
    $row = mysqli_fetch_array($result);

    if($row){
        echo $row[0];
    }
}

//9. Fungsi count jumlah broadcastnotdone
function countbroadcastnotdone(){
    global $conn;
    $usernip = $_COOKIE['logincookie'];
    $query = "SELECT COUNT(activityID) FROM broadcast_activity WHERE receivernip='".$usernip."' AND broadcaststatus='0'" ;
    $result = mysqli_query($conn,$query);
    $row = mysqli_fetch_array($result);

    if($row){
        echo $row[0];
    }
}

//10. display announcement function
function addanouncement(){
    $addanouncement = $_POST['addanouncement'];
    if(isset($_POST['submitaddanouncement'])){

        echo $addanouncement;
    }
}

//11.fungsi update status broadcast melalui tombol update di halaman broadcast list
function donebroadcastbutton(){
    global $conn;
    $usernip = $_COOKIE['logincookie'];
    $broadcastid = $_GET['broadcastid'];
    $query= "UPDATE broadcast_activity SET broadcaststatus='1' WHERE broadcastID='".$broadcastid."' AND receivernip='".$usernip."'";
    $result=mysqli_query($conn, $query);
    if($result){
        header('location:broadcastlist.php');
    }
}

//12. fungsi monitor user broadcast activity 
function monitorBroadcast(){
    global $conn;
    $broadcastid= $_GET['broadcastid'];
    $query="SELECT user.nama, user.jabatan, broadcast_activity.broadcaststatus, broadcast_activity.time_completed, broadcast_activity.broadcastcomment FROM broadcast_activity INNER JOIN user ON broadcast_activity.receivernip=user.NIP WHERE broadcastID = ?";
    $stmt= mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "s", $broadcastid);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $counter = 1;
    while ($row = mysqli_fetch_assoc($result)){

        $timecomplete = "";
        if($row['time_completed']!==NULL){
        $splitTime = explode(" ", $row['time_completed']);
        $datecomplete= $splitTime[0];
        $datecomplete= strtotime($datecomplete);
        $datecomplete= date("d-M-y", $datecomplete);
        $timecomplete = $splitTime[1];
        }else{
        $datecomplete = "NULL";  
        $timecomplete = ""; 
        }

        $status = "";
        if($row['broadcaststatus']=='1'){
        $status = "<td><badge class='badge badge-pill badge-success'>Sudah </badge></td>";
        }else{
        $status = "<td><badge class='badge badge-pill badge-danger'>Belum </badge></td>";
        }

        $comment = "";
        if($row['broadcastcomment']!==NULL){
        $comment = $row['broadcastcomment'];
        }else{
        $comment = "-";
        }
       
        echo "<tr>
        <td>".$counter."</td>
        <td>".$row['nama']."</td>
        <td>".$row['jabatan']."</td>
        ".$status."
        <td>".$datecomplete." ". $timecomplete."</td>
        <td>".$comment."</td>
        </tr>
        ";
        $counter++;
    }
}

//13. fungsi menunjukan nama user di topbar
function usernameTopbar(){
    global $conn;
    $usernip = $_COOKIE['logincookie'];
    
    $query = "SELECT * FROM user WHERE NIP='".$usernip."'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);

    if($row){
        echo $row['nama'];
    }
}

//14. fungsi insert Recurring Broadcast
function sendrbroadcast(){
    global $conn;

    // check if the form has been submitted
    if(isset($_POST['submitrbroadcast'])){
    
        // validate the form inputs
        if(empty($_POST['number2']) || empty($_POST['message2']) || empty($_POST['cronexpression']) || empty($_POST['judulpesan'])) {
            echo "<script>Swal.fire({
                icon: 'error',
                title: 'Failed',
                text: 'Please fill all required field!',
            });</script>";
        } else {
        
            $tujuanrbroadcast = mysqli_real_escape_string($conn, $_POST['number2']);
            $isirbroadcast = mysqli_real_escape_string($conn, $_POST['message2']);
            $cronexpression = mysqli_real_escape_string($conn, $_POST['cronexpression']);
            $judulrbroadcast = mysqli_real_escape_string($conn, $_POST['judulpesan']);
            $rbroadcastcreator = mysqli_real_escape_string($conn, $_COOKIE['logincookie']);

            // insert the data into the database
            $query = "INSERT INTO rbroadcast(judulrbroadcast, isirbroadcast, rbroadcastcreator, cron_expression, tujuanrbroadcast)  VALUES ('$judulrbroadcast', '$isirbroadcast', '$rbroadcastcreator', '$cronexpression', '$tujuanrbroadcast')";
            $result = mysqli_query($conn, $query);

            if(!$result){
               echo "<script>failedCreateRbroadcast()</script>" ;
            } else {
                echo "<script>successCreateRbroadcast()</script>";
            }
        }
    }
}



//15. fungsi show recurring broadcast
function readrbroadcast(){
    global $conn;
    $query = "SELECT rbroadcastID, judulrbroadcast, isirbroadcast, user.nama, created_at, cron_expression, tujuanrbroadcast, status FROM rbroadcast INNER JOIN user ON rbroadcast.rbroadcastcreator=user.NIP";
    $result = mysqli_query($conn, $query);
    $number = 1;

    function statusToText($param){
        if($param==1){
            return "<p class='text-success'>Active</p>";
        }else{return "<p class='text-danger'>Inactive</p>";}
    }

    while($row = mysqli_fetch_assoc($result)){
        $query2 = "SELECT * FROM groupchat WHERE groupNumber = '".$row['tujuanrbroadcast']."'";
        $result2 = mysqli_query($conn, $query2);
        $row2 = mysqli_fetch_assoc($result2);
        if($row['status']==1){
            echo "
            <tr>
                <td>".$number."</td>
                <td>".$row['judulrbroadcast']."</td>
                <td>".$row['isirbroadcast']."</td>
                <td>".$row['nama']."</td>
                <td>".$row2['groupName']."</td>
                <td class='cron-expression'>".$row['cron_expression']."</td>
                <td>".statusToText($row['status'])."</td>
                <td>
                    <span> <a class='button btn-sm btn-danger' onclick='hapusrbroadcast(".$row['rbroadcastID'].")'><i class='fas fa-trash'></i></a></span>
                </td>
            </tr>";
            $number++;
        }else{
            echo "
            <tr>
                <td>".$number."</td>
                <td>".$row['judulrbroadcast']."</td>
                <td>".$row['isirbroadcast']."</td>
                <td>".$row['nama']."</td>
                <td>".$row2['groupName']."</td>
                <td class='cron-expression'>".$row['cron_expression']."</td>
                <td>".statusToText($row['status'])."</td>
                <td>
                    <span> <a class='button btn-sm btn-success' onclick='updaterbroadcast(".$row['rbroadcastID'].")'>Activate</a></span>
                    <span> <a class='button btn-sm btn-danger' onclick='hapusrbroadcast(".$row['rbroadcastID'].")'><i class='fas fa-trash'></i></a></span>
                </td>
            </tr>";
            $number++;
        }
    }
}

//16. fungsi hapus rbroadcast
function deleterbroadcast(){
    global $conn;
    $rbroadcastid= $_GET['rbroadcastid'];
    $query = "DELETE FROM rbroadcast WHERE rbroadcastID='".$rbroadcastid."'";
    $delete = mysqli_query($conn, $query);

    if($delete){
        header('location: activebroadcast.php');
    }
}

//17. menampilkan option contact group
function selectGroupContact(){
    global $conn;
    $query = "SELECT * FROM groupchat";
    $result = mysqli_query($conn, $query);

    while($row = mysqli_fetch_assoc($result)){
        echo "<option value='".$row['groupnumber']."'>".$row['groupName']." (Test Group)</option>";

    }
}


//18. menampilkan option contact individual
function selectIndividualContact(){
    global $conn;
    $query = "SELECT nama, nomor_hp FROM user";
    $result = mysqli_query($conn, $query);

    while($row = mysqli_fetch_assoc($result)){
        echo "<option value='".$row['nomor_hp']."'>".$row['nama']."</option>";
    }

}

//19. fungsi insert feedback
function tambahfeedback(){
    if(isset($_POST['submitfeedback'])){
    
    global $conn;
    
    $feedback = $_POST['feedbacknote'];
    $nip = $_COOKIE["logincookie"];
    $query="INSERT INTO feedback(isiFeedback, sender) VALUES ('$feedback', '$nip');";
    $insert = mysqli_query($conn, $query);
    if(!$insert){
        echo "<script>Swal.fire({
            icon: 'error',
            title: 'Failed',
            text: 'Send feedback failed',
          })</script>";
    }else {echo "<script>Swal.fire({
        icon: 'success',
        title: 'Success',
        text: 'Feedback sent',
      })</script>";}
        }
    }


//20. fungsi hapus rbroadcast
function updaterbroadcastStatus(){
    global $conn;
    $rbroadcastid= $_GET['rbroadcastid'];
    $query = "UPDATE  rbroadcast SET status= 1 WHERE rbroadcastID='".$rbroadcastid."'";
    $update = mysqli_query($conn, $query);

    if($update){
        header('location: activebroadcast.php');
    }
}

//21. fungsi menampilkan tabel My broadcastlist
function mybroadcastlist(){

    global $conn;
    $usernip = $_COOKIE['logincookie'];
    $query = "SELECT broadcast.broadcastID, broadcast.deadline, broadcast.judulbroadcast, broadcast.tujuanbroadcast, broadcast_activity.broadcaststatus FROM broadcast_activity INNER JOIN broadcast ON broadcast_activity.broadcastID=broadcast.broadcastID WHERE receivernip='".$usernip."' AND usernip='".$usernip."'";
    $result = mysqli_query($conn, $query);
    while($row=mysqli_fetch_assoc($result)){
        $query2 = "SELECT * FROM groupchat WHERE groupnumber='".$row['tujuanbroadcast']."'";
        $result2 = mysqli_query($conn, $query2);
        $row2 = mysqli_fetch_assoc($result2);
        $namaTujuan = $row2['groupName'];
        $deadline= $row['deadline'];
        $sortdate= date('d/m/y', strtotime($deadline));
        $status = $row['broadcaststatus'];

        if($status!=='1'){
                echo"
                <tr>
                <td>".$sortdate."</td>
                <td><a href='readbroadcast.php?broadcastid=".$row['broadcastID']."'>".$row['judulbroadcast']."</a></td>
                <td>".$namaTujuan."</td>
                <td>
                    <badge class='badge badge-pill badge-danger' data-broadcastid='".$row['broadcastID']."'>
                    Belum
                    </badge>
                </td>
                </tr>";
                } else {
                echo"<tr>
                <td>".$sortdate."</td>
                <td><a href='readbroadcast.php?broadcastid=".$row['broadcastID']."'>".$row['judulbroadcast']."</a></td>
                <td>".$namaTujuan."</td>
                <td><span class='badge badge-pill badge-success'>Sudah</span></td>
                </tr>";
                } 
    }

}

//22. fungsi menampilkan data value area chart
function monthlyStatistic(){
    global $conn;
    $usernip = $_COOKIE['logincookie'];
    $query = "SELECT time_assigned FROM broadcast_activity WHERE receivernip=?";
    $stmt=mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt,"s", $usernip);
    mysqli_stmt_execute($stmt);
    $result=mysqli_stmt_get_result($stmt);
    $array=[];
    while($row=mysqli_fetch_assoc($result)){
    $date= $row['time_assigned'];
    $month = substr($date, 5, 2);
    array_push($array, $month);
    }

    $monthArray=['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12'];
    $countMonthlyArray=[];

    foreach($monthArray as $month){
    if(in_array($month, $array)){
    $monthlyCount=array_count_values($array)[$month];
    array_push($countMonthlyArray, $monthlyCount);
    }else{
    $monthlyCount = 0;
    array_push($countMonthlyArray, $monthlyCount);
    }

    }
    
    for($i=0; $i<12; $i++){
        if($i==11){
        echo $countMonthlyArray[$i];
        }else{
        echo $countMonthlyArray[$i].",";   
        }
     }
    }

//23. fungsi search bar
function searchbar() {
    global $conn;
    $usernip = $_COOKIE['logincookie'];
  
    if(isset($_POST['searchbutton'])){
    $search= '%'.$_POST['searchinput'].'%';
    $query = "SELECT broadcast.broadcastID FROM broadcast_activity LEFT JOIN broadcast ON broadcast_activity.broadcastID=broadcast.broadcastID WHERE receivernip=? AND broadcast.judulbroadcast LIKE ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "ss", $usernip, $search);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if($row = mysqli_fetch_assoc($result)){

    $broadcastid= $row['broadcastID'];
    echo "<meta http-equiv='refresh'  content='0; URL=readbroadcast.php?broadcastid=".$broadcastid."'/>";
    }
    }

  }
  



////////////////////////////////////ADMIN FUNCTION/////////////////////////////////////////////////////////////

//1. fungsi membaca referensi user
function readuser(){
    global $conn;
    
    $query = "SELECT * FROM user ORDER BY user_id ASC";
    $result = mysqli_query($conn, $query);
    $number = 1;
    $route = "route-deleteuser.php?userid=";
    $type = " user";

    $route2="route-resetpassword.php?userid=";
    $title= "Reset password";

    function convertAdminString($role){
        if($role==1){
            return "Admin";
        }else
        {return "User";}
    }
    
    while($row = mysqli_fetch_assoc($result)){
        echo"
        <tr>
        <td>".$number."</td>
        <td>".$row['nama']."</td>
        <td>".$row['NIP']."</td>
        <td>".$row['jabatan']."</td>
        <td>".$row['nomor_hp']."</td>
        <td>".convertAdminString($row['role'])."</td>
        <td>
            <span> <a class='button btn-sm btn-success' title='edit data user' href='edituser.php?userid=".$row['user_id']."'><i class='fas fa-edit'></i></a></span>
            <span> <a class='button btn-sm btn-danger' title='delete user' onclick='hapusdata(\"".$route."\",".$row['user_id'].",\"".$type."\")'><i class='fas fa-trash'></i></a></span>
            <span> <a class='button btn-sm btn-secondary' title='reset password user' onclick='resetPassword(\"".$route2."\",".$row['user_id'].",\"".$title."\")'><i class='fas fa-key'></i></a></span>
        </td>
    </tr>";

    $number++;
    }
}

//2. fungsi menambah user
function adduser(){

    if(isset($_POST['submituser'])){
        global $conn;
        $namauser = $_POST['namauser'];
        $NIPuser = $_POST['NIPuser'];
        $jabatan = $_POST['jabatanuser'];
        $nomorhpuser = $_POST['nomorhpuser'];
        $password =$_POST['NIPuser'];
        $roleuser=$_POST['roleUser'];
        $passwordhash = password_hash($password, PASSWORD_BCRYPT);

        if(empty($NIPuser)==TRUE||strlen($NIPuser)!==18||preg_match('/[a-z]/i',$NIPuser)==TRUE){
        echo "NIP invalid";
        }else {
            $query="INSERT INTO user(nama, NIP, jabatan, nomor_hp, role, password_hash) VALUES('$namauser', '$NIPuser', '$jabatan', '$nomorhpuser', '$roleuser', '$passwordhash');";
            $insert = mysqli_query($conn, $query);
                if($insert){
                    header('location:reference.php');
                    exit();
                } else {echo "insert data failed";}
        }
}
}

//3. fungsi menunjukan data user di page edituser
function showuserdata(){

    global $conn;
    $userid= $_GET['userid'];
    $query = "SELECT * FROM user WHERE user_id= '".$userid."'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    $jabatanuser= $row['jabatan'];

    $selectBidang = "";
    switch($jabatanuser){
        case 'Bidang SKKI';
        $selectBidang="
        <div class='form-group id=groupdiv2'>
        <label for='jabatanuser'>Bidang</label>
            <select name='jabatanuser' id='jabatanuser' class='form-control'>
            <option>Bagian Umum</option>
            <option>Bidang PPA 1</option>
            <option>Bidang PPA 2</option>
            <option selected>Bidang SKKI</option>
            <option>Bidang PAPK</option>
            </select>
        </div>";
        break;

        case 'Bagian Umum';
        $selectBidang="
        <div class='form-group id=groupdiv2'>
        <label for='jabatanuser'>Bidang</label>
            <select name='jabatanuser' id='jabatanuser' class='form-control'>
            <option selected>Bagian Umum</option>
            <option>Bidang PPA 1</option>
            <option>Bidang PPA 2</option>
            <option>Bidang SKKI</option>
            <option>Bidang PAPK</option>
            </select>
        </div>";
        break;

        case 'Bidang PPA 2';
        $selectBidang="
        <div class='form-group id=groupdiv2'>
        <label for='jabatanuser'>Bidang</label>
            <select name='jabatanuser' id='jabatanuser' class='form-control'>
            <option>Bagian Umum</option>
            <option>Bidang PPA 1</option>
            <option selected>Bidang PPA 2</option>
            <option>Bidang SKKI</option>
            <option>Bidang PAPK</option>
            </select>
        </div>";
        break;

        case 'Bidang PAPK';
        $selectBidang="
        <div class='form-group id=groupdiv2'>
        <label for='jabatanuser'>Bidang</label>
            <select name='jabatanuser' id='jabatanuser' class='form-control'>
            <option>Bagian Umum</option>
            <option>Bidang PPA 1</option>
            <option>Bidang PPA 2</option>
            <option>Bidang SKKI</option>
            <option selected>Bidang PAPK</option>
            </select>
        </div>";
        break;

        case 'Bidang PPA 1';
        $selectBidang="
        <div class='form-group id=groupdiv2'>
        <label for='jabatanuser'>Bidang</label>
            <select name='jabatanuser' id='jabatanuser' class='form-control'>
            <option>Bagian Umum</option>
            <option selected>Bidang PPA 1</option>
            <option>Bidang PPA 2</option>
            <option>Bidang SKKI</option>
            <option>Bidang PAPK</option>
            </select>
        </div>";
        break;

        default;
        $selectBidang="
        <div class='form-group id=groupdiv2'>
        <label for='jabatanuser'>Bidang</label>
            <select name='jabatanuser' id='jabatanuser' class='form-control'>
            <option>Bagian Umum</option>
            <option>Bidang PPA 1</option>
            <option>Bidang PPA 2</option>
            <option>Bidang SKKI</option>
            <option>Bidang PAPK</option>
            </select>
        </div>";
        break;
    }

    $selectRole="";
    if($row['role']=='1'){
    $selectRole="<div class='form-group'>
    <label for='roleuser'>Role User</label>
    <select name='roleuser' id='roleuser' class= 'form-control'>
    <option value=0>User</option>
    <option value=1 selected>Admin</option>
    </select>
    </div>";
    }else{
    $selectRole="<div class='form-group'>
    <label for='roleuser'>Role User</label>
    <select name='roleuser' id='roleuser' class= 'form-control'>
    <option value=0 selected>User</option>
    <option value=1>Admin</option>
    </select>
    </div>";
    }

    if ($result){

        echo"
        <form name='edituserform' id='edituserform' method='POST' action='edituser.php'>
                    
        <div class='form-group'>
        <label for='nama'>Nama</label>
        <input name='namauser' id='namauser' class='form-control' value='".$row['nama']."'></input>
        </div>

        <div class='form-group'>
        <label for='NIPuser'>NIP</label>
        <input name='NIPuser' id='NIPuser' class='form-control' value='".$row['NIP']."'></input>
        </div>

        ".$selectBidang."

        <div class='form-group'>
        <label for='nomorhpuser'>Nomor HP</label>
        <input name='nomorhpuser' id='nomorhpuser' class='form-control' value='".$row['nomor_hp']."'></input>
        </div>

        <input type='hidden' name='userid' value='".$userid."'>

        ".$selectRole."

        <div class='form-group mt-5 text-center'>
        <button type='submit' name='submitedituser' id='submitedituser' class='btn btn-primary '>Edit</button>
        <a type='button' href='' class='btn btn-outline-secondary' name='clearsubmituser' id='clearsubmituser'>Reset</a>
        </form>
        </div>
        ";
    } else {
        echo "query failed, there is a problem with this user!";
    }
}

//4. Fungsi update user
function updateuser(){
    if(isset($_POST['submitedituser'])){

    global $conn;
    $namauser = $_POST['namauser'];
    $nipuser = $_POST['NIPuser'];
    $jabatanuser = $_POST['jabatanuser'];
    $nomorhpuser = $_POST['nomorhpuser'];
    $roleuser = $_POST['roleuser'];
    $userid = $_POST['userid'];
    $query2 = "SELECT NIP from user WHERE user_id='".$userid."'";
    $result2 = mysqli_query($conn, $query2);
    $row = mysqli_fetch_assoc($result2);
    $rownip = $row['NIP'];
    
    if($rownip !== $nipuser){
        $query = "UPDATE user SET nama='".$namauser."', NIP='".$nipuser."', jabatan='".$jabatanuser."', nomor_hp='".$nomorhpuser."', role='".$roleuser."' WHERE NIP='".$rownip."'";
        $result = mysqli_query($conn, $query);
            if($result){
                header('location:reference.php');
                }else{
                    echo "insert data failed";
                }

    }elseif($rownip == $nipuser){
        $query3 = "UPDATE user SET nama='".$namauser."', jabatan='".$jabatanuser."', nomor_hp='".$nomorhpuser."', role='".$roleuser."' WHERE NIP='".$rownip."'";
        $result3 = mysqli_query($conn, $query3);
        if($result3){
            header('location:reference.php');
            }else{
                echo "insert data failed";
            }
    }
  }

}

//5. fungsi delete user
function deleteuser(){
    global $conn;
    $userid= $_GET['userid'];
    $query = "DELETE FROM user WHERE user_id='".$userid."'";
    $delete = mysqli_query($conn, $query);

    if($delete){
        header('location: reference.php');
    }
}

//6. fungsi login
function login(){
global $conn;
if (isset($_POST['submitlogin'])){
$inputnip = $_POST['inputnip'];
$inputpassword = $_POST['inputpassword'];
$inputpasswordhash = password_hash($inputpassword, PASSWORD_BCRYPT);

$query = "SELECT * FROM user WHERE NIP='".$inputnip."'";
$result = mysqli_query($conn, $query);
$query2 = "UPDATE user SET last_login = CURRENT_TIMESTAMP WHERE NIP='".$inputnip."'" ;
$row = mysqli_fetch_assoc($result);

if($row){
$nip = $row['NIP'];
$passwordhash = $row['password_hash'];

        if($inputnip=null || !password_verify($inputpassword, $passwordhash) || !$result){
        echo
        '<div class="alert alert-danger alert-dismissible fade show position-fixed" role="alert" style="top: 15px; right: 25px; z-index: 9999;">
        Incorrect password!
        </div>
        ';
            } else{
                mysqli_query($conn, $query2);
                $cookiename ="logincookie";
                $cookievalue = $nip;
                setcookie($cookiename, $cookievalue, time()+(365*24*60*60));
                header('location:home.php');
                }
    }else {
        echo'
        <div class="alert alert-danger alert-dismissible fade show position-fixed" role="alert" style="top: 10px; right: 10px; z-index: 9999;">
        Incorrect username / User is not registered
        </div>';

    }   
 }
}

//7. fungsi cek cookies exist
function logincheck(){
    if(!isset($_COOKIE['logincookie'])){
    header("location:login.php");
    }
}

//8. fungsi logout
function logout(){
setcookie('logincookie', '', time()-3600);
header('location:login.php');}


//9. fungsi prevent 2 login 
function prevent2login(){
    if(isset($_COOKIE['logincookie'])){
    header("location:home.php");}
}

//10. Change Password
function changePassword(){

    if(isset($_POST['submitnewpassword'])){
        global $conn;
        $nip = $_COOKIE['logincookie'];
        $query1 = "SELECT password_hash FROM user WHERE NIP ='".$nip."' ";
        $result1= mysqli_query ($conn, $query1);
        $row = mysqli_fetch_assoc($result1);
        $currentpassword = $_POST['currentpassword'];
        $checkpassword = password_verify($currentpassword, $row['password_hash']);
        $newpassword =$_POST['newpassword'];
        $passwordhash = password_hash($newpassword, PASSWORD_BCRYPT);

        $query2 = "UPDATE user SET password_hash = '".$passwordhash."'WHERE NIP ='".$nip."' " ;
        $insert = mysqli_query($conn, $query2);
        if($checkpassword && $insert){
            header('location:home.php');
            exit();
        } else {echo "insert data failed";}
}
}

//11. fungsi membaca daftar grup
function readgroup(){
    global $conn;
    
    $query = "SELECT * FROM groupchat";
    $result = mysqli_query($conn, $query);
    $number = 1;
    $route = "route-deletegroup.php?groupid=";
    $type = " group";

    
    while($row = mysqli_fetch_assoc($result)){
        echo"
        <tr>
        <td>".$number."</td>
        <td>".$row['groupName']."</td>
        <td>".$row['groupnumber']."</td>
        <td>
            <span> <a class='button btn-sm btn-success' title='edit group data' href='edituser.php?groupid=".$row['groupID']."'><i class='fas fa-edit'></i></a></span>
            <span> <a class='button btn-sm btn-danger' title='delete group' onclick='hapusdata(\"".$route."\",".$row['groupID'].",\"".$type."\")'><i class='fas fa-trash'></i></a></span>
            <span> <a class='button btn-sm btn-warning' title='assign user' href='assignuser.php?groupid=".$row['groupID']."'><i class='fas fa-user'></i></a></span>
        </td>
    </tr>";

    $number++;
    }
}


//12. fungsi delete grup
function deletegrup(){
    global $conn;
    $groupid= $_GET['groupid'];
    $query = "DELETE FROM groupchat WHERE groupID='".$groupid."'";
    $delete = mysqli_query($conn, $query);

    if($delete){
        header('location: reference.php');
    }else{echo "failed to run query";}
}

//13. fungsi menunjukan data user di page edituser
function showgroupdata(){

    global $conn;
    $groupid= $_GET['groupid'];
    $query = "SELECT * FROM groupchat WHERE groupID= '".$groupid."'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);

    if ($result){

        echo "
        <form name='editgroupform' id='editgroupform' method='POST' action='edituser.php'>
                    
        <div class='form-group'>
        <label for='namagroup'>Nama Group</label>
        <input name='namagroup' id='namagroup' class='form-control' value='".$row['groupName']."'></input>
        </div>

        <div class='form-group'>
        <label for='groupID'>Group ID</label>
        <input name='groupID' id='groupID' class='form-control' value='".$row['groupnumber']."'></input>
        </div>

        <input type='hidden' name='groupidvalue' value='".$groupid."'>

        <div class='form-group mt-5 text-center'>
        <button type='submit' name='submiteditgroup' id='submiteditgroup' class='btn btn-primary '>Edit</button>
        <a type='button' href='' class='btn btn-outline-secondary' name='clearsubmitgroup' id='clearsubmitgroup'>Reset</a>
        </form>
        ";
    } else {
        echo "query failed, there is a problem with this user!";
    }
}

//14. Fungsi update group
function updategroup(){
    if(isset($_POST['submiteditgroup'])){
    global $conn;
    $groupidvalue = $_POST['groupidvalue'];
    $groupname = $_POST['namagroup'];
    $groupid = $_POST['groupID'];

    $query = "UPDATE groupchat SET groupName='".$groupname."', groupnumber='".$groupid."' WHERE groupID='".$groupidvalue."'";
    $result = mysqli_query($conn, $query);

    if($result){
        header('location:reference.php');
    }else{
        echo "insert data failed";
        }
    }
  }

//14. Fungsi print halaman add user/ add group
function addUserOrGroup(){
    if($_GET['type']=="user"){
        echo "
                <!-- Data Content -->
                <div class='container-fluid'>
                    <div class='d-sm-flex align-items-center justify-content-between mb-5'>
                    <h3>
                    <span><a  class= 'h5' href='reference.php'><i class='fas fa-arrow-left'></i></a></span>
                    <span>Add User</span>
                    </h3>
                    </div>
                
                <!-- Isi Form-->
                <div class='card shadow mb-4 col-sm-5 mx-auto'>
                    <div class='card-body'>
                    <form name='adduser' id='adduserform' method='POST' action='adduser.php'>
                    <div class='form-group'>
                        <label for='nama'>Nama</label>
                        <input name='namauser' id='namauser' class='form-control' placeholder='insert name'></input>
                    </div>

                    <div class='form-group'>
                        <label for='NIPuser'>NIP</label>
                        <input name='NIPuser' id='NIPuser' class='form-control' placeholder='insert NIP'></input>
                    </div>

                    <div class='form-group'>
                    <label for='jabatanuser'>Bidang</label>
                        <select name='jabatanuser' id='jabatanuser' class='form-control'>
                        <option>Bagian Umum</option>
                        <option>Bidang PPA 1</option>
                        <option>Bidang PPA 2</option>
                        <option>Bidang SKKI</option>
                        <option>Bidang PAPK</option>
                        </select>
                    </div>

                    <div class='form-group'>
                        <label for='nomorhpuser'>Nomor HP</label>
                        <input name='nomorhpuser' id='nomorhpuser' class='form-control' placeholder='format: 62xxxxx@c.us '></input>
                    </div>

                    <div class='form-group'>
                        <label for='roleUser'>Role</label>
                        <select type='password' name='roleUser' id='roleUser' class='form-control'>
                            <option value=0> User</option>
                            <option value=1>Admin</option>
                        </select>
                    </div>

                    <div class='form-group mt-5 text-center'>
                        <button type='submit' name='submituser' id='submituser' class='btn btn-primary '>Submit</button>
                        <a type='button' href='' class='btn btn-outline-secondary' name='clearsubmituser' id='clearsubmituser'>Reset</a>
                    </div>
                    </form>
                </div>
                </div>

                </div>
                <!-- Data Content/container-fluid -->
        ";
    }else{
        echo"
        <!-- Data Content -->
        <div class='container-fluid'>
            <div class='d-sm-flex align-items-center justify-content-between mb-5'>
            <h3>
            <span><a  class= 'h5' href='reference.php'><i class='fas fa-arrow-left'></i></a></span>
            <span>Add Group</span>
            </h3>
            </div>
        
        <!-- Isi Form-->
        <div class='card shadow mb-4 col-sm-5 mx-auto'>
            <div class='card-body'>
            <form method='POST' action='adduser.php'>
            <div class='form-group'>
                <label for='nama'>Nama Group</label>
                <input name='namagroup' id='namagroup' class='form-control' placeholder='insert name'></input>
            </div>

            <div class='form-group'>
                <label for='groupidvalue'>Group ID</label>
                <input name='groupidvalue' id='groupidvalue' class='form-control' placeholder='insert group ID'></input>
            </div>

            <div class='form-group mt-5 text-center'>
                <button type='submit' name='submitgroup' id='submitgroup' class='btn btn-primary '>Submit</button>
                <a href='' type='button' class='btn btn-outline-secondary' name='clearsubmitgroup' id='clearsubmitgroup'>Reset</a>
            </div>
            </form>
        </div>
        </div>

        <!--Find Group ID-->
        <div class='d-sm-flex align-items-center mb-2 mx-auto'>
            <h3 class='h5 mb-0 text-gray-900 text-center'>Find Group ID</h3>   
        </div>
        <div class='card shadow mb-4 col-sm-5 mx-auto'>
            <div class='card-body'>
                <div><button onclick='logChats()' class='btn btn-primary mb-3'>Log</button></div>
                <div id='chats-data'></div>
            </div>
        </div>

        </div>
        <!-- Data Content/container-fluid -->
        ";
    }

}

//15. fungsi menambah group
function addgroup(){
    if(isset($_POST['submitgroup'])){
        global $conn;
        $namagroup = $_POST['namagroup'];
        $groupidvalue = $_POST['groupidvalue'];
        $query="INSERT INTO groupchat (groupName, groupnumber) VALUES('$namagroup', '$groupidvalue');";
        $insert = mysqli_query($conn, $query);
        if($insert){
            header('location:reference.php');
            exit();
        } else {echo "insert data failed";}
}
}

//16. fungsi admin check
function admincheck(){
    global $conn;
    $usernip = $_COOKIE['logincookie'];
    $query = "SELECT * from user WHERE NIP ='".$usernip."'";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);

    if($row['role']!=='1'){
    header("location:unauthorized.php");
    }

}

//17. Fungsi reset password
function resetPassword(){
    global $conn;
    $userid = $_GET['userid'];
    $query1 = "SELECT NIP FROM user WHERE user_id=?";
    $stmt = mysqli_prepare($conn, $query1);
    mysqli_stmt_bind_param($stmt, "s", $userid );
    mysqli_stmt_execute($stmt);
    $result= mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);
    $nip = $row['NIP'];

    $query2 = "UPDATE user SET  password_hash =? WHERE NIP=?";
    $passwordhash = password_hash($nip, PASSWORD_BCRYPT);
    $stmt2 = mysqli_prepare($conn, $query2);
    mysqli_stmt_bind_param($stmt2, "ss", $passwordhash, $nip);
    if(mysqli_stmt_execute($stmt2)){
        header('location:reference.php');
    }else{
        echo "update password failed";
    }
}


//18. Fungsi Show All user untuk kemudian Assign User ke group chat
function showUserToAssign()
{
    global $conn;
    $groupid = $_GET['groupid'];
    $counter = 1;
    $query = "SELECT user.nama, junctionTableGroup.userID, user.NIP
              FROM user
              LEFT JOIN junctionTableGroup ON junctionTableGroup.userID = user.NIP AND groupID = ?";

    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "s", $groupid);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    while ($row = mysqli_fetch_assoc($result)) {
        $nama = $row['nama'];
        $userID = $row['userID'];
        $nip = $row['NIP'];
        $checked = "";

        if(!empty($userID)){
            $checked="checked";
        };

        echo "
        <div class='list-group-item'>
            <div class='row'>
                <div class='col-10'>
                    <label for='user1' class='form-check-label'>".$counter.". ".$nama."</label>
                </div>
                <div class='col-2'>
                    <input type='checkbox' class='form-check-input float-right' name='checkbox[".$counter."]' value='".$row['NIP']."'".$checked.">
                </div>
            </div>
        </div>";
    $counter++;
    }
}

//19. Update User Assignment in Group
function updateUserAssignment(){
    global $conn;

    if(isset($_POST['updateassignuser'])){
    $selectedCheckBox=[];
    if($_POST['checkbox']){
    $selectedCheckBox= $_POST['checkbox'];}

    $groupid = $_POST['groupidHidden'];
    $groupid = (int)$groupid;

    $queryAll = "SELECT * FROM user";
    $stmtAll = mysqli_prepare($conn, $queryAll);
    mysqli_stmt_execute($stmtAll);
    $resultAll = mysqli_stmt_get_result($stmtAll);
    $allCheckBox = [];
    while ($rowAll= mysqli_fetch_assoc($resultAll)) {
        array_push($allCheckBox, $rowAll['NIP']);
    }

    $nonSelectedCheckBox = array_diff($allCheckBox, $selectedCheckBox);

    foreach($nonSelectedCheckBox as $nonSelected){
        $query5= "DELETE FROM junctiontablegroup WHERE userID=? AND groupID=?";
        $stmt5=mysqli_prepare($conn, $query5);
        mysqli_stmt_bind_param($stmt5, "si", $nonSelected, $groupid);
        $delete=mysqli_stmt_execute($stmt5);
        if($delete){
            header('location:reference.php');
        }
    }

    foreach($selectedCheckBox as $selected){
    $query2 = "SELECT userID, groupID FROM junctiontablegroup WHERE userID=? AND groupID=?";
    $stmt2= mysqli_prepare($conn,$query2);
    mysqli_stmt_bind_param($stmt2, "ss", $selected, $groupid);
    mysqli_stmt_execute($stmt2);
    $result2=mysqli_stmt_get_result($stmt2);

    if(mysqli_num_rows($result2)==0){
        $query3= "SELECT nama FROM user WHERE NIP=?";
        $stmt3= mysqli_prepare($conn, $query3);
        mysqli_stmt_bind_param($stmt3, "s", $selected);
        mysqli_stmt_execute($stmt3);
        $result3=mysqli_stmt_get_result($stmt3);
        $row3=mysqli_fetch_assoc($result3);
        $namauser=$row3['nama'];

        $query = "INSERT INTO junctiontablegroup(userID, groupID) VALUES(?,?)";
        $stmt= mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "ss", $selected, $groupid);
        if (mysqli_stmt_execute($stmt)){
        header('location:reference.php');
        }else{
        echo "insert data failed";
        }
     }
    }
 }   
}

//20. Delete user assignment
function deleteUserAssignment(){
    global $conn;
    if(isset($_POST['updateassignuser'])){
        $selectedCheckBox= $_POST['checkbox'];
        $groupid = $_POST['groupidHidden'];
        $groupid = (int)$groupid;
    
        $queryAll = "SELECT * FROM user";
        $stmtAll = mysqli_prepare($conn, $queryAll);
        mysqli_stmt_execute($stmtAll);
        $resultAll = mysqli_stmt_get_result($stmtAll);
        $allCheckBox = [];
        while ($rowAll= mysqli_fetch_assoc($resultAll)) {
            array_push($allCheckBox, $rowAll['NIP']);
        }
    
        $nonSelectedCheckBox = array_diff($allCheckBox, $selectedCheckBox);
    
        foreach($nonSelectedCheckBox as $nonSelected){
            $query5= "DELETE FROM junctiontablegroup WHERE userID=? AND groupID=?";
            $stmt5=mysqli_prepare($conn, $query5);
            mysqli_stmt_bind_param($stmt5, "si", $nonSelected, $groupid);
            if(mysqli_stmt_execute($stmt5)){
            header('location:reference.php');
            }else{
                echo"delete data failed";
            }
        }
    }

}


//////////////////////////////////////////////////////////OTHER FUNCTION////////////////////////////////////////
//1. fungsi convert cron ke english readable language
function convertCron($cronExpression) {
    $parts = explode(' ', $cronExpression);
    $minute = $parts[0];
    $hour = $parts[1];
    $dayOfMonth = $parts[2];
    $month = $parts[3];
    $dayOfWeek = $parts[4];

    $dayOfWeekMap = array(
        '0' => 'Sunday',
        '1' => 'Monday',
        '2' => 'Tuesday',
        '3' => 'Wednesday',
        '4' => 'Thursday',
        '5' => 'Friday',
        '6' => 'Saturday'
    );

    $english = '';

    if ($dayOfWeek == '1-5') {
        $english .= 'Monday to Friday ';
    } elseif ($dayOfWeek != '*') {
        if (strpos($dayOfWeek, '-') !== false) {
            list($startDay, $endDay) = explode('-', $dayOfWeek);
            $daysOfWeek = array_map(function($dow) use($dayOfWeekMap) { return $dayOfWeekMap[$dow]; }, range($startDay, $endDay));
            $english .= implode(', ', $daysOfWeek) . ' ';
        } else {
            $daysOfWeek = array_map(function($dow) use($dayOfWeekMap) { return $dayOfWeekMap[$dow]; }, explode(',', $dayOfWeek));
            $english .= implode(', ', $daysOfWeek) . ' ';
        }
    }

    if ($hour == '0' && $minute == '0') {
        $english .= 'midnight';
    } elseif ($hour == '12' && $minute == '0') {
        $english .= 'noon';
    } else {
        $english .= date('g.i A', strtotime("$hour:$minute"));
    }

    $english .= ' every day';

    return $english;
}

?>






