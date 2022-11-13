<?php
        session_start();
        $idUser=$_POST['idPHP'];
        $posUser=$_POST['posPHP'];
        $server="localhost";
        $user="root";
        $password="";
        $db="management";
        $conn = mysqli_connect($server,$user,$password,$db);
        $sql = "SELECT * FROM users WHERE id ='$idUser'";
        $result= mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($result);
        $id=$username=$row['ID'];
        $username=$row['username'];
        echo("
        <label>Image:</label><br>
        <img src='data:image/jpeg;base64,".base64_encode($row['image'])."'height='80' width='100'/>
        <br><div class='form-group'>
        <label for='Name'>User ID:</label>
        <input type='text' class='form-control' id='ID' value=$id readonly>
      </div>
        <br><div class='form-group'>
        <label for='Name'>Username:</label>
        <input type='text' class='form-control' id='Name' value=$username readonly>
      </div>
      <br>

    <br>
    <br><div class='row'>
    <div class='col-4'></div>
    <div class='d-flex justify-content-center col-4'>
            <button type='button' class='btn btn-danger mx-auto w-10 reset' >Reset Password</button>
            <button type='button' class='btn btn-danger mx-auto w-10 del' >Remove $posUser</button>
            </div><div class='col-4'></div>
    </div>"
    );

        exit();

    
?>