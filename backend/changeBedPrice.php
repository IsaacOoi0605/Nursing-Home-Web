<?php

        $server="localhost";
        $user="root";
        $password="";
        $db="management";
        $conn = mysqli_connect($server,$user,$password,$db);
        $bedLevel=$_POST["bedSeries"];
        $bedPrice=$_POST["bedPrice"];
        $sql="UPDATE bed SET Cost='$bedPrice' WHERE Level='$bedLevel'";
        mysqli_query($conn,$sql);

        ?>
