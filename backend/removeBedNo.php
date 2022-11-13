<?php

        $server="localhost";
        $user="root";
        $password="";
        $db="management";
        $conn = mysqli_connect($server,$user,$password,$db);
        $bedLevel=$_POST["bedSeries"];
        $bedID=$_POST["bedID"];
        $sql="DELETE from bed where BedID='$bedID' and Level='$bedLevel'";
        if(mysqli_query($conn,$sql)){
            echo("bed successfully removed");
        }
        ?>
