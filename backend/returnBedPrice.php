<?php

        $server="localhost";
        $user="root";
        $password="";
        $db="management";
        $conn = mysqli_connect($server,$user,$password,$db);
        $bedLevel=$_POST["bedSeries"];
        $sql="SELECT Cost from bed where Level='$bedLevel'";
        $result=mysqli_query($conn,$sql);
        $row=mysqli_fetch_array($result);
        echo $row['Cost'];
        ?>
