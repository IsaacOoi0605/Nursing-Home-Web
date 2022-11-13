<?php
        session_start();
        $server="localhost";
        $user="root";
        $password="";
        $db="management";
        $conn = mysqli_connect($server,$user,$password,$db);
        //get user id from the session
        $id=$_SESSION['id'];
        //verifying old password from database
        if(isset($_POST['modifyTest'])){
        $oldPass=$_POST['oldPassPHP'];
        $sql = "SELECT password FROM users WHERE ID='$id' AND password='$oldPass'";
        $result=mysqli_query($conn, $sql);
        $resultCheck = mysqli_num_rows($result);
        //if password correct
        if($resultCheck>0){
          echo("1");
        }
        else{
          echo("0");
        }}
        else{
        $newPass=$_POST['newPassPHP'];
        $sql = "UPDATE users SET password =$newPass WHERE ID='$id'";
        $result= mysqli_query($conn, $sql);
        }
        exit();

    

?>