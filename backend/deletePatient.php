<?php

        $server="localhost";
        $user="root";
        $password="";
        $db="management";
        $conn = mysqli_connect($server,$user,$password,$db);
        $id=$_POST['idPHP'];
        $sql = "DELETE FROM patient WHERE patientID='$id'";
        $result= mysqli_query($conn, $sql);
        exit();

    
?>