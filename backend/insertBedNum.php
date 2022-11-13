<?php

        $server="localhost";
        $user="root";
        $password="";
        $db="management";
        $conn = mysqli_connect($server,$user,$password,$db);
        $bedLevel=$_POST["bedSeries"];
        $bedNum=$_POST["bedNum"];
        $bedInsertType=$_POST["bedInsertType"];
        $sql="SELECT Cost from bed where Level='$bedLevel'";
        $result=mysqli_query($conn,$sql);
        $row=mysqli_fetch_array($result);
        $cost=$row['Cost'];
        if($bedInsertType=="specific"){
            $sql="SELECT Cost from bed where BedID='$bedNum' and Level='$bedLevel'";
            $result=mysqli_query($conn,$sql);
            if(mysqli_num_rows($result)){
                echo "bed number has been inserted before";
            }
            else{
                $sql="INSERT into bed (BedID,Level,Cost,Availability) VALUES ('$bedNum','$bedLevel','$cost', TRUE)";
                mysqli_query($conn,$sql);
            }

        }
        else if($bedInsertType=="number"){
            $sql="SELECT max(BedID) from bed where Level='$bedLevel'";
            $result=mysqli_query($conn,$sql);
            $row=mysqli_fetch_array($result);
            $max=$row['max(BedID)'];
            for ($x = 1; $x <= $bedNum; $x++) {
                $bedNo=$max+$x;
                $sql="INSERT into bed (BedID,Level,Cost,Availability) VALUES ('$bedNo','$bedLevel','$cost',TRUE)";
                mysqli_query($conn,$sql);
              }
        }

        ?>
