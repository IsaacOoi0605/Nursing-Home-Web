<?php
        $server="localhost";
        $user="root";
        $password="";
        $db="management";
        $conn = mysqli_connect($server,$user,$password,$db);
        //get patient id
        $patID=$_POST['id'];
        //get bed info
        $sql="SELECT BedLevel, BedID, HosID from hospitalised WHERE PatientID='$patID' AND CheckOutDate='0'";
        $result= mysqli_query($conn, $sql);
        $row=mysqli_fetch_array($result);
        //update bed availability
        $bedID=$row['BedID'];
        $bedLevel=$row['BedLevel'];
        $hosID=$row['HosID'];
        $sql="UPDATE bed SET Availability='1' WHERE BedID='$bedID' AND Level='$bedLevel'";
        $result= mysqli_query($conn, $sql);
        //get bed price
        $sql="SELECT Cost from bed WHERE BedID='$bedID' AND Level='$bedLevel'";
        $result= mysqli_query($conn, $sql);
        $row=mysqli_fetch_array($result);
        $cost=$row['Cost'];
        //get today date
        $date=date("Y/m/d");
        //update hospitalised info
        $sql="UPDATE hospitalised SET CheckOutDate='$date' WHERE PatientID='$patID' AND CheckOutDate='0'";
        $result= mysqli_query($conn, $sql);
        //update patient info
        $sql="UPDATE patient SET Hospitalised='0' WHERE PatientID='$patID'";
        $result= mysqli_query($conn, $sql);
        //update daily revenue info
        $sql="INSERT INTO patientrevenue (todayDate,HosID,Cost) VALUES ('$date', '$hosID','$cost')";
        $result= mysqli_query($conn, $sql);

        ?>
