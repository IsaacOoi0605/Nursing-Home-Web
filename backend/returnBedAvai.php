<?php

        $server="localhost";
        $user="root";
        $password="";
        $db="management";
        $conn = mysqli_connect($server,$user,$password,$db);
        $bedLevel=$_POST["bedSeries"];
        $bedID=$_POST["bedID"];
        $sql="SELECT Availability from bed where BedID='$bedID' and Level='$bedLevel'";
        $result=mysqli_query($conn,$sql);
        $row=mysqli_fetch_array($result);
        if($row['Availability']=='1'){
           echo ("available");
        }
        else{
            $sql="SELECT HosID, PatientID from hospitalised where CheckOutDate='0' and BedID='$bedID' and BedLevel='$bedLevel'";
            $result=mysqli_query($conn,$sql);
            if($row=mysqli_fetch_array($result)){
                echo("in-used");
            }
            else{
                echo("not available");
            }
        }
        ?>
