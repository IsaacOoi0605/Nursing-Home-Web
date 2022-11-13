<?php

        $server="localhost";
        $user="root";
        $password="";
        $db="management";
        $conn = mysqli_connect($server,$user,$password,$db);
        $id=$_POST['idPHP'];
        $pos=$_POST['posPHP'];
        $sql = "DELETE FROM users WHERE ID='$id' AND position='$pos'";
        $result= mysqli_query($conn, $sql);
        exit();

    
?>