<?php

        $server="localhost";
        $user="root";
        $password="";
        $db="management";
        $conn = mysqli_connect($server,$user,$password,$db);
        $bedLevel=$_POST["bedSeries"];
        $bedID=$_POST["bedID"];
        $sql="SELECT HosID, PatientID from hospitalised where CheckOutDate='0' and BedID='$bedID' and BedLevel='$bedLevel'";
        $result=mysqli_query($conn,$sql);
        $row=mysqli_fetch_array($result);
        $patient=array();
        array_push($patient,$row['PatientID']);
        array_push($patient,$row['HosID']);
        echo json_encode($patient);
        ?>
