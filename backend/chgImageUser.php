<?php
        session_start();
        $server="localhost";
        $user="root";
        $password="";
        $db="management";
        $conn = mysqli_connect($server,$user,$password,$db);
        $data=addslashes(file_get_contents($_FILES['img']['tmp_name']));
        $uID=$_SESSION['id'];
        $sql="UPDATE users SET image ='{$data}' where ID=$uID";
        $result= mysqli_query($conn, $sql);
        ?>