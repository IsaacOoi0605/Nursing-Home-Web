<?php

        $server="localhost";
        $user="root";
        $password="";
        $db="management";
        $conn = mysqli_connect($server,$user,$password,$db);
        $data=addslashes(file_get_contents($_FILES['img']['tmp_name']));
        $userPos=$_POST['posPHP'];
        $userName=$_POST['namePHP'];
        $userPass=$_POST['passPHP'];
        $sql="SELECT * FROM users WHERE username='$userName'";
        $result=mysqli_query($conn, $sql);
        $resultCheck = mysqli_num_rows($result);
        if($resultCheck>0){
            echo("1");  
        }
        else{
        $sql = "INSERT INTO users (username, password, position,image) VALUES ('$userName', '$userPass', '$userPos','{$data}')";
        $result= mysqli_query($conn, $sql);
        if($result){
            echo ($userPos.' insert successfully');
        }
        else{echo("0");}}
        exit();

    
?>