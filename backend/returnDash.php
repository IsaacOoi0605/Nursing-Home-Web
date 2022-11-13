<?php
    session_start();
    $server="localhost";
    $user="root";
    $password="";
    $db="management";
    $conn = mysqli_connect($server,$user,$password,$db);
    $position=$_SESSION["position"];
    echo"<div class=' me-2 mt-5 mb-3 ms-2'>
    <div class='row'>";
    if($position=="superAdmin"){
        $sql="SELECT COUNT(ID) as num from users where position='admin'";
        $result=mysqli_query($conn,$sql);
        $row=mysqli_fetch_array($result);
        echo '
          <div class="col-md-4">
          <div class="card p-3 mb-5 pt-0  bg-light">
            <div class="mt-5 text-center">
                <h3 class="heading">Manage Admin<br></h3>
                
                <div class="mt-5">
                    <div class="mt-3">
                        <span class="text1">total number of '.$row['num'].' admin</span> 
                    </div>
                    <br>
                    <a href="ManageAdmin.php" class="btn btn-primary view">View</a>
                </div>
            </div>
        </div>
        </div>';
        $sql="SELECT COUNT(ID) as num from users where position='nurse'";
        $result=mysqli_query($conn,$sql);
        $row=mysqli_fetch_array($result);
        echo '
          <div class="col-md-4">
          <div class="card p-3 mb-5 pt-0  bg-secondary">
            <div class="mt-5 text-center text-white">
                <h3 class="heading">Manage Nurse</h3>
                <div class="mt-5">
                    <div class="mt-3">
                        <span class="text1">total number of '.$row['num'].' nurse</span> 
                    </div>
                    <br>
                    <a href="ManageNurse.php" class="btn btn-light view">View</a>
                </div>
            </div>
        </div>
        </div>';
    }
    else if($position=="admin"){
        $sql="SELECT COUNT(ID) as num from users where position='nurse'";
        $result=mysqli_query($conn,$sql);
        $row=mysqli_fetch_array($result);
        echo '
          <div class="col-md-4">
          <div class="card p-3 mb-5 pt-0  bg-secondary">
            <div class="mt-5 text-center text-white">
                <h3 class="heading">Manage Nurse</h3>
                
                <div class="mt-5">
                    <div class="mt-3">
                        <span class="text1">total number of '.$row['num'].' nurse</span> 
                    </div>
                    <br>
                    <a href="ManageNurse.php" class="btn btn-light view">View</a>
                </div>
            </div>
        </div>
        </div>';
    }
    $sql="SELECT COUNT(PatientID) as num from patient";
    $result=mysqli_query($conn,$sql);
    $row=mysqli_fetch_array($result);
    echo '
      <div class="col-md-4">
      <div class="card p-3 mb-5 pt-0  bg-danger">
        <div class="mt-5 text-center text-white">
            <h3 class="heading">Manage Patient</h3>
            <div class="mt-5">
                <div class="mt-3">
                    <span class="text1">total number of '.$row['num'].' patient</span> 
                </div>
                <br>
                <a href="ManagePatient.php" class="btn btn-light view">View</a>
            </div>
        </div>
    </div>
    </div>';
    echo"</div>
    </div>";
?>