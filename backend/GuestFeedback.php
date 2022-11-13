<?php
        session_start();
        $server="localhost";
        $user="root";
        $password="";
        $db="management";
        $conn = mysqli_connect($server,$user,$password,$db);
        $des=$_POST['description'];
        $date=date("Y/m/d");
        if(isset($_SESSION["id"])){
            $id=$_SESSION["id"];
            $sql="INSERT INTO support_ticket (ID,description,date) VALUES ('$id', '$des', '$date')";
        }
        else{
            $sql="INSERT INTO support_ticket (description,date) VALUES ('$des', '$date')";
        }
        if(mysqli_query($conn,$sql)){
            echo 1;
        }
        exit();

    
?>