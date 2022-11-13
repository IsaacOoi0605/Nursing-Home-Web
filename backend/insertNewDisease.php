<?php

        $server="localhost";
        $user="root";
        $password="";
        $db="management";
        $conn = mysqli_connect($server,$user,$password,$db);
        $name=$_POST['namePHP'];
        $sql= "SELECT * from disease where Name='$name' and Available=0";
        $result=mysqli_query($conn, $sql);
        if(mysqli_num_rows($result)){
            $sql= "UPDATE disease SET Available=1 where Name='$name'";
            mysqli_query($conn, $sql);
        }
        else{
            $sql= "SELECT * from disease where Name='$name' and Available=1";
            $result= mysqli_query($conn, $sql);
            if(mysqli_num_rows($result)){
                echo 2;
            }
            else{
                $sql = "INSERT INTO disease (Name,Available) VALUES ('$name',TRUE)";
                mysqli_query($conn, $sql);
            }
        }
        exit();

    
?>