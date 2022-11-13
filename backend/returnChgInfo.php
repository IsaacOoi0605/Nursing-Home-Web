<?php
    session_start();
    $server="localhost";
    $user="root";
    $password="";
    $db="management";
    $conn = mysqli_connect($server,$user,$password,$db);
    $uID=$_SESSION['id'];
    $hihi=password_hash('1234678',PASSWORD_DEFAULT);
    $ttt=password_verify('1234678',$hihi);
    $sql="SELECT * FROM users where ID='$uID'";
    $result= mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($result);
        $id=$username=$row['ID'];
        $username=$row['username'];
        echo("
        <label>Image:</label><br>
        <img class='img' src='data:image/jpeg;base64,".base64_encode($row['image'])."'height='80' width='100'/>
        <form id='form'>
        <input name='img' class='form-control mt-1' type='file' onchange='showImage(this);' accept='.png,.jpg'/></form>
        <div class='btn btn-primary saveImg d-none mt-1'>Save Image</div>
        <br><div class='form-group'>
        <label for='Name'>User ID:</label>
        <input type='text' class='form-control' id='ID' value=$id readonly>
      </div>
        <br><div class='form-group'>
        <label for='Name'>Username:</label>
        <input type='text' class='form-control' id='Name' value=$username readonly>
      </div>"
    );
        exit();    
?>
