<?php

        $server="localhost";
        $user="root";
        $password="";
        $db="management";
        $conn = mysqli_connect($server,$user,$password,$db);
        $bedLevel=$_POST["bedSeries"];
        $bedID=$_POST["bedID"];
        $availability=$_POST["status"];
        if($availability=='available'){
            $sql="UPDATE bed SET Availability='1' where BedID='$bedID' and Level='$bedLevel'";
        }
        else if($availability=='not available'){
            $sql="UPDATE bed SET Availability='0' where BedID='$bedID' and Level='$bedLevel'";
        }
        if(mysqli_query($conn,$sql)){
            echo"bed status has been modified successfully";
        }
        ?>
