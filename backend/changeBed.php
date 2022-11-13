<?php

        $server="localhost";
        $user="root";
        $password="";
        $db="management";
        $conn = mysqli_connect($server,$user,$password,$db);
        $patID=$_POST['patID'];
        $sql="SELECT BedID,BedLevel FROM hospitalised WHERE PatientID='$patID' AND CheckOutDate='0'";
        $result=mysqli_query($conn,$sql);
        $row=mysqli_fetch_array($result);
        $oldBedID=$row['BedID'];
        $oldBedLevel=$row['BedLevel'];
        $sql="UPDATE bed SET Availability='1' WHERE BedID='$oldBedID' AND Level='$oldBedLevel'";
        $result=mysqli_query($conn,$sql);
        $newBedID=$_POST['bedID'];
        $newBedLevel=$_POST['bedLevel'];
        $sql="UPDATE hospitalised SET BedID='$newBedID',BedLevel='$newBedLevel' WHERE PatientID='$patID' AND CheckOutDate='0'";
        $result=mysqli_query($conn,$sql);
        $sql="UPDATE bed SET Availability='0' WHERE BedID='$newBedID' AND Level='$newBedLevel'";
        $result=mysqli_query($conn,$sql);

        ?>
