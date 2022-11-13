<?php
        session_start();
        $server="localhost";
        $user="root";
        $password="";
        $db="management";
        $conn = mysqli_connect($server,$user,$password,$db);
        //return patient details
        $patientID=$_SESSION['checkPatientID'];
        //patient detail
        $sql="SELECT * FROM patient WHERE PatientID='$patientID'";
        $result=mysqli_query($conn, $sql);
        if($result){
            echo "<div class='border p-3 mb-2 rounded'><h3>Patient Details:</h3>";
            while($row = mysqli_fetch_array($result)){
            echo "<div class='row'>";
            //patient name
            echo "<div class='col-4'>Patient Name:";
            echo"<div class=''><input class='form-control input-sm ' value='".$row['Name']."' readonly></div></div>";
            //patient ic
            echo "<div class='col-4'>Patient IC:";
            echo"<div class=''><input class='form-control input-sm ' value='".$row['IC']."' readonly></div></div></div>";
            //patient image
            echo "<img class='mt-3' src='data:image/jpeg;base64,".base64_encode($row['img_path'])."'height='80' width='100'/>";
        }
        echo "</div>";
        }
        //bed detail
        $bedSeries=$_SESSION['checkBedSeries'];
        $bedID=$_SESSION['checkBedID'];
        $sql="SELECT * FROM bed WHERE BedID='$bedID' AND Level='$bedSeries'";
        $result=mysqli_query($conn, $sql);
        if($result){
            echo "<div class='border p-3 rounded'><h3>Bed Details:</h3>";
            while($row = mysqli_fetch_array($result)){
                //bed level
                echo "<div class='row'><div class='col-2 pt-1'>Bed Selected:</div>";
                echo"<div class='col-4'><input class='form-control input-sm' value='".$row['Level']."-";
                if($row['BedID']<10){
                    echo "00";
                  }
                  elseif($row['BedID']<100){
                    echo "0";
                  }
                echo $row['BedID']."' readonly></div>";
                //bed price
                echo "<div class='col-1 pt-1'>Bed Price:</div><div class='col-4'><input class='form-control input-sm' value='RM".$row['Cost']."' readonly></div></div>";
        }
            echo "</div>";
    
        }
        //disease detail
        echo "<div class='border p-3 rounded mt-3 mb-2'><h3>Disease Details:</h3>";
        //if disease is selected
        if (!empty($_SESSION['checkDisease'])){
            $disease=$_SESSION['checkDisease'];
            //retrieve disease from database
            //for each disease id in the array
            foreach($disease as $dis){
            $sql="SELECT * FROM disease WHERE DiseaseID='$dis'";
            $result=mysqli_query($conn, $sql);
            $row=mysqli_fetch_array($result);
            echo "<div class='mb-3'><input class='form-control input-sm' value='".$row['Name']."' readonly></div>";}
        }
        //no disease is selected
        else{
            echo"<h4>No Disease Selected.</h4>";
        }
        echo"</div>";
        //medicine detail
        echo "<div class='border p-3 rounded mt-3 mb-2'><h3>Medicine Details:</h3>";
        //if medicine are selected
        if (!empty($_SESSION['checkMedicine'])){
            //retrieve medicine list from session
            $medicine=$_SESSION['checkMedicine'];
            $medi="";
            //for each medicine selected
            foreach($medicine as $med){
                //get the varId from the array
                $medID=$med["id"];
                //if the medicine name is same with previous then wont echo
                if($medi!=$med["name"]){
                    $medi=$med["name"];
                    echo '<div class="border col-11 bg-light ms-2 mt-2 rounded ps-3"><h3 class="medName">'.$medi.'</h3></div>';
                }
                //retrieve info from database based on ID
                $sql="SELECT * FROM variantmedicine WHERE varID='$medID'";
                $result=mysqli_query($conn, $sql);
                $row=mysqli_fetch_array($result);
                //echo medicine weight, number of tablets, number of times to be taken, and hiding the variant id for further use
                echo "<div class='ms-2 ps-2 col-10 rounded border pt-2 pb-2 mt-1 mb-1'>
                    <div class='weight'>Weight: <b>".$row['Weight']."mg</b></div>
                    <div class='no'>Number of tablet: <b>".$med['no']."</b></div>
                    <div class='time'>Number of times per day: <b>".$med['time']."</b></div>
                    <div class='id d-none'>".$medID."</div>
                </div>";
            }
        }
        //if no medicine is selected
        else {
            echo"<h4>No Medicine Selected.</h4>";
        }
        echo"</div>";
        exit();
?>