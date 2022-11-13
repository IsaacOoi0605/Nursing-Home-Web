<?php

    if(isset($_POST['login'])){
        $server="localhost";
        $user="root";
        $password="";
        $db="management";
        $conn = mysqli_connect($server,$user,$password,$db);
        $name=$_POST['namePHP'];
        $pass=$_POST['passPHP'];
        $sql = "SELECT * FROM users WHERE username='$name' AND password='$pass'";
        $result= mysqli_query($conn, $sql);
        $resultCheck = mysqli_num_rows($result);
        if($resultCheck>0){
          $row = mysqli_fetch_array($result);
          echo $row['ID'];
          $pos=$row['position'];
          session_start();
          $_SESSION["position"] = $row['position'];
          $_SESSION["id"] = $row['ID'];
          $_SESSION["username"] = $row['username'];
        }
        else{
          echo("0");
        }
        exit();

    }
?>